@extends('layouts.app')

@push('styles')
<style>
    :root {
        --primary: #1a6e3e;
        --primary-dark: #0d4727;
        --amber: #f59e0b;
        --amber-hover: #d97706;
        --light-bg: #f0fdf4;
        --text-dark: #1f2937;
        --text-light: #6b7280;
        --white: #ffffff;
        --shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -4px rgba(0,0,0,0.1);
        --radius: 8px;
        --radius-lg: 12px;
        --transition: all 0.3s ease;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

    .hero-slider { position: relative; width: 100%; height: 600px; overflow: hidden; }
    .hero-slides { position: relative; width: 100%; height: 100%; }
    .hero-slide { position: absolute; inset: 0; opacity: 0; transition: opacity 1s ease; display: flex; align-items: center; justify-content: center; }
    .hero-slide.active { opacity: 1; z-index: 1; }
    .hero-slide .overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.55); z-index: 1; }
    .hero-slide .slide-bg { position: absolute; inset: 0; background-size: cover; background-position: center; z-index: 0; }
    .hero-slide .slide-content { position: relative; z-index: 2; text-align: center; color: var(--white); max-width: 800px; padding: 0 20px; }
    .hero-slide .slide-content h1 { font-size: 3rem; font-weight: 800; margin-bottom: 1rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); }
    .hero-slide .slide-content p { font-size: 1.2rem; margin-bottom: 2rem; opacity: 0.95; }
    .hero-slide .slide-content .btn-amber { display: inline-block; padding: 14px 36px; background: var(--amber); color: var(--white); font-weight: 700; font-size: 1rem; border-radius: var(--radius); text-decoration: none; transition: var(--transition); text-transform: uppercase; letter-spacing: 1px; border: none; cursor: pointer; }
    .hero-slide .slide-content .btn-amber:hover { background: var(--amber-hover); transform: translateY(-2px); box-shadow: var(--shadow-lg); }
    .slider-dots { position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); z-index: 10; display: flex; gap: 12px; }
    .slider-dots .dot { width: 14px; height: 14px; border-radius: 50%; background: rgba(255,255,255,0.5); border: 2px solid var(--white); cursor: pointer; transition: var(--transition); }
    .slider-dots .dot.active { background: var(--amber); border-color: var(--amber); transform: scale(1.2); }

    .section-title { text-align: center; margin-bottom: 3rem; }
    .section-title h2 { font-size: 2.2rem; font-weight: 800; color: var(--primary-dark); position: relative; display: inline-block; }
    .section-title h2::after { content: ''; display: block; width: 60px; height: 4px; background: var(--amber); margin: 12px auto 0; border-radius: 2px; }
    .section-title p { color: var(--text-light); margin-top: 1rem; font-size: 1.1rem; max-width: 600px; margin-left: auto; margin-right: auto; }

    .vision-section { padding: 5rem 0; background: var(--white); }
    .vmv-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
    .vmv-card { background: var(--white); border-radius: var(--radius-lg); padding: 2rem; text-align: center; box-shadow: var(--shadow); transition: var(--transition); border-top: 4px solid var(--primary); }
    .vmv-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
    .vmv-card .icon-wrap { width: 64px; height: 64px; background: var(--light-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.2rem; }
    .vmv-card .icon-wrap svg { width: 32px; height: 32px; color: var(--primary); }
    .vmv-card h3 { font-size: 1.2rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 0.8rem; }
    .vmv-card p { font-size: 0.95rem; color: var(--text-light); line-height: 1.6; }
    .vmv-card .read-more { display: inline-block; margin-top: 1rem; color: var(--primary); font-weight: 600; text-decoration: none; font-size: 0.9rem; transition: var(--transition); }
    .vmv-card .read-more:hover { color: var(--amber); }

    .built-section { padding: 5rem 0; background: var(--light-bg); }
    .built-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; }
    .built-text h2 { font-size: 2rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 1.5rem; }
    .built-text h2 span { color: var(--amber); }
    .built-text p { font-size: 1.05rem; color: var(--text-light); line-height: 1.7; margin-bottom: 1rem; }
    .built-people { display: flex; gap: 20px; margin-top: 2rem; }
    .built-people .person-circle { width: 80px; height: 80px; border-radius: 50%; background: #9ca3af; display: flex; align-items: center; justify-content: center; color: var(--white); font-weight: 700; font-size: 1.2rem; border: 3px solid var(--primary); }
    .built-image { background: #d1d5db; border-radius: var(--radius-lg); min-height: 380px; display: flex; align-items: center; justify-content: center; color: #6b7280; font-size: 1.2rem; font-weight: 600; }

    .why-section { padding: 5rem 0; background: var(--light-bg); }
    .why-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
    .why-card { background: var(--white); border-radius: var(--radius-lg); padding: 2.5rem 2rem; text-align: center; box-shadow: var(--shadow); transition: var(--transition); position: relative; overflow: hidden; }
    .why-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: var(--amber); }
    .why-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-lg); }
    .why-card .icon-wrap { width: 72px; height: 72px; background: var(--light-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.2rem; }
    .why-card .icon-wrap svg { width: 36px; height: 36px; color: var(--primary); }
    .why-card h3 { font-size: 1.3rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 0.8rem; }
    .why-card p { font-size: 0.95rem; color: var(--text-light); line-height: 1.6; }

    .membership-section { padding: 5rem 0; background: var(--white); }
    .membership-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 40px; }
    .membership-card { background: var(--white); border: 2px solid #e5e7eb; border-radius: var(--radius-lg); padding: 2rem; text-align: center; transition: var(--transition); }
    .membership-card:hover { border-color: var(--primary); box-shadow: var(--shadow-lg); }
    .membership-card .card-icon { width: 56px; height: 56px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; }
    .membership-card .card-icon svg { width: 28px; height: 28px; color: var(--white); }
    .membership-card h3 { font-size: 1.15rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 0.8rem; }
    .membership-card ul { list-style: none; padding: 0; text-align: left; }
    .membership-card ul li { padding: 0.4rem 0; color: var(--text-light); font-size: 0.95rem; display: flex; align-items: baseline; gap: 8px; }
    .membership-card ul li::before { content: '\2713'; color: var(--primary); font-weight: 700; }
    .membership-images { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .membership-images .img-placeholder { height: 200px; background: #d1d5db; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; color: #6b7280; font-weight: 600; font-size: 1rem; transition: var(--transition); }
    .membership-images .img-placeholder:hover { transform: scale(1.02); box-shadow: var(--shadow); }

    .stats-section { padding: 5rem 0; background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); position: relative; overflow: hidden; }
    .stats-section::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; position: relative; z-index: 1; }
    .stat-item { text-align: center; color: var(--white); padding: 1.5rem; }
    .stat-item .stat-number { font-size: 3rem; font-weight: 800; margin-bottom: 0.5rem; }
    .stat-item .stat-label { font-size: 1.05rem; opacity: 0.9; font-weight: 500; }
    .stat-item .stat-icon { margin-bottom: 1rem; }
    .stat-item .stat-icon svg { width: 40px; height: 40px; color: var(--amber); }

    .products-section { padding: 5rem 0; background: var(--white); }
    .products-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
    .product-card { background: var(--white); border: 1px solid #e5e7eb; border-radius: var(--radius-lg); padding: 1.8rem; text-align: center; transition: var(--transition); }
    .product-card:hover { border-color: var(--primary); box-shadow: var(--shadow-lg); transform: translateY(-4px); }
    .product-card .icon-wrap { width: 60px; height: 60px; background: var(--light-bg); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; }
    .product-card .icon-wrap svg { width: 30px; height: 30px; color: var(--primary); }
    .product-card h3 { font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 0.6rem; }
    .product-card p { font-size: 0.9rem; color: var(--text-light); line-height: 1.5; margin-bottom: 1rem; }
    .product-card .learn-more { color: var(--primary); font-weight: 600; text-decoration: none; font-size: 0.9rem; transition: var(--transition); }
    .product-card .learn-more:hover { color: var(--amber); }

    .msacco-section { padding: 5rem 0; background: var(--light-bg); }
    .msacco-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center; }
    .msacco-phone { background: #d1d5db; border-radius: 24px; min-height: 450px; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #6b7280; font-weight: 600; font-size: 1.2rem; }
    .msacco-phone .phone-screen { width: 80%; height: 70%; background: var(--white); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-weight: 700; font-size: 1.5rem; margin-top: 1rem; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1); }
    .msacco-content h2 { font-size: 2rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 1.5rem; }
    .msacco-content h2 span { color: var(--amber); }
    .msacco-content p { font-size: 1.05rem; color: var(--text-light); line-height: 1.7; margin-bottom: 2rem; }
    .msacco-benefits { list-style: none; padding: 0; }
    .msacco-benefits li { display: flex; align-items: flex-start; gap: 12px; padding: 0.8rem 0; font-size: 1rem; color: var(--text-dark); }
    .msacco-benefits li svg { width: 24px; height: 24px; color: var(--primary); flex-shrink: 0; margin-top: 2px; }

    .news-section { padding: 5rem 0; background: var(--white); }
    .news-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
    .news-card { background: var(--white); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow); transition: var(--transition); }
    .news-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
    .news-card .news-img { height: 200px; background: #d1d5db; display: flex; align-items: center; justify-content: center; color: #6b7280; font-weight: 600; position: relative; }
    .news-card .news-badge { position: absolute; top: 12px; left: 12px; background: var(--amber); color: var(--white); padding: 4px 14px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; }
    .news-card .news-body { padding: 1.5rem; }
    .news-card .news-date { font-size: 0.85rem; color: var(--text-light); margin-bottom: 0.5rem; }
    .news-card .news-title { font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 0.8rem; line-height: 1.4; }
    .news-card .news-excerpt { font-size: 0.9rem; color: var(--text-light); line-height: 1.6; margin-bottom: 1rem; }
    .news-card .news-author { display: flex; align-items: center; gap: 10px; }
    .news-card .news-author .avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--primary); display: flex; align-items: center; justify-content: center; color: var(--white); font-weight: 700; font-size: 0.85rem; }
    .news-card .news-author .name { font-size: 0.9rem; font-weight: 600; color: var(--text-dark); }

    .faq-section { padding: 5rem 0; background: var(--light-bg); }
    .faq-list { max-width: 800px; margin: 0 auto; }
    .faq-item { background: var(--white); border-radius: var(--radius); margin-bottom: 12px; box-shadow: var(--shadow); overflow: hidden; }
    .faq-question { width: 100%; padding: 1.2rem 1.5rem; background: none; border: none; text-align: left; font-size: 1.05rem; font-weight: 600; color: var(--text-dark); cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: var(--transition); }
    .faq-question:hover { color: var(--primary); }
    .faq-question svg { width: 20px; height: 20px; transition: var(--transition); flex-shrink: 0; }
    .faq-question.open svg { transform: rotate(180deg); color: var(--primary); }
    .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.4s ease, padding 0.4s ease; padding: 0 1.5rem; }
    .faq-answer.open { max-height: 300px; padding: 0 1.5rem 1.2rem; }
    .faq-answer p { color: var(--text-light); line-height: 1.7; font-size: 0.95rem; }

    .partners-section { padding: 4rem 0; background: var(--white); overflow: hidden; }
    .partners-track { display: flex; gap: 60px; animation: scrollPartners 20s linear infinite; width: max-content; }
    .partners-track:hover { animation-play-state: paused; }
    .partner-logo { min-width: 160px; height: 80px; background: var(--light-bg); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; color: var(--primary); font-weight: 700; font-size: 1rem; border: 1px solid #e5e7eb; padding: 0 20px; transition: var(--transition); }
    .partner-logo:hover { border-color: var(--primary); background: var(--white); }
    @keyframes scrollPartners { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    .partners-wrapper { position: relative; }
    .partners-wrapper::before, .partners-wrapper::after { content: ''; position: absolute; top: 0; bottom: 0; width: 80px; z-index: 2; pointer-events: none; }
    .partners-wrapper::before { left: 0; background: linear-gradient(to right, var(--white), transparent); }
    .partners-wrapper::after { right: 0; background: linear-gradient(to left, var(--white), transparent); }
    .partners-container { overflow: hidden; }

    .cta-section { padding: 4rem 0; background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); }
    .cta-content { text-align: center; color: var(--white); }
    .cta-content h2 { font-size: 2.2rem; font-weight: 800; margin-bottom: 0.8rem; }
    .cta-content .cta-phone { font-size: 1.8rem; font-weight: 700; color: var(--amber); margin-bottom: 1.5rem; }
    .cta-content .cta-phone a { color: var(--amber); text-decoration: none; }
    .cta-content .cta-phone a:hover { text-decoration: underline; }
    .cta-content .btn-member { display: inline-block; padding: 16px 44px; background: var(--amber); color: var(--white); font-weight: 700; font-size: 1.1rem; border-radius: var(--radius); text-decoration: none; transition: var(--transition); text-transform: uppercase; letter-spacing: 1px; border: none; cursor: pointer; }
    .cta-content .btn-member:hover { background: var(--amber-hover); transform: translateY(-2px); box-shadow: 0 8px 25px rgba(245,158,11,0.4); }

    @media (max-width: 1024px) {
        .vmv-grid { grid-template-columns: repeat(2, 1fr); }
        .products-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .hero-slider { height: 450px; }
        .hero-slide .slide-content h1 { font-size: 2rem; }
        .hero-slide .slide-content p { font-size: 1rem; }
        .vmv-grid { grid-template-columns: 1fr; }
        .built-grid { grid-template-columns: 1fr; }
        .why-grid { grid-template-columns: 1fr; }
        .membership-cards { grid-template-columns: 1fr; }
        .membership-images { grid-template-columns: 1fr; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .stat-item .stat-number { font-size: 2.2rem; }
        .products-grid { grid-template-columns: 1fr; }
        .msacco-grid { grid-template-columns: 1fr; }
        .news-grid { grid-template-columns: 1fr; }
        .section-title h2 { font-size: 1.8rem; }
        .cta-content h2 { font-size: 1.6rem; }
        .cta-content .cta-phone { font-size: 1.3rem; }
        .built-image { min-height: 250px; }
        .msacco-phone { min-height: 350px; }
    }
    @media (max-width: 480px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
        .hero-slider { height: 380px; }
    }
</style>
@endpush

@section('content')

<!-- ===== 1. HERO SLIDER ===== -->
<section class="hero-slider" id="heroSlider">
    <div class="hero-slides">
        <div class="hero-slide active" data-index="0">
            <!-- IMAGE: public/images/slides/slide-1.jpg (1360x600px - People in SACCO office/meeting) -->
            <div class="slide-bg" style="background: linear-gradient(135deg, #0d4727 0%, #1a6e3e 50%, #145c32 100%); background-image: url('/images/slides/slide-1.jpg'); background-blend-mode: overlay;"></div>
            <div class="overlay"></div>
            <div class="slide-content">
                <h1>Safe Savings &amp; Affordable Loans</h1>
                <p>We provide secure savings options and low-interest loans to help you achieve your financial goals.</p>
                <a href="{{ url('/saving-products') }}" class="btn-amber">View Saving Products</a>
            </div>
        </div>
        <div class="hero-slide" data-index="1">
            <!-- IMAGE: public/images/slides/slide-2.jpg (1360x600px - Staff/team photo) -->
            <div class="slide-bg" style="background: linear-gradient(135deg, #0d4727 0%, #1e7d48 50%, #0d4727 100%); background-image: url('/images/slides/slide-2.jpg'); background-blend-mode: overlay;"></div>
            <div class="overlay"></div>
            <div class="slide-content">
                <h1>Save. Borrow. Grow.</h1>
                <p>Join Kasambya SACCO today and take control of your financial future through smart saving and responsible borrowing.</p>
                <a href="{{ url('/membership') }}" class="btn-amber">Join Our SACCO</a>
            </div>
        </div>
        <div class="hero-slide" data-index="2">
            <!-- IMAGE: public/images/slides/slide-3.jpg (1360x600px - Chairman/leadership meeting) -->
            <div class="slide-bg" style="background: linear-gradient(135deg, #145c32 0%, #0d4727 50%, #1a6e3e 100%); background-image: url('/images/slides/slide-3.jpg'); background-blend-mode: overlay;"></div>
            <div class="overlay"></div>
            <div class="slide-content">
                <h1>Accountability in Leadership</h1>
                <p>Our leadership is committed to transparency, integrity, and responsible management of member resources.</p>
                <a href="{{ url('/membership') }}" class="btn-amber">Join Our SACCO</a>
            </div>
        </div>
        <div class="hero-slide" data-index="3">
            <!-- IMAGE: public/images/slides/slide-4.jpg (1360x600px - Office/exterior building) -->
            <div class="slide-bg" style="background: linear-gradient(135deg, #1a6e3e 0%, #145c32 50%, #0d4727 100%); background-image: url('/images/slides/slide-4.jpg'); background-blend-mode: overlay;"></div>
            <div class="overlay"></div>
            <div class="slide-content">
                <h1>Working Premises</h1>
                <p>Visit our offices located in Kasambya Town, Mubende District. We are ready to serve you.</p>
                <a href="{{ url('/contact') }}" class="btn-amber">Visit Our Offices</a>
            </div>
        </div>
        <div class="hero-slide" data-index="4">
            <!-- IMAGE: public/images/slides/slide-5.jpg (1360x600px - Person using mobile phone/M-SACCO) -->
            <div class="slide-bg" style="background: linear-gradient(135deg, #0d4727 0%, #1a6e3e 50%, #228b22 100%); background-image: url('/images/slides/slide-5.jpg'); background-blend-mode: overlay;"></div>
            <div class="overlay"></div>
            <div class="slide-content">
                <h1>Pay From Any Where</h1>
                <p>Access your savings, apply for loans, and make payments using our M-SACCO mobile platform.</p>
                <a href="{{ url('/msacco') }}" class="btn-amber">How It Works</a>
            </div>
        </div>
    </div>
    <div class="slider-dots" id="sliderDots">
        <span class="dot active" data-index="0"></span>
        <span class="dot" data-index="1"></span>
        <span class="dot" data-index="2"></span>
        <span class="dot" data-index="3"></span>
        <span class="dot" data-index="4"></span>
    </div>
</section>

<!-- ===== 2. VISION / MISSION / VALUES ===== -->
<section class="vision-section">
    <div class="container">
        <div class="section-title">
            <h2>Who We Are</h2>
            <p>Kasambya SACCO is a member-owned financial cooperative dedicated to empowering our community.</p>
        </div>
        <div class="vmv-grid">
            <div class="vmv-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12h4l3-9 3 18 3-9h4"/>
                    </svg>
                </div>
                <h3>Our Vision</h3>
                <p>To provide affordable and sustainable financial services to our members.</p>
                <a href="{{ url('/about') }}" class="read-more">Read More &rarr;</a>
            </div>
            <div class="vmv-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                    </svg>
                </div>
                <h3>Our Mission</h3>
                <p>To develop a strong spirit of saving among our members.</p>
                <a href="{{ url('/about') }}" class="read-more">Read More &rarr;</a>
            </div>
            <div class="vmv-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h3>Core Values</h3>
                <p>We uphold honesty and ethical conduct in all our operations.</p>
                <a href="{{ url('/about') }}" class="read-more">Read More &rarr;</a>
            </div>
            <div class="vmv-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <h3>Customer Care</h3>
                <p>We prioritize the needs and satisfaction of our members.</p>
                <a href="{{ url('/about') }}" class="read-more">Read More &rarr;</a>
            </div>
        </div>
    </div>
</section>

<!-- ===== 3. A SACCO BUILT FOR YOU ===== -->
<section class="built-section">
    <div class="container">
        <div class="built-grid">
            <div class="built-text">
                <h2>A SACCO <span>Built for You</span></h2>
                <p>Kasambya SACCO was established in 2003 and fully registered by the Registrar of Cooperative Societies. For over two decades, we have been at the forefront of providing accessible and affordable financial services to our members in Kasambya and beyond.</p>
                <p>We believe in the power of collective saving and responsible lending to transform lives and build sustainable communities.</p>
                <div class="built-people">
                    <!-- IMAGE: public/images/team/person-1.jpg (80x80px - Board member/leader photo) -->
                    <div class="person-circle" style="background-image: url('/images/team/person-1.jpg'); background-size: cover;">JM</div>
                    <!-- IMAGE: public/images/team/person-2.jpg (80x80px - Board member/leader photo) -->
                    <div class="person-circle" style="background-image: url('/images/team/person-2.jpg'); background-size: cover;">AN</div>
                </div>
            </div>
            <div class="built-image">
                <!-- IMAGE: public/images/building.jpg (600x380px - SACCO building/office exterior) -->
                <span style="display:none;">Kasambya SACCO Building</span>
            </div>
        </div>
    </div>
</section>

<!-- ===== 4. WHY CHOOSE US ===== -->
<section class="why-section">
    <div class="container">
        <div class="section-title">
            <h2>Why Choose Us</h2>
            <p>We are committed to providing the highest quality financial services to our members.</p>
        </div>
        <div class="why-grid">
            <div class="why-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h3>We act with Integrity</h3>
                <p>We maintain the highest standards of honesty and ethical behavior in all our dealings with members and stakeholders.</p>
            </div>
            <div class="why-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12a9 9 0 0 1-9 9m9-9a9 9 0 0 0-9-9m9 9H3m9 9a9 9 0 0 1-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 0 1 9-9"/>
                    </svg>
                </div>
                <h3>We practice Transparency</h3>
                <p>Our operations are open and transparent. Members have full visibility into how their funds are managed.</p>
            </div>
            <div class="why-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                    </svg>
                </div>
                <h3>We value Your Time</h3>
                <p>We have streamlined our processes to ensure quick service delivery and minimal waiting times for our members.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== 5. MEMBERSHIP APPLICATION PROCESS ===== -->
<section class="membership-section">
    <div class="container">
        <div class="section-title">
            <h2>Membership &amp; Accounts</h2>
            <p>Join Kasambya SACCO today and choose from our range of account types designed to meet your needs.</p>
        </div>
        <div class="membership-cards">
            <div class="membership-card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h3>Regular Membership</h3>
                <ul>
                    <li>Valid National ID required</li>
                    <li>Passport photos (2 copies)</li>
                    <li>Minimum share deposit</li>
                    <li>Completed application form</li>
                </ul>
            </div>
            <div class="membership-card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h3>Associate Membership</h3>
                <ul>
                    <li>Valid ID (National/Passport)</li>
                    <li>Passport photos (2 copies)</li>
                    <li>Recommendation letter</li>
                    <li>Minimum registration fee</li>
                </ul>
            </div>
            <div class="membership-card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
                    </svg>
                </div>
                <h3>Group Accounts</h3>
                <ul>
                    <li>Group registration certificate</li>
                    <li>List of members &amp; details</li>
                    <li>Group constitution</li>
                    <li>Minutes of committee resolution</li>
                </ul>
            </div>
        </div>
        <div class="membership-images">
            <!-- IMAGE: public/images/membership/registration.jpg (Member Registration) -->
            <div class="img-placeholder" style="background: #d1d5db url('/images/membership/registration.jpg') center/cover no-repeat;">Member Registration</div>
            <!-- IMAGE: public/images/membership/account-opening.jpg (Account Opening) -->
            <div class="img-placeholder" style="background: #d1d5db url('/images/membership/account-opening.jpg') center/cover no-repeat;">Account Opening</div>
            <!-- IMAGE: public/images/membership/saving-culture.jpg (Saving Culture) -->
            <div class="img-placeholder" style="background: #d1d5db url('/images/membership/saving-culture.jpg') center/cover no-repeat;">Saving Culture</div>
        </div>
    </div>
</section>

<!-- ===== 6. STATISTICS COUNTERS ===== -->
<section class="stats-section" id="statsSection">
    <div class="container">
        <div class="section-title" style="margin-bottom: 2rem;">
            <h2 style="color: var(--white);">Our Impact in Numbers</h2>
            <p style="color: rgba(255,255,255,0.8);">Kasambya SACCO by the numbers</p>
        </div>
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                    </svg>
                </div>
                <div class="stat-number"><span class="counter" data-target="50">0</span>+</div>
                <div class="stat-label">Professional Staff</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                    </svg>
                </div>
                <div class="stat-number"><span class="counter" data-target="25">0</span>+</div>
                <div class="stat-label">Districts Served</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                    </svg>
                </div>
                <div class="stat-number"><span class="counter" data-target="21">0</span>+</div>
                <div class="stat-label">Years of Experience</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div class="stat-number"><span class="counter" data-target="10">0</span>K</div>
                <div class="stat-label">Satisfied Customers</div>
            </div>
        </div>
    </div>
</section>

<!-- ===== 7. KEY SAVING PRODUCTS ===== -->
<section class="products-section">
    <div class="container">
        <div class="section-title">
            <h2>Key Saving Products</h2>
            <p>Explore our range of saving products designed to meet your unique financial needs.</p>
        </div>
        <div class="products-grid">
            <div class="product-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/>
                    </svg>
                </div>
                <h3>Voluntary Savings</h3>
                <p>Flexible savings account with no fixed deposit requirements. Save any amount at any time.</p>
                <a href="{{ url('/saving-products') }}" class="learn-more">Learn More &rarr;</a>
            </div>
            <div class="product-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
                    </svg>
                </div>
                <h3>Fixed Savings</h3>
                <p>Earn higher returns by committing to save a fixed amount over a specified period.</p>
                <a href="{{ url('/saving-products') }}" class="learn-more">Learn More &rarr;</a>
            </div>
            <div class="product-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h3>Minor Account</h3>
                <p>Savings accounts for children under 18, managed by a parent or guardian.</p>
                <a href="{{ url('/saving-products') }}" class="learn-more">Learn More &rarr;</a>
            </div>
            <div class="product-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h3>Associate Account</h3>
                <p>Designed for non-members who wish to save with Kasambya SACCO.</p>
                <a href="{{ url('/saving-products') }}" class="learn-more">Learn More &rarr;</a>
            </div>
            <div class="product-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12h4l3-9 3 18 3-9h4"/>
                    </svg>
                </div>
                <h3>Share Savings</h3>
                <p>Purchase shares in the SACCO and earn dividends based on the annual performance.</p>
                <a href="{{ url('/saving-products') }}" class="learn-more">Learn More &rarr;</a>
            </div>
            <div class="product-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </div>
                <h3>Joint Account</h3>
                <p>A savings account owned by two or more individuals, perfect for families and partners.</p>
                <a href="{{ url('/saving-products') }}" class="learn-more">Learn More &rarr;</a>
            </div>
            <div class="product-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h3>Individual Account</h3>
                <p>A personal savings account tailored to meet your individual financial goals.</p>
                <a href="{{ url('/saving-products') }}" class="learn-more">Learn More &rarr;</a>
            </div>
            <div class="product-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
                    </svg>
                </div>
                <h3>Group Account</h3>
                <p>Savings accounts for groups, associations, and community-based organizations.</p>
                <a href="{{ url('/saving-products') }}" class="learn-more">Learn More &rarr;</a>
            </div>
        </div>
    </div>
</section>

<!-- ===== 8. M-SACCO SECTION ===== -->
<section class="msacco-section">
    <div class="container">
        <div class="msacco-grid">
            <div class="msacco-phone">
                <div style="text-align: center; padding: 1rem;">
                    <div style="font-size: 1.5rem; color: var(--primary); font-weight: 700;">M-SACCO</div>
                    <div class="phone-screen">
                        <div style="text-align: center;">
                            <div style="font-size: 2rem; margin-bottom: 0.5rem;">Mobile</div>
                            <div>Mobile Banking</div>
                            <div style="font-size: 0.8rem; margin-top: 0.5rem;">Kasambya SACCO</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="msacco-content">
                <h2>M-SACCO: <span>Banking at Your Fingertips</span></h2>
                <p>Access your Kasambya SACCO account anytime, anywhere using your mobile phone. Our M-SACCO platform brings banking convenience directly to you.</p>
                <ul class="msacco-benefits">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                        <div><strong>Convenience</strong> &ndash; Access your account 24/7 from anywhere in Uganda.</div>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                        <div><strong>Time Saving</strong> &ndash; No more waiting in lines. Transact instantly.</div>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                        <div><strong>Improved Financial Management</strong> &ndash; Track your savings and transactions in real time.</div>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <div><strong>Enhanced Security</strong> &ndash; Your transactions and data are protected with industry-standard security.</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ===== 9. NEWS SECTION ===== -->
<section class="news-section">
    <div class="container">
        <div class="section-title">
            <h2>Latest News</h2>
            <p>Stay updated with the latest news and announcements from Kasambya SACCO.</p>
        </div>
        <div class="news-grid">
            <div class="news-card">
                <!-- IMAGE: public/images/news/news-1.jpg (News Image 1) -->
                <div class="news-img" style="background: #d1d5db url('/images/news/news-1.jpg') center/cover no-repeat;">
                    <span>News Image</span>
                    <span class="news-badge">Announcement</span>
                </div>
                <div class="news-body">
                    <div class="news-date">January 15, 2026</div>
                    <h3 class="news-title">Kasambya SACCO Announces Increased Dividends for Members</h3>
                    <p class="news-excerpt">We are pleased to announce a 12% dividend payout for the 2025 financial year, reflecting our strong performance.</p>
                    <div class="news-author">
                        <div class="avatar">KS</div>
                        <span class="name">Kasambya SACCO</span>
                    </div>
                </div>
            </div>
            <div class="news-card">
                <!-- IMAGE: public/images/news/news-2.jpg (News Image 2) -->
                <div class="news-img" style="background: #d1d5db url('/images/news/news-2.jpg') center/cover no-repeat;">
                    <span>News Image</span>
                    <span class="news-badge">Events</span>
                </div>
                <div class="news-body">
                    <div class="news-date">December 5, 2025</div>
                    <h3 class="news-title">Annual General Meeting 2026 Date Announced</h3>
                    <p class="news-excerpt">Mark your calendars! The 2026 Annual General Meeting will be held on March 15th at our headquarters.</p>
                    <div class="news-author">
                        <div class="avatar">KS</div>
                        <span class="name">Kasambya SACCO</span>
                    </div>
                </div>
            </div>
            <div class="news-card">
                <!-- IMAGE: public/images/news/news-3.jpg (News Image 3) -->
                <div class="news-img" style="background: #d1d5db url('/images/news/news-3.jpg') center/cover no-repeat;">
                    <span>News Image</span>
                    <span class="news-badge">Update</span>
                </div>
                <div class="news-body">
                    <div class="news-date">November 20, 2025</div>
                    <h3 class="news-title">New M-SACCO Features Launched for Easier Banking</h3>
                    <p class="news-excerpt">We have upgraded our mobile platform with new features including loan applications and statement requests.</p>
                    <div class="news-author">
                        <div class="avatar">KS</div>
                        <span class="name">Kasambya SACCO</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== 10. FAQ SECTION ===== -->
<section class="faq-section">
    <div class="container">
        <div class="section-title">
            <h2>Frequently Asked Questions</h2>
            <p>Find answers to common questions about Kasambya SACCO and our services.</p>
        </div>
        <div class="faq-list">
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>What is a SACCO and how does it work?</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>
                <div class="faq-answer">
                    <p>A SACCO (Savings and Credit Cooperative Organization) is a member-owned financial cooperative that provides savings and loan services to its members. Members pool their savings together and can borrow from the shared fund at affordable interest rates. Profits are shared among members through dividends.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>How can I become a member of Kasambya SACCO?</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>
                <div class="faq-answer">
                    <p>To become a member, visit our offices with a valid National ID or Passport, two passport-size photos, and the minimum share deposit. Complete the membership application form and you will be registered as a member. You can also inquire about group membership for organizations.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>What types of loans are available and what are the requirements?</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>
                <div class="faq-answer">
                    <p>We offer various loan products including development loans, emergency loans, school fees loans, and business loans. Requirements include being an active member with regular savings, a completed loan application form, guarantors, and proof of income or collateral depending on the loan type and amount.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== 11. PARTNERS SECTION ===== -->
<section class="partners-section">
    <div class="container">
        <div class="section-title">
            <h2>Our Partners</h2>
            <p>We are proud to collaborate with these trusted organizations.</p>
        </div>
        <div class="partners-wrapper">
            <div class="partners-container">
                <div class="partners-track">
                    <div class="partner-logo">Stanbic Bank</div>
                    <div class="partner-logo">Pearl Bank</div>
                    <div class="partner-logo">MS</div>
                    <div class="partner-logo">UCSU</div>
                    <div class="partner-logo">UMRA</div>
                    <div class="partner-logo">Stanbic Bank</div>
                    <div class="partner-logo">Pearl Bank</div>
                    <div class="partner-logo">MS</div>
                    <div class="partner-logo">UCSU</div>
                    <div class="partner-logo">UMRA</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== 12. CTA BANNER ===== -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Join Kasambya SACCO?</h2>
            <div class="cta-phone">Call us today: <a href="tel:+2560775125122">+256 0775 125 122</a></div>
            <p style="margin-bottom: 2rem; opacity: 0.9; font-size: 1.1rem;">Start your journey towards financial freedom today.</p>
            <a href="{{ url('/membership') }}" class="btn-member">Become a Member</a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    (function() {
        var slides = document.querySelectorAll('.hero-slide');
        var dots = document.querySelectorAll('.dot');
        var currentSlide = 0;
        var interval;

        function goToSlide(index) {
            for (var i = 0; i < slides.length; i++) {
                slides[i].classList.remove('active');
                dots[i].classList.remove('active');
            }
            currentSlide = (index + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }

        function nextSlide() { goToSlide(currentSlide + 1); }

        function startSlider() { interval = setInterval(nextSlide, 5000); }

        for (var i = 0; i < dots.length; i++) {
            dots[i].addEventListener('click', function() {
                clearInterval(interval);
                goToSlide(parseInt(this.dataset.index));
                startSlider();
            });
        }

        startSlider();
    })();

    (function() {
        var counters = document.querySelectorAll('.counter');
        var countersAnimated = false;

        function animateCounters() {
            if (countersAnimated) return;
            var section = document.getElementById('statsSection');
            var rect = section.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                countersAnimated = true;
                for (var i = 0; i < counters.length; i++) {
                    (function(counter) {
                        var target = parseInt(counter.dataset.target);
                        var increment = Math.ceil(target / 60);
                        var current = 0;
                        var update = setInterval(function() {
                            current += increment;
                            if (current >= target) {
                                counter.textContent = target;
                                clearInterval(update);
                            } else {
                                counter.textContent = current;
                            }
                        }, 30);
                    })(counters[i]);
                }
            }
        }

        window.addEventListener('scroll', animateCounters);
        window.addEventListener('load', animateCounters);
    })();

    function toggleFAQ(btn) {
        var answer = btn.nextElementSibling;
        var isOpen = answer.classList.contains('open');
        var allAnswers = document.querySelectorAll('.faq-answer.open');
        var allQuestions = document.querySelectorAll('.faq-question.open');
        for (var i = 0; i < allAnswers.length; i++) {
            allAnswers[i].classList.remove('open');
        }
        for (var i = 0; i < allQuestions.length; i++) {
            allQuestions[i].classList.remove('open');
        }
        if (!isOpen) {
            answer.classList.add('open');
            btn.classList.add('open');
        }
    }
</script>
@endpush

