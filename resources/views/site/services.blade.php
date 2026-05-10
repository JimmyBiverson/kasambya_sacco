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

    .page-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        padding: 4rem 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .page-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .page-header h1 {
        font-size: 2.8rem;
        font-weight: 800;
        color: var(--white);
        position: relative;
        z-index: 1;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    .breadcrumb {
        position: relative;
        z-index: 1;
        color: rgba(255,255,255,0.8);
        font-size: 0.95rem;
        margin-top: 0.8rem;
    }
    .breadcrumb a {
        color: var(--amber);
        text-decoration: none;
    }
    .breadcrumb a:hover {
        text-decoration: underline;
    }
    .breadcrumb span {
        color: rgba(255,255,255,0.6);
    }

    .section-padding { padding: 5rem 0; }

    .section-title { text-align: center; margin-bottom: 3rem; }
    .section-title h2 {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--primary-dark);
        position: relative;
        display: inline-block;
    }
    .section-title h2::after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background: var(--amber);
        margin: 12px auto 0;
        border-radius: 2px;
    }
    .section-title p {
        color: var(--text-light);
        margin-top: 1rem;
        font-size: 1.1rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }
    .service-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 2rem;
        text-align: center;
        box-shadow: var(--shadow);
        transition: var(--transition);
        border: 1px solid #e5e7eb;
        position: relative;
        overflow: hidden;
    }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary);
    }
    .service-card .icon-wrap {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
        transition: var(--transition);
    }
    .service-card:hover .icon-wrap {
        transform: scale(1.1) rotate(-5deg);
    }
    .service-card .icon-wrap svg {
        width: 36px;
        height: 36px;
    }
    .service-card h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 0.7rem;
    }
    .service-card p {
        font-size: 0.93rem;
        color: var(--text-light);
        line-height: 1.6;
    }
    .service-card .card-number {
        position: absolute;
        top: 12px;
        right: 16px;
        font-size: 3rem;
        font-weight: 900;
        color: rgba(0,0,0,0.04);
        line-height: 1;
        pointer-events: none;
    }

    .cta-section {
        padding: 4rem 0;
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
    }
    .cta-content { text-align: center; color: var(--white); }
    .cta-content h2 {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 0.8rem;
    }
    .cta-content .cta-phone {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--amber);
        margin-bottom: 1.5rem;
    }
    .cta-content .cta-phone a {
        color: var(--amber);
        text-decoration: none;
    }
    .cta-content .cta-phone a:hover {
        text-decoration: underline;
    }
    .cta-content .btn-member {
        display: inline-block;
        padding: 16px 44px;
        background: var(--amber);
        color: var(--white);
        font-weight: 700;
        font-size: 1.1rem;
        border-radius: var(--radius);
        text-decoration: none;
        transition: var(--transition);
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        cursor: pointer;
    }
    .cta-content .btn-member:hover {
        background: var(--amber-hover);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245,158,11,0.4);
    }

    .newsletter-section {
        padding: 4rem 0;
        background: var(--light-bg);
    }
    .newsletter-box {
        max-width: 640px;
        margin: 0 auto;
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 3rem;
        text-align: center;
        box-shadow: var(--shadow-lg);
    }
    .newsletter-box h3 {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--primary-dark);
        margin-bottom: 0.8rem;
    }
    .newsletter-box p {
        color: var(--text-light);
        margin-bottom: 2rem;
        font-size: 1rem;
    }
    .newsletter-form {
        display: flex;
        gap: 12px;
        max-width: 480px;
        margin: 0 auto;
    }
    .newsletter-form input {
        flex: 1;
        padding: 14px 18px;
        border: 2px solid #e5e7eb;
        border-radius: var(--radius);
        font-size: 1rem;
        outline: none;
        transition: var(--transition);
    }
    .newsletter-form input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(26,110,62,0.15);
    }
    .newsletter-form button {
        padding: 14px 32px;
        background: var(--primary);
        color: var(--white);
        font-weight: 700;
        font-size: 1rem;
        border: none;
        border-radius: var(--radius);
        cursor: pointer;
        transition: var(--transition);
        white-space: nowrap;
    }
    .newsletter-form button:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    @media (max-width: 1024px) {
        .services-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .page-header h1 { font-size: 2rem; }
        .services-grid { grid-template-columns: 1fr; }
        .section-title h2 { font-size: 1.8rem; }
        .cta-content h2 { font-size: 1.6rem; }
        .cta-content .cta-phone { font-size: 1.3rem; }
        .newsletter-form { flex-direction: column; }
        .newsletter-box { padding: 2rem 1.5rem; }
    }
