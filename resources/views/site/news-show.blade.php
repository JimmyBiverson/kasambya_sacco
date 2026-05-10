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
        font-size: 2.2rem;
        font-weight: 800;
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
        line-height: 1.3;
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

    .article-section { padding: 4rem 0; background: var(--white); }
    .article-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 40px;
    }

    .article-main .featured-image {
        width: 100%;
        height: 420px;
        background: #d1d5db;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }
    .article-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }
    .article-meta .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.9rem;
        color: var(--text-light);
    }
    .article-meta .meta-item svg {
        width: 18px;
        height: 18px;
        color: var(--primary);
    }
    .article-meta .category-badge {
        background: var(--amber);
        color: var(--white);
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .article-content h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin: 2rem 0 1rem;
    }
    .article-content h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin: 1.5rem 0 0.8rem;
    }
    .article-content p {
        font-size: 1.05rem;
        color: var(--text-dark);
        line-height: 1.8;
        margin-bottom: 1.2rem;
    }
    .article-content ul, .article-content ol {
        margin: 1rem 0 1.5rem 1.5rem;
        color: var(--text-dark);
        line-height: 1.8;
    }
    .article-content li {
        margin-bottom: 0.5rem;
    }
    .article-content blockquote {
        border-left: 4px solid var(--primary);
        background: var(--light-bg);
        padding: 1.2rem 1.5rem;
        margin: 1.5rem 0;
        border-radius: 0 var(--radius) var(--radius) 0;
        font-style: italic;
        color: var(--text-dark);
        font-size: 1.05rem;
    }

    .share-section {
        margin-top: 2.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .share-section span {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.95rem;
    }
    .share-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        border-radius: var(--radius);
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        border: none;
        cursor: pointer;
    }
    .share-btn:hover {
        transform: translateY(-2px);
    }
    .share-btn.facebook { background: #1877f2; color: var(--white); }
    .share-btn.twitter { background: #1da1f2; color: var(--white); }
    .share-btn.whatsapp { background: #25d366; color: var(--white); }
    .share-btn.email { background: var(--text-light); color: var(--white); }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: var(--transition);
        margin-top: 2rem;
    }
    .back-link:hover {
        color: var(--amber);
    }
    .back-link svg {
        width: 20px;
        height: 20px;
    }

    .article-sidebar .sidebar-widget {
        background: var(--white);
        border: 1px solid #e5e7eb;
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .article-sidebar .sidebar-widget h3 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 1rem;
        padding-bottom: 0.8rem;
        border-bottom: 2px solid var(--amber);
    }
    .article-sidebar .sidebar-widget p {
        font-size: 0.95rem;
        color: var(--text-light);
        line-height: 1.6;
    }
    .sidebar-news-list { list-style: none; padding: 0; }
    .sidebar-news-list li { padding: 0.8rem 0; border-bottom: 1px solid #f3f4f6; }
    .sidebar-news-list li:last-child { border-bottom: none; }
    .sidebar-news-list a {
        text-decoration: none;
        color: var(--text-dark);
        font-size: 0.95rem;
        font-weight: 600;
        line-height: 1.4;
        transition: var(--transition);
        display: block;
    }
    .sidebar-news-list a:hover {
        color: var(--primary);
    }
    .sidebar-news-list .sidebar-date {
        font-size: 0.8rem;
        color: var(--text-light);
        margin-top: 4px;
    }

    @media (max-width: 768px) {
        .page-header { padding: 3rem 0; }
        .page-header h1 { font-size: 1.6rem; }
        .article-layout { grid-template-columns: 1fr; }
        .article-main .featured-image { height: 280px; }
        .article-content p { font-size: 1rem; }
    }
    @media (max-width: 480px) {
        .page-header h1 { font-size: 1.3rem; }
        .article-main .featured-image { height: 220px; }
        .article-meta { gap: 12px; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1>{{ ucwords(str_replace('-', ' ', $slug)) }}</h1>
    </div>
</div>

<div class="breadcrumb">
    <div class="container">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <a href="{{ route('news') }}">News & Events</a>
        <span class="separator">/</span>
        <span class="current">{{ ucwords(str_replace('-', ' ', $slug)) }}</span>
    </div>
</div>

<section class="article-section">
    <div class="container">
        <div class="article-layout">
            <div class="article-main">
                <div class="featured-image">
                    <span>Article Image</span>
                </div>

                <div class="article-meta">
                    <span class="meta-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        Published: March 19, 2026
                    </span>
                    <span class="meta-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                        Author: Kasambya SACCO
                    </span>
                    <span class="category-badge">Annual Events</span>
                </div>

                <div class="article-content">
                    <p>Kasambya SACCO successfully held its Annual Delegates Meeting on March 19, 2026, bringing together members, delegates, and stakeholders from across the region to review the SACCO's performance and chart the strategic direction for the coming year.</p>

                    <p>The meeting, held at the SACCO headquarters in Kasambya Town Council, was attended by over 200 delegates representing the diverse membership base. Key agenda items included the presentation of the 2025 annual report, financial statements, election of new board members, and deliberations on proposed policy changes.</p>

                    <h2>Key Highlights</h2>

                    <p>During the meeting, the Board of Directors presented a comprehensive report showcasing remarkable growth across all key performance indicators. The SACCO recorded a 15% increase in membership, a 20% growth in the loan portfolio, and improved dividend payouts for members.</p>

                    <blockquote>
                        "This year's meeting was particularly significant as it marked over two decades of serving our community. We are proud of the milestones we have achieved together and remain committed to our mission of providing affordable and sustainable financial services."
                        <br><br>
                        <strong>- The Board Chairperson</strong>
                    </blockquote>

                    <h3>Financial Performance</h3>
                    <p>The SACCO reported a strong financial performance for the 2025 financial year, with total assets growing by 18% compared to the previous year. The loan portfolio expanded significantly, driven by increased uptake of agricultural and development loans.</p>

                    <h3>Election of Board Members</h3>
                    <p>Delegates unanimously elected new board members to serve for the next three-year term. The election process was conducted transparently, with candidates presenting their manifestos before the delegates.</p>

                    <h3>Way Forward</h3>
                    <p>The meeting resolved to focus on expanding digital financial services, increasing outreach to rural members, and strengthening the SACCO's capital base. A special committee was appointed to oversee the implementation of the new strategic plan.</p>

                    <p>Members expressed satisfaction with the SACCO's leadership and management, pledging continued support for the cooperative's initiatives and programs.</p>
                </div>

                <div class="share-section">
                    <span>Share this article:</span>
                    <a href="#" class="share-btn facebook">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        Facebook
                    </a>
                    <a href="#" class="share-btn twitter">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        Twitter
                    </a>
                    <a href="#" class="share-btn whatsapp">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        WhatsApp
                    </a>
                    <a href="#" class="share-btn email">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        Email
                    </a>
                </div>

                <a href="{{ route('news') }}" class="back-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
                    </svg>
                    Back to News & Events
                </a>
            </div>

            <aside class="article-sidebar">
                <div class="sidebar-widget">
                    <h3>Recent News</h3>
                    <ul class="sidebar-news-list">
                        <li>
                            <a href="{{ route('news.show', 'annual-delegates-meeting-2026') }}">
                                Kasambya SACCO Holds Successful Annual Delegates Meeting 2026
                                <div class="sidebar-date">March 19, 2026</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('news.show', 'coffee-seedlings-initiative') }}">
                                Kasambya SACCO Supports Members with Coffee Seedlings Initiative
                                <div class="sidebar-date">November 29, 2025</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('news.show', 'green-financing-training') }}">
                                Leaders Trained on Green Financing and Environmental Protection
                                <div class="sidebar-date">November 27, 2025</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('news.show', 'msacco-mobile-banking-launch') }}">
                                New M-SACCO Mobile Banking Features Launched
                                <div class="sidebar-date">October 15, 2025</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('news.show', 'annual-report-2025') }}">
                                Kasambya SACCO Annual Report 2025 Released
                                <div class="sidebar-date">January 20, 2026</div>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="sidebar-widget">
                    <h3>About Kasambya SACCO</h3>
                    <p>Kasambya SACCO was established in 2003 and registered under Registration Number 6682 by the Registrar of Cooperative Societies. We provide affordable and sustainable financial services to our members across Uganda.</p>
                </div>

                <div class="sidebar-widget">
                    <h3>Categories</h3>
                    <ul class="sidebar-news-list">
                        <li><a href="#">Annual Events (1)</a></li>
                        <li><a href="#">Community Empowerment (1)</a></li>
                        <li><a href="#">Training (1)</a></li>
                        <li><a href="#">Technology (1)</a></li>
                        <li><a href="#">Reports (1)</a></li>
                        <li><a href="#">Education (1)</a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

@endsection
