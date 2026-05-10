<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Application;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        return view('site.home');
    }

    public function about()
    {
        return view('site.about');
    }

    public function history()
    {
        return view('site.history');
    }

    public function managerMessage()
    {
        return view('site.manager-message');
    }

    public function services()
    {
        return view('site.services');
    }

    public function loanProducts()
    {
        return view('site.loan-products');
    }

    public function msacco()
    {
        return view('site.msacco');
    }

    public function news()
    {
        return view('site.news');
    }

    public function newsShow($slug)
    {
        return view('site.news-show', compact('slug'));
    }

    public function careers()
    {
        return view('site.careers');
    }

    public function contact()
    {
        return view('site.contact');
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
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
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date',
            'occupation' => 'nullable|string|max:255',
            'employer' => 'nullable|string|max:255',
            'monthly_income' => 'nullable|numeric|min:0',
            'loan_type' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        Application::create($validated);

        return back()->with('success', 'Your application has been submitted successfully. We will contact you soon.');
    }

    public function reports()
    {
        return view('site.reports');
    }
}
