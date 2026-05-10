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
        padding: 3rem 0;
        text-align: center;
        color: var(--white);
    }
    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }
    .breadcrumb {
        font-size: 0.95rem;
        opacity: 0.85;
    }
    .breadcrumb a {
        color: var(--amber);
        text-decoration: none;
    }
    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .contact-section { padding: 4rem 0; background: var(--white); }
    .contact-grid { display: grid; grid-template-columns: 1.2fr 1fr; gap: 40px; }

    .form-group { margin-bottom: 1.2rem; }
    .form-group label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.4rem;
    }
    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: var(--radius);
        font-size: 0.95rem;
        transition: var(--transition);
        background: var(--white);
        color: var(--text-dark);
    }
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(26, 110, 62, 0.1);
    }
    .form-group textarea { resize: vertical; min-height: 120px; }

    .btn-submit {
        display: inline-block;
        padding: 14px 36px;
        background: var(--primary);
        color: var(--white);
        font-weight: 700;
        font-size: 1rem;
        border-radius: var(--radius);
        border: none;
        cursor: pointer;
        transition: var(--transition);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .btn-submit:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .info-card {
        background: var(--light-bg);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        transition: var(--transition);
        border: 1px solid transparent;
    }
    .info-card:hover {
        border-color: var(--primary);
        transform: translateX(4px);
    }
    .info-card .icon-wrap {
        width: 48px;
        height: 48px;
        background: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .info-card .icon-wrap svg {
        width: 24px;
        height: 24px;
        color: var(--primary);
    }
    .info-card h4 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 0.3rem;
    }
    .info-card p {
        font-size: 0.95rem;
        color: var(--text-light);
        line-height: 1.6;
    }

    .faq-section { padding: 4rem 0; background: var(--light-bg); }
    .section-title { text-align: center; margin-bottom: 3rem; }
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
    .faq-list { max-width: 800px; margin: 0 auto; }
    .faq-item {
        background: var(--white);
        border-radius: var(--radius);
        margin-bottom: 12px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }
    .faq-question {
        width: 100%;
        padding: 1.2rem 1.5rem;
        background: none;
        border: none;
        text-align: left;
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--text-dark);
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: var(--transition);
    }
    .faq-question:hover { color: var(--primary); }
    .faq-question svg {
        width: 20px;
        height: 20px;
        transition: var(--transition);
        flex-shrink: 0;
    }
    .faq-question.open svg { transform: rotate(180deg); color: var(--primary); }
    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease, padding 0.4s ease;
        padding: 0 1.5rem;
    }
    .faq-answer.open { max-height: 300px; padding: 0 1.5rem 1.2rem; }
    .faq-answer p {
        color: var(--text-light);
        line-height: 1.7;
        font-size: 0.95rem;
    }

    .success-alert {
        background: #d1fae5;
        border: 2px solid #059669;
        color: #065f46;
        padding: 1rem 1.5rem;
        border-radius: var(--radius);
        margin-bottom: 1.5rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .success-alert svg {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
    }

    @media (max-width: 768px) {
        .contact-grid { grid-template-columns: 1fr; }
        .page-header h1 { font-size: 2rem; }
        .section-title h2 { font-size: 1.6rem; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Contact</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Kasambya Sacco</a> &gt; Contact
        </div>
    </div>
</div>

<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <div>
                @if(session('success'))
                    <div class="success-alert">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your full name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Your email address" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Your phone number" required>
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Subject of your message" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Write your message here..." required>{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="btn-submit">Send Message</button>
                </form>
            </div>

            <div>
                <div class="info-card">
                    <div class="icon-wrap">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <h4>Office Location</h4>
                        <p>Kasambya Town Council, Masengere Road, Kasambya, Uganda</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="icon-wrap">
                        <svg fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                    </div>
                    <div>
                        <h4>Phone</h4>
                        <p>0775 125 122 / 0779 892 660</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="icon-wrap">
                        <svg fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                    </div>
                    <div>
                        <h4>Email</h4>
                        <p>kasambyasacco@gmail.com / info@kasambyasacco.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="faq-section">
    <div class="container">
        <div class="section-title">
            <h2>Frequently Asked Questions</h2>
        </div>
        <div class="faq-list" x-data="{ openFaq: null }">
            <div class="faq-item">
                <button class="faq-question" :class="{ 'open': openFaq === 0 }" @click="openFaq = openFaq === 0 ? null : 0">
                    <span>How can I get in touch with Kasambya SACCO?</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div class="faq-answer" :class="{ 'open': openFaq === 0 }">
                    <p>You can reach us by phone at 0775 125 122 / 0779 892 660, email us at kasambyasacco@gmail.com, or visit our offices at Kasambya Town Council, Masengere Road, Kasambya, Uganda. Our working hours are Monday to Friday, 8:45 AM to 5:00 PM, and Saturdays from 8:45 AM to 3:00 PM.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" :class="{ 'open': openFaq === 1 }" @click="openFaq = openFaq === 1 ? null : 1">
                    <span>What is the best way to choose the right contact method?</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div class="faq-answer" :class="{ 'open': openFaq === 1 }">
                    <p>For general inquiries, we recommend using the contact form on this page. For urgent matters, please call our phone lines. For document submissions or detailed inquiries, visiting our office in person or sending an email ensures you receive the most comprehensive assistance.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" :class="{ 'open': openFaq === 2 }" @click="openFaq = openFaq === 2 ? null : 2">
                    <span>How do I create an account with Kasambya SACCO?</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div class="faq-answer" :class="{ 'open': openFaq === 2 }">
                    <p>To create an account, visit our offices with a valid National ID or Passport, two passport-size photos, and the minimum share deposit. You can also fill out the membership application form on our website to get started. Our team will guide you through the account opening process and help you choose the right account type for your needs.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" :class="{ 'open': openFaq === 3 }" @click="openFaq = openFaq === 3 ? null : 3">
                    <span>Where is Kasambya SACCO located?</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div class="faq-answer" :class="{ 'open': openFaq === 3 }">
                    <p>Our offices are located at Kasambya Town Council, Masengere Road, Kasambya, Uganda. We are situated in the heart of Kasambya Town, Mubende District, making us easily accessible to both individual and group members from across the region.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
