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

    .application-section { padding: 4rem 0; background: var(--white); }
    .application-grid { display: grid; grid-template-columns: 1.2fr 1fr; gap: 40px; }
    .application-grid .form-wrap { order: 1; }
    .application-grid .info-wrap { order: 2; }

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
    .form-group textarea { resize: vertical; min-height: 100px; }

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

    .req-card {
        background: var(--light-bg);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        margin-bottom: 1.2rem;
        transition: var(--transition);
        border: 1px solid transparent;
        border-left: 4px solid var(--primary);
    }
    .req-card:hover {
        border-color: var(--primary);
        border-left-width: 4px;
        transform: translateX(4px);
    }
    .req-card h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .req-card h4 svg {
        width: 20px;
        height: 20px;
        color: var(--primary);
    }
    .req-card ul {
        list-style: none;
        padding: 0;
    }
    .req-card ul li {
        padding: 0.4rem 0;
        color: var(--text-light);
        font-size: 0.95rem;
        display: flex;
        align-items: baseline;
        gap: 8px;
    }
    .req-card ul li::before {
        content: '\2713';
        color: var(--primary);
        font-weight: 700;
    }

    .info-section-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--primary-dark);
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 3px solid var(--amber);
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

    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    @media (max-width: 768px) {
        .application-grid { grid-template-columns: 1fr; }
        .form-row { grid-template-columns: 1fr; }
        .page-header h1 { font-size: 2rem; }
        .application-grid .form-wrap { order: 1; }
        .application-grid .info-wrap { order: 2; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Application</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Kasambya Sacco</a> &gt; Application
        </div>
    </div>
</div>

<section class="application-section">
    <div class="container">
        <div class="application-grid">
            <div class="form-wrap">
                @if(session('success'))
                    <div class="success-alert">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('application.submit') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" placeholder="Your full name" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Your email address" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Your phone number" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" placeholder="Your physical address" required>{{ old('address') }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" value="{{ old('dob') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="occupation">Occupation</label>
                            <input type="text" id="occupation" name="occupation" value="{{ old('occupation') }}" placeholder="Your occupation" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="employer">Employer</label>
                            <input type="text" id="employer" name="employer" value="{{ old('employer') }}" placeholder="Your employer name">
                        </div>
                        <div class="form-group">
                            <label for="monthly_income">Monthly Income</label>
                            <input type="number" id="monthly_income" name="monthly_income" value="{{ old('monthly_income') }}" placeholder="Your monthly income" step="0.01" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="product_type">Product Type</label>
                        <select id="product_type" name="product_type" required>
                            <option value="">Select a product type</option>
                            <option value="Trade & Commerce Loan" {{ old('product_type') == 'Trade & Commerce Loan' ? 'selected' : '' }}>Trade & Commerce Loan</option>
                            <option value="Housing Loan" {{ old('product_type') == 'Housing Loan' ? 'selected' : '' }}>Housing Loan</option>
                            <option value="School Fees Loan" {{ old('product_type') == 'School Fees Loan' ? 'selected' : '' }}>School Fees Loan</option>
                            <option value="Automatic Loan" {{ old('product_type') == 'Automatic Loan' ? 'selected' : '' }}>Automatic Loan</option>
                            <option value="Emergency Loan" {{ old('product_type') == 'Emergency Loan' ? 'selected' : '' }}>Emergency Loan</option>
                            <option value="Asset Acquisition Loan" {{ old('product_type') == 'Asset Acquisition Loan' ? 'selected' : '' }}>Asset Acquisition Loan</option>
                            <option value="Environmental Loan" {{ old('product_type') == 'Environmental Loan' ? 'selected' : '' }}>Environmental Loan</option>
                            <option value="Agriculture Loan" {{ old('product_type') == 'Agriculture Loan' ? 'selected' : '' }}>Agriculture Loan</option>
                            <option value="Transport Loan" {{ old('product_type') == 'Transport Loan' ? 'selected' : '' }}>Transport Loan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="account_type">Account Type</label>
                        <select id="account_type" name="account_type" required>
                            <option value="">Select an account type</option>
                            <option value="Voluntary Savings" {{ old('account_type') == 'Voluntary Savings' ? 'selected' : '' }}>Voluntary Savings</option>
                            <option value="Minor Account" {{ old('account_type') == 'Minor Account' ? 'selected' : '' }}>Minor Account</option>
                            <option value="Associate Account" {{ old('account_type') == 'Associate Account' ? 'selected' : '' }}>Associate Account</option>
                            <option value="Fixed Savings" {{ old('account_type') == 'Fixed Savings' ? 'selected' : '' }}>Fixed Savings</option>
                            <option value="Share Savings" {{ old('account_type') == 'Share Savings' ? 'selected' : '' }}>Share Savings</option>
                            <option value="Joint Account" {{ old('account_type') == 'Joint Account' ? 'selected' : '' }}>Joint Account</option>
                            <option value="Individual Account" {{ old('account_type') == 'Individual Account' ? 'selected' : '' }}>Individual Account</option>
                            <option value="Group Account" {{ old('account_type') == 'Group Account' ? 'selected' : '' }}>Group Account</option>
                            <option value="Institutional Account" {{ old('account_type') == 'Institutional Account' ? 'selected' : '' }}>Institutional Account</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="additional_message">Additional Message</label>
                        <textarea id="additional_message" name="additional_message" placeholder="Any additional information or message">{{ old('additional_message') }}</textarea>
                    </div>

                    <button type="submit" class="btn-submit">Submit Application</button>
                </form>
            </div>

            <div class="info-wrap">
                <h3 class="info-section-title">Membership Requirements</h3>

                <div class="req-card">
                    <h4>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                        Voluntary Savings Account
                    </h4>
                    <ul>
                        <li>UGX 60,000 minimum deposit</li>
                        <li>3 passport photos</li>
                        <li>National ID copy</li>
                        <li>LC1 letter of recommendation</li>
                    </ul>
                </div>

                <div class="req-card">
                    <h4>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        Minor Account
                    </h4>
                    <ul>
                        <li>UGX 20,000 minimum deposit</li>
                        <li>Passport photos</li>
                        <li>For children under 18 years</li>
                        <li>Parent or guardian required</li>
                    </ul>
                </div>

                <div class="req-card">
                    <h4>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        Associate Account
                    </h4>
                    <ul>
                        <li>UGX 30,000 minimum deposit</li>
                        <li>National ID copy</li>
                        <li>Passport photos</li>
                        <li>LC1 letter of recommendation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
