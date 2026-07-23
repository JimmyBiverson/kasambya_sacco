<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    public function index(): View
    {
        $teamMembers = TeamMember::orderBy('sort_order')->paginate(10);
        return view('admin.team-members.index', compact('teamMembers'));
    }

    public function create(): View
    {
        return view('admin.team-members.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'email' => 'nullable|email|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('team', 'public');
        }

        TeamMember::create($validated);

        Cache::forget('site.team_members');
        Cache::forget('site.team_members.history');

        return redirect()->route('admin.team-members.index')->with('success', 'Team member created successfully.');
    }

    public function edit(TeamMember $teamMember): View
    {
        return view('admin.team-members.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'email' => 'nullable|email|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            if ($teamMember->photo) {
                Storage::disk('public')->delete($teamMember->photo);
            }
            $validated['photo'] = $request->file('photo')->store('team', 'public');
        }

        $teamMember->update($validated);

        Cache::forget('site.team_members');
        Cache::forget('site.team_members.history');

        return redirect()->route('admin.team-members.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        if ($teamMember->photo) {
            Storage::disk('public')->delete($teamMember->photo);
        }
        $teamMember->delete();

        Cache::forget('site.team_members');
        Cache::forget('site.team_members.history');

        return redirect()->route('admin.team-members.index')->with('success', 'Team member deleted successfully.');
    }
}
