=============================================
  SEO ANALYZER - Vercel Backend (Node.js)
=============================================

WHERE TO DEPLOY:
  Vercel (https://vercel.com) or any Node.js host

HOW TO DEPLOY ON VERCEL:
  1. Push this folder to a GitHub/GitLab repository
  2. Go to https://vercel.com and sign in
  3. Click "Add New" → "Project"
  4. Import your repository
  5. Set the Root Directory to this folder if needed
  6. Click "Deploy"
  7. Copy the URL Vercel gives you (e.g. https://your-app.vercel.app)

AFTER DEPLOYING:
  Update the SEO tool endpoint in your WordPress theme:
  - Open page-templates/seo-tool.php in the theme
  - Replace "http://localhost:3000/api/audit" with your Vercel URL
  - Example: "https://your-app.vercel.app/api/audit"

NOTES:
  - This is a standalone Node.js/Express backend
  - It does NOT go inside WordPress
  - It powers the SEO audit tool page on your website
  - Vercel will run "npm install" automatically (no node_modules needed)
