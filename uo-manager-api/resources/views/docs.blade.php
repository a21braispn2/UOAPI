<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Fragment+Mono:ital@0;1&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon_api.ico') }}" type="image/x-icon">
    <title>UO API - Docs</title>
    <style>
        /* ══════════════ TOKENS ══════════════ */
        :root {
            --principal:  #E6FB04;
            --cta1:       #0CE4E8;
            --cta2:       #FFA341;
            --estado1:    #748F45;
            --estado2r:   #B64F4F;
            --estado2y:   #E2B952;
            --sec1:       #F5F5F3;
            --sec2:       #416060;

            /* dark theme (default) */
            --bg:         #0c1616;
            --bg2:        #122020;
            --surface:    #162626;
            --border:     #1e3535;
            --text:       #eef2f2;
            --muted:      #547070;
            --accent:     var(--principal);
            --accent2:    var(--cta1);
            --shadow:     var(--principal);
            --nav-bg:     rgba(12,22,22,.94);

            --font-display: 'Syne', sans-serif;
            --font-mono:    'Fragment Mono', monospace;
        }

        :root.light {
            --bg:         #F5F5F3;
            --bg2:        #ebebea;
            --surface:    #ffffff;
            --border:     #c8ccc8;
            --text:       #1a2e2e;
            --muted:      #7a9090;
            --accent:     var(--sec2);
            --accent2:    var(--estado1);
            --shadow:     var(--sec2);
            --nav-bg:     rgba(245,245,243,.94);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--font-mono);
            font-size: 13px;
            min-height: 100vh;
            overflow-x: hidden;
            transition: background .3s, color .3s;
        }

        /* ── diagonal stripe bg ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: repeating-linear-gradient(
                -45deg,
                transparent,
                transparent 28px,
                rgba(255,255,255,.012) 28px,
                rgba(255,255,255,.012) 29px
            );
            pointer-events: none;
            z-index: 0;
        }

        :root.light body::before {
            background-image: repeating-linear-gradient(
                -45deg,
                transparent,
                transparent 28px,
                rgba(0,0,0,.025) 28px,
                rgba(0,0,0,.025) 29px
            );
        }

        /* ══════════════ NAV ══════════════ */
        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: stretch;
            height: 56px;
            background: var(--nav-bg);
            backdrop-filter: blur(16px);
            border-bottom: 2px solid var(--border);
            transition: background .3s, border-color .3s;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 24px;
            border-right: 2px solid var(--border);
        }

        .nav-brand-icon {
            width: 40px;
            height: 30px;
            background: var(--principal);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 13px;
            color: #0c1616;
            flex-shrink: 0;
        }

        .nav-brand h1 {
            font-family: var(--font-display);
            font-size: 15px;
            font-weight: 800;
            letter-spacing: .04em;
            color: var(--text);
            text-transform: uppercase;
            transition: color .3s;
        }

        .nav-status {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 0 20px;
            border-right: 2px solid var(--border);
            font-size: 10px;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--estado1);
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--estado1);
            animation: blink 2.2s ease-in-out infinite;
        }

        @keyframes blink {
            0%,100% { opacity:1; }
            50%      { opacity:.35; }
        }

        nav ul {
            display: flex;
            list-style: none;
            margin-left: auto;
        }

        nav ul li a {
            display: flex;
            align-items: center;
            height: 56px;
            padding: 0 20px;
            color: var(--muted);
            text-decoration: none;
            font-family: var(--font-mono);
            font-size: 10px;
            letter-spacing: .12em;
            text-transform: uppercase;
            border-left: 2px solid var(--border);
            transition: color .2s, background .2s;
        }

        nav ul li a:hover, nav ul li a.active {
            color: var(--text);
            background: var(--surface);
        }
        
        nav ul li a.active {
            color: var(--principal);
        }
        
        :root.light nav ul li a.active {
            color: var(--sec2);
        }

        /* ── theme toggle btn ── */
        .theme-btn {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 0 20px;
            border: none;
            border-left: 2px solid var(--border);
            background: transparent;
            color: var(--muted);
            font-family: var(--font-mono);
            font-size: 10px;
            letter-spacing: .12em;
            text-transform: uppercase;
            cursor: pointer;
            transition: color .2s, background .2s;
        }

        .theme-btn:hover { color: var(--text); background: var(--surface); }

        .tb-track {
            width: 34px;
            height: 18px;
            border-radius: 3px;
            border: 2px solid var(--border);
            background: var(--bg);
            position: relative;
            transition: background .3s, border-color .3s;
        }

        .tb-thumb {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 10px;
            height: 10px;
            background: var(--muted);
            border-radius: 1px;
            transition: transform .3s cubic-bezier(.34,1.56,.64,1), background .3s;
        }

        :root.light .tb-track { background: var(--principal); border-color: var(--sec2); }
        :root.light .tb-thumb { transform: translateX(14px); background: var(--sec2); }

        /* ══════════════ LAYOUT ══════════════ */
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 52px 24px 80px;
            position: relative;
            z-index: 1;
        }

        /* ══════════════ HERO ══════════════ */
        .hero {
            display: flex;
            flex-direction: column;
            border: 2px solid var(--border);
            background: var(--surface);
            margin-bottom: 36px;
            box-shadow: 5px 5px 0 var(--shadow);
            transition: background .3s, border-color .3s, box-shadow .3s;
            visibility: hidden;
            padding: 36px 40px;
        }

        .hero-tag {
            display: inline-block;
            font-size: 9px;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: #0c1616;
            background: var(--principal);
            padding: 3px 10px;
            margin-bottom: 20px;
            font-family: var(--font-mono);
            align-self: flex-start;
        }

        .hero h2 {
            font-family: var(--font-display);
            font-size: 42px;
            font-weight: 800;
            line-height: .95;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: -.02em;
            margin-bottom: 14px;
            transition: color .3s;
        }

        .hero h2 em {
            font-style: normal;
            color: var(--cta1);
        }

        :root.light .hero h2 em { color: var(--sec2); }

        .hero-sub {
            font-size: 12px;
            color: var(--muted);
            line-height: 1.7;
            max-width: 600px;
        }

        /* ══════════════ SECTIONS ══════════════ */
        .section-label {
            display: flex;
            align-items: center;
            gap: 0;
            margin-bottom: 16px;
            visibility: hidden;
        }

        .section-label span {
            font-family: var(--font-display);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--text);
            background: var(--bg2);
            border: 2px solid var(--border);
            padding: 6px 16px;
            transition: all .3s;
        }

        .section-label::after {
            content: '';
            flex: 1;
            height: 2px;
            background: var(--border);
            transition: background .3s;
        }

        /* ══════════════ DOCS COMPONENT ══════════════ */
        .doc-section {
            margin-bottom: 40px;
        }

        .doc-card {
            border: 2px solid var(--border);
            background: var(--surface);
            padding: 28px 32px;
            box-shadow: 5px 5px 0 var(--border);
            transition: background .3s, border-color .3s, box-shadow .3s;
            visibility: hidden;
        }

        .doc-card h3 {
            font-family: var(--font-display);
            font-size: 20px;
            font-weight: 700;
            color: var(--cta1);
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: .02em;
            transition: color .3s;
        }

        :root.light .doc-card h3 { color: var(--sec2); }

        .doc-card p {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .inline-code {
            background: var(--bg2);
            color: var(--text);
            padding: 2px 6px;
            border-radius: 3px;
            border: 1px solid var(--border);
            font-family: var(--font-mono);
            font-size: 11.5px;
            transition: background .3s, color .3s, border-color .3s;
        }
        
        .code-block-wrap {
            position: relative;
            background: var(--bg);
            border: 2px solid var(--border);
            padding: 20px;
            transition: background .3s, border-color .3s;
        }

        .code-block-wrap pre {
            margin: 0;
            font-family: var(--font-mono);
            font-size: 12px;
            color: var(--text);
            line-height: 1.5;
            white-space: pre-wrap;
            transition: color .3s;
        }

        .c-kw { color: var(--cta1); }
        .c-str { color: var(--estado1); }
        .c-num { color: var(--cta2); }
        .c-comment { color: var(--muted); }
        
        :root.light .c-kw { color: #0088cc; }
        :root.light .c-str { color: #1e7a4b; }
        :root.light .c-num { color: #d66400; }

        /* ══════════════ COPY BUTTON ══════════════ */
        .copy-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 5px 12px;
            font-family: var(--font-mono);
            font-size: 9px;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
            background: var(--bg2);
            border: 2px solid var(--border);
            cursor: pointer;
            transition: color .2s, border-color .2s, background .3s;
            will-change: transform;
        }

        .copy-btn:hover {
            color: var(--principal);
            border-color: var(--principal);
        }

        :root.light .copy-btn:hover {
            color: var(--sec2);
            border-color: var(--sec2);
        }

        .copy-btn.copied {
            color: var(--estado1);
            border-color: var(--estado1);
        }

        /* ══════════════ FOOTER ══════════════ */
        footer {
            border-top: 2px solid var(--border);
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 10px;
            color: var(--muted);
            letter-spacing: .1em;
            position: relative;
            z-index: 1;
            transition: border-color .3s;
            visibility: hidden;
        }

        .footer-accent {
            width: 28px;
            height: 4px;
            background: var(--principal);
            border-radius: 1px;
        }

        /* ══════════════ RESPONSIVE ══════════════ */
        @media (max-width: 640px) {
            .hero { padding: 24px; }
            .doc-card { padding: 20px; }
            .theme-btn span:last-child { display: none; }
            nav ul li:not(:last-child) a { display: none; }
            .copy-btn { padding: 4px 8px; }
        }
    </style>
</head>
<body>

    <nav>
        <div class="nav-brand">
            <div class="nav-brand-icon">UO</div>
            <h1>API</h1>
        </div>
        <div class="nav-status">
            <span class="status-dot"></span>
            Operational
        </div>
        <ul>
            <li><a href="/api">API</a></li>
            <li><a href="/docs" class="active">Docs</a></li>
            <li><a href="/debug">Debug</a></li>
        </ul>
        <button class="theme-btn" id="themeBtn">
            <span>☽</span>
            <div class="tb-track"><div class="tb-thumb"></div></div>
            <span>☀</span>
        </button>
    </nav>

    <div class="container">

        {{-- ── HERO ── --}}
        <div class="hero">
            <div class="hero-tag">// reference</div>
            <h2>Guides &amp; <em>Docs</em></h2>
            <p class="hero-sub">Learn how to authenticate, format requests, and handle API responses effectively.</p>
        </div>

        {{-- ── SECTIONS ── --}}
        <div class="doc-section">
            <div class="section-label"><span>01. Authentication</span></div>
            <div class="doc-card">
                <h3>Bearer Token</h3>
                <p>All endpoints require a valid API key sent via the <code class="inline-code">Authorization</code> header. Your API keys carry many privileges, be sure to keep them incredibly secure.</p>
                <div class="code-block-wrap">
                    <button class="copy-btn copy-code" data-code="Authorization: Bearer YOUR_API_KEY">Copy</button>
                    <pre><code><span class="c-kw">Authorization</span>: Bearer <span class="c-str">YOUR_API_KEY</span></code></pre>
                </div>
            </div>
        </div>

        <div class="doc-section">
            <div class="section-label"><span>02. General Headers</span></div>
            <div class="doc-card">
                <h3>Request Format</h3>
                <p>The UO API expects and returns data strictly in JSON format. You must always specify the <code class="inline-code">Accept</code> and <code class="inline-code">Content-Type</code> headers.</p>
                <div class="code-block-wrap">
                    <button class="copy-btn copy-code" data-code="Accept: application/json&#10;Content-Type: application/json">Copy</button>
                    <pre><code><span class="c-kw">Accept</span>: application/json
<span class="c-kw">Content-Type</span>: application/json</code></pre>
                </div>
            </div>
        </div>

        <div class="doc-section">
            <div class="section-label"><span>03. Pagination</span></div>
            <div class="doc-card">
                <h3>Offset &amp; Limit</h3>
                <p>When fetching lists (like <code class="inline-code">/users</code>), the API enforces pagination to guarantee fast responses. Use the query parameters <code class="inline-code">page</code> and <code class="inline-code">per_page</code>.</p>
                <div class="code-block-wrap">
                    <button class="copy-btn copy-code" data-code="GET /api/v1/users?page=2&per_page=15">Copy</button>
                    <pre><code><span class="c-comment">// Example request to get the second page with 15 items per page</span>
<span class="c-kw">GET</span> /api/v1/users?page=<span class="c-num">2</span>&per_page=<span class="c-num">15</span></code></pre>
                </div>
            </div>
        </div>

        <div class="doc-section">
            <div class="section-label"><span>04. Response Errors</span></div>
            <div class="doc-card">
                <h3>Standard Envelope</h3>
                <p>Successful responses return a 2xx status code. Errors return a proper 4xx or 5xx code alongside a structured JSON envelope showing the underlying cause.</p>
                <div class="code-block-wrap">
                    <button class="copy-btn copy-code" data-code='{
  "success": false,
  "message": "Resource not found",
  "errors": {
    "id": ["The provided ID format is invalid."]
  }
}'>Copy</button>
                    <pre><code>{
  <span class="c-str">"success"</span>: <span class="c-kw">false</span>,
  <span class="c-str">"message"</span>: <span class="c-str">"Resource not found"</span>,
  <span class="c-str">"errors"</span>: {
    <span class="c-str">"id"</span>: [<span class="c-str">"The provided ID format is invalid."</span>]
  }
}</code></pre>
                </div>
            </div>
        </div>

    </div>

    <footer>
        <span>UO API Docs &copy; {{ date('Y') }}</span>
        <div class="footer-accent"></div>
        <span>v1.0.0</span>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/ScrollTrigger.min.js"></script>
    <script>
        // ══════════════ THEME ══════════════
        const html = document.documentElement;
        const btn  = document.getElementById('themeBtn');
        if (localStorage.getItem('uo-theme') === 'light') html.classList.add('light');
        btn.addEventListener('click', () => {
            html.classList.toggle('light');
            localStorage.setItem('uo-theme', html.classList.contains('light') ? 'light' : 'dark');
        });

        // ══════════════ GSAP ENGINE ══════════════
        gsap.registerPlugin(ScrollTrigger);
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (prefersReduced) gsap.globalTimeline.timeScale(0);

        // ── 1. NAV reveal ──
        gsap.from('nav', {
            yPercent: -100,
            autoAlpha: 0,
            duration: .6,
            ease: 'expo.out',
            clearProps: 'all'
        });

        // ── 2. HERO timeline ──
        const heroTl = gsap.timeline({ defaults: { ease: 'expo.out' } });
        heroTl
            .from('.hero',      { y: 32, autoAlpha: 0, duration: .7 })
            .from('.hero-tag',  { x: -20, autoAlpha: 0, duration: .5 }, '<.15')
            .from('.hero h2',   { y: 20, autoAlpha: 0, duration: .6 }, '<.1')
            .from('.hero-sub',  { y: 12, autoAlpha: 0, duration: .5 }, '<.1');

        // ── 3. DOC LABELS — ScrollTrigger reveal ──
        gsap.utils.toArray('.section-label').forEach(el => {
            gsap.from(el, {
                scrollTrigger: { trigger: el, start: 'top 88%', toggleActions: 'play none none none' },
                x: -24, autoAlpha: 0, duration: .55, ease: 'power3.out'
            });
        });

        // ── 4. DOC CARDS — Staggering Elements ──
        gsap.utils.toArray('.doc-card').forEach(card => {
            // First reveal the card wrapper
            gsap.from(card, {
                scrollTrigger: { trigger: card, start: 'top 85%', toggleActions: 'play none none none' },
                autoAlpha: 0, y: 24, duration: .6, ease: 'power2.out',
                clearProps: 'transform'
            });

            // Then stagger its inner content: h3, p, and code-block
            const children = card.querySelectorAll('h3, p, .code-block-wrap');
            gsap.from(children, {
                scrollTrigger: { trigger: card, start: 'top 82%', toggleActions: 'play none none none' },
                y: 16, autoAlpha: 0, stagger: .1, duration: .5, ease: 'power3.out',
                clearProps: 'transform'
            });
        });

        // ── 5. FOOTER fade ──
        gsap.from('footer', {
            scrollTrigger: { trigger: 'footer', start: 'top 95%', toggleActions: 'play none none none' },
            autoAlpha: 0, y: 12, duration: .6, ease: 'power2.out'
        });

        // ══════════════ MAGNETIC / COPY BUTTONS ══════════════
        document.querySelectorAll('.copy-btn').forEach(b => {
            // magnetic hover
            b.addEventListener('mousemove', e => {
                const rect = b.getBoundingClientRect();
                const dx = e.clientX - (rect.left + rect.width  / 2);
                const dy = e.clientY - (rect.top  + rect.height / 2);
                gsap.to(b, { x: dx * .25, y: dy * .35, duration: .3, ease: 'power2.out' });
            });
            b.addEventListener('mouseleave', () => {
                gsap.to(b, { x: 0, y: 0, duration: .6, ease: 'elastic.out(1,.4)' });
            });
            // click: copy code + ripple
            b.addEventListener('click', () => {
                const code = b.dataset.code;
                navigator.clipboard?.writeText(code);
                gsap.timeline()
                    .to(b, { scale: .9, duration: .1, ease: 'power1.in' })
                    .to(b, { scale: 1,  duration: .55, ease: 'elastic.out(1,.4)' });
                b.textContent = '✓';
                b.classList.add('copied');
                setTimeout(() => { b.textContent = 'Copy'; b.classList.remove('copied'); }, 1400);
            });
        });
    </script>
</body>
</html>
