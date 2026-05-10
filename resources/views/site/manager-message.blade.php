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

    .message-section { padding: 4rem 0; background: var(--white); }
    .message-grid { display: grid; grid-template-columns: auto 1fr; gap: 50px; align-items: start; }
    .message-avatar { width: 280px; flex-shrink: 0; }
    .message-avatar .photo { width: 280px; height: 280px; border-radius: 50%; background: #d1d5db; display: flex; align-items: center; justify-content: center; color: #6b7280; font-weight: 600; font-size: 1.2rem; border: 5px solid var(--primary); box-shadow: var(--shadow-lg); }
    .message-avatar .photo-inner { text-align: center; }
    .message-avatar .photo-inner .initials { font-size: 4rem; font-weight: 800; color: var(--primary-dark); }
    .message-avatar .photo-inner .label { font-size: 0.9rem; color: var(--text-light); margin-top: 0.5rem; }
    .message-avatar h3 { font-size: 1.2rem; font-weight: 700; color: var(--primary-dark); margin-top: 1.5rem; text-align: center; }
    .message-avatar .title { font-size: 0.95rem; color: var(--amber); font-weight: 600; text-align: center; }
    .message-body h2 { font-size: 2rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 0.5rem; }
    .message-body h2 span { color: var(--amber); }
    .message-body .greeting { font-size: 1.1rem; color: var(--text-light); margin-bottom: 2rem; font-style: italic; }
    .message-body p { font-size: 1.05rem; color: var(--text-light); line-height: 1.8; margin-bottom: 1.2rem; }
    .message-body .signature { margin-top: 2.5rem; padding-top: 1.5rem; border-top: 2px solid #e5e7eb; }
    .message-body .signature .name { font-size: 1.2rem; font-weight: 700; color: var(--primary-dark); }
    .message-body .signature .position { font-size: 0.95rem; color: var(--primary); font-weight: 600; }

    .values-banner { padding: 4rem 0; background: var(--light-bg); }
    .values-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
    .value-item { text-align: center; padding: 2rem 1.5rem; background: var(--white); border-radius: var(--radius-lg); box-shadow: var(--shadow); transition: var(--transition); }
    .value-item:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }
    .value-item .icon-wrap { width: 56px; height: 56px; background: var(--light-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; }
    .value-item .icon-wrap svg { width: 28px; height: 28px; color: var(--primary); }
    .value-item h4 { font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 0.5rem; }
    .value-item p { font-size: 0.9rem; color: var(--text-light); line-height: 1.5; }

    .cta-mini { padding: 3rem 0; background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); text-align: center; color: var(--white); }
    .cta-mini h3 { font-size: 1.8rem; font-weight: 700; margin-bottom: 0.5rem; }
    .cta-mini p { opacity: 0.9; margin-bottom: 1.5rem; }
    .cta-mini a { display: inline-block; padding: 14px 36px; background: var(--amber); color: var(--white); font-weight: 700; border-radius: var(--radius); text-decoration: none; transition: var(--transition); }
    .cta-mini a:hover { background: var(--amber-hover); transform: translateY(-2px); box-shadow: 0 8px 25px rgba(245,158,11,0.4); }

    @media (max-width: 768px) {
        .message-grid { grid-template-columns: 1fr; justify-items: center; }
        .message-avatar { width: 200px; }
        .message-avatar .photo { width: 200px; height: 200px; }
        .message-avatar .photo-inner .initials { font-size: 3rem; }
        .message-body { text-align: center; }
        .message-body h2 { font-size: 1.6rem; }
        .values-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 480px) {
        .values-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">Message from the Manager</h1>
        <p style="opacity: 0.9; font-size: 1.1rem;">A word from our SACCO Manager</p>
    </div>
</div>

<div class="breadcrumb">
    <div class="container">
        <a href="{{ url('/') }}">Home</a>
        <span class="sep">/</span>
        <span>Kasambya Sacco</span>
        <span class="sep">/</span>
        <span style="color: var(--primary); font-weight: 600;">Message from the Manager</span>
    </div>
</div>

<section class="message-section">
    <div class="container">
        <div class="message-grid">
            <div class="message-avatar">
                <!-- IMAGE: public/images/team/manager.jpg (300x300px - Byamukama Bernard photo) -->
                <div class="photo" style="background: #d1d5db url('/images/team/manager.jpg') center/cover no-repeat;">
                    <div class="photo-inner">
                        <div class="initials">BB</div>
                        <div class="label">SACCO Manager</div>
                    </div>
                </div>
                <h3>Byamukama Bernard</h3>
                <div class="title">SACCO Manager</div>
            </div>
            <div class="message-body">
                <h2>Welcome to <span>Kasambya SACCO</span></h2>
                <div class="greeting">A message of commitment, growth, and transparency</div>

                <p>Dear Esteemed Members and Prospective Members,</p>

                <p>It is with great pleasure and a deep sense of responsibility that I welcome you to Kasambya SACCO. Since our establishment in 2003, we have remained steadfast in our commitment to providing accessible, affordable, and reliable financial services to our members. Our journey has been one of growth, resilience, and unwavering dedication to the communities we serve.</p>

                <p>At Kasambya SACCO, our members are at the heart of everything we do. We believe that financial inclusion is a powerful tool for transformation, and we are committed to ensuring that every member has access to the resources they need to achieve their financial goals. Whether you are saving for the future, seeking affordable credit for a business venture, or planning for your children's education, we are here to support you every step of the way.</p>

                <p><strong>Transparency and accountability</strong> are the cornerstones of our operations. We believe that our members have the right to know how their funds are being managed, which is why we maintain open communication channels and provide regular financial reports. Our Board of Directors and management team are committed to upholding the highest standards of governance and ethical conduct.</p>

                <p>We have also embraced technology to enhance our service delivery. Through our M-SACCO mobile banking platform, members can now access their accounts, make inquiries, and transact from the comfort of their homes. This is part of our commitment to innovation and improving the member experience.</p>

                <p>As we look to the future, we are excited about the opportunities ahead. We will continue to expand our product offerings, strengthen our financial position, and find new ways to add value to our members. Your trust is our greatest asset, and we will work tirelessly to deserve it every single day.</p>

                <p>I invite you to explore our website to learn more about our products and services. If you are not yet a member, I encourage you to join us and experience the Kasambya SACCO difference. Together, we can build a brighter financial future.</p>

                <p>Thank you for your continued support and trust in Kasambya SACCO.</p>

                <div class="signature">
                    <div class="name">Byamukama Bernard</div>
                    <div class="position">SACCO Manager, Kasambya SACCO</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="values-banner">
    <div class="container">
        <div class="section-title" style="text-align: center; margin-bottom: 3rem;">
            <h2 style="font-size: 2.2rem; font-weight: 800; color: var(--primary-dark); position: relative; display: inline-block;">
                Our Commitment to You
            </h2>
            <p style="color: var(--text-light); margin-top: 1rem; font-size: 1.1rem;">The principles that guide our leadership and service</p>
        </div>
        <div class="values-grid">
            <div class="value-item">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h4>Transparency</h4>
                <p>Open and honest communication about our operations, finances, and decisions affecting members.</p>
            </div>
            <div class="value-item">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12a9 9 0 0 1-9 9m9-9a9 9 0 0 0-9-9m9 9H3m9 9a9 9 0 0 1-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 0 1 9-9"/>
                    </svg>
                </div>
                <h4>Integrity</h4>
                <p>Upholding the highest ethical standards in all our dealings with members and stakeholders.</p>
            </div>
            <div class="value-item">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h4>Member Focus</h4>
                <p>Putting our members first in every decision, product, and service we offer.</p>
            </div>
            <div class="value-item">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <h4>Excellence</h4>
                <p>Striving for the highest quality in service delivery and operational efficiency.</p>
            </div>
        </div>
    </div>
</section>

<section class="cta-mini">
    <div class="container">
        <h3>Have Questions or Need Assistance?</h3>
        <p>We are here to help you with all your financial needs.</p>
        <a href="{{ route('contact') }}">Contact Us Today</a>
    </div>
</section>

@endsection
