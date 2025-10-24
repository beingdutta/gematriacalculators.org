<!DOCTYPE html>
<html lang="en" data-theme="light">

  <head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1DQQSD51V4"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-1DQQSD51V4');
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact Free Gematria Calculator Online - Get support, provide feedback, or ask questions about our numerology calculation tools.">
    <meta name="keywords" content="contact gematria calculator, gematria calculator support, numerology tool help, biblical numerology contact">
    <title>Contact Free Gematria Calculator Online</title>
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link rel="canonical" href="https://gematriacalculators.org/contact-us/">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/styles/contact-us.css">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4198904821948931"
     crossorigin="anonymous"></script>

  </head>

  <body>
    <nav class="header-nav">
        <a href="/">Home</a>
        <a href="/more-tools/">More Tools</a>
        <a href="/blog-collections/">Blog</a>
        <a href="/about-us/">About Us</a>
        <a href="/contact-us/">Contact Us</a>
        <a href="/terms-conditions/">Terms & Conditions</a>
        <a href="/privacy-policy/">Privacy Policy</a>
        <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle theme">
          <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
          <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
        </button>
    </nav>
    <div class="container" style="padding-top: 2rem;">
      <header class="header">
        <h1>Contact Our Numerology Team</h1>
        <p class="subtitle">(We're Here to Help With All Gematria Calculator Inquiries)</p>
      </header>

      <main>
        <div class="result-card contact-page">
          <h4>How to Reach Us</h4>

          <div class="result-card">
            <h3>✉️ Email Support</h3>
            <p>For technical issues or calculator questions:<br>
              <strong>admins@gematriacalculators.org</strong></p>
          </div>

          <div class="result-card">
            <h3>📬 Spiritual Guidance</h3>
            <p>For numerology interpretations:<br>
              <strong>admins@gematriacalculators.org</strong></p>
          </div>

          <div class="contact-form">
            <h4>Send Us a Message</h4>
            <input type="text" id="contactName" placeholder="Your Name">
            <input type="email" id="contactEmail" placeholder="Your Email">
            <textarea id="contactMessage" placeholder="Type your message here..."></textarea>
            <button onclick="submitContactForm()">Send Message</button>
          </div>

          <div class="social-media-section">
            <h4>Follow Us</h4>
            <div class="social-icons">
              <a href="https://www.facebook.com/profile.php?id=61573578305569" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
              <a href="https://in.pinterest.com/GematriaCalculatorsOnline/" target="_blank" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
              <a href="https://x.com/AnnaBosle26323" target="_blank" aria-label="X"><i class="fab fa-twitter"></i></a>
            </div>
          </div>
        </div>
      </main>

      <footer class="footer">
        <!-- Footer links are now in the header nav -->
        <div class="copyright">
          © 2025 gematriacalculators.org
        </div>
      </footer>

      <div class="global-feedback-message" id="globalFeedback"></div>
    </div>

    <script src="/scripts/index.js"></script>
    <script>
      async function submitContactForm() {
        const name = document.getElementById('contactName').value.trim();
        const email = document.getElementById('contactEmail').value.trim();
        const message = document.getElementById('contactMessage').value.trim();
        const feedback = document.getElementById('globalFeedback');
        const button = document.querySelector('.contact-form button');

        if (!name || !email || !message) {
          feedback.textContent = "⚠️ Please fill all fields";
          feedback.style.display = 'block';
          setTimeout(() => feedback.style.display = 'none', 3000);
          return;
        }
        
        button.disabled = true;
        button.textContent = 'Sending...';

        try {
            const response = await fetch('/send-contact-email.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ name, email, message }),
            });

            const result = await response.json();

            if (response.ok) {
                feedback.textContent = "✓ Message sent successfully!";
                // Clear form
                document.getElementById('contactName').value = '';
                document.getElementById('contactEmail').value = '';
                document.getElementById('contactMessage').value = '';
            } else {
                throw new Error(result.message || 'Something went wrong.');
            }
        } catch (error) {
            feedback.textContent = `❌ Error: ${error.message}`;
        } finally {
            feedback.style.display = 'block';
            setTimeout(() => feedback.style.display = 'none', 4000);
            button.disabled = false;
            button.textContent = 'Send Message';
        }
      }
    </script>
  </body>
</html>
