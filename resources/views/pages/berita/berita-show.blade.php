<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Berita — PCM Duren Sawit 1</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400;1,600&family=Syne:wght@400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet" />

    <style>
        :root {
            --cream: #F4F1EB;
            --ink: #111010;
            --muted: #7A7570;
            --gold: #C8A96E;
            --gold-dk: #8B6840;
            --line: #E4E0D8;
            --white: #FDFCFA;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
        }

        .serif {
            font-family: 'Playfair Display', serif;
        }

        .syne {
            font-family: 'Syne', sans-serif;
        }

        /* ── NAV ── */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            height: 68px;
            background: rgba(244, 241, 235, .88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--line);
        }

        .nav-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: .75rem;
            text-decoration: none;
        }

        .nav-logo img {
            height: 28px;
        }

        .nav-logo span {
            font-family: 'Syne', sans-serif;
            font-weight: 600;
            font-size: .95rem;
            color: var(--ink);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-links a {
            font-size: .82rem;
            color: var(--muted);
            text-decoration: none;
            letter-spacing: .02em;
            transition: color .2s;
        }

        .nav-links a:hover {
            color: var(--ink);
        }

        .nav-links a.active {
            color: var(--gold);
            font-weight: 600;
        }

        /* Mobile nav */
        #mobile-menu {
            display: none;
            position: absolute;
            top: 68px;
            left: 0;
            right: 0;
            background: rgba(244, 241, 235, .97);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--line);
            padding: 1.25rem 2rem;
            flex-direction: column;
            gap: .9rem;
        }

        #mobile-menu.open {
            display: flex;
        }

        #mobile-menu a {
            font-size: .88rem;
            color: var(--muted);
            text-decoration: none;
        }

        #mobile-menu a.active {
            color: var(--gold);
            font-weight: 600;
        }

        #menu-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: .4rem;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            max-width: 1280px;
            margin: 0 auto;
            padding: 5.5rem 2rem 3rem;
            position: relative;
            overflow: hidden;
        }

        .big-count {
            position: absolute;
            right: 2rem;
            top: 50%;
            transform: translateY(-50%);
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: clamp(6rem, 12vw, 10rem);
            line-height: 1;
            color: #EAE6DF;
            user-select: none;
            pointer-events: none;
        }

        .eyebrow {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1.5rem;
        }

        .eyebrow-line {
            width: 32px;
            height: 1px;
            background: var(--gold);
        }

        .eyebrow-label {
            font-family: 'Syne', sans-serif;
            font-size: .68rem;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: var(--gold);
            font-weight: 600;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.8rem, 6vw, 5rem);
            line-height: 1.05;
            letter-spacing: -.02em;
            color: var(--ink);
        }

        .page-title em {
            font-style: italic;
            color: var(--muted);
        }

        .header-divider {
            height: 1px;
            background: var(--line);
            margin-top: 2.5rem;
        }

        /* ── FILTER TABS ── */
        .filter-wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1.75rem 2rem 2rem;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: .5rem;
        }

        .filter-btn {
            font-family: 'Syne', sans-serif;
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: .5rem 1.2rem;
            border-radius: 100px;
            cursor: pointer;
            border: 1.5px solid var(--line);
            background: transparent;
            color: var(--muted);
            transition: background .2s, color .2s, border-color .2s;
        }

        .filter-btn:hover {
            border-color: var(--ink);
            color: var(--ink);
        }

        .filter-btn.active-all {
            background: var(--ink);
            color: var(--white);
            border-color: var(--ink);
        }

        .filter-btn.active-dakwah {
            background: #2D7A4F;
            color: #fff;
            border-color: #2D7A4F;
        }

        .filter-btn.active-pendidikan {
            background: #2B5EA7;
            color: #fff;
            border-color: #2B5EA7;
        }

        .filter-btn.active-sosial {
            background: #C05621;
            color: #fff;
            border-color: #C05621;
        }

        .filter-btn.active-organisasi {
            background: #6B46C1;
            color: #fff;
            border-color: #6B46C1;
        }

        /* Category badge */
        .cat-badge {
            font-family: 'Syne', sans-serif;
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: .25rem .7rem;
            border-radius: 100px;
            display: inline-block;
        }

        .cat-dakwah {
            background: #D1FAE5;
            color: #065F46;
        }

        .cat-pendidikan {
            background: #DBEAFE;
            color: #1E3A8A;
        }

        .cat-sosial {
            background: #FFEDD5;
            color: #7C2D12;
        }

        .cat-organisasi {
            background: #EDE9FE;
            color: #4C1D95;
        }

        .cat-default {
            background: #F3F0E8;
            color: var(--muted);
        }

        /* ── FEATURED ── */
        .featured-wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem 3rem;
        }

        .feat-card {
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid var(--line);
            text-decoration: none;
            transition: box-shadow .4s ease, transform .4s ease;
        }

        .feat-card:hover {
            box-shadow: 0 24px 60px rgba(0, 0, 0, .09);
            transform: translateY(-2px);
        }

        .feat-img-wrap {
            position: relative;
            overflow: hidden;
        }

        .feat-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 8s ease;
        }

        .feat-card:hover .feat-img-wrap img {
            transform: scale(1.05);
        }

        .feat-badge {
            position: absolute;
            top: 1.25rem;
            left: 1.25rem;
            font-family: 'Syne', sans-serif;
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            background: rgba(253, 252, 250, .92);
            backdrop-filter: blur(8px);
            color: var(--gold);
            padding: .4rem .9rem;
            border-radius: 100px;
        }

        .no-img-feat {
            width: 100%;
            height: 100%;
            min-height: 340px;
            background: linear-gradient(135deg, #E8E3D8 0%, #D4CFC4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .no-img-glyph {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 6rem;
            color: rgba(0, 0, 0, .08);
            line-height: 1;
            user-select: none;
        }

        .feat-body {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .feat-meta {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin-bottom: 1.25rem;
            flex-wrap: wrap;
        }

        .feat-meta span {
            font-size: .78rem;
            color: var(--muted);
        }

        .feat-meta .sep {
            color: var(--line);
        }

        .feat-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.5rem, 2.4vw, 2.1rem);
            line-height: 1.18;
            letter-spacing: -.015em;
            color: var(--ink);
            margin-bottom: 1rem;
            transition: color .25s;
        }

        .feat-card:hover .feat-title {
            color: #3a3a3a;
        }

        .feat-excerpt {
            font-size: .85rem;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 2rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .feat-cta {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            font-family: 'Syne', sans-serif;
            font-weight: 600;
            font-size: .82rem;
            color: var(--ink);
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .feat-cta svg {
            transition: transform .2s;
        }

        .feat-card:hover .feat-cta svg {
            transform: translateX(4px);
        }

        .feat-cta-line {
            display: block;
            height: 1px;
            background: var(--ink);
            width: 0;
            transition: width .3s ease;
            margin-top: .3rem;
        }

        .feat-card:hover .feat-cta-line {
            width: 100%;
        }

        /* ── SECTION LABEL ── */
        .section-label {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .section-label-text {
            font-family: 'Syne', sans-serif;
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--muted);
            white-space: nowrap;
        }

        .section-label-line {
            flex: 1;
            height: 1px;
            background: var(--line);
        }

        .section-label-count {
            font-family: 'Syne', sans-serif;
            font-size: .68rem;
            color: #B8B3AB;
            white-space: nowrap;
        }

        /* ── BENTO GRID ── */
        .bento-wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem 2rem;
        }

        #bento-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            grid-auto-rows: minmax(56px, auto);
            gap: 14px;
        }

        /* Card base */
        .b-card {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 16px;
            overflow: hidden;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            transition: box-shadow .35s ease, transform .35s ease;
        }

        .b-card:hover {
            box-shadow: 0 16px 40px rgba(0, 0, 0, .08);
            transform: translateY(-2px);
        }

        /* Bento slots — same rhythm as article page */
        .b-card[data-slot="a0"] {
            grid-column: span 7;
            grid-row: span 6;
        }

        .b-card[data-slot="a1"] {
            grid-column: span 5;
            grid-row: span 3;
        }

        .b-card[data-slot="a2"] {
            grid-column: span 5;
            grid-row: span 3;
        }

        .b-card[data-slot="b0"] {
            grid-column: span 4;
            grid-row: span 4;
        }

        .b-card[data-slot="b1"] {
            grid-column: span 4;
            grid-row: span 4;
        }

        .b-card[data-slot="b2"] {
            grid-column: span 4;
            grid-row: span 4;
        }

        .b-card[data-slot="c0"] {
            grid-column: span 5;
            grid-row: span 5;
        }

        .b-card[data-slot="c1"] {
            grid-column: span 7;
            grid-row: span 3;
        }

        .b-card[data-slot="c2"] {
            grid-column: span 7;
            grid-row: span 2;
        }

        .b-card[data-slot="d"] {
            grid-column: span 4;
            grid-row: span 4;
        }

        /* Image heights */
        [data-slot="a0"] .b-img-wrap {
            height: 200px;
        }

        [data-slot="a1"] .b-img-wrap,
        [data-slot="a2"] .b-img-wrap,
        [data-slot="b0"] .b-img-wrap,
        [data-slot="b1"] .b-img-wrap,
        [data-slot="b2"] .b-img-wrap {
            height: 130px;
        }

        [data-slot="c0"] .b-img-wrap {
            height: 170px;
        }

        [data-slot="c1"] .b-img-wrap,
        [data-slot="c2"] .b-img-wrap {
            height: 0;
            display: none;
        }

        [data-slot="d"] .b-img-wrap {
            height: 130px;
        }

        /* Horizontal cards */
        [data-slot="c1"],
        [data-slot="c2"] {
            flex-direction: row !important;
            align-items: center;
        }

        [data-slot="c1"] .b-body,
        [data-slot="c2"] .b-body {
            padding: 1.25rem 1.5rem !important;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        [data-slot="c1"] .b-excerpt,
        [data-slot="c2"] .b-excerpt {
            display: none;
        }

        [data-slot="c2"] .b-title {
            font-size: .9rem !important;
        }

        /* No-image placeholder */
        .b-img-wrap {
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }

        .b-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 6s ease;
        }

        .b-card:hover .b-img-wrap img {
            transform: scale(1.06);
        }

        .b-no-img {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #EAE6DF, #D8D3CA);
        }

        .b-no-img-glyph {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 3rem;
            color: rgba(0, 0, 0, .1);
            user-select: none;
        }

        [data-slot="a0"] .b-no-img {
            height: 200px;
        }

        [data-slot="a1"] .b-no-img,
        [data-slot="a2"] .b-no-img,
        [data-slot="b0"] .b-no-img,
        [data-slot="b1"] .b-no-img,
        [data-slot="b2"] .b-no-img {
            height: 130px;
        }

        [data-slot="c0"] .b-no-img {
            height: 170px;
        }

        [data-slot="c1"] .b-no-img,
        [data-slot="c2"] .b-no-img {
            width: 88px;
            height: 100% !important;
            flex-shrink: 0;
        }

        [data-slot="d"] .b-no-img {
            height: 130px;
        }

        /* Gold stripe on a0 */
        [data-slot="a0"] {
            position: relative;
        }

        [data-slot="a0"]::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(to bottom, var(--gold), transparent);
        }

        /* Body */
        .b-body {
            padding: 1.1rem 1.25rem 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        [data-slot="a0"] .b-body {
            padding: 1.4rem 1.6rem 1.6rem;
        }

        .b-meta {
            display: flex;
            align-items: center;
            gap: .4rem;
            margin-bottom: .6rem;
            flex-wrap: wrap;
        }

        .b-meta-txt {
            font-size: .7rem;
            color: var(--muted);
            font-family: 'Syne', sans-serif;
            letter-spacing: .02em;
        }

        .b-meta .sep {
            color: var(--line);
            font-size: .8rem;
        }

        .b-title {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            line-height: 1.3;
            letter-spacing: -.01em;
            color: var(--ink);
            transition: color .2s;
            margin: .35rem 0 0;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        [data-slot="a0"] .b-title {
            font-size: 1.3rem;
            -webkit-line-clamp: 4;
        }

        .b-card:hover .b-title {
            color: #444;
        }

        .b-excerpt {
            font-size: .75rem;
            color: var(--muted);
            line-height: 1.65;
            margin-top: .5rem;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        [data-slot="a0"] .b-excerpt {
            -webkit-line-clamp: 3;
            font-size: .8rem;
        }

        .b-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            padding-top: .75rem;
            border-top: 1px solid var(--line);
        }

        .b-read {
            font-family: 'Syne', sans-serif;
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--gold);
        }

        .b-date {
            font-size: .65rem;
            color: #B8B3AB;
        }

        /* ── HIDDEN / REVEAL ── */
        .b-card.hidden-card {
            display: none !important;
        }

        .b-card.filtered-out {
            display: none !important;
        }

        /* ── SHOW MORE ── */
        .show-more-wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1.5rem 2rem 5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.25rem;
        }

        .progress-track {
            width: 120px;
            height: 2px;
            background: var(--line);
            border-radius: 99px;
            overflow: hidden;
        }

        #progress-fill {
            height: 100%;
            background: var(--gold);
            border-radius: 99px;
            transition: width .5s cubic-bezier(.4, 0, .2, 1);
        }

        .shown-label {
            font-family: 'Syne', sans-serif;
            font-size: .7rem;
            color: var(--muted);
            letter-spacing: .06em;
        }

        .btn-row {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .btn-more {
            font-family: 'Syne', sans-serif;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--ink);
            background: transparent;
            border: 1.5px solid var(--ink);
            padding: .7rem 1.75rem;
            border-radius: 100px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: .5rem;
            transition: background .2s, color .2s;
        }

        .btn-more:hover {
            background: var(--ink);
            color: var(--white);
        }

        .btn-less {
            font-family: 'Syne', sans-serif;
            font-size: .75rem;
            font-weight: 500;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--muted);
            background: transparent;
            border: 1.5px solid var(--line);
            padding: .7rem 1.75rem;
            border-radius: 100px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: .5rem;
            transition: border-color .2s, color .2s;
        }

        .btn-less:hover {
            border-color: var(--muted);
            color: var(--ink);
        }

        /* ── EMPTY STATE ── */
        .empty-msg {
            max-width: 1280px;
            margin: 0 auto;
            padding: 6rem 2rem;
            text-align: center;
        }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid var(--line);
        }

        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1.75rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .footer-brand img {
            height: 22px;
        }

        .footer-brand span {
            font-family: 'Playfair Display', serif;
            font-size: .85rem;
            color: var(--ink);
        }

        .footer-copy {
            font-size: .72rem;
            color: var(--muted);
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .au {
            animation: fadeUp .55s cubic-bezier(.4, 0, .2, 1) both;
        }

        .d1 {
            animation-delay: .05s;
        }

        .d2 {
            animation-delay: .13s;
        }

        .d3 {
            animation-delay: .21s;
        }

        .d4 {
            animation-delay: .29s;
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: translateY(12px) scale(.99);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .card-in {
            animation: cardIn .38s cubic-bezier(.4, 0, .2, 1) both;
        }

        /* Initial stagger */
        #bento-grid .b-card:nth-child(1) {
            animation: cardIn .45s .08s both cubic-bezier(.4, 0, .2, 1);
        }

        #bento-grid .b-card:nth-child(2) {
            animation: cardIn .45s .15s both cubic-bezier(.4, 0, .2, 1);
        }

        #bento-grid .b-card:nth-child(3) {
            animation: cardIn .45s .22s both cubic-bezier(.4, 0, .2, 1);
        }

        #bento-grid .b-card:nth-child(4) {
            animation: cardIn .45s .28s both cubic-bezier(.4, 0, .2, 1);
        }

        #bento-grid .b-card:nth-child(5) {
            animation: cardIn .45s .34s both cubic-bezier(.4, 0, .2, 1);
        }

        #bento-grid .b-card:nth-child(6) {
            animation: cardIn .45s .40s both cubic-bezier(.4, 0, .2, 1);
        }

        #bento-grid .b-card:nth-child(7) {
            animation: cardIn .45s .46s both cubic-bezier(.4, 0, .2, 1);
        }

        #bento-grid .b-card:nth-child(8) {
            animation: cardIn .45s .52s both cubic-bezier(.4, 0, .2, 1);
        }

        #bento-grid .b-card:nth-child(9) {
            animation: cardIn .45s .58s both cubic-bezier(.4, 0, .2, 1);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .feat-card {
                grid-template-columns: 1fr;
            }

            .feat-img-wrap {
                aspect-ratio: 16/7;
            }

            #bento-grid {
                grid-template-columns: repeat(6, 1fr);
                grid-auto-rows: minmax(48px, auto);
            }

            .b-card[data-slot="a0"] {
                grid-column: span 6;
                grid-row: span 5;
            }

            .b-card[data-slot="a1"],
            .b-card[data-slot="a2"] {
                grid-column: span 3;
                grid-row: span 3;
            }

            .b-card[data-slot="b0"],
            .b-card[data-slot="b1"],
            .b-card[data-slot="b2"] {
                grid-column: span 2;
                grid-row: span 4;
            }

            .b-card[data-slot="c0"] {
                grid-column: span 3;
                grid-row: span 4;
            }

            .b-card[data-slot="c1"] {
                grid-column: span 3;
                grid-row: span 2;
                flex-direction: column !important;
            }

            .b-card[data-slot="c2"] {
                grid-column: span 6;
                grid-row: span 2;
                flex-direction: column !important;
            }

            .b-card[data-slot="d"] {
                grid-column: span 3;
                grid-row: span 4;
            }
        }

        @media (max-width: 600px) {
            .nav-links {
                display: none;
            }

            #menu-btn {
                display: block !important;
            }

            .page-header {
                padding-top: 5rem;
            }

            .page-title {
                font-size: 2.4rem;
            }

            #bento-grid {
                grid-template-columns: 1fr 1fr;
                grid-auto-rows: auto;
                gap: 10px;
            }

            .b-card[data-slot] {
                grid-column: span 1 !important;
                grid-row: span 1 !important;
            }

            [data-slot="c1"],
            [data-slot="c2"] {
                flex-direction: column !important;
            }

            [data-slot="c1"] .b-no-img,
            [data-slot="c2"] .b-no-img {
                width: 100% !important;
                height: 110px !important;
            }

            .filter-wrap {
                padding: 1.25rem 1.25rem 1.5rem;
            }

            .feat-body {
                padding: 1.75rem;
            }

            .big-count {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    {{-- ══════════ NAV ══════════ --}}
    @include('layouts.navigation')

    {{-- ══════════ PAGE HEADER ══════════ --}}
    <div style="padding-top:68px">
        <div class="page-header">
            <span class="big-count" id="big-num">{{ count($berita) }}</span>

            <div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:1rem">
                <h1 class="font-sans text-4xl">Semua <em>Berita</em></h1>
                <p style="font-size:.82rem;color:var(--muted);max-width:260px;line-height:1.7" class="au d3">
                    Update terbaru dari aktivitas dan kegiatan PCM Duren Sawit 1.
                </p>
            </div>

            <a href="/" class="bg-black w-44 h-10 text-white flex items-center justify-center rounded-xl mt-10">
                Kembali
            </a>

            <div class="header-divider"></div>
        </div>
    </div>

    @php
        $beritaCollection = collect($berita);
        $total = $beritaCollection->count();
    @endphp

    @if ($total > 0)

        {{-- ══════════ FILTER TABS ══════════ --}}
        <div class="filter-wrap au d4">
            <button class="filter-btn active-all" data-filter="all">Semua</button>
            <button class="filter-btn" data-filter="dakwah">Dakwah</button>
            <button class="filter-btn" data-filter="pendidikan">Pendidikan</button>
            <button class="filter-btn" data-filter="sosial">Sosial</button>
            <button class="filter-btn" data-filter="organisasi">Organisasi</button>
        </div>

        @php $featured = $beritaCollection->first(); @endphp

        {{-- ══════════ FEATURED ══════════ --}}
        <div class="featured-wrap" id="featured-wrap">
            <a href="{{ route('berita.show', $featured['slug']) }}" class="feat-card"
                data-kategori="{{ $featured['kategori'] }}">
                <div class="feat-img-wrap" style="aspect-ratio:16/9">
                    @if (!empty($featured['gambar']))
                        <img src="{{ $featured['gambar'] }}" alt="{{ $featured['judul'] }}" />
                    @else
                        <div class="no-img-feat">
                            <span class="no-img-glyph">{{ strtoupper(substr($featured['judul'], 0, 1)) }}</span>
                        </div>
                    @endif
                    <span class="feat-badge">Terbaru</span>
                </div>

                <div class="feat-body">
                    <div class="feat-meta">
                        @php
                            $catFeat = strtolower($featured['kategori'] ?? '');
                            $catClass = in_array($catFeat, ['dakwah', 'pendidikan', 'sosial', 'organisasi'])
                                ? 'cat-' . $catFeat
                                : 'cat-default';
                        @endphp
                        <span class="cat-badge {{ $catClass }}">{{ $featured['kategori'] ?? 'Umum' }}</span>
                        <span class="sep">·</span>
                        <span>{{ \Carbon\Carbon::parse($featured['created_at'])->diffForHumans() }}</span>
                    </div>

                    <h2 class="font-sans text-3xl font-semibold">{{ $featured['judul'] }}</h2>
                    <p class="feat-excerpt">{{ $featured['excerpt'] }}</p>

                    <div>
                        <span class="feat-cta">
                            Baca Berita
                            <svg width="14" height="14" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </span>
                        <span class="feat-cta-line"></span>
                    </div>
                </div>
            </a>
        </div>

        {{-- ══════════ SECTION LABEL ══════════ --}}
        @if ($total > 1)
            <div class="section-label">
                <span class="section-label-text">Berita Lainnya</span>
                <div class="section-label-line"></div>
                <span id="grid-count-label" class="section-label-count">
                    {{ min(9, $total - 1) }} dari {{ $total - 1 }}
                </span>
            </div>

            {{-- ══════════ BENTO GRID ══════════ --}}
            <div class="bento-wrap">
                <div id="bento-grid">
                    @foreach ($beritaCollection->skip(1) as $i => $item)
                        @php
                            $pat = $i % 9;
                            if ($pat === 0) {
                                $slot = 'a0';
                            } elseif ($pat === 1) {
                                $slot = 'a1';
                            } elseif ($pat === 2) {
                                $slot = 'a2';
                            } elseif ($pat === 3) {
                                $slot = 'b0';
                            } elseif ($pat === 4) {
                                $slot = 'b1';
                            } elseif ($pat === 5) {
                                $slot = 'b2';
                            } elseif ($pat === 6) {
                                $slot = 'c0';
                            } elseif ($pat === 7) {
                                $slot = 'c1';
                            } else {
                                $slot = 'c2';
                            }

                            $kat = strtolower($item['kategori'] ?? '');
                            $catClass = in_array($kat, ['dakwah', 'pendidikan', 'sosial', 'organisasi'])
                                ? 'cat-' . $kat
                                : 'cat-default';
                        @endphp

                        <a href="{{ route('berita.show', $item['slug']) }}" data-index="{{ $i }}"
                            data-slot="{{ $slot }}" data-kategori="{{ $item['kategori'] }}"
                            class="b-card {{ $i >= 9 ? 'hidden-card' : '' }}">

                            {{-- Image / gradient tile --}}
                            @if (!empty($item['gambar']))
                                <div class="b-img-wrap">
                                    <img src="{{ $item['gambar'] }}" alt="{{ $item['judul'] }}" loading="lazy" />
                                </div>
                            @else
                                <div class="b-no-img b-img-wrap">
                                    <span class="b-no-img-glyph">{{ strtoupper(substr($item['judul'], 0, 1)) }}</span>
                                </div>
                            @endif

                            {{-- Body --}}
                            <div class="b-body">
                                <div class="b-meta">
                                    <span class="cat-badge {{ $catClass }}"
                                        style="font-size:.58rem;padding:.18rem .55rem">{{ $item['kategori'] ?? 'Umum' }}</span>
                                    <span class="sep">·</span>
                                    <span
                                        class="b-meta-txt">{{ \Carbon\Carbon::parse($item['created_at'])->diffForHumans() }}</span>
                                </div>
                                <h3 class="b-title">{{ $item['judul'] }}</h3>
                                <p class="b-excerpt">{{ $item['excerpt'] }}</p>
                                <div class="b-footer">
                                    <span class="b-read">Baca →</span>
                                    <span
                                        class="b-date">{{ \Carbon\Carbon::parse($item['created_at'])->format('d M Y') }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- EMPTY STATE for filter --}}
            <div id="empty-filter" style="display:none">
                <div class="empty-msg">
                    <p class="serif" style="font-size:3rem;color:var(--line);margin-bottom:.75rem">— ✦ —</p>
                    <p style="font-size:.85rem;color:var(--muted)">Belum ada berita untuk kategori ini.</p>
                </div>
            </div>

            {{-- SHOW MORE --}}
            @if ($total - 1 > 9)
                <div class="show-more-wrap" id="show-more-area">
                    <div class="progress-track">
                        <div id="progress-fill" style="width:{{ min((9 / ($total - 1)) * 100, 100) }}%"></div>
                    </div>
                    <p class="shown-label">
                        Menampilkan <span id="shown-num">9</span> dari <span
                            id="total-visible">{{ $total - 1 }}</span> berita
                    </p>
                    <div class="btn-row">
                        <button id="show-more-btn" class="btn-more">
                            <svg width="13" height="13" fill="none" stroke="currentColor"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                            Tampilkan Lebih Banyak
                        </button>
                        <button id="show-less-btn" class="btn-less" style="display:none">
                            <svg width="13" height="13" fill="none" stroke="currentColor"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M5 15l7-7 7 7" />
                            </svg>
                            Lebih Sedikit
                        </button>
                    </div>
                </div>
            @else
                <div style="padding-bottom:5rem"></div>
            @endif

        @endif
    @else
        <div class="empty-msg">
            <p class="serif" style="font-size:3.5rem;color:var(--line);margin-bottom:.75rem">— ✦ —</p>
            <p style="font-size:.85rem;color:var(--muted)">Belum ada berita yang dipublikasikan.</p>
        </div>
    @endif

    {{-- ══════════ FOOTER ══════════ --}}
    @include('layouts.footer')

    <script>
        // ── Mobile nav ──
        document.getElementById('menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('open');
        });

        // ── Filter ──
        var STEP = 9;
        var activeFilter = 'all';
        var allCards = Array.from(document.querySelectorAll('#bento-grid .b-card'));
        var featWrap = document.getElementById('featured-wrap');
        var emptyMsg = document.getElementById('empty-filter');
        var countLabel = document.getElementById('grid-count-label');
        var shownNum = document.getElementById('shown-num');
        var totalVis = document.getElementById('total-visible');
        var fillEl = document.getElementById('progress-fill');
        var moreBtn = document.getElementById('show-more-btn');
        var lessBtn = document.getElementById('show-less-btn');
        var showArea = document.getElementById('show-more-area');

        var shown = Math.min(STEP, allCards.length);

        function getFilteredCards() {
            if (activeFilter === 'all') return allCards;
            return allCards.filter(function(c) {
                return (c.dataset.kategori || '').toLowerCase() === activeFilter;
            });
        }

        function applyFilter() {
            var filtered = getFilteredCards();
            var unfiltered = allCards.filter(function(c) {
                return filtered.indexOf(c) === -1;
            });

            // Hide cards not in current filter
            unfiltered.forEach(function(c) {
                c.classList.add('filtered-out');
            });

            // Show/hide based on filter + shown count
            filtered.forEach(function(c, idx) {
                c.classList.remove('filtered-out');
                if (idx < shown) {
                    c.classList.remove('hidden-card');
                } else {
                    c.classList.add('hidden-card');
                }
            });

            // Featured visibility
            if (featWrap) {
                var featEl = featWrap.querySelector('[data-kategori]');
                if (featEl) {
                    var featKat = (featEl.dataset.kategori || '').toLowerCase();
                    featWrap.style.display = (activeFilter === 'all' || featKat === activeFilter) ? '' : 'none';
                }
            }

            // Empty state
            var visibleCount = document.querySelectorAll('#bento-grid .b-card:not(.hidden-card):not(.filtered-out)').length;
            if (emptyMsg) emptyMsg.style.display = (filtered.length === 0) ? 'block' : 'none';

            // Sync labels
            var filtTotal = filtered.length;
            shown = Math.min(shown, filtTotal) || Math.min(STEP, filtTotal);

            if (countLabel) countLabel.textContent = Math.min(shown, filtTotal) + ' dari ' + filtTotal;
            if (shownNum) shownNum.textContent = Math.min(shown, filtTotal);
            if (totalVis) totalVis.textContent = filtTotal;
            if (fillEl) fillEl.style.width = filtTotal > 0 ? Math.min(shown / filtTotal * 100, 100) + '%' : '0%';
            if (showArea) showArea.style.display = filtTotal > STEP ? 'flex' : 'none';
            if (moreBtn) moreBtn.style.display = shown >= filtTotal ? 'none' : '';
            if (lessBtn) lessBtn.style.display = shown <= STEP ? 'none' : '';
        }

        // Filter buttons
        document.querySelectorAll('.filter-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                activeFilter = this.dataset.filter;
                shown = STEP;

                // Update active class
                document.querySelectorAll('.filter-btn').forEach(function(b) {
                    b.className = 'filter-btn';
                });
                var f = activeFilter;
                this.classList.add(f === 'all' ? 'active-all' : 'active-' + f);

                applyFilter();

                // Re-animate visible cards
                var visCards = document.querySelectorAll(
                    '#bento-grid .b-card:not(.hidden-card):not(.filtered-out)');
                visCards.forEach(function(c, i) {
                    c.style.animation = 'none';
                    void c.offsetWidth;
                    c.style.animation = 'cardIn .38s ' + (i * 0.05) +
                        's both cubic-bezier(.4,0,.2,1)';
                });
            });
        });

        // Show more
        if (moreBtn) {
            moreBtn.addEventListener('click', function() {
                var filtered = getFilteredCards();
                var hidden = filtered.filter(function(c) {
                    return c.classList.contains('hidden-card');
                });
                var count = 0;
                hidden.forEach(function(card) {
                    if (count < STEP) {
                        card.classList.remove('hidden-card');
                        void card.offsetWidth;
                        card.classList.add('card-in');
                        shown++;
                        count++;
                    }
                });
                applyFilter();
                window.scrollBy({
                    top: 260,
                    behavior: 'smooth'
                });
            });
        }

        // Show less
        if (lessBtn) {
            lessBtn.addEventListener('click', function() {
                shown = STEP;
                applyFilter();
                var grid = document.getElementById('bento-grid');
                if (grid) window.scrollTo({
                    top: grid.offsetTop - 140,
                    behavior: 'smooth'
                });
            });
        }

        applyFilter();
    </script>
</body>

</html>
