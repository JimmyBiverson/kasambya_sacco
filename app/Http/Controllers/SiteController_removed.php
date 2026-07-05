<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Application;
use App\Models\Faq;
use App\Models\NewsEvent;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Loan;
use App\Models\Member;
use App\Models\SavingsAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SiteController extends Controller
{
    public function home()
    {
        try {
            $services = Cache::remember('site.services.featured', 300, fn () =>
                Service::orderBy('sort_order')->get()
            );

            $slides = [];
            if (class_exists(\App\Models\Slide::class)) {
                $slides = Cache::remember('site.slides', 300, fn () =>
                    \App\Models\Slide::where('is_published', true)
                        ->orderBy('sort_order')
                        ->get()
                );
            }

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
        } catch (\Exception $e) {
            $services   = collect();
            $slides     = collect();
            $partners   = collect();
            $latestNews = collect();
            $faqs       = collect();
        }

        return view('site.home', compact('services', 'slides', 'partners', 'latestNews', 'faqs'));
    }

    public function about()
    {
        try {
            $page = Cache::remember('site.page.about', 300, fn () =>
                Page::where('slug', 'about')->where('is_published', true)->first()
            );

            $teamMembers = Cache::remember('site.team_members', 300, fn () =>
                TeamMember::orderBy('sort_order')->get()
            );
        } catch (\Exception $e) {
            $page        = null;
            $teamMembers = collect();
        }

        return view('site.about', compact('page', 'teamMembers'));
    }

    public function history()
    {
        try {
            $page = Cache::remember('site.page.history', 300, fn () =>
                Page::where('slug', 'history')->where('is_published', true)->first()
            );
        } catch (\Exception $e) {
            $page = null;
        }

        return view('site.history', compact('page'));
    }

    public function managerMessage()
    {
        try {
            $page = Cache::remember('site.page.manager-message', 300, fn () =>
                Page::where('slug', 'manager-message')->where('is_published', true)->first()
            );
        } catch (\Exception $e) {
            $page = null;
        }

        return view('site.manager-message', compact('page'));
    }

    public function services()
    {
        try {
            $services = Cache::remember('site.services', 300, fn () =>
                Service::orderBy('sort_order')->get()
            );
        } catch (\Exception $e) {
            $services = collect();
        }

        return view('site.services', compact('services'));
    }

    public function loanProducts()
    {
        try {
            $services = Cache::remember('site.services.loans', 300, fn () =>
                Service::where('type', 'loan')->orderBy('sort_order')->get()
            );
        } catch (\Exception $e) {
            $services = collect();
        }

        return view('site.loan-products', compact('services'));
    }

    public function msacco()
    {
        try {
            $page = Cache::remember('site.page.msacco', 300, fn () =>
                Page::where('slug', 'msacco')->where('is_published', true)->first()
            );
        } catch (\Exception $e) {
            $page = null;
        }

        return view('site.msacco', compact('page'));
    }

    public function news()
    {
        try {
            $news = NewsEvent::where('is_published', true)
                    ->orderByDesc('published_at')
                    ->paginate(9);
        } catch (\Exception $e) {
            $news = collect();
        }

        return view('site.news', compact('news'));
    }

    public function newsShow($slug)
    {
        try {
            $newsItem = Cache::remember("site.news.{$slug}", 300, fn () =>
                NewsEvent::where('slug', $slug)->where('is_published', true)->firstOrFail()
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404);
        } catch (\Exception $e) {
            $newsItem = null;
        }

        return view('site.news-show', compact('newsItem', 'slug'));
    }

    public function careers()
    {
        try {
            $page = Cache::remember('site.page.careers', 300, fn () =>
                Page::where('slug', 'careers')->where('is_published', true)->first()
            );
        } catch (\Exception $e) {
            $page = null;
        }

        return view('site.careers', compact('page'));
    }

    public function contact()
    {
        try {
            $faqs = Cache::remember('site.faqs', 300, fn () =>
                Faq::where('is_published', true)->orderBy('sort_order')->get()
            );
        } catch (\Exception $e) {
            $faqs = collect();
        }

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
            'full_name'      => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'required|string|max:20',
            'address'        => 'nullable|string|max:500',
            'date_of_birth'  => 'nullable|date',
            'occupation'     => 'nullable|string|max:255',
            'employer'       => 'nullable|string|max:255',
            'monthly_income' => 'nullable|numeric|min:0',
            'loan_type'      => 'nullable|string|max:255',
            'message'        => 'nullable|string',
        ]);

        Application::create($validated);

        return back()->with('success', 'Your application has been submitted successfully. We will contact you soon.');
    }

    public function savingProducts()
    {
        return view('site.saving-products');
    }

    public function membership()
    {
        return view('site.membership');
    }

    public function reports()
    {
        return view('site.reports');
    }

    public function showMemberLogin()
    {
        // simple arithmetic captcha for bot mitigation
        $a = rand(2, 9);
        $b = rand(2, 9);
        session(['member_captcha' => $a + $b]);
        return view('site.member-login', compact('a', 'b'));
    }

    public function memberLogin(Request $request)
    {
        $credentials = $request->validate([
            'membership_number' => ['required', 'string'],
            'dob' => ['required', 'date'],
        ]);
        $validated = $request->validate([
            'captcha' => ['required', 'integer'],
        ]);

        if (session('member_captcha') !== (int) $request->input('captcha')) {
            return back()->withErrors(['captcha' => 'Captcha answer is incorrect.'])->withInput();
        }

        $member = Member::where('membership_number', $credentials['membership_number'])
            ->where('dob', $credentials['dob'])
            ->where('status', 'active')
            ->first();

        if (! $member) {
            return back()->withErrors(['membership_number' => 'Membership number or date of birth is incorrect, or your account is not active.'])->withInput();
        }

        // Link or create a `User` record for the member so we can use Laravel auth
        $email = $member->email ?: sprintf('member+%s@local.test', preg_replace('/[^A-Za-z0-9]/', '', $member->membership_number));

        $user = \App\Models\User::firstOrCreate([
            'email' => $email,
        ], [
            'name' => $member->full_name ?? $member->membership_number,
            'password' => Hash::make(strtoupper(substr($member->membership_number, -6)) . '!' ),
        ]);

        // store reference to member and log user in
        session()->put('member_id', $member->id);
        Auth::login($user);
        session()->regenerate();

        return redirect()->route('member.dashboard');
    }

    public function memberDashboard()
    {
        $memberId = session('member_id');
        if (! $memberId) {
            return redirect()->route('member.login');
        }

        $member = Member::with(['branch', 'loans.loanProduct', 'savingsAccounts'])
            ->findOrFail($memberId);

        $loanSummary = $member->loans()
            ->selectRaw('status, COUNT(*) as count, SUM(disbursed_amount) as total_disbursed')
            ->groupBy('status')
            ->get();

        $activeSavings = $member->savingsAccounts()->where('status', 'active')->sum('balance');
        $totalLoaned = $member->loans()->where('status', 'approved')->sum('disbursed_amount');

        return view('site.member-dashboard', compact('member', 'loanSummary', 'activeSavings', 'totalLoaned'));
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
