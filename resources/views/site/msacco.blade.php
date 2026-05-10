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

    .msacco-intro {
        padding: 4rem 0;
        background: var(--light-bg);
    }
    .msacco-intro .intro-text {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }
    .msacco-intro .intro-text p {
        font-size: 1.1rem;
        color: var(--text-light);
        line-height: 1.8;
    }

    .benefits-section {
        padding: 5rem 0;
        background: var(--white);
    }
    .benefits-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: center;
    }
    .benefits-list { display: flex; flex-direction: column; gap: 24px; }
    .benefit-item {
        display: flex;
        gap: 16px;
        align-items: flex-start;
        padding: 1.5rem;
        background: var(--light-bg);
        border-radius: var(--radius-lg);
        transition: var(--transition);
        border-left: 4px solid var(--primary);
    }
    .benefit-item:hover {
        transform: translateX(8px);
        box-shadow: var(--shadow);
    }
    .benefit-item .icon-wrap {
        width: 56px;
        height: 56px;
        background: var(--white);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .benefit-item .icon-wrap svg {
        width: 28px;
        height: 28px;
        color: var(--primary);
    }
    .benefit-item .benefit-text h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 0.3rem;
    }
    .benefit-item .benefit-text p {
        font-size: 0.93rem;
        color: var(--text-light);
        line-height: 1.5;
    }

    .phone-mockup {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .phone-frame {
        width: 280px;
        background: var(--primary-dark);
        border-radius: 40px;
        padding: 16px;
        box-shadow: var(--shadow-lg), 0 0 0 2px var(--primary);
    }
    .phone-screen {
        background: var(--white);
        border-radius: 28px;
        overflow: hidden;
        min-height: 480px;
        display: flex;
        flex-direction: column;
    }
    .phone-status {
        background: var(--primary);
        color: var(--white);
        text-align: center;
        padding: 10px 0;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 1px;
    }
    .phone-app-header {
        background: var(--primary);
        color: var(--white);
        padding: 16px;
        text-align: center;
    }
    .phone-app-header .app-name {
        font-weight: 800;
        font-size: 1.1rem;
    }
    .phone-app-header .app-sub {
        font-size: 0.75rem;
        opacity: 0.9;
    }
    .phone-body {
        padding: 20px 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .phone-menu-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        background: var(--light-bg);
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-dark);
    }
    .phone-menu-item .menu-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--primary);
        flex-shrink: 0;
    }
    .phone-footer-note {
        text-align: center;
        font-size: 0.7rem;
        color: var(--text-light);
        padding: 8px 0;
        border-top: 1px solid #e5e7eb;
    }

    .how-it-works {
        padding: 5rem 0;
        background: var(--light-bg);
    }
    .steps-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        counter-reset: step;
    }
    .step-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 2rem;
        text-align: center;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
    }
    .step-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg);
    }
    .step-card .step-number {
        width: 48px;
        height: 48px;
        background: var(--primary);
        color: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        font-weight: 800;
        margin: 0 auto 1rem;
    }
    .step-card h4 {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 0.6rem;
    }
    .step-card p {
        font-size: 0.9rem;
        color: var(--text-light);
        line-height: 1.5;
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
    .cta-content .btn-contact {
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
    .cta-content .btn-contact:hover {
        background: var(--amber-hover);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245,158,11,0.4);
    }

    @media (max-width: 1024px) {
        .steps-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .page-header h1 { font-size: 2rem; }
        .benefits-grid { grid-template-columns: 1fr; }
        .steps-grid { grid-template-columns: 1fr; }
        .section-title h2 { font-size: 1.8rem; }
        .cta-content h2 { font-size: 1.6rem; }
        .cta-content .cta-phone { font-size: 1.3rem; }
        .phone-frame { width: 240px; }
        .phone-screen { min-height: 380px; }
        .benefit-item:hover { transform: none; }
    }
</style>
@endpush

@section('content')

<!-- ===== PAGE HEADER ===== -->
<section class="page-header">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1>M-SACCO Service</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Kasambya Sacco</a>
            <span> &rsaquo; </span>
            <span>M-SACCO Service</span>
        </div>
    </div>
</section>

<!-- ===== INTRO ===== -->
<section class="msacco-intro">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="intro-text">
            <p>M-SACCO is Kasambya SACCO's innovative mobile banking platform that brings financial services directly to your mobile phone. With M-SACCO, you can access your account, check balances, make transactions, apply for loans, and manage your savings anytime, anywhere in Uganda. No more long queues or travel to the branch &mdash; banking is now at your fingertips.</p>
        </div>
    </div>
</section>

<!-- ===== BENEFITS + PHONE MOCKUP ===== -->
<section class="benefits-section">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="benefits-grid">
            <div class="benefits-list">
                <div class="benefit-item">
                    <div class="icon-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                    </div>
                    <div class="benefit-text">
                        <h4>Convenience</h4>
                        <p>Access your Kasambya SACCO account 24 hours a day, 7 days a week from anywhere in Uganda using your mobile phone. No need to visit the branch for basic transactions.</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="icon-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div class="benefit-text">
                        <h4>Time Saving</h4>
                        <p>No more waiting in long queues. Perform transactions instantly with just a few taps on your phone. Save valuable time that you can invest in your business or family.</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="icon-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <div class="benefit-text">
                        <h4>Improved Financial Management</h4>
                        <p>Track your savings, monitor your loan balances, view transaction history, and manage your finances in real time. Stay in control of your money at all times.</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="icon-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </div>
                    <div class="benefit-text">
                        <h4>Enhanced Security</h4>
                        <p>Your transactions and personal data are protected with industry-standard encryption and security protocols. Your PIN and personal information remain confidential.</p>
                    </div>
                </div>
            </div>

            <div class="phone-mockup">
                <div class="phone-frame">
                    <div class="phone-screen">
                        <div class="phone-status">M-SACCO</div>
                        <div class="phone-app-header">
                            <div class="app-name">Kasambya SACCO</div>
                            <div class="app-sub">Mobile Banking</div>
                        </div>
                        <div class="phone-body">
                            <div class="phone-menu-item">
                                <span class="menu-dot" style="background: var(--primary);"></span>
                                Check Balance
                            </div>
                            <div class="phone-menu-item">
                                <span class="menu-dot" style="background: var(--amber);"></span>
                                Send Money
                            </div>
                            <div class="phone-menu-item">
                                <span class="menu-dot" style="background: var(--primary);"></span>
                                Loan Application
                            </div>
                            <div class="phone-menu-item">
                                <span class="menu-dot" style="background: var(--amber);"></span>
                                Savings Deposit
                            </div>
                            <div class="phone-menu-item">
                                <span class="menu-dot" style="background: var(--primary);"></span>
                                Mini Statement
                            </div>
                            <div class="phone-menu-item">
                                <span class="menu-dot" style="background: var(--amber);"></span>
                                Change PIN
                            </div>
                            <div class="phone-footer-note">Dial *227# to access</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== HOW IT WORKS ===== -->
<section class="how-it-works">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="section-title">
            <h2>How It Works</h2>
            <p>Getting started with M-SACCO is quick and easy. Follow these simple steps.</p>
        </div>
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-number">1</div>
                <h4>Register for M-SACCO</h4>
                <p>Visit any Kasambya SACCO branch or contact our customer service to register your mobile number for M-SACCO services.</p>
            </div>
            <div class="step-card">
                <div class="step-number">2</div>
                <h4>Set Up Your PIN</h4>
                <p>After registration, you will receive instructions to set up your secure PIN. Your PIN is confidential &mdash; never share it with anyone.</p>
            </div>
            <div class="step-card">
                <div class="step-number">3</div>
                <h4>Dial the USSD Code</h4>
                <p>Dial <strong>*227#</strong> on your mobile phone to access the M-SACCO menu. Follow the on-screen prompts to navigate the options.</p>
            </div>
            <div class="step-card">
                <div class="step-number">4</div>
                <h4>Start Transacting</h4>
                <p>Check balances, send money, apply for loans, make deposits, and manage your account directly from your phone anytime.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== CTA BANNER ===== -->
<section class="cta-section">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="cta-content">
            <h2>Get Started with M-SACCO Today</h2>
            <div class="cta-phone">Call us today: <a href="tel:+2560775125122">+256 0775 125 122</a></div>
            <p style="margin-bottom: 2rem; opacity: 0.9; font-size: 1.1rem;">Register for M-SACCO and enjoy the convenience of mobile banking.</p>
            <a href="{{ route('contact') }}" class="btn-contact">Contact Us</a>
        </div>
    </div>
</section>

@endsection
