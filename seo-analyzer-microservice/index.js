const express = require('express');
const cors = require('cors');
const axios = require('axios');
const cheerio = require('cheerio');

const app = express();
app.use(cors());
app.use(express.json());

app.get('/api/audit', async (req, res) => {
  const { url } = req.query;

  if (!url) {
    return res.status(400).json({ error: 'Please provide a valid URL to analyze.' });
  }

  // Ensure URL has http/https
  let targetUrl = url;
  if (!/^https?:\/\//i.test(targetUrl)) {
    targetUrl = 'https://' + targetUrl;
  }

  try {
    const startTime = Date.now();
    const response = await axios.get(targetUrl, {
      headers: {
        'User-Agent': 'Tabaix-SEO-Bot/1.0 (Compatible; +https://yourwebsite.com)',
        'Accept': 'text/html,application/xhtml+xml'
      },
      timeout: 10000
    });
    const fetchTime = Date.now() - startTime;

    const $ = cheerio.load(response.data);

    // 1. Title Analysis
    const title = $('title').text().trim();
    const titleLength = title.length;
    let titleScore = 100;
    if (titleLength === 0) titleScore = 0;
    else if (titleLength < 30 || titleLength > 60) titleScore = 50;

    // 2. Meta Description Analysis
    const metaDesc = $('meta[name="description"]').attr('content') || '';
    const descLength = metaDesc.length;
    let descScore = 100;
    if (descLength === 0) descScore = 0;
    else if (descLength < 120 || descLength > 160) descScore = 60;

    // 3. Headings Hierarchy
    const h1Count = $('h1').length;
    const h2Count = $('h2').length;
    const h3Count = $('h3').length;
    let headingScore = 100;
    if (h1Count === 0) headingScore -= 40;
    if (h1Count > 1) headingScore -= 20; // Best practice is 1 H1
    if (h2Count === 0) headingScore -= 20;

    // 4. Image Alt Attributes
    const images = $('img');
    const totalImages = images.length;
    let imagesWithAlt = 0;
    images.each((i, img) => {
      if ($(img).attr('alt') && $(img).attr('alt').trim().length > 0) {
        imagesWithAlt++;
      }
    });
    const missingAlt = totalImages - imagesWithAlt;
    const imageScore = totalImages > 0 ? Math.round((imagesWithAlt / totalImages) * 100) : 100;

    // 5. Link Analysis
    const links = $('a');
    let internalLinks = 0;
    let externalLinks = 0;
    const targetDomain = new URL(targetUrl).hostname.replace('www.', '');

    links.each((i, a) => {
      const href = $(a).attr('href');
      if (href) {
        if (href.startsWith('#') || href.startsWith('javascript:')) return;
        if (href.startsWith('/') || href.includes(targetDomain)) {
          internalLinks++;
        } else if (href.startsWith('http')) {
          externalLinks++;
        }
      }
    });

    // 6. Word Count (Rough Estimate)
    const textContent = $('body').text().replace(/\s+/g, ' ').trim();
    const wordCount = textContent.split(' ').length;
    const contentScore = wordCount > 500 ? 100 : (wordCount / 500) * 100;

    // Calculate Overall SEO Score
    const overallScore = Math.round(
      (titleScore * 0.25) + 
      (descScore * 0.20) + 
      (headingScore * 0.20) + 
      (imageScore * 0.15) + 
      (contentScore * 0.20)
    );

    res.json({
      success: true,
      url: targetUrl,
      overall_score: overallScore,
      performance: {
        load_time_ms: fetchTime
      },
      content: {
        word_count: wordCount
      },
      meta: {
        title: { text: title, length: titleLength, score: titleScore },
        description: { text: metaDesc, length: descLength, score: descScore }
      },
      headings: {
        h1: h1Count,
        h2: h2Count,
        h3: h3Count,
        score: Math.max(0, headingScore)
      },
      images: {
        total: totalImages,
        missing_alt: missingAlt,
        score: imageScore
      },
      links: {
        internal: internalLinks,
        external: externalLinks
      }
    });

  } catch (error) {
    console.error('Audit Error:', error.message);
    res.status(500).json({ error: 'Failed to analyze URL. Ensure the site is accessible and not blocking bots.', details: error.message });
  }
});

app.get('/', (req, res) => res.json({ status: 'Tabaix SEO Audit API is running.' }));

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => console.log(`SEO Analyzer listening on port ${PORT}`));
