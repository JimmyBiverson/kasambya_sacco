<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::orderBy('sort_order')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:50',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        Service::create($validated);

        Cache::forget('site.services.featured');
        Cache::forget('site.services.all');

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug,' . $service->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:50',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $service->update($validated);

        Cache::forget('site.services.featured');
        Cache::forget('site.services.all');

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        Cache::forget('site.services.featured');
        Cache::forget('site.services.all');

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
