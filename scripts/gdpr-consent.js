(function () {
    var CONSENT_KEY = 'gdpr_consent';
    var GA_ID       = 'G-1DQQSD51V4';
    var CLARITY_ID  = 'rcxnkrgboo';
    var YANDEX_ID   = '105402705';
    var ADSENSE_ID  = 'ca-pub-4198904821948931';

    // ── Script loaders ──────────────────────────────────────────────────────
    function loadGA() {
        var s = document.createElement('script');
        s.async = true;
        s.src = 'https://www.googletagmanager.com/gtag/js?id=' + GA_ID;
        document.head.appendChild(s);
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        window.gtag = gtag;
        gtag('js', new Date());
        gtag('config', GA_ID);
    }

    function loadClarity() {
        (function (c, l, a, r, i, t, y) {
            c[a] = c[a] || function () { (c[a].q = c[a].q || []).push(arguments); };
            t = l.createElement(r); t.async = 1;
            t.src = 'https://www.clarity.ms/tag/' + i + '?ref=bwt';
            y = l.getElementsByTagName(r)[0]; y.parentNode.insertBefore(t, y);
        })(window, document, 'clarity', 'script', CLARITY_ID);
    }

    function loadYandex() {
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () { (m[i].a = m[i].a || []).push(arguments); };
            m[i].l = 1 * new Date();
            for (var j = 0; j < document.scripts.length; j++) {
                if (document.scripts[j].src === r) { return; }
            }
            k = e.createElement(t); a = e.getElementsByTagName(t)[0];
            k.async = 1; k.src = r; a.parentNode.insertBefore(k, a);
        })(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js?id=' + YANDEX_ID, 'ym');
        ym(YANDEX_ID, 'init', {
            ssr: true, webvisor: true, clickmap: true,
            ecommerce: 'dataLayer', accurateTrackBounce: true, trackLinks: true
        });
    }

    function loadAdSense() {
        var s = document.createElement('script');
        s.async = true;
        s.src = 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=' + ADSENSE_ID;
        s.setAttribute('crossorigin', 'anonymous');
        document.head.appendChild(s);
    }

    function loadAllTracking() {
        loadGA();
        loadClarity();
        loadYandex();
        loadAdSense();
    }

    // ── Check prior consent ──────────────────────────────────────────────────
    var consent;
    try { consent = localStorage.getItem(CONSENT_KEY); } catch (e) { consent = null; }

    if (consent === 'accepted') {
        loadAllTracking();
        return;
    }

    if (consent === 'declined') {
        return;
    }

    // ── No prior decision — show banner ──────────────────────────────────────
    function injectStyles() {
        var css = [
            '#gdpr-banner{position:fixed;bottom:0;left:0;right:0;background:#1a1a2e;color:#d4d4d4;',
            'padding:14px 24px;z-index:999999;display:flex;align-items:center;justify-content:space-between;',
            'gap:14px;box-shadow:0 -3px 16px rgba(0,0,0,.35);font-family:Inter,sans-serif;font-size:13.5px;',
            'flex-wrap:wrap;line-height:1.5;}',
            '#gdpr-banner a{color:#7ca8d6;text-decoration:underline;}',
            '#gdpr-banner-text{flex:1;min-width:220px;}',
            '#gdpr-banner-btns{display:flex;gap:8px;flex-shrink:0;}',
            '#gdpr-accept{background:#4a6fa5;color:#fff;border:none;padding:8px 18px;border-radius:6px;',
            'cursor:pointer;font-size:13.5px;font-weight:600;white-space:nowrap;}',
            '#gdpr-accept:hover{background:#3a5a8f;}',
            '#gdpr-decline{background:transparent;color:#aaa;border:1px solid #555;padding:8px 18px;',
            'border-radius:6px;cursor:pointer;font-size:13.5px;white-space:nowrap;}',
            '#gdpr-decline:hover{color:#ddd;border-color:#888;}',
            '@media(max-width:600px){#gdpr-banner{flex-direction:column;align-items:flex-start;}',
            '#gdpr-banner-btns{width:100%;}',
            '#gdpr-accept,#gdpr-decline{flex:1;text-align:center;}}'
        ].join('');
        var style = document.createElement('style');
        style.textContent = css;
        document.head.appendChild(style);
    }

    function showBanner() {
        injectStyles();
        var banner = document.createElement('div');
        banner.id = 'gdpr-banner';
        banner.setAttribute('role', 'dialog');
        banner.setAttribute('aria-label', 'Cookie consent');
        banner.innerHTML =
            '<div id="gdpr-banner-text">' +
            'We use cookies for analytics and advertising to keep this site free. ' +
            'By clicking <strong>Accept All</strong> you consent to Google Analytics, ' +
            'Google AdSense, Microsoft Clarity, and Yandex Metrica. ' +
            'See our <a href="/privacy-policy/">Privacy Policy</a>.' +
            '</div>' +
            '<div id="gdpr-banner-btns">' +
            '<button id="gdpr-decline">Decline</button>' +
            '<button id="gdpr-accept">Accept All</button>' +
            '</div>';
        document.body.appendChild(banner);

        document.getElementById('gdpr-accept').addEventListener('click', function () {
            try { localStorage.setItem(CONSENT_KEY, 'accepted'); } catch (e) {}
            banner.remove();
            loadAllTracking();
        });

        document.getElementById('gdpr-decline').addEventListener('click', function () {
            try { localStorage.setItem(CONSENT_KEY, 'declined'); } catch (e) {}
            banner.remove();
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', showBanner);
    } else {
        showBanner();
    }

    // ── Public API: allow users to re-open consent settings ──────────────────
    window.openCookieSettings = function () {
        try { localStorage.removeItem(CONSENT_KEY); } catch (e) {}
        // Remove any existing banner first
        var existing = document.getElementById('gdpr-banner');
        if (existing) { existing.remove(); }
        showBanner();
    };

})();
