<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Branch;
use App\Models\Contact;
use App\Models\Loan;
use App\Models\LoanProduct;
use App\Models\Member;
use App\Models\SavingsAccount;
use App\Models\SavingsTransaction;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $totalMembers = Cache::remember('admin.dashboard.total_members', 60, fn () =>
                Member::count()
            );

            $activeLoans = Cache::remember('admin.dashboard.active_loans', 60, fn () =>
                Loan::whereIn('status', ['active', 'approved', 'disbursed'])->count()
            );

            $totalSavings = Cache::remember('admin.dashboard.total_savings', 60, fn () =>
                SavingsAccount::sum('balance')
            );

            $totalBranches = Cache::remember('admin.dashboard.total_branches', 60, fn () =>
                Branch::where('is_active', true)->count()
            );

            $totalApplications = Cache::remember('admin.dashboard.total_applications', 60, fn () =>
                Application::count()
            );

            $pendingApplications = Cache::remember('admin.dashboard.pending_applications', 60, fn () =>
                Application::where('status', 'pending')->count()
            );

            $unreadContacts = Cache::remember('admin.dashboard.unread_contacts', 60, fn () =>
                Contact::where('is_read', false)->count()
            );

            $pendingMembers = Cache::remember('admin.dashboard.pending_members', 60, fn () =>
                Member::where('status', 'pending')->count()
            );

            $totalLoanedAmount = Cache::remember('admin.dashboard.total_loaned', 60, fn () =>
                Loan::sum('disbursed_amount')
            );

            $loanProducts = Cache::remember('admin.dashboard.loan_products_chart', 60, fn () =>
                LoanProduct::where('is_active', true)
                    ->withCount('loans')
                    ->get(['id', 'name', 'category'])
            );

            $monthlyDeposits = Cache::remember('admin.dashboard.monthly_deposits', 60, function () {
                $months = collect();
                for ($i = 5; $i >= 0; $i--) {
                    $date = now()->subMonths($i);
                    $start = $date->copy()->startOfMonth();
                    $end = $date->copy()->endOfMonth();

                    $total = SavingsTransaction::where('type', 'deposit')
                        ->whereBetween('created_at', [$start, $end])
                        ->sum('amount');

                    $months->push([
                        'month' => $date->format('M Y'),
                        'total' => $total,
                    ]);
                }
                return $months;
            });

            $recentMembers = Cache::remember('admin.dashboard.recent_members', 60, fn () =>
                Member::latest()->take(5)->get(['id', 'full_name', 'membership_number', 'status', 'created_at'])
            );

            $maleCount = Cache::remember('admin.dashboard.male_count', 60, fn () =>
                Member::where('gender', 'M')->count()
            );

            $femaleCount = Cache::remember('admin.dashboard.female_count', 60, fn () =>
                Member::where('gender', 'F')->count()
            );

        } catch (\Exception $e) {
            Log::error('Dashboard data loading failed', ['error' => $e->getMessage()]);
            $totalMembers = 0;
            $activeLoans = 0;
            $totalSavings = 0;
            $totalBranches = 0;
            $totalApplications = 0;
            $pendingApplications = 0;
            $unreadContacts = 0;
            $pendingMembers = 0;
            $totalLoanedAmount = 0;
            $loanProducts = collect();
            $monthlyDeposits = collect();
            $recentMembers = collect();
            $maleCount = 0;
            $femaleCount = 0;
        }

        $chartLabels = $monthlyDeposits->pluck('month');
        $chartData = $monthlyDeposits->pluck('total');

        $productLabels = $loanProducts->pluck('name');
        $productCounts = $loanProducts->pluck('loans_count');

        return view('admin.dashboard.index', compact(
            'totalMembers',
            'activeLoans',
            'totalSavings',
            'totalBranches',
            'totalApplications',
            'pendingApplications',
            'unreadContacts',
            'pendingMembers',
            'totalLoanedAmount',
            'loanProducts',
            'monthlyDeposits',
            'recentMembers',
            'chartLabels',
            'chartData',
            'productLabels',
            'productCounts',
            'maleCount',
            'femaleCount',
        ));
    }

    /**
     * AJAX endpoint to return admin notification counts
     */
    public function notificationCounts()
    {
        try {
            $pendingApplications = Cache::remember('admin.notifications.pending_applications', 30, fn () =>
                Application::where('status', 'pending')->count()
            );
            $unreadContacts = Cache::remember('admin.notifications.unread_contacts', 30, fn () =>
                Contact::where('is_read', false)->count()
            );
            $pendingMembers = Cache::remember('admin.notifications.pending_members', 30, fn () =>
                Member::where('status', 'pending')->count()
            );
        } catch (\Exception $e) {
            Log::error('Failed to load notification counts', ['error' => $e->getMessage()]);
            $pendingApplications = 0;
            $unreadContacts = 0;
            $pendingMembers = 0;
        }

        return response()->json([
            'pending_applications' => $pendingApplications,
            'unread_contacts' => $unreadContacts,
            'pending_members' => $pendingMembers,
        ]);
    }
}
