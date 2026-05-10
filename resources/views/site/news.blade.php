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

    .news-listing { padding: 4rem 0; background: var(--white); }
    .news-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }

    .news-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
    }
    .news-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg);
    }
    .news-card .news-img {
        height: 220px;
        background: #d1d5db;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        font-weight: 600;
        position: relative;
        flex-shrink: 0;
    }
    .news-card .news-img .date-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        padding: 2rem 1rem 0.8rem;
        color: var(--white);
        font-size: 0.85rem;
        font-weight: 600;
    }
    .news-card .news-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: var(--amber);
        color: var(--white);
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .news-card .news-body {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .news-card .news-date {
        font-size: 0.85rem;
        color: var(--text-light);
        margin-bottom: 0.5rem;
    }
    .news-card .news-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 0.8rem;
        line-height: 1.4;
        transition: var(--transition);
    }
    .news-card:hover .news-title {
        color: var(--primary);
    }
    .news-card .news-excerpt {
        font-size: 0.9rem;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 1rem;
        flex: 1;
    }
    .news-card .news-author {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid #f3f4f6;
    }
    .news-card .news-author .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-weight: 700;
        font-size: 0.85rem;
    }
    .news-card .news-author .name {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    .pagination-section {
        padding: 2rem 0 4rem;
        text-align: center;
        background: var(--white);
    }
    .pagination {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .pagination a, .pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: var(--radius);
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }
    .pagination a {
        color: var(--text-dark);
        background: var(--white);
        border: 1px solid #e5e7eb;
    }
    .pagination a:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: var(--light-bg);
    }
    .pagination .active {
        background: var(--primary);
        color: var(--white);
        border: 1px solid var(--primary);
    }
    .pagination .disabled {
        color: #d1d5db;
        cursor: not-allowed;
    }
    .pagination .prev-next {
        width: auto;
        padding: 0 16px;
    }

    .intro-section {
        padding: 2rem 0;
        background: var(--white);
        text-align: center;
    }
    .intro-section p {
        font-size: 1.1rem;
        color: var(--text-light);
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.7;
    }

    @media (max-width: 1024px) {
        .news-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .page-header { padding: 3rem 0; }
        .page-header h1 { font-size: 2rem; }
        .news-grid { grid-template-columns: 1fr; }
        .news-card .news-img { height: 200px; }
    }
    @media (max-width: 480px) {
        .page-header h1 { font-size: 1.6rem; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1>News & Events</h1>
        <p>Stay Updated with Our Latest News</p>
    </div>
</div>

<div class="breadcrumb">
    <div class="container">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <span class="current">News & Events</span>
    </div>
</div>

<section class="intro-section">
    <div class="container">
        <p>Stay informed with the latest updates, events, and announcements from Kasambya SACCO. We are committed to keeping our members engaged and empowered through timely information.</p>
    </div>
</section>

<section class="news-listing">
    <div class="container">
        <div class="news-grid">
            <a href="{{ route('news.show', 'annual-delegates-meeting-2026') }}" class="news-card" style="text-decoration: none;">
                <div class="news-img">
                    <span>Image</span>
                    <span class="news-badge">Annual Events</span>
                    <div class="date-overlay">March 19, 2026</div>
                </div>
                <div class="news-body">
                    <div class="news-date">March 19, 2026</div>
                    <h3 class="news-title">Kasambya SACCO Holds Successful Annual Delegates Meeting 2026</h3>
                    <p class="news-excerpt">The Annual Delegates Meeting brought together members from across the region to review performance, elect leaders, and chart the way forward for the SACCO.</p>
                    <div class="news-author">
                        <div class="avatar">KS</div>
                        <span class="name">Kasambya SACCO</span>
                    </div>
                </div>
            </a>

            <a href="{{ route('news.show', 'coffee-seedlings-initiative') }}" class="news-card" style="text-decoration: none;">
                <div class="news-img">
                    <span>Image</span>
                    <span class="news-badge">Community Empowerment</span>
                    <div class="date-overlay">November 29, 2025</div>
                </div>
                <div class="news-body">
                    <div class="news-date">November 29, 2025</div>
                    <h3 class="news-title">Kasambya SACCO Supports Members with Coffee Seedlings Initiative</h3>
                    <p class="news-excerpt">Through our agricultural empowerment program, members received high-yield coffee seedlings to boost household incomes and promote sustainable farming.</p>
                    <div class="news-author">
                        <div class="avatar">KM</div>
                        <span class="name">Kasambya SACCO</span>
                    </div>
                </div>
            </a>

            <a href="{{ route('news.show', 'green-financing-training') }}" class="news-card" style="text-decoration: none;">
                <div class="news-img">
                    <span>Image</span>
                    <span class="news-badge">Training</span>
                    <div class="date-overlay">November 27, 2025</div>
                </div>
                <div class="news-body">
                    <div class="news-date">November 27, 2025</div>
                    <h3 class="news-title">Leaders Trained on Green Financing and Environmental Protection</h3>
                    <p class="news-excerpt">Community leaders participated in a training workshop on green financing, environmental conservation, and climate-smart agricultural practices.</p>
                    <div class="news-author">
                        <div class="avatar">JT</div>
                        <span class="name">John Tumusiime</span>
                    </div>
                </div>
            </a>

            <a href="{{ route('news.show', 'msacco-mobile-banking-launch') }}" class="news-card" style="text-decoration: none;">
                <div class="news-img">
                    <span>Image</span>
                    <span class="news-badge">Technology</span>
                    <div class="date-overlay">October 15, 2025</div>
                </div>
                <div class="news-body">
                    <div class="news-date">October 15, 2025</div>
                    <h3 class="news-title">New M-SACCO Mobile Banking Features Launched</h3>
                    <p class="news-excerpt">Kasambya SACCO unveiled enhanced mobile banking features including loan applications, statement downloads, and real-time balance inquiries.</p>
                    <div class="news-author">
                        <div class="avatar">SN</div>
                        <span class="name">Sarah Nakato</span>
                    </div>
                </div>
            </a>

            <a href="{{ route('news.show', 'annual-report-2025') }}" class="news-card" style="text-decoration: none;">
                <div class="news-img">
                    <span>Image</span>
                    <span class="news-badge">Reports</span>
                    <div class="date-overlay">January 20, 2026</div>
                </div>
                <div class="news-body">
                    <div class="news-date">January 20, 2026</div>
                    <h3 class="news-title">Kasambya SACCO Annual Report 2025 Released</h3>
                    <p class="news-excerpt">The 2025 annual report highlights strong financial performance, increased membership, and expanded service delivery across all districts.</p>
                    <div class="news-author">
                        <div class="avatar">KS</div>
                        <span class="name">Kasambya SACCO</span>
                    </div>
                </div>
            </a>

            <a href="{{ route('news.show', 'financial-literacy-workshop') }}" class="news-card" style="text-decoration: none;">
                <div class="news-img">
                    <span>Image</span>
                    <span class="news-badge">Education</span>
                    <div class="date-overlay">September 5, 2025</div>
                </div>
                <div class="news-body">
                    <div class="news-date">September 5, 2025</div>
                    <h3 class="news-title">Member Education Workshop on Financial Literacy</h3>
                    <p class="news-excerpt">Members gathered for an interactive workshop covering budgeting, saving strategies, loan management, and long-term financial planning.</p>
                    <div class="news-author">
                        <div class="avatar">PN</div>
                        <span class="name">Peter Nsubuga</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

<div class="pagination-section">
    <div class="container">
        <div class="pagination">
            <span class="prev-next disabled">&laquo; Prev</span>
            <span class="active">1</span>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#" class="prev-next">Next &raquo;</a>
        </div>
    </div>
</div>

@endsection
