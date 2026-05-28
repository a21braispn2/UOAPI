<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Fragment+Mono:ital@0;1&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon_api.ico') }}" type="image/x-icon">
    <title>UO API - Debug</title>
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
            color: var(--cta2);
        }

        :root.light .hero h2 em { color: var(--estado2r); }

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

        /* ══════════════ DEBUG UI ══════════════ */
        .debug-warn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 18px;
            background: rgba(182,79,79,.1);
            border: 2px solid var(--estado2r);
            box-shadow: 3px 3px 0 rgba(182,79,79,.3);
            margin-bottom: 36px;
            font-size: 10px;
            color: var(--estado2r);
            letter-spacing: .08em;
            text-transform: uppercase;
            visibility: hidden;
        }
        
        .debug-grid {
            border: 2px solid var(--border);
            background: var(--surface);
            margin-bottom: 40px;
            box-shadow: 5px 5px 0 var(--border);
            transition: background .3s, border-color .3s, box-shadow .3s;
            visibility: hidden;
        }

        .debug-row {
            display: grid;
            grid-template-columns: 240px 1fr;
            border-bottom: 2px solid var(--border);
            transition: border-color .3s, background .15s;
        }
        
        .debug-row:hover {
            background: var(--bg2);
        }

        .debug-row:last-child { border-bottom: none; }

        .debug-row .dk {
            padding: 14px 20px;
            font-size: 10px;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--muted);
            border-right: 2px solid var(--border);
            background: var(--bg2);
            display: flex;
            align-items: center;
            transition: all .3s;
        }

        .debug-row .dv {
            padding: 14px 20px;
            font-size: 13px;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 12px;
            transition: color .3s;
            font-family: var(--font-mono);
        }

        .dv.hi  { color: var(--principal); font-weight: bold; }
        .dv.wa  { color: var(--cta2); }
        .dv.pa  { color: var(--muted); letter-spacing: .05em; }
        .dv.ok  { color: var(--estado1); }
        .dv.err { color: var(--estado2r); }

        :root.light .dv.hi { color: var(--sec2); }
        :root.light .dv.wa { color: var(--estado2r); }
        
        .status-badge {
            padding: 3px 8px;
            font-size: 9px;
            letter-spacing: .1em;
            text-transform: uppercase;
            border-radius: 2px;
            font-family: var(--font-display);
            font-weight: 800;
        }
        
        .status-badge.ok {
            background: rgba(116,143,69,.15);
            color: var(--estado1);
            border: 1px solid var(--estado1);
        }
        
        .status-badge.fail {
            background: rgba(182,79,79,.15);
            color: var(--estado2r);
            border: 1px solid var(--estado2r);
        }
        
        .status-badge.warn {
            background: rgba(255,163,65,.15);
            color: var(--cta2);
            border: 1px solid var(--cta2);
        }

        /* ══════════════ TIMETABLE ══════════════ */
        .log-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .log-table th {
            text-align: left;
            padding: 14px 20px;
            font-size: 10px;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--muted);
            border-bottom: 2px solid var(--border);
            background: var(--bg2);
            transition: all .3s;
        }
        
        .log-table td {
            padding: 14px 20px;
            font-family: var(--font-mono);
            font-size: 12px;
            color: var(--text);
            border-bottom: 1px solid var(--border);
            transition: all .3s;
        }
        
        .log-table tr:hover td {
            background: var(--bg2);
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
            .debug-row { grid-template-columns: 1fr; }
            .debug-row .dk { border-right: none; border-bottom: 1px solid var(--border); }
            .theme-btn span:last-child { display: none; }
            nav ul li:not(:last-child) a { display: none; }
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
            <li><a href="/docs">Docs</a></li>
            <li><a href="/debug" class="active">Debug</a></li>
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
            <div class="hero-tag">// debugging</div>
            <h2>System <em>Telemetry</em></h2>
            <p class="hero-sub">Runtime variables, configuration overrides, and underlying system health metrics.</p>
        </div>

        @if(!config('app.debug'))
        <div class="debug-warn">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
            System is in production mode. Sensitive telemetry is hidden.
        </div>
        @else
        <div class="debug-warn">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
            Debug mode active — system details exposed
        </div>
        @endif

        {{-- ── SECTIONS ── --}}
        <div class="section-label"><span>Environment context</span></div>
        <div class="debug-grid">
            <div class="debug-row">
                <span class="dk">Application Env</span>
                <span class="dv hi">{{ config('app.env') }}</span>
            </div>
            <div class="debug-row">
                <span class="dk">Laravel Engine</span>
                <span class="dv">{{ app()->version() }}</span>
            </div>
            <div class="debug-row">
                <span class="dk">PHP Version</span>
                <span class="dv">{{ phpversion() }}</span>
            </div>
            <div class="debug-row">
                <span class="dk">Cache Driver</span>
                <span class="dv">{{ config('cache.default') }}</span>
            </div>
            <div class="debug-row">
                <span class="dk">Timezone</span>
                <span class="dv">{{ config('app.timezone') }}</span>
            </div>
            <div class="debug-row">
                <span class="dk">Locale</span>
                <span class="dv">{{ config('app.locale') }}</span>
            </div>
        </div>

        <div class="section-label"><span>Database</span></div>
        <div class="debug-grid">
            @php
                $dbStatus = 'OK';
                $dbClass = 'ok';
                try {
                    \Illuminate\Support\Facades\DB::connection()->getPdo();
                } catch (\Exception $e) {
                    $dbStatus = 'FAILED';
                    $dbClass = 'fail';
                }
            @endphp
            <div class="debug-row">
                <span class="dk">Connection Status</span>
                <span class="dv"><span class="status-badge {{ $dbClass }}">{{ $dbStatus }}</span></span>
            </div>
            <div class="debug-row">
                <span class="dk">Driver</span>
                <span class="dv wa">{{ config('database.default') }}</span>
            </div>
            <div class="debug-row">
                <span class="dk">Host : Port</span>
                <span class="dv">{{ config('database.connections.'.config('database.default').'.host') }} : {{ config('database.connections.'.config('database.default').'.port') }}</span>
            </div>
            <div class="debug-row">
                <span class="dk">Database Name</span>
                <span class="dv">{{ config('database.connections.'.config('database.default').'.database') }}</span>
            </div>
            @if(config('app.debug'))
            <div class="debug-row">
                <span class="dk">Credentials</span>
                <span class="dv pa">U: {{ config('database.connections.'.config('database.default').'.username') }} | P: ******</span>
            </div>
            @endif
        </div>
        
        <div class="section-label"><span>Storage & Volumes</span></div>
        <div class="debug-grid" style="padding: 0;">
            <table class="log-table">
                <thead>
                    <tr>
                        <th>Disk</th>
                        <th>Driver</th>
                        <th>Path</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>local</td>
                        <td>{{ config('filesystems.disks.local.driver') }}</td>
                        <td>{{ str_replace(base_path(), '', config('filesystems.disks.local.root')) }}</td>
                        <td><span class="status-badge ok">Mounted</span></td>
                    </tr>
                    <tr>
                        <td>public</td>
                        <td>{{ config('filesystems.disks.public.driver') }}</td>
                        <td>{{ str_replace(base_path(), '', config('filesystems.disks.public.root')) }}</td>
                        <td><span class="status-badge ok">Mounted</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <footer>
        <span>UO Debug Telemetry &copy; {{ date('Y') }}</span>
        <div class="footer-accent"></div>
        <span>Diagnostics Panel</span>
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

        // ── NAV reveal ──
        gsap.from('nav', {
            yPercent: -100,
            autoAlpha: 0,
            duration: .6,
            ease: 'expo.out',
            clearProps: 'all'
        });

        // ── HERO timeline ──
        const heroTl = gsap.timeline({ defaults: { ease: 'expo.out' } });
        heroTl
            .from('.hero',      { y: 32, autoAlpha: 0, duration: .7 })
            .from('.hero-tag',  { x: -20, autoAlpha: 0, duration: .5 }, '<.15')
            .from('.hero h2',   { y: 20, autoAlpha: 0, duration: .6 }, '<.1')
            .from('.hero-sub',  { y: 12, autoAlpha: 0, duration: .5 }, '<.1');

        // ── WARN / SECTIONS / TABLES ──
        const debugWarn = document.querySelector('.debug-warn');
        if (debugWarn) {
            gsap.from(debugWarn, {
                scrollTrigger: { trigger: debugWarn, start: 'top 90%', toggleActions: 'play none none none' },
                x: -16, autoAlpha: 0, duration: .5, ease: 'power2.out'
            });
        }

        gsap.utils.toArray('.section-label').forEach(el => {
            gsap.from(el, {
                scrollTrigger: { trigger: el, start: 'top 88%', toggleActions: 'play none none none' },
                x: -24, autoAlpha: 0, duration: .55, ease: 'power3.out'
            });
        });

        gsap.utils.toArray('.debug-grid').forEach(grid => {
            gsap.from(grid, {
                scrollTrigger: { trigger: grid, start: 'top 85%', toggleActions: 'play none none none' },
                autoAlpha: 0, y: 16, duration: .5, ease: 'power2.out'
            });
            const rows = grid.querySelectorAll('.debug-row, tr');
            if (rows.length) {
                gsap.from(rows, {
                    scrollTrigger: { trigger: grid, start: 'top 85%', toggleActions: 'play none none none' },
                    x: -16, autoAlpha: 0, stagger: .065, duration: .45, ease: 'power2.out',
                    clearProps: 'transform'
                });
            }
        });

        // ── FOOTER fade ──
        gsap.from('footer', {
            scrollTrigger: { trigger: 'footer', start: 'top 95%', toggleActions: 'play none none none' },
            autoAlpha: 0, y: 12, duration: .6, ease: 'power2.out'
        });
    </script>
</body>
</html>
