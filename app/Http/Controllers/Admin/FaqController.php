<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::orderBy('sort_order')->paginate(10);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create(): View
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        Faq::create($validated);

        Cache::forget('site.faqs.home');
        Cache::forget('site.faqs.contact');

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        $faq->update($validated);

        Cache::forget('site.faqs.home');
        Cache::forget('site.faqs.contact');

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        Cache::forget('site.faqs.home');
        Cache::forget('site.faqs.contact');

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }
}
