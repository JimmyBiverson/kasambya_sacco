<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\LoanProduct;
use App\Models\Member;
use App\Models\NewsEvent;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Slide;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    private function cacheOrFallback(string $key, callable $callback, mixed $fallback = null): mixed
    {
        try {
            return Cache::remember($key, 300, $callback);
        } catch (\Exception $e) {
            Log::error("Cache::remember failed for key: {$key}", ['error' => $e->getMessage()]);
            return $fallback ?? collect();
        }
    }

    public function home()
    {
        try {
            $slides = Cache::remember('site.slides', 300, fn () =>
                Slide::where('is_published', true)->orderBy('sort_order')->get()
            );

            $services = Cache::remember('site.services.featured', 300, fn () =>
                Service::orderBy('sort_order')->get()
            );

            $loanProducts = Cache::remember('site.loan_products.featured', 300, fn () =>
                LoanProduct::where('is_active', true)->get()
            );

            $partners = Cache::remember('site.partners', 300, fn () =>
                Partner::orderBy('sort_order')->get()
            );

            $latestNews = Cache::remember('site.news.latest', 300, fn () =>
                NewsEvent::where('is_published', true)
                    ->orderByDesc('published_at')
                    ->limit(3)
                    ->get()
            );

            $faqs = Cache::remember('site.faqs.home', 300, fn () =>
                Faq::where('is_published', true)
                    ->orderBy('sort_order')
                    ->limit(5)
                    ->get()
            );

            if ($slides->isEmpty()) {
                $slides = collect([
                    (object) ['title' => 'Safe Savings & Affordable Loans', 'subtitle' => 'Join a trusted SACCO that empowers you with low-interest loans, secure savings, and financial growth.', 'cta_text' => 'Become Member', 'cta_url' => route('application'), 'image_path' => null],
                    (object) ['title' => 'Save. Borrow. Grow.', 'subtitle' => 'Started operation in 1999 empowering our community with accessible and affordable financial services.', 'cta_text' => 'View Products', 'cta_url' => route('services'), 'image_path' => null],
                    (object) ['title' => 'Join Mubende Employees and Community Sacco Ltd Today', 'subtitle' => 'Start your journey towards financial freedom with flexible savings and loan products designed for you.', 'cta_text' => 'Apply Now', 'cta_url' => route('application'), 'image_path' => null],
                ]);
            }
        } catch (\Exception $e) {
            $slides = collect([
                (object) ['title' => 'Safe Savings & Affordable Loans', 'subtitle' => 'Join a trusted SACCO that empowers you with low-interest loans, secure savings, and financial growth.', 'cta_text' => 'Become Member', 'cta_url' => route('application'), 'image_path' => null],
                (object) ['title' => 'Save. Borrow. Grow.', 'subtitle' => 'Started operation in 1999 empowering our community with accessible and affordable financial services.', 'cta_text' => 'View Products', 'cta_url' => route('services'), 'image_path' => null],
                (object) ['title' => 'Join Mubende Employees and Community Sacco Ltd Today', 'subtitle' => 'Start your journey towards financial freedom with flexible savings and loan products designed for you.', 'cta_text' => 'Apply Now', 'cta_url' => route('application'), 'image_path' => null],
            ]);
            $services = collect();
            $loanProducts = collect();
            $partners = collect();
            $latestNews = collect();
            $faqs = collect();
        }

        return view('site.home', compact('slides', 'services', 'loanProducts', 'partners', 'latestNews', 'faqs'));
    }

    public function about()
    {
        $page = $this->cacheOrFallback('site.page.about', fn () =>
            Page::where('slug', 'about-mubende-sacco')->where('is_published', true)->first()
        , null);

        $teamMembers = $this->cacheOrFallback('site.team_members', fn () =>
            TeamMember::orderBy('sort_order')->get()
        );

        return view('site.about', compact('page', 'teamMembers'));
    }

    public function history()
    {
        $page = $this->cacheOrFallback('site.page.history', fn () =>
            Page::where('slug', 'our-history')->where('is_published', true)->first()
        , null);

        $teamMembers = $this->cacheOrFallback('site.team_members.history', fn () =>
            TeamMember::orderBy('sort_order')->get()
        );

        return view('site.history', compact('page', 'teamMembers'));
    }

    public function managerMessage()
    {
        $page = $this->cacheOrFallback('site.page.manager-message', fn () =>
            Page::where('slug', 'message-from-the-manager')->where('is_published', true)->first()
        , null);

        return view('site.manager-message', compact('page'));
    }

    public function reports()
    {
        $page = $this->cacheOrFallback('site.page.reports', fn () =>
            Page::where('slug', 'reports')->where('is_published', true)->first()
        , null);

        return view('site.reports', compact('page'));
    }

    public function services()
    {
        $services = $this->cacheOrFallback('site.services.all', fn () =>
            Service::orderBy('sort_order')->get()
        );

        return view('site.services', compact('services'));
    }

    public function loanProducts()
    {
        $loanProducts = $this->cacheOrFallback('site.loan_products.all', fn () =>
            LoanProduct::where('is_active', true)->get()
        );

        return view('site.loan-products', compact('loanProducts'));
    }

    public function msacco()
    {
        $page = $this->cacheOrFallback('site.page.msacco', fn () =>
            Page::where('slug', 'msacco')->where('is_published', true)->first()
        , null);

        return view('site.msacco', compact('page'));
    }

    public function news(Request $request)
    {
        try {
            $query = NewsEvent::where('is_published', true);

            if ($search = $request->input('search')) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%");
                });
            }

            if ($category = $request->input('category')) {
                $query->where('category', $category);
            }

            $news = $query->orderByDesc('published_at')->paginate(9)->withQueryString();

            $recentNews = Cache::remember('site.news.recent', 300, fn () =>
                NewsEvent::where('is_published', true)
                    ->orderByDesc('published_at')
                    ->limit(5)
                    ->get()
            );

            $categories = Cache::remember('site.news.categories', 300, fn () =>
                NewsEvent::where('is_published', true)
                    ->whereNotNull('category')
                    ->select('category')
                    ->distinct()
                    ->pluck('category')
            );
        } catch (\Exception $e) {
            $news = collect();
            $recentNews = collect();
            $categories = collect();
        }

        return view('site.news', compact('news', 'recentNews', 'categories'));
    }

    public function newsShow($slug)
    {
        try {
            $newsItem = Cache::remember("site.news.{$slug}", 300, fn () =>
                NewsEvent::where('slug', $slug)->where('is_published', true)->firstOrFail()
            );

            $recentNews = Cache::remember('site.news.recent.sidebar', 300, fn () =>
                NewsEvent::where('is_published', true)
                    ->where('id', '!=', $newsItem->id)
                    ->orderByDesc('published_at')
                    ->limit(5)
                    ->get()
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404);
        } catch (\Exception $e) {
            $newsItem = null;
            $recentNews = collect();
        }

        return view('site.news-show', compact('newsItem', 'recentNews'));
    }

    public function careers()
    {
        $page = $this->cacheOrFallback('site.page.careers', fn () =>
            Page::where('slug', 'careers')->where('is_published', true)->first()
        , null);

        return view('site.careers', compact('page'));
    }

    public function contact()
    {
        $faqs = $this->cacheOrFallback('site.faqs.contact', fn () =>
            Faq::where('is_published', true)->orderBy('sort_order')->get()
        );

        return view('site.contact', compact('faqs'));
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Your message has been sent successfully. We will get back to you shortly.');
    }

    public function application()
    {
        return view('site.application');
    }

    public function applicationSubmit(Request $request)
    {
        $validated = $request->validate([
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'required|string|max:20',
            'address'       => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date',
            'occupation'    => 'nullable|string|max:255',
            'employer'      => 'nullable|string|max:255',
            'monthly_income'=> 'nullable|numeric|min:0',
            'product_type'  => 'nullable|string|max:255',
            'account_type'  => 'nullable|string|max:255',
            'message'       => 'nullable|string',
        ]);

        Application::create($validated);

        return back()->with('success', 'Your application has been submitted successfully. We will contact you soon.');
    }

    public function reportsPage()
    {
        return view('site.reports');
    }

    public function showMemberLogin()
    {
        $a = rand(10, 50);
        $b = rand(10, 50);
        session(['member_captcha_' . ($a + $b) => $a + $b]);
        session(['member_captcha_answer' => $a + $b]);
        return view('site.member-login', compact('a', 'b'));
    }

    public function memberLogin(Request $request)
    {
        $credentials = $request->validate([
            'membership_number' => ['required', 'string'],
            'dob' => ['required', 'date'],
        ]);

        $request->validate([
            'captcha' => ['required', 'integer'],
        ]);

        $expected = session('member_captcha_answer');
        session()->forget('member_captcha_answer');

        if ($expected === null || (int) $request->input('captcha') !== $expected) {
            return back()->withErrors(['captcha' => 'Captcha answer is incorrect.'])->withInput();
        }

        $member = Member::where('membership_number', $credentials['membership_number'])
            ->where('dob', $credentials['dob'])
            ->where('status', 'active')
            ->first();

        if (!$member) {
            return back()->withErrors(['membership_number' => 'Membership number or date of birth is incorrect, or your account is not active.'])->withInput();
        }

        $email = $member->email ?: sprintf('member-%d@local.test', $member->id);

        $user = \App\Models\User::firstOrCreate([
            'email' => $email,
        ], [
            'name' => $member->full_name ?? $member->membership_number,
            'password' => Hash::make(Str::random(16)),
        ]);

        session()->put('member_id', $member->id);
        Auth::login($user);
        session()->regenerate();

        return redirect()->route('member.dashboard');
    }

    public function memberDashboard()
    {
        $memberId = session('member_id');
        if (!$memberId) {
            return redirect()->route('member.login');
        }

        $member = Member::with(['branch', 'loans.loanProduct', 'savingsAccounts.branch', 'shareAccounts'])
            ->findOrFail($memberId);

        $savingsAccountIds = $member->savingsAccounts->pluck('id');

        $loanSummary = $member->loans->groupBy('status')->map(fn($loans) => [
            'status' => $loans->first()->status,
            'count' => $loans->count(),
            'total_disbursed' => $loans->sum('disbursed_amount'),
        ])->values();

        $activeSavings = $member->savingsAccounts->where('status', 'active')->sum('balance');
        $totalLoaned = $member->loans->whereIn('status', ['approved', 'disbursed'])->sum('disbursed_amount');
        $totalShares = $member->shareAccounts->sum('total_shares');

        $savingsAccounts = $member->savingsAccounts;
        $loans = $member->loans->sortByDesc('created_at')->take(10);

        $recentTransactions = \App\Models\SavingsTransaction::whereIn(
            'savings_account_id', $savingsAccountIds
        )->with('savingsAccount')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('site.member-dashboard', compact(
            'member', 'loanSummary', 'activeSavings', 'totalLoaned',
            'savingsAccounts', 'loans', 'recentTransactions', 'totalShares'
        ));
    }

    public function memberLogout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('member_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('member.login');
    }
}
