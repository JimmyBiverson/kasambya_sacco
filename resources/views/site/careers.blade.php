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

    .page-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        padding: 4rem 0;
        text-align: center;
        color: var(--white);
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
        font-size: 2.5rem;
        font-weight: 800;
        position: relative;
        z-index: 1;
        margin-bottom: 0.5rem;
    }
    .page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        position: relative;
        z-index: 1;
    }

    .breadcrumb {
        background: var(--light-bg);
        padding: 0.8rem 0;
        border-bottom: 1px solid #e5e7eb;
    }
    .breadcrumb .container {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        color: var(--text-light);
    }
    .breadcrumb a {
        color: var(--primary);
        text-decoration: none;
        transition: var(--transition);
    }
    .breadcrumb a:hover {
        color: var(--amber);
    }
    .breadcrumb .separator {
        color: #d1d5db;
    }
    .breadcrumb .current {
        color: var(--text-dark);
        font-weight: 600;
    }

    .intro-section {
        padding: 3rem 0;
        background: var(--white);
    }
    .intro-section .container {
        max-width: 800px;
        text-align: center;
    }
    .intro-section h2 {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--primary-dark);
        margin-bottom: 1rem;
    }
    .intro-section p {
        font-size: 1.05rem;
        color: var(--text-light);
        line-height: 1.7;
    }

    .openings-section { padding: 0 0 4rem; background: var(--white); }
    .section-title { text-align: center; margin-bottom: 2.5rem; }
    .section-title h2 {
        font-size: 2rem;
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
        margin-top: 0.8rem;
        font-size: 1.05rem;
    }

    .jobs-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }

    .job-card {
        background: var(--white);
        border: 1px solid #e5e7eb;
        border-radius: var(--radius-lg);
        padding: 2rem;
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }
    .job-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary);
        transition: var(--transition);
    }
    .job-card:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-lg);
        transform: translateY(-4px);
    }
    .job-card:hover::before {
        background: var(--amber);
    }
    .job-card .job-icon {
        width: 56px;
        height: 56px;
        background: var(--light-bg);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.2rem;
    }
    .job-card .job-icon svg {
        width: 28px;
        height: 28px;
        color: var(--primary);
    }
    .job-card h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 1rem;
    }
    .job-card .job-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 1rem;
    }
    .job-card .job-tags .tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .job-card .job-tags .tag.type {
        background: #dbeafe;
        color: #1d4ed8;
    }
    .job-card .job-tags .tag.location {
        background: var(--light-bg);
        color: var(--primary);
    }
    .job-card .job-tags .tag svg {
        width: 14px;
        height: 14px;
    }
    .job-card .job-description {
        font-size: 0.95rem;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 1.5rem;
        flex: 1;
    }
    .job-card .btn-apply {
        display: inline-block;
        padding: 10px 28px;
        background: var(--primary);
        color: var(--white);
        font-weight: 700;
        font-size: 0.9rem;
        border-radius: var(--radius);
        text-decoration: none;
        transition: var(--transition);
        text-align: center;
        border: none;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .job-card .btn-apply:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .benefits-section { padding: 4rem 0; background: var(--light-bg); }
    .benefits-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
    .benefit-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 2.5rem 2rem;
        text-align: center;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }
    .benefit-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--amber);
    }
    .benefit-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }
    .benefit-card .icon-wrap {
        width: 72px;
        height: 72px;
        background: var(--light-bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
    }
    .benefit-card .icon-wrap svg {
        width: 36px;
        height: 36px;
        color: var(--primary);
    }
    .benefit-card h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 0.8rem;
    }
    .benefit-card p {
        font-size: 0.95rem;
        color: var(--text-light);
        line-height: 1.6;
    }

    .contact-section { padding: 4rem 0; background: var(--white); }
    .contact-section .container {
        max-width: 700px;
        text-align: center;
    }
    .contact-section h2 {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--primary-dark);
        margin-bottom: 1rem;
    }
    .contact-section p {
        font-size: 1.05rem;
        color: var(--text-light);
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }
    .contact-section .contact-details {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
    }
    .contact-section .contact-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1rem;
        color: var(--text-dark);
    }
    .contact-section .contact-item svg {
        width: 22px;
        height: 22px;
        color: var(--primary);
        flex-shrink: 0;
    }
    .contact-section .contact-item a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
    }
    .contact-section .contact-item a:hover {
        color: var(--amber);
    }

    .cta-banner {
        padding: 3rem 0;
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        text-align: center;
        color: var(--white);
    }
    .cta-banner h2 {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 0.8rem;
    }
    .cta-banner p {
        font-size: 1.05rem;
        opacity: 0.9;
        margin-bottom: 1.5rem;
    }
    .cta-banner .btn-gold {
        display: inline-block;
        padding: 14px 36px;
        background: var(--amber);
        color: var(--white);
        font-weight: 700;
        font-size: 1rem;
        border-radius: var(--radius);
        text-decoration: none;
        transition: var(--transition);
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        cursor: pointer;
    }
    .cta-banner .btn-gold:hover {
        background: var(--amber-hover);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245,158,11,0.4);
    }

    @media (max-width: 1024px) {
        .jobs-grid { grid-template-columns: repeat(2, 1fr); }
        .benefits-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .page-header { padding: 3rem 0; }
        .page-header h1 { font-size: 2rem; }
        .jobs-grid { grid-template-columns: 1fr; }
        .benefits-grid { grid-template-columns: 1fr; }
        .contact-section .contact-details { flex-direction: column; align-items: center; }
        .intro-section h2 { font-size: 1.5rem; }
        .section-title h2 { font-size: 1.6rem; }
    }
    @media (max-width: 480px) {
        .page-header h1 { font-size: 1.6rem; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Careers</h1>
        <p>Join Our Team and Make a Difference</p>
    </div>
</div>

<div class="breadcrumb">
    <div class="container">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <span class="current">Careers</span>
    </div>
</div>

<section class="intro-section">
    <div class="container">
        <h2>Grow Your Career with Kasambya SACCO</h2>
        <p>At Kasambya SACCO, we believe that our people are our greatest asset. We are committed to creating a work environment that fosters professional growth, innovation, and a shared passion for serving our community. Join us in our mission to provide affordable and sustainable financial services to our members.</p>
    </div>
</section>

<section class="openings-section">
    <div class="container">
        <div class="section-title">
            <h2>Current Openings</h2>
            <p>Explore available opportunities and take the next step in your career</p>
        </div>
        <div class="jobs-grid">
            <div class="job-card">
                <div class="job-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h3>Loan Officer</h3>
                <div class="job-tags">
                    <span class="tag type">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Full Time
                    </span>
                    <span class="tag location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        Kasambya
                    </span>
                </div>
                <p class="job-description">We are looking for a motivated Loan Officer to evaluate, authorize, and recommend loan applications. The ideal candidate will have strong analytical skills and a passion for helping members access affordable credit.</p>
                <a href="#" class="btn-apply">Apply Now</a>
            </div>

            <div class="job-card">
                <div class="job-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
                    </svg>
                </div>
                <h3>ICT Officer</h3>
                <div class="job-tags">
                    <span class="tag type">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Full Time
                    </span>
                    <span class="tag location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        Kasambya
                    </span>
                </div>
                <p class="job-description">We seek a skilled ICT Officer to manage our information technology systems, maintain network infrastructure, and support the M-SACCO mobile banking platform. Experience with financial systems is an added advantage.</p>
                <a href="#" class="btn-apply">Apply Now</a>
            </div>

            <div class="job-card">
                <div class="job-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/>
                    </svg>
                </div>
                <h3>Accountant</h3>
                <div class="job-tags">
                    <span class="tag type">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Full Time
                    </span>
                    <span class="tag location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        Kasambya
                    </span>
                </div>
                <p class="job-description">We are looking for a qualified Accountant to manage financial records, prepare reports, and ensure compliance with cooperative accounting standards. CPA or ACCA qualification is required.</p>
                <a href="#" class="btn-apply">Apply Now</a>
            </div>
        </div>
    </div>
</section>

<section class="benefits-section">
    <div class="container">
        <div class="section-title">
            <h2>Why Work With Us</h2>
            <p>We offer a rewarding work environment with opportunities for growth and development</p>
        </div>
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h3>Competitive Compensation</h3>
                <p>We offer attractive salary packages, performance bonuses, and annual increments that recognize your contributions and dedication.</p>
            </div>
            <div class="benefit-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h3>Professional Development</h3>
                <p>We invest in our employees through training, workshops, and opportunities for career advancement within the organization.</p>
            </div>
            <div class="benefit-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                    </svg>
                </div>
                <h3>Stable Work Environment</h3>
                <p>Join a well-established organization with over 20 years of history, providing job security and a supportive workplace culture.</p>
            </div>
            <div class="benefit-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <h3>Community Impact</h3>
                <p>Work for an organization that makes a real difference in people's lives by providing access to affordable financial services.</p>
            </div>
            <div class="benefit-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </div>
                <h3>Health & Wellness</h3>
                <p>We prioritize the well-being of our employees with comprehensive health insurance coverage and wellness programs.</p>
            </div>
            <div class="benefit-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                    </svg>
                </div>
                <h3>Work-Life Balance</h3>
                <p>We understand the importance of balance and offer flexible working arrangements, leave days, and a supportive team environment.</p>
            </div>
        </div>
    </div>
</section>

<section class="contact-section">
    <div class="container">
        <h2>Don't See a Suitable Opening?</h2>
        <p>We are always on the lookout for talented individuals who share our vision. If you believe you have what it takes to contribute to our team, we encourage you to send your CV and cover letter to our HR department.</p>
        <div class="contact-details">
            <div class="contact-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                </svg>
                <a href="mailto:kasambyasacco@gmail.com">kasambyasacco@gmail.com</a>
            </div>
            <div class="contact-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
                <a href="tel:+2560775125122">+256 0775 125 122</a>
            </div>
        </div>
    </div>
</section>

<div class="cta-banner">
    <div class="container">
        <h2>Ready to Join Our Team?</h2>
        <p>Take the first step towards a rewarding career with Kasambya SACCO.</p>
        <a href="mailto:kasambyasacco@gmail.com" class="btn-gold">Send Your Application</a>
    </div>
</div>

@endsection