</style>
@endpush

@section('content')

<!-- ===== PAGE HEADER ===== -->
<section class="page-header">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1>Our Services</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Kasambya Sacco</a>
            <span> &rsaquo; </span>
            <span>Our Services</span>
        </div>
    </div>
</section>

<!-- ===== SAVING ACCOUNTS GRID ===== -->
<section class="section-padding" style="background: var(--white);">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="section-title">
            <h2>Saving Products</h2>
            <p>Choose from a wide range of saving accounts designed to meet your unique financial goals.</p>
        </div>
        <div class="services-grid">

            <div class="service-card">
                <div class="icon-wrap" style="background: #e8f5e9;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#1a6e3e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/>
                    </svg>
                </div>
                <span class="card-number">01</span>
                <h3>Voluntary Savings</h3>
                <p>Flexible savings account with no fixed deposit requirements. Save any amount at any time and watch your money grow with competitive interest rates.</p>
            </div>

            <div class="service-card">
                <div class="icon-wrap" style="background: #fef3c7;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
                    </svg>
                </div>
                <span class="card-number">02</span>
                <h3>Fixed Savings</h3>
                <p>Commit to saving a fixed amount over a specified period and earn higher returns. Ideal for members with a regular income stream.</p>
            </div>

            <div class="service-card">
                <div class="icon-wrap" style="background: #fce4ec;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#e91e63" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <span class="card-number">03</span>
                <h3>Minor Account</h3>
                <p>Savings accounts for children under 18 years, managed by a parent or guardian. Build a saving culture from an early age.</p>
            </div>

            <div class="service-card">
                <div class="icon-wrap" style="background: #e3f2fd;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#1565c0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <span class="card-number">04</span>
                <h3>Associate Account</h3>
                <p>Designed for non-members and organizations who wish to save with Kasambya SACCO while enjoying competitive benefits.</p>
            </div>

            <div class="service-card">
                <div class="icon-wrap" style="background: #f3e5f5;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#7b1fa2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12h4l3-9 3 18 3-9h4"/>
                    </svg>
                </div>
                <span class="card-number">05</span>
                <h3>Share Savings</h3>
                <p>Purchase shares in the SACCO and earn annual dividends based on the society's performance. Your investment grows with us.</p>
            </div>

            <div class="service-card">
                <div class="icon-wrap" style="background: #fce4ec;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#d81b60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </div>
                <span class="card-number">06</span>
                <h3>Joint Account</h3>
                <p>A savings account owned by two or more individuals. Perfect for married couples, business partners, and family members.</p>
            </div>

            <div class="service-card">
                <div class="icon-wrap" style="background: #e8f5e9;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <span class="card-number">07</span>
                <h3>Individual Account</h3>
                <p>A personal savings account tailored to meet your individual financial goals. The most popular choice for our members.</p>
            </div>

            <div class="service-card">
                <div class="icon-wrap" style="background: #fff3e0;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#e65100" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
                    </svg>
                </div>
                <span class="card-number">08</span>
                <h3>Group Account</h3>
                <p>Savings accounts designed for groups, associations, VSLA groups, and community-based organizations. Save collectively.</p>
            </div>

            <div class="service-card">
                <div class="icon-wrap" style="background: #e0f2f1;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#00695c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <span class="card-number">09</span>
                <h3>Institutional Account</h3>
                <p>Tailored for schools, churches, NGOs, and other institutions seeking a reliable savings partner for their funds.</p>
            </div>

        </div>
    </div>
</section>

<!-- ===== CTA BANNER ===== -->
<section class="cta-section">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="cta-content">
            <h2>Start Saving Today</h2>
            <div class="cta-phone">Call us today: <a href="tel:+2560775125122">+256 0775 125 122</a></div>
            <p style="margin-bottom: 2rem; opacity: 0.9; font-size: 1.1rem;">Choose the saving plan that works for you and start building your financial future.</p>
            <a href="{{ route('application') }}" class="btn-member">Become a Member</a>
        </div>
    </div>
</section>

<!-- ===== NEWSLETTER SUBSCRIBE ===== -->
<section class="newsletter-section">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="newsletter-box">
            <h3>Subscribe to Get Quarterly Updates</h3>
            <p>Stay informed about new products, interest rates, dividends, and SACCO news delivered to your inbox every quarter.</p>
            <form class="newsletter-form" action="#" method="POST">
                <input type="email" name="email" placeholder="Enter your email address" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </div>
</section>

@endsection
