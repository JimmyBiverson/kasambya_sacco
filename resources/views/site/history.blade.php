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

    .section-title { text-align: center; margin-bottom: 3rem; }
    .section-title h2 { font-size: 2.2rem; font-weight: 800; color: var(--primary-dark); position: relative; display: inline-block; }
    .section-title h2::after { content: ''; display: block; width: 60px; height: 4px; background: var(--amber); margin: 12px auto 0; border-radius: 2px; }
    .section-title p { color: var(--text-light); margin-top: 1rem; font-size: 1.1rem; max-width: 600px; margin-left: auto; margin-right: auto; }

    .history-founded { padding: 4rem 0; background: var(--white); }
    .history-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center; }
    .history-image { background: #d1d5db; border-radius: var(--radius-lg); min-height: 380px; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #6b7280; font-size: 1.2rem; font-weight: 600; position: relative; overflow: hidden; }
    .history-image .year-badge { position: absolute; top: 20px; left: 20px; background: var(--amber); color: var(--white); padding: 8px 20px; border-radius: var(--radius); font-size: 1.5rem; font-weight: 800; }
    .history-text h2 { font-size: 2rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 1.5rem; }
    .history-text h2 span { color: var(--amber); }
    .history-text p { font-size: 1.05rem; color: var(--text-light); line-height: 1.7; margin-bottom: 1rem; }

    .timeline-section { padding: 5rem 0; background: var(--light-bg); }
    .timeline { position: relative; max-width: 800px; margin: 0 auto; padding: 0; }
    .timeline::before { content: ''; position: absolute; left: 50%; top: 0; bottom: 0; width: 4px; background: var(--primary); transform: translateX(-50%); border-radius: 2px; }
    .timeline-item { position: relative; margin-bottom: 3rem; }
    .timeline-item:last-child { margin-bottom: 0; }
    .timeline-dot { position: absolute; left: 50%; top: 0; width: 20px; height: 20px; background: var(--amber); border: 4px solid var(--primary); border-radius: 50%; transform: translateX(-50%); z-index: 1; }
    .timeline-content { position: relative; width: calc(50% - 40px); padding: 1.5rem; background: var(--white); border-radius: var(--radius-lg); box-shadow: var(--shadow); }
    .timeline-item:nth-child(odd) .timeline-content { left: 0; }
    .timeline-item:nth-child(even) .timeline-content { left: calc(50% + 40px); }
    .timeline-content h3 { font-size: 1.2rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 0.5rem; }
    .timeline-content .year { font-size: 0.9rem; color: var(--amber); font-weight: 700; margin-bottom: 0.5rem; }
    .timeline-content p { font-size: 0.95rem; color: var(--text-light); line-height: 1.6; }

    .vmv-history { padding: 5rem 0; background: var(--white); }
    .vmv-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
    .vmv-card { background: var(--white); border-radius: var(--radius-lg); padding: 2.5rem 2rem; box-shadow: var(--shadow); transition: var(--transition); border-top: 4px solid var(--primary); }
    .vmv-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
    .vmv-card .icon-wrap { width: 64px; height: 64px; background: var(--light-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.2rem; }
    .vmv-card .icon-wrap svg { width: 32px; height: 32px; color: var(--primary); }
    .vmv-card h3 { font-size: 1.3rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 1rem; }
    .vmv-card p { font-size: 0.95rem; color: var(--text-light); line-height: 1.6; }
    .vmv-card ul { list-style: none; padding: 0; margin-top: 0.8rem; }
    .vmv-card ul li { padding: 0.4rem 0; color: var(--text-light); font-size: 0.9rem; display: flex; align-items: baseline; gap: 8px; }
    .vmv-card ul li::before { content: '\2713'; color: var(--primary); font-weight: 700; }

    .team-history { padding: 5rem 0; background: var(--light-bg); }
    .team-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; max-width: 900px; margin: 0 auto; }
    .team-card { background: var(--white); border-radius: var(--radius-lg); padding: 2rem 1.5rem; text-align: center; box-shadow: var(--shadow); transition: var(--transition); border: 1px solid #e5e7eb; }
    .team-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); border-color: var(--primary); }
    .team-card .avatar { width: 120px; height: 120px; border-radius: 50%; background: #d1d5db; margin: 0 auto 1.2rem; display: flex; align-items: center; justify-content: center; color: #6b7280; font-weight: 700; font-size: 1.5rem; border: 4px solid var(--primary); }
    .team-card h4 { font-size: 1.15rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 0.3rem; }
    .team-card .position { font-size: 0.9rem; color: var(--amber); font-weight: 600; margin-bottom: 0.8rem; }
    .team-card p { font-size: 0.9rem; color: var(--text-light); line-height: 1.5; }
    .team-card .social-icons { display: flex; justify-content: center; gap: 10px; margin-top: 1rem; }
    .team-card .social-icons a { width: 36px; height: 36px; border-radius: 50%; background: var(--light-bg); display: flex; align-items: center; justify-content: center; color: var(--primary); transition: var(--transition); text-decoration: none; }
    .team-card .social-icons a:hover { background: var(--primary); color: var(--white); }
    .team-card .social-icons a svg { width: 18px; height: 18px; }

    @media (max-width: 768px) {
        .history-grid { grid-template-columns: 1fr; }
        .timeline::before { left: 20px; }
        .timeline-dot { left: 20px; }
        .timeline-content { width: calc(100% - 60px); }
        .timeline-item:nth-child(odd) .timeline-content,
        .timeline-item:nth-child(even) .timeline-content { left: 60px; }
        .vmv-grid { grid-template-columns: 1fr; }
        .team-grid { grid-template-columns: 1fr; }
        .section-title h2 { font-size: 1.8rem; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">Our History</h1>
        <p style="opacity: 0.9; font-size: 1.1rem;">The story of Kasambya SACCO</p>
    </div>
</div>

<div class="breadcrumb">
    <div class="container">
        <a href="{{ url('/') }}">Home</a>
        <span class="sep">/</span>
        <span>Kasambya Sacco</span>
        <span class="sep">/</span>
        <span style="color: var(--primary); font-weight: 600;">Our History</span>
    </div>
</div>

<section class="history-founded">
    <div class="container">
        <div class="history-grid">
            <!-- IMAGE: public/images/history-building.jpg (SACCO headquarters) -->
            <div class="history-image" style="background: #d1d5db url('/images/history-building.jpg') center/cover no-repeat;">
                <div class="year-badge">Est. 2003</div>
                <span>Kasambya SACCO Headquarters</span>
            </div>
            <div class="history-text">
                <h2>Established in <span>2003</span></h2>
                <p>Kasambya SACCO was founded in 2003 by a group of visionary community members in Kasambya Town, Mubende District. Recognizing the need for accessible and affordable financial services in the area, they came together to form a member-owned savings and credit cooperative that would serve the community's financial needs.</p>
                <p>From humble beginnings with a small membership base and limited capital, the SACCO has grown steadily over the years. It was fully registered by the Registrar of Cooperative Societies under <strong>Registration Number 6682</strong>, gaining official recognition and regulatory oversight.</p>
                <p>Today, Kasambya SACCO stands as a testament to the power of collective action and community-driven development. With thousands of active members, a professional staff team, and a wide range of financial products and services, we continue to fulfill our founding mission of empowering our community through financial inclusion.</p>
            </div>
        </div>
    </div>
</section>

<section class="timeline-section">
    <div class="container">
        <div class="section-title">
            <h2>Our Journey</h2>
            <p>Key milestones in the history of Kasambya SACCO</p>
        </div>
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="year">2003</div>
                    <h3>Foundation</h3>
                    <p>Kasambya SACCO was established by community members in Kasambya Town to provide accessible savings and credit services.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="year">2005</div>
                    <h3>Official Registration</h3>
                    <p>The SACCO was fully registered by the Registrar of Cooperative Societies, gaining official regulatory status and recognition.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="year">2010</div>
                    <h3>Expansion of Services</h3>
                    <p>Expanded the range of loan products to include development loans, school fees loans, and emergency loans to better serve member needs.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="year">2015</div>
                    <h3>Membership Growth</h3>
                    <p>Membership surpassed 5,000 active members, reflecting growing trust in the SACCO's services and management.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="year">2020</div>
                    <h3>Digital Transformation</h3>
                    <p>Launched the M-SACCO mobile banking platform, enabling members to access their accounts, make payments, and apply for loans via mobile phone.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="year">2026</div>
                    <h3>Continued Growth</h3>
                    <p>Serving over 10,000 members across 25+ districts with a professional team of 50+ staff and a comprehensive range of financial products.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="vmv-history">
    <div class="container">
        <div class="section-title">
            <h2>Vision, Mission &amp; Core Values</h2>
            <p>The principles that have guided us since 2003</p>
        </div>
        <div class="vmv-grid">
            <div class="vmv-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12h4l3-9 3 18 3-9h4"/>
                    </svg>
                </div>
                <h3>Our Vision</h3>
                <p>To provide affordable and sustainable financial services to our members, fostering economic growth and community development throughout the region.</p>
            </div>
            <div class="vmv-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                    </svg>
                </div>
                <h3>Our Mission</h3>
                <p>To develop a strong spirit of saving among our members, mobilize savings for productive investment, and provide affordable credit to improve livelihoods.</p>
            </div>
            <div class="vmv-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h3>Core Values</h3>
                <ul>
                    <li>Integrity and honesty in all operations</li>
                    <li>Transparency and accountability to members</li>
                    <li>Member-focused service delivery</li>
                    <li>Innovation and continuous improvement</li>
                    <li>Teamwork and collaboration</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="team-history">
    <div class="container">
        <div class="section-title">
            <h2>The Amazing Team</h2>
            <p>Meet the leadership driving Kasambya SACCO forward</p>
        </div>
        <div class="team-grid">
            <div class="team-card">
                <!-- IMAGE: public/images/team/manager.jpg (300x300px - Byamukama Bernard photo) -->
                <div class="avatar" style="background: #d1d5db url('/images/team/manager.jpg') center/cover no-repeat;">BB</div>
                <h4>Byamukama Bernard</h4>
                <div class="position">SACCO Manager</div>
                <p>Provides strategic direction and leadership, ensuring the SACCO fulfills its mission of serving members with integrity and excellence.</p>
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
                <div class="position">Accountant / Finance Officer</div>
                <p>Oversees all financial operations, budgeting, accounting, and ensures compliance with financial regulations and reporting standards.</p>
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
                <!-- IMAGE: public/images/team/loan-admin.jpg (300x300px - Loan administrator photo) -->
                <div class="avatar" style="background: #d1d5db url('/images/team/loan-admin.jpg') center/cover no-repeat;">LA</div>
                <h4>Loan Administrator</h4>
                <div class="position">Loan Administrator</div>
                <p>Manages the loan application process, credit assessment, and ensures timely disbursement and recovery of loans.</p>
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

@endsection
