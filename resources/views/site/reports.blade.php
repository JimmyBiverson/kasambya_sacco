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

    .intro-section { padding: 4rem 0; background: var(--white); }
    .intro-text { max-width: 800px; margin: 0 auto; text-align: center; }
    .intro-text h2 { font-size: 1.8rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 1.5rem; }
    .intro-text h2 span { color: var(--amber); }
    .intro-text p { font-size: 1.05rem; color: var(--text-light); line-height: 1.8; margin-bottom: 1rem; }
    .intro-text .highlight-box { background: var(--light-bg); border-left: 4px solid var(--primary); padding: 1.5rem 2rem; border-radius: 0 var(--radius) var(--radius) 0; text-align: left; margin-top: 2rem; }
    .intro-text .highlight-box p { font-size: 0.95rem; margin-bottom: 0; }

    .reports-table-section { padding: 3rem 0 5rem; background: var(--light-bg); }
    .table-wrapper { max-width: 900px; margin: 0 auto; background: var(--white); border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); overflow: hidden; }
    .table-header { background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); padding: 1.5rem 2rem; }
    .table-header h3 { color: var(--white); font-size: 1.3rem; font-weight: 700; margin: 0; }
    .table-header p { color: rgba(255,255,255,0.8); font-size: 0.9rem; margin-top: 0.3rem; }
    table { width: 100%; border-collapse: collapse; }
    thead { background: var(--primary); }
    thead th { padding: 1rem 1.5rem; text-align: left; color: var(--white); font-weight: 600; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px; }
    tbody tr { border-bottom: 1px solid #e5e7eb; transition: var(--transition); }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: var(--light-bg); }
    tbody td { padding: 1rem 1.5rem; color: var(--text-dark); font-size: 0.95rem; }
    tbody td .report-icon { display: inline-flex; align-items: center; gap: 8px; }
    tbody td .report-icon svg { width: 18px; height: 18px; color: var(--primary); }
    tbody td .type-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
    .type-badge.annual { background: #dbeafe; color: #1d4ed8; }
    .type-badge.audit { background: #fef3c7; color: #b45309; }
    .type-badge.quarterly { background: #e0f2fe; color: #0369a1; }
    .type-badge.special { background: #ede9fe; color: #6d28d9; }
    .btn-download { display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; background: var(--primary); color: var(--white); border-radius: var(--radius); text-decoration: none; font-size: 0.85rem; font-weight: 600; transition: var(--transition); border: none; cursor: pointer; }
    .btn-download:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: var(--shadow); }
    .btn-download svg { width: 16px; height: 16px; }

    .commitment-section { padding: 4rem 0; background: var(--white); }
    .commitment-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
    .commitment-card { text-align: center; padding: 2rem; border-radius: var(--radius-lg); background: var(--white); border: 1px solid #e5e7eb; transition: var(--transition); }
    .commitment-card:hover { box-shadow: var(--shadow-lg); border-color: var(--primary); transform: translateY(-4px); }
    .commitment-card .icon-wrap { width: 56px; height: 56px; background: var(--light-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; }
    .commitment-card .icon-wrap svg { width: 28px; height: 28px; color: var(--primary); }
    .commitment-card h4 { font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 0.6rem; }
    .commitment-card p { font-size: 0.9rem; color: var(--text-light); line-height: 1.6; }

    @media (max-width: 768px) {
        .commitment-grid { grid-template-columns: 1fr; }
        table { font-size: 0.85rem; }
        thead th, tbody td { padding: 0.8rem 1rem; }
        .btn-download { padding: 6px 14px; font-size: 0.8rem; }
    }
    @media (max-width: 480px) {
        .table-wrapper { border-radius: var(--radius); }
        table { display: block; overflow-x: auto; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">Financial Reports</h1>
        <p style="opacity: 0.9; font-size: 1.1rem;">Transparency and accountability in our financial reporting</p>
    </div>
</div>

<div class="breadcrumb">
    <div class="container">
        <a href="{{ url('/') }}">Home</a>
        <span class="sep">/</span>
        <span>Kasambya Sacco</span>
        <span class="sep">/</span>
        <span style="color: var(--primary); font-weight: 600;">Financial Reports</span>
    </div>
</div>

<section class="intro-section">
    <div class="container">
        <div class="intro-text">
            <h2>Financial <span>Transparency</span></h2>
            <p>At Kasambya SACCO, we believe that transparency and accountability are fundamental to building and maintaining the trust of our members. As a member-owned financial cooperative, we are committed to keeping our members informed about the financial health and performance of the SACCO.</p>
            <p>Below, you will find our financial reports including annual reports, audited financial statements, quarterly summaries, and special reports. These documents provide a comprehensive overview of our financial position, operational performance, and the stewardship of member resources.</p>
            <div class="highlight-box">
                <p><strong>Our Commitment:</strong> We adhere to the highest standards of financial reporting and are subject to regular audits by independent auditors and oversight by the Registrar of Cooperative Societies. Members are encouraged to review these reports and contact us with any questions.</p>
            </div>
        </div>
    </div>
</section>

<section class="reports-table-section">
    <div class="container">
        <div class="table-wrapper">
            <div class="table-header">
                <h3>Download Financial Reports</h3>
                <p>Access our latest financial reports and statements</p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Report Type</th>
                        <th>Description</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <span class="report-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                2025
                            </span>
                        </td>
                        <td><span class="type-badge annual">Annual Report</span></td>
                        <td>Annual report for the 2025 financial year including performance highlights and member statistics.</td>
                        <td><a href="#" class="btn-download" onclick="event.preventDefault(); alert('Download placeholder - PDF not yet uploaded.');"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> Download</a></td>
                    </tr>
                    <tr>
                        <td>
                            <span class="report-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                2025
                            </span>
                        </td>
                        <td><span class="type-badge audit">Audited Statements</span></td>
                        <td>Audited financial statements for 2025 including balance sheet, income statement, and cash flows.</td>
                        <td><a href="#" class="btn-download" onclick="event.preventDefault(); alert('Download placeholder - PDF not yet uploaded.');"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> Download</a></td>
                    </tr>
                    <tr>
                        <td>
                            <span class="report-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                2024
                            </span>
                        </td>
                        <td><span class="type-badge annual">Annual Report</span></td>
                        <td>Comprehensive annual report for 2024 covering all SACCO operations and performance.</td>
                        <td><a href="#" class="btn-download" onclick="event.preventDefault(); alert('Download placeholder - PDF not yet uploaded.');"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> Download</a></td>
                    </tr>
                    <tr>
                        <td>
                            <span class="report-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                2024
                            </span>
                        </td>
                        <td><span class="type-badge audit">Audited Statements</span></td>
                        <td>2024 audited financial statements with independent auditor's report and notes.</td>
                        <td><a href="#" class="btn-download" onclick="event.preventDefault(); alert('Download placeholder - PDF not yet uploaded.');"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> Download</a></td>
                    </tr>
                    <tr>
                        <td>
                            <span class="report-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                2024
                            </span>
                        </td>
                        <td><span class="type-badge quarterly">Q4 Report</span></td>
                        <td>Fourth quarter performance report for the 2024 financial year.</td>
                        <td><a href="#" class="btn-download" onclick="event.preventDefault(); alert('Download placeholder - PDF not yet uploaded.');"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> Download</a></td>
                    </tr>
                    <tr>
                        <td>
                            <span class="report-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                2023
                            </span>
                        </td>
                        <td><span class="type-badge annual">Annual Report</span></td>
                        <td>Annual report for 2023 with complete financial and operational review.</td>
                        <td><a href="#" class="btn-download" onclick="event.preventDefault(); alert('Download placeholder - PDF not yet uploaded.');"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> Download</a></td>
                    </tr>
                    <tr>
                        <td>
                            <span class="report-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                2023
                            </span>
                        </td>
                        <td><span class="type-badge audit">Audited Statements</span></td>
                        <td>2023 audited financial statements with detailed notes and auditor opinions.</td>
                        <td><a href="#" class="btn-download" onclick="event.preventDefault(); alert('Download placeholder - PDF not yet uploaded.');"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> Download</a></td>
                    </tr>
                    <tr>
                        <td>
                            <span class="report-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                2022
                            </span>
                        </td>
                        <td><span class="type-badge special">Special Report</span></td>
                        <td>Special report on SACCO growth, membership trends, and financial performance 2018&ndash;2022.</td>
                        <td><a href="#" class="btn-download" onclick="event.preventDefault(); alert('Download placeholder - PDF not yet uploaded.');"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> Download</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section class="commitment-section">
    <div class="container">
        <div class="section-title">
            <h2>Our Reporting Commitment</h2>
            <p>How we ensure financial transparency and accountability</p>
        </div>
        <div class="commitment-grid">
            <div class="commitment-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h4>Independent Audits</h4>
                <p>Our financial statements are audited annually by independent external auditors to ensure accuracy and compliance with accounting standards.</p>
            </div>
            <div class="commitment-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h4>Regulatory Oversight</h4>
                <p>We are regulated by the Registrar of Cooperative Societies and comply with all statutory reporting requirements and governance standards.</p>
            </div>
            <div class="commitment-card">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/>
                    </svg>
                </div>
                <h4>Member Access</h4>
                <p>Members have the right to access financial reports and can request additional information at any time through our head office.</p>
            </div>
        </div>
    </div>
</section>

@endsection
