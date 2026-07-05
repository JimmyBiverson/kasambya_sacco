<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — Mubende SACCO</title>
    <meta name="description" content="Mubende SACCO Admin Panel Login">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f0fdfa 0%, #f8fafc 55%, #e2e8f0 100%);
            padding: 20px;
            position: relative;
            overflow: hidden;
            color: #0f172a;
        }

        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 30%, rgba(16, 185, 129, 0.1) 0%, transparent 35%),
                radial-gradient(circle at 80% 15%, rgba(59, 130, 246, 0.08) 0%, transparent 30%),
                radial-gradient(circle at 50% 80%, rgba(14, 165, 233, 0.06) 0%, transparent 35%);
            pointer-events: none;
        }

        .pattern-overlay {
            position: absolute;
            inset: 0;
            opacity: 0.12;
            background-image:
                radial-gradient(circle at 25px 25px, rgba(15, 23, 42, 0.12) 1.5px, transparent 0),
                radial-gradient(circle at 75px 75px, rgba(15, 23, 42, 0.08) 1px, transparent 0);
            background-size: 100px 100px;
            pointer-events: none;
        }

        .login-card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 460px;
            background: #ffffff;
            border-radius: 24px;
            padding: 48px 38px 42px;
            box-shadow:
                0 35px 80px rgba(15, 23, 42, 0.12),
                0 0 0 1px rgba(15, 23, 42, 0.04);
            animation: cardIn 0.5s ease-out;
        }

        @keyframes cardIn {
            from { opacity: 0; transform: translateY(20px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .login-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 36px;
        }

        .logo-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #0d4727, #1a6e3e);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 22px;
            box-shadow: 0 8px 20px rgba(13, 71, 39, 0.25);
            margin-bottom: 16px;
        }

        .login-logo h1 {
            font-size: 20px;
            font-weight: 700;
            color: #0d4727;
            letter-spacing: -0.3px;
        }

        .login-logo p {
            font-size: 13px;
            color: #6b7280;
            margin-top: 4px;
            font-weight: 500;
        }

        .login-logo .badge {
            display: inline-block;
            margin-top: 10px;
            padding: 4px 14px;
            background: #f0fdf4;
            color: #1a6e3e;
            font-size: 11px;
            font-weight: 600;
            border-radius: 20px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper .icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #9ca3af;
            pointer-events: none;
            transition: color 0.2s;
        }

        .input-wrapper input {
            width: 100%;
            padding: 13px 14px 13px 44px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            outline: none;
            transition: all 0.2s;
            background: #f9fafb;
            color: #1f2937;
        }

        .input-wrapper input:focus {
            border-color: #1a6e3e;
            background: white;
            box-shadow: 0 0 0 4px rgba(26, 110, 62, 0.1);
        }

        .input-wrapper input:focus + .icon,
        .input-wrapper:focus-within .icon {
            color: #1a6e3e;
        }

        .input-wrapper input::placeholder {
            color: #9ca3af;
            font-size: 13px;
        }

        .input-error {
            font-size: 12px;
            color: #dc2626;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .error-alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .error-alert svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            color: #dc2626;
        }

        .btn-signin {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #d97706, #f59e0b);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-signin:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35);
        }

        .btn-signin:active {
            transform: translateY(0);
        }

        .btn-signin:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .login-footer {
            text-align: center;
            margin-top: 24px;
        }

        .login-footer a {
            color: #6b7280;
            font-size: 13px;
            text-decoration: none;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .login-footer a:hover {
            color: #1a6e3e;
        }

        .login-footer a svg {
            width: 16px;
            height: 16px;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
            color: #d1d5db;
            font-size: 12px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 36px 24px 32px;
                border-radius: 16px;
            }

            .logo-icon {
                width: 56px;
                height: 56px;
                font-size: 18px;
            }

            .login-logo h1 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="pattern-overlay"></div>

    <div class="login-card">
        <div class="login-logo">
            <div class="logo-icon">MS</div>
            <h1>Mubende SACCO</h1>
            <p>Admin Panel</p>
            <span class="badge">Secure Access</span>
        </div>

        @if ($errors->any())
            <div class="error-alert">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span>{{ $errors->first('email') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="error-alert">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}" autocomplete="off">
            @csrf

            <div class="input-group">
                <label for="email">Email Address</label>
                <div class="input-wrapper">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus autocomplete="email">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </div>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input id="password" type="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
            </div>

            <button type="submit" class="btn-signin">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                Sign In
            </button>
        </form>

        <div class="divider"></div>

        <div class="login-footer">
            <a href="{{ route('home') }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Back to Website
            </a>
        </div>
    </div>
</body>
</html>
