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
    .breadcrumb a { color: var(--amber); text-decoration: none; }
    .breadcrumb a:hover { text-decoration: underline; }
    .breadcrumb span { color: rgba(255,255,255,0.6); }

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

    .intro-section {
        padding: 3rem 0;
        background: var(--light-bg);
    }
    .intro-content {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }
    .intro-content p {
        font-size: 1.1rem;
        color: var(--text-light);
        line-height: 1.8;
    }

    .loans-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }
    .loan-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 2rem;
        box-shadow: var(--shadow);
        transition: var(--transition);
        border: 1px solid #e5e7eb;
        position: relative;
        overflow: hidden;
    }
    .loan-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary);
        transition: var(--transition);
    }
    .loan-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }
    .loan-card:hover::before {
        background: var(--amber);
    }
    .loan-card .icon-wrap {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.2rem;
        transition: var(--transition);
    }
    .loan-card:hover .icon-wrap {
        transform: scale(1.1) rotate(-5deg);
    }
    .loan-card .icon-wrap .emoji {
        font-size: 2rem;
        line-height: 1;
    }
    .loan-card h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 0.7rem;
    }
    .loan-card p {
        font-size: 0.93rem;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 1rem;
    }
    .loan-card .loan-features {
        list-style: none;
        padding: 0;
        border-top: 1px solid #f3f4f6;
        padding-top: 1rem;
    }
    .loan-card .loan-features li {
        font-size: 0.85rem;
        color: var(--text-light);
        padding: 0.3rem 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .loan-card .loan-features li::before {
        content: '';
        display: inline-block;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--primary);
        flex-shrink: 0;
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
    .cta-content .cta-phone a { color: var(--amber); text-decoration: none; }
    .cta-content .cta-phone a:hover { text-decoration: underline; }
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

    @media (max-width: 1024px) {
        .loans-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .page-header h1 { font-size: 2rem; }
        .loans-grid { grid-template-columns: 1fr; }
        .section-title h2 { font-size: 1.8rem; }
        .cta-content h2 { font-size: 1.6rem; }
        .cta-content .cta-phone { font-size: 1.3rem; }
    }
</style>
@endpush

@section('content')

<!-- ===== PAGE HEADER ===== -->
<section class="page-header">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1>Loan Products</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Kasambya Sacco</a>
            <span> &rsaquo; </span>
            <span>Loan Products</span>
        </div>
    </div>
</section>

<!-- ===== INTRO ===== -->
<section class="intro-section">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="intro-content">
            <p>Kasambya SACCO offers a variety of loan products designed to meet the diverse needs of our members. Whether you need capital for your business, school fees for your children, or a loan to acquire an asset, we have you covered. Our loans come with competitive interest rates, flexible repayment terms, and quick approval processes.</p>
        </div>
    </div>
</section>

<!-- ===== LOAN PRODUCTS GRID ===== -->
<section class="section-padding" style="background: var(--white);">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="section-title">
            <h2>Our Loan Products</h2>
            <p>Affordable loans designed to help you achieve your goals and improve your livelihood.</p>
        </div>
        <div class="loans-grid">

            <div class="loan-card">
                <div class="icon-wrap" style="background: #e8f5e9;">
                    <span class="emoji">&#x1F4B0;</span>
                </div>
                <h3>Trade &amp; Commerce Loan</h3>
                <p>Capital for your business, shop, or trading enterprise. Boost your inventory and expand your commercial operations with flexible terms.</p>
                <ul class="loan-features">
                    <li>Up to 10 million UGX</li>
                    <li>Competitive interest rates</li>
                    <li>Flexible repayment up to 24 months</li>
                </ul>
            </div>

            <div class="loan-card">
                <div class="icon-wrap" style="background: #fef3c7;">
                    <span class="emoji">&#x1F3E0;</span>
                </div>
                <h3>Housing Loan</h3>
                <p>Build, purchase, or renovate your home. Achieve your dream of owning a house with our affordable housing loan facility.</p>
                <ul class="loan-features">
                    <li>Up to 20 million UGX</li>
                    <li>Long-term repayment options</li>
                    <li>Land purchase &amp; construction</li>
                </ul>
            </div>

            <div class="loan-card">
                <div class="icon-wrap" style="background: #e3f2fd;">
                    <span class="emoji">&#x1F393;</span>
                </div>
                <h3>School Fees Loan</h3>
                <p>Never let school fees stand in the way of your child's education. Pay tuition fees conveniently and repay in affordable installments.</p>
                <ul class="loan-features">
                    <li>Up to 5 million UGX</li>
                    <li>Term-based repayment</li>
                    <li>All education levels covered</li>
                </ul>
            </div>

            <div class="loan-card">
                <div class="icon-wrap" style="background: #fce4ec;">
                    <span class="emoji">&#x26A1;</span>
                </div>
                <h3>Automatic Loan</h3>
                <p>A pre-approved loan facility based on your savings and share deposits. Access funds instantly with minimal paperwork.</p>
                <ul class="loan-features">
                    <li>Backed by your savings</li>
                    <li>Quick disbursement</li>
                    <li>No collateral required</li>
                </ul>
            </div>

            <div class="loan-card">
                <div class="icon-wrap" style="background: #fff3e0;">
                    <span class="emoji">&#x1F6A8;</span>
                </div>
                <h3>Emergency Loan</h3>
                <p>Quick funds for unexpected emergencies such as medical expenses, urgent repairs, or family emergencies. Fast approval when you need it most.</p>
                <ul class="loan-features">
                    <li>Same-day disbursement</li>
                    <li>Up to 3 million UGX</li>
                    <li>Minimal requirements</li>
                </ul>
            </div>

            <div class="loan-card">
                <div class="icon-wrap" style="background: #f3e5f5;">
                    <span class="emoji">&#x1F4BC;</span>
                </div>
                <h3>Asset Acquisition Loan</h3>
                <p>Acquire productive assets such as machinery, equipment, vehicles, or household goods. Build your asset base with our financing.</p>
                <ul class="loan-features">
                    <li>Up to 15 million UGX</li>
                    <li>Asset-backed financing</li>
                    <li>Extended repayment period</li>
                </ul>
            </div>

            <div class="loan-card">
                <div class="icon-wrap" style="background: #e0f2f1;">
                    <span class="emoji">&#x1F331;</span>
                </div>
                <h3>Environmental Loan</h3>
                <p>Finance eco-friendly projects including tree planting, renewable energy, sustainable farming, and environmental conservation initiatives.</p>
                <ul class="loan-features">
                    <li>Green project financing</li>
                    <li>Reduced interest rates</li>
                    <li>Technical support included</li>
                </ul>
            </div>

            <div class="loan-card">
                <div class="icon-wrap" style="background: #fff8e1;">
                    <span class="emoji">&#x1F33E;</span>
                </div>
                <h3>Agriculture Loan</h3>
                <p>Finance your farming activities including crop production, livestock rearing, poultry, and farm equipment. Boost your agricultural output.</p>
                <ul class="loan-features">
                    <li>Up to 10 million UGX</li>
                    <li>Season-based repayment</li>
                    <li>Farm input financing</li>
                </ul>
            </div>

            <div class="loan-card">
                <div class="icon-wrap" style="background: #ebe9f0;">
                    <span class="emoji">&#x1F68C;</span>
                </div>
                <h3>Transport Loan</h3>
                <p>Financing for boda boda motorcycles, taxis, buses, and other transport vehicles. Start or expand your transport business today.</p>
                <ul class="loan-features">
                    <li>Up to 15 million UGX</li>
                    <li>Vehicle financing</li>
                    <li>Insurance included</li>
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- ===== CTA BANNER ===== -->
<section class="cta-section">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="cta-content">
            <h2>Need a Loan?</h2>
            <div class="cta-phone">Call us today: <a href="tel:+2560775125122">+256 0775 125 122</a></div>
            <p style="margin-bottom: 2rem; opacity: 0.9; font-size: 1.1rem;">Apply for a loan today and get the funds you need to achieve your goals.</p>
            <a href="{{ route('application') }}" class="btn-member">Apply Now</a>
        </div>
    </div>
</section>

@endsection
