<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SlideController extends Controller
{
    public function index(): View
    {
        $slides = Slide::orderBy('sort_order')->paginate(10);
        return view('admin.slides.index', compact('slides'));
    }

    public function create(): View
    {
        return view('admin.slides.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'cta_text' => 'nullable|string|max:255',
            'cta_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('slides', 'public');
        }

        Slide::create($validated);

        Cache::forget('site.slides');

        return redirect()->route('admin.slides.index')->with('success', 'Slide created successfully.');
    }

    public function edit(Slide $slide): View
    {
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(Request $request, Slide $slide): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'cta_text' => 'nullable|string|max:255',
            'cta_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($slide->image_path) {
                Storage::disk('public')->delete($slide->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('slides', 'public');
        }

        $slide->update($validated);

        Cache::forget('site.slides');

        return redirect()->route('admin.slides.index')->with('success', 'Slide updated successfully.');
    }

    public function destroy(Slide $slide): RedirectResponse
    {
        if ($slide->image_path) {
            Storage::disk('public')->delete($slide->image_path);
        }
        $slide->delete();

        Cache::forget('site.slides');

        return redirect()->route('admin.slides.index')->with('success', 'Slide deleted successfully.');
    }
}
