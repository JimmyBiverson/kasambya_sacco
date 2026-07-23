<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Member;
use App\Models\Contact;
use App\Models\Branch;
use App\Models\User;
use App\Notifications\ApplicationApprovedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Services\MemberNumberService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(): View
    {
        $applications = Application::orderByDesc('created_at')->paginate(15);
        return view('admin.applications.index', compact('applications'));
    }

    public function updateStatus(Request $request, Application $application): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,contacted,approved,rejected',
        ]);

        $previousStatus = $application->status;

        DB::transaction(function () use ($application, $validated) {
            if ($application->status !== 'approved' && $validated['status'] === 'approved') {
                $member = Member::where('email', $application->email)
                    ->where('dob', $application->date_of_birth)
                    ->first();

                if (!$member) {
                    $membershipNumber = app(MemberNumberService::class)->generate();

                    $branch = Branch::first();
                    if (!$branch) {
                        $branch = Branch::create([
                            'code' => 'MAIN',
                            'name' => 'Main Branch',
                            'address' => 'Head Office',
                            'district' => 'Headquarters',
                            'phone' => '',
                            'email' => '',
                            'manager_name' => null,
                            'is_active' => true,
                        ]);
                    }

                    Member::create([
                        'membership_number' => $membershipNumber,
                        'full_name' => $application->full_name,
                        'email' => $application->email,
                        'phone' => $application->phone,
                        'address' => $application->address,
                        'dob' => $application->date_of_birth,
                        'occupation' => $application->occupation,
                        'employer' => $application->employer,
                        'monthly_income' => $application->monthly_income,
                        'status' => 'active',
                        'joined_at' => now(),
                        'branch_id' => $branch->id,
                        'category' => 'Regular',
                        'gender' => 'Other',
                    ]);
                }
            }

            $application->update($validated);
        });

        // If the application was just approved, notify admins
        if ($previousStatus !== 'approved' && $validated['status'] === 'approved') {
            try {
                $admins = User::role('Super Admin')->get();
                if ($admins->isNotEmpty()) {
                    foreach ($admins as $admin) {
                        $admin->notify(new ApplicationApprovedNotification($application));
                    }
                } else {
                    // fallback to admin email route defined in config
                    Notification::route('mail', config('app.admin_email'))->notify(new ApplicationApprovedNotification($application));
                }
            } catch (\Exception $e) {
                // don't break the update flow for notification errors
            }
            // Broadcast a realtime event (if broadcasting configured)
            try {
                event(new \App\Events\ApplicationApproved($application));
            } catch (\Exception $e) {
                // ignore broadcasting errors
            }
        }

        // If this was an AJAX request, return JSON (useful for the admin UI)
        if ($request->ajax() || $request->wantsJson()) {
            try {
                $pendingApplications = Application::where('status', 'pending')->count();
                $unreadContacts = Contact::where('is_read', false)->count();
                $pendingMembers = Member::where('status', 'pending')->count();
            } catch (\Exception $e) {
                $pendingApplications = 0;
                $unreadContacts = 0;
                $pendingMembers = 0;
            }

            return response()->json([
                'status' => $validated['status'],
                'application_id' => $application->id,
                'pending_applications' => $pendingApplications,
                'unread_contacts' => $unreadContacts,
                'pending_members' => $pendingMembers,
                'message' => 'Application status updated.'
            ]);
        }

        return back()->with('success', 'Application status updated.');
    }

    public function destroy(Application $application): RedirectResponse
    {
        $application->delete();
        return redirect()->route('admin.applications.index')->with('success', 'Application deleted.');
    }
}
