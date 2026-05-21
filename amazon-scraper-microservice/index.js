const express = require('express');
const cors = require('cors');
const axios = require('axios');
const cheerio = require('cheerio');
const UserAgent = require('user-agents');

const app = express();
app.use(cors());
app.use(express.json());

function extractPrice($) {
  const priceSelectors = [
    '.a-price.a-text-price.header-price.a-size-base.a-text-normal .a-offscreen',
    '#priceblock_ourprice',
    '#priceblock_dealprice',
    '.a-price .a-offscreen',
    '#corePrice_feature_div .a-offscreen',
    '.a-color-price'
  ];

  for (const selector of priceSelectors) {
    const priceElement = $(selector).first();
    if (priceElement.length > 0) {
      return priceElement.text().trim();
    }
  }
  return null;
}

// 1. Endpoint: Scrape single product by ASIN or URL
app.get('/api/scrape', async (req, res) => {
  const { asin, url } = req.query;
  
  if (!asin && !url) {
    return res.status(400).json({ error: 'Please provide an ASIN or an Amazon URL' });
  }

  const targetUrl = url || `https://www.amazon.com/dp/${asin}`;

  try {
    const userAgent = new UserAgent({ deviceCategory: 'desktop' }).toString();
    const response = await axios.get(targetUrl, {
      headers: {
        'User-Agent': userAgent,
        'Accept': 'text/html,application/xhtml+xml',
        'Accept-Language': 'en-US,en;q=0.9',
        'Referer': 'https://www.google.com/'
      },
      timeout: 10000
    });

    const $ = cheerio.load(response.data);

    if ($('form[action="/errors/validateCaptcha"]').length > 0) {
      return res.status(429).json({ error: 'Amazon Anti-Bot Triggered.' });
    }

    const title = $('#productTitle').text().trim();
    const price = extractPrice($);
    const image = $('#landingImage').attr('src') || $('#imgBlkFront').attr('src');
    const ratingElement = $('#acrPopover .a-icon-alt').first().text();
    const rating = ratingElement ? ratingElement.split(' ')[0] : null;

    res.json({ success: true, data: { asin, title, price, image, rating, url: targetUrl } });

  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch data.', details: error.message });
  }
});

// 2. Endpoint: ADVANCED SEARCH by Keyword (Like Hostinger Plugin)
app.get('/api/search', async (req, res) => {
  const { q } = req.query;
  
  if (!q) {
    return res.status(400).json({ error: 'Please provide a search keyword (q).' });
  }

  const searchUrl = `https://www.amazon.com/s?k=${encodeURIComponent(q)}`;

  try {
    const userAgent = new UserAgent({ deviceCategory: 'desktop' }).toString();
    const response = await axios.get(searchUrl, {
      headers: {
        'User-Agent': userAgent,
        'Accept': 'text/html,application/xhtml+xml',
        'Accept-Language': 'en-US,en;q=0.9',
        'Referer': 'https://www.amazon.com/'
      },
      timeout: 15000
    });

    const $ = cheerio.load(response.data);
    const products = [];

    // Parse Amazon's search result grid
    $('.s-result-item[data-asin]').each((i, element) => {
      const asin = $(element).attr('data-asin');
      if (!asin) return; // Skip non-product items (like ads or containers)

      const title = $(element).find('h2 a span').text().trim();
      const image = $(element).find('.s-image').attr('src');
      
      // Look for the price element within the search card
      const priceWhole = $(element).find('.a-price-whole').first().text().replace('.', '').trim();
      const priceFraction = $(element).find('.a-price-fraction').first().text().trim();
      const symbol = $(element).find('.a-price-symbol').first().text().trim() || '$';
      
      let price = null;
      if (priceWhole) {
        price = `${symbol}${priceWhole}.${priceFraction || '00'}`;
      }

      const ratingText = $(element).find('.a-icon-alt').text().trim();
      const rating = ratingText ? ratingText.split(' ')[0] : null;

      // Only push if it's a valid product with a title and image
      if (title && image) {
        products.push({
          asin,
          title,
          price,
          image,
          rating,
          url: `https://www.amazon.com/dp/${asin}`
        });
      }
    });

    res.json({
      success: true,
      keyword: q,
      total_found: products.length,
      data: products
    });

  } catch (error) {
    console.error('Search Scrape Error:', error.message);
    res.status(500).json({ error: 'Failed to search Amazon.', details: error.message });
  }
});

app.get('/', (req, res) => res.json({ status: 'Tabaix Amazon API is running. Endpoints: /api/scrape, /api/search' }));

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => console.log(`Scraper microservice listening on port ${PORT}`));
