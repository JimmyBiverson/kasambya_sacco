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

    .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

    .breadcrumb { padding: 1rem 0; background: var(--light-bg); }
    .breadcrumb .container { display: flex; align-items: center; gap: 8px; font-size: 0.95rem; color: var(--text-light); }
    .breadcrumb a { color: var(--primary); text-decoration: none; font-weight: 500; }
    .breadcrumb a:hover { color: var(--amber); }
    .breadcrumb .sep { color: #9ca3af; }

    .about-intro { padding: 4rem 0; background: var(--white); }
    .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center; }
    .about-image { background: #d1d5db; border-radius: var(--radius-lg); min-height: 400px; display: flex; align-items: center; justify-content: center; color: #6b7280; font-size: 1.2rem; font-weight: 600; }
    .about-text h2 { font-size: 2rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 1.5rem; }
    .about-text h2 span { color: var(--amber); }
    .about-text p { font-size: 1.05rem; color: var(--text-light); line-height: 1.7; margin-bottom: 1rem; }

    .vmv-detailed { padding: 5rem 0; background: var(--light-bg); }
    .section-title { text-align: center; margin-bottom: 3rem; }
    .section-title h2 { font-size: 2.2rem; font-weight: 800; color: var(--primary-dark); position: relative; display: inline-block; }
    .section-title h2::after { content: ''; display: block; width: 60px; height: 4px; background: var(--amber); margin: 12px auto 0; border-radius: 2px; }
    .section-title p { color: var(--text-light); margin-top: 1rem; font-size: 1.1rem; max-width: 600px; margin-left: auto; margin-right: auto; }
    .vmv-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
    .vmv-card { background: var(--white); border-radius: var(--radius-lg); padding: 2.5rem 2rem; box-shadow: var(--shadow); transition: var(--transition); border-top: 4px solid var(--primary); }
    .vmv-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
    .vmv-card .icon-wrap { width: 64px; height: 64px; background: var(--light-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.2rem; }
    .vmv-card .icon-wrap svg { width: 32px; height: 32px; color: var(--primary); }
    .vmv-card h3 { font-size: 1.3rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 1rem; }
    .vmv-card p { font-size: 0.95rem; color: var(--text-light); line-height: 1.6; }
    .vmv-card ul { list-style: none; padding: 0; margin-top: 0.8rem; }
    .vmv-card ul li { padding: 0.4rem 0; color: var(--text-light); font-size: 0.9rem; display: flex; align-items: baseline; gap: 8px; }
    .vmv-card ul li::before { content: '\2713'; color: var(--primary); font-weight: 700; }

    .stats-section { padding: 5rem 0; background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); position: relative; overflow: hidden; }
    .stats-section::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; position: relative; z-index: 1; }
    .stat-item { text-align: center; color: var(--white); padding: 1.5rem; }
    .stat-item .stat-number { font-size: 3rem; font-weight: 800; margin-bottom: 0.5rem; }
    .stat-item .stat-label { font-size: 1.05rem; opacity: 0.9; font-weight: 500; }
    .stat-item .stat-icon { margin-bottom: 1rem; }
    .stat-item .stat-icon svg { width: 40px; height: 40px; color: var(--amber); }

    .team-section { padding: 5rem 0; background: var(--white); }
    .team-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 24px; }
    .team-card { background: var(--white); border-radius: var(--radius-lg); padding: 2rem 1.5rem; text-align: center; box-shadow: var(--shadow); transition: var(--transition); border: 1px solid #e5e7eb; }
    .team-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); border-color: var(--primary); }
    .team-card .avatar { width: 100px; height: 100px; border-radius: 50%; background: #d1d5db; margin: 0 auto 1.2rem; display: flex; align-items: center; justify-content: center; color: #6b7280; font-weight: 600; font-size: 0.9rem; border: 3px solid var(--primary); }
    .team-card h4 { font-size: 1.05rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 0.3rem; }
    .team-card .position { font-size: 0.85rem; color: var(--amber); font-weight: 600; margin-bottom: 0.8rem; }
    .team-card p { font-size: 0.85rem; color: var(--text-light); line-height: 1.5; margin-bottom: 1rem; }
    .team-card .social-icons { display: flex; justify-content: center; gap: 10px; }
    .team-card .social-icons a { width: 34px; height: 34px; border-radius: 50%; background: var(--light-bg); display: flex; align-items: center; justify-content: center; color: var(--primary); transition: var(--transition); text-decoration: none; }
    .team-card .social-icons a:hover { background: var(--primary); color: var(--white); }
    .team-card .social-icons a svg { width: 16px; height: 16px; }

    .cta-section { padding: 4rem 0; background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); }
    .cta-content { text-align: center; color: var(--white); }
    .cta-content h2 { font-size: 2.2rem; font-weight: 800; margin-bottom: 1rem; }
    .cta-content p { font-size: 1.1rem; opacity: 0.9; margin-bottom: 2rem; }
    .cta-content .btn-gold-custom { display: inline-block; padding: 16px 44px; background: var(--amber); color: var(--white); font-weight: 700; font-size: 1.1rem; border-radius: var(--radius); text-decoration: none; transition: var(--transition); text-transform: uppercase; letter-spacing: 1px; }
    .cta-content .btn-gold-custom:hover { background: var(--amber-hover); transform: translateY(-2px); box-shadow: 0 8px 25px rgba(245,158,11,0.4); }

    @media (max-width: 1024px) {
        .team-grid { grid-template-columns: repeat(3, 1fr); }
        .vmv-cards { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
        .about-grid { grid-template-columns: 1fr; }
        .team-grid { grid-template-columns: repeat(2, 1fr); }
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .stat-item .stat-number { font-size: 2.2rem; }
        .section-title h2 { font-size: 1.8rem; }
        .cta-content h2 { font-size: 1.6rem; }
    }
    @media (max-width: 480px) {
        .team-grid { grid-template-columns: 1fr; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">About us</h1>
        <p style="opacity: 0.9; font-size: 1.1rem;">Learn more about Kasambya SACCO</p>
    </div>
</div>

<div class="breadcrumb">
    <div class="container">
        <a href="{{ url('/') }}">Home</a>
        <span class="sep">/</span>
        <span>Kasambya Sacco</span>
        <span class="sep">/</span>
        <span style="color: var(--primary); font-weight: 600;">About us</span>
    </div>
</div>

<section class="about-intro">
    <div class="container">
        <div class="about-grid">
            <!-- IMAGE: public/images/about-office.jpg (SACCO office photo) -->
            <div class="about-image" style="background: #d1d5db url('/images/about-office.jpg') center/cover no-repeat;">
                <span>Kasambya SACCO Office</span>
            </div>
            <div class="about-text">
                <h2>About <span>Kasambya SACCO</span></h2>
                <p>Kasambya SACCO is a member-owned financial cooperative dedicated to empowering our community through accessible and affordable financial services. Established in 2003, we have grown from a small community initiative into a trusted financial institution serving thousands of members across multiple districts.</p>
                <p>We are fully registered by the Registrar of Cooperative Societies under Registration Number 6682. Our commitment to transparency, integrity, and member satisfaction has made us a pillar of the community in Kasambya Town, Mubende District, and beyond.</p>
                <p>At Kasambya SACCO, we believe in the power of collective saving and responsible lending. We offer a comprehensive range of savings and loan products designed to meet the diverse needs of our members, from individual savers to groups and institutions.</p>
            </div>
        </div>
    </div>
</section>

<section class="vmv-detailed">
    <div class="container">
        <div class="section-title">
            <h2>Our Vision, Mission &amp; Values</h2>
            <p>Guided by our core principles, we strive to deliver exceptional financial services to our members.</p>
        </div>
        <div class="vmv-cards">
            <div class="vmv-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12h4l3-9 3 18 3-9h4"/>
                    </svg>
                </div>
                <h3>Our Vision</h3>
                <p>To be the leading member-owned financial cooperative that transforms lives and builds sustainable communities by providing accessible, affordable, and innovative financial services.</p>
            </div>
            <div class="vmv-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                    </svg>
                </div>
                <h3>Our Mission</h3>
                <p>To develop a strong spirit of saving among our members, mobilize savings for productive investment, provide affordable credit, and promote financial literacy for sustainable socio-economic development.</p>
            </div>
            <div class="vmv-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h3>Core Values</h3>
                <ul>
                    <li><strong>Integrity</strong> &ndash; Upholding honesty in all operations</li>
                    <li><strong>Transparency</strong> &ndash; Open communication with members</li>
                    <li><strong>Member Focus</strong> &ndash; Prioritizing member needs</li>
                    <li><strong>Accountability</strong> &ndash; Responsible management of resources</li>
                    <li><strong>Innovation</strong> &ndash; Embracing modern financial solutions</li>
                </ul>
            </div>
        </div>
    </div>
</section>

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

<section class="team-section">
    <div class="container">
        <div class="section-title">
            <h2>Management Staff</h2>
            <p>Meet our dedicated team of professionals committed to serving you.</p>
        </div>
        <div class="team-grid">
            <div class="team-card">
                <!-- IMAGE: public/images/team/manager.jpg (300x300px - Byamukama Bernard photo) -->
                <div class="avatar" style="background: #d1d5db url('/images/team/manager.jpg') center/cover no-repeat;">BB</div>
                <h4>Byamukama Bernard</h4>
                <div class="position">SACCO Manager</div>
                <p>Providing strategic leadership and oversight for all SACCO operations.</p>
                <div class="social-icons">
                    <a href="#" title="Facebook">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" title="Twitter">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" title="LinkedIn">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>
            <div class="team-card">
                <!-- IMAGE: public/images/team/accountant.jpg (300x300px - Ampeire Charity photo) -->
                <div class="avatar" style="background: #d1d5db url('/images/team/accountant.jpg') center/cover no-repeat;">AC</div>
                <h4>Ampeire Charity</h4>
                <div class="position">Accountant/Finance Officer</div>
                <p>Managing the financial records, budgeting, and ensuring financial compliance.</p>
                <div class="social-icons">
                    <a href="#" title="Facebook">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" title="Twitter">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" title="LinkedIn">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>
            <div class="team-card">
                <!-- IMAGE: public/images/team/credit-supervisor.jpg (300x300px - Ssebayima Edwine photo) -->
                <div class="avatar" style="background: #d1d5db url('/images/team/credit-supervisor.jpg') center/cover no-repeat;">SE</div>
                <h4>Ssebayima Edwine</h4>
                <div class="position">Credit Supervisor</div>
                <p>Overseeing credit assessment, loan disbursement, and recovery processes.</p>
                <div class="social-icons">
                    <a href="#" title="Facebook">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" title="Twitter">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" title="LinkedIn">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>
            <div class="team-card">
                <!-- IMAGE: public/images/team/ict-officer.jpg (300x300px - Nyakato Rose photo) -->
                <div class="avatar" style="background: #d1d5db url('/images/team/ict-officer.jpg') center/cover no-repeat;">NR</div>
                <h4>Nyakato Rose</h4>
                <div class="position">ICT Officer</div>
                <p>Managing technology infrastructure, M-SACCO platform, and digital services.</p>
                <div class="social-icons">
                    <a href="#" title="Facebook">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" title="Twitter">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" title="LinkedIn">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>
            <div class="team-card">
                <!-- IMAGE: public/images/team/loan-officer.jpg (300x300px - Kizito Richard photo) -->
                <div class="avatar" style="background: #d1d5db url('/images/team/loan-officer.jpg') center/cover no-repeat;">KR</div>
                <h4>Kizito Richard</h4>
                <div class="position">Loan Officer</div>
                <p>Assisting members with loan applications, inquiries, and repayment plans.</p>
                <div class="social-icons">
                    <a href="#" title="Facebook">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" title="Twitter">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" title="LinkedIn">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Join us today to start your journey to financial growth</h2>
            <p>Become a member and access affordable loans, secure savings, and a community that cares about your financial well-being.</p>
            <a href="{{ route('contact') }}" class="btn-gold-custom">Let's get in touch</a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
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
</script>
@endpush
