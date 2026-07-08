<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsEventController extends Controller
{
    public function index(): View
    {
        $news = NewsEvent::orderByDesc('published_at')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news_events,slug',
            'content' => 'nullable|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        if (empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        NewsEvent::create($validated);

        Cache::forget('site.news.latest');
        Cache::forget('site.news.recent');
        Cache::forget('site.news.categories');
        Cache::forget('site.news.recent.sidebar');

        return redirect()->route('admin.news.index')->with('success', 'News article created successfully.');
    }

    public function edit(NewsEvent $news): View
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, NewsEvent $news): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news_events,slug,' . $news->id,
            'content' => 'nullable|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($validated);

        Cache::forget('site.news.latest');
        Cache::forget('site.news.recent');
        Cache::forget('site.news.categories');
        Cache::forget('site.news.recent.sidebar');
        Cache::forget('site.news.' . $news->slug);

        return redirect()->route('admin.news.index')->with('success', 'News article updated successfully.');
    }

    public function destroy(NewsEvent $news): RedirectResponse
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $slug = $news->slug;
        $news->delete();

        Cache::forget('site.news.latest');
        Cache::forget('site.news.recent');
        Cache::forget('site.news.categories');
        Cache::forget('site.news.recent.sidebar');
        Cache::forget('site.news.' . $slug);

        return redirect()->route('admin.news.index')->with('success', 'News article deleted successfully.');
    }
}
