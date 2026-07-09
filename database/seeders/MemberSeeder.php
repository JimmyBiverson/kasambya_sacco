<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\LoanProduct;
use App\Models\Member;
use App\Models\SavingsAccount;
use App\Models\SavingsTransaction;
use App\Models\ShareAccount;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Branches
        $branch1 = Branch::firstOrCreate(['code' => 'MB-HQ'], [
            'name' => 'Mubende Office (HQ)',
            'address' => 'Kaweeri Cell, East Division opp Mubende District Head quaters',
            'district' => 'Mubende',
            'region' => 'Central',
            'phone' => '0775125122',
            'email' => 'mubendehq@gmail.com',
            'manager_name' => 'Nsubuga John',
            'is_active' => true,
        ]);

        $branch2 = Branch::firstOrCreate(['code' => 'MB-KL'], [
            'name' => 'Kalamba Branch',
            'address' => 'opp. Akatale Komubuulo',
            'district' => 'Mubende',
            'region' => 'Central',
            'phone' => '0779892660',
            'email' => 'kalambabranch@gmail.com',
            'manager_name' => 'Mukasa Sarah',
            'is_active' => true,
        ]);

        $branch3 = Branch::firstOrCreate(['code' => 'MB-KS'], [
            'name' => 'Kassanda Service Center',
            'address' => 'at The Arcade',
            'district' => 'Kassanda',
            'region' => 'Central',
            'phone' => '0700000003',
            'email' => 'kassandaservice@gmail.com',
            'manager_name' => 'Atwine Ronald',
            'is_active' => true,
        ]);

        // 2. Seed Loan Products
        $agriLoan = LoanProduct::firstOrCreate(['code' => 'LP-AGRI'], [
            'name' => 'Agriculture Loan',
            'description' => 'Low-interest loans for farmers to purchase seeds, fertilizer, and agricultural equipment.',
            'min_amount' => 500000,
            'max_amount' => 10000000,
            'min_term' => 3,
            'max_term' => 24,
            'interest_rate' => 0.02, // 2% per month
            'interest_method' => 'reducing',
            'penalty_rate' => 0.001,
            'grace_period' => 30,
            'processing_fee' => 0.015,
            'insurance_fee' => 0.005,
            'max_loan_to_savings' => 3.00,
            'max_loan_to_share' => 4.00,
            'collateral_required' => true,
            'category' => 'Agriculture',
            'is_active' => true,
        ]);

        $bizLoan = LoanProduct::firstOrCreate(['code' => 'LP-BIZ'], [
            'name' => 'Business Growth Loan',
            'description' => 'Designed to assist small-to-medium enterprises with working capital.',
            'min_amount' => 1000000,
            'max_amount' => 30000000,
            'min_term' => 6,
            'max_term' => 36,
            'interest_rate' => 0.02, // 2% per month
            'interest_method' => 'reducing',
            'penalty_rate' => 0.001,
            'grace_period' => 15,
            'processing_fee' => 0.02,
            'insurance_fee' => 0.005,
            'max_loan_to_savings' => 3.00,
            'max_loan_to_share' => 4.00,
            'collateral_required' => true,
            'category' => 'Business',
            'is_active' => true,
        ]);

        $eduLoan = LoanProduct::firstOrCreate(['code' => 'LP-EDU'], [
            'name' => 'School Fees Loan',
            'description' => 'Short term loan to cover educational expenses for members children.',
            'min_amount' => 200000,
            'max_amount' => 3000000,
            'min_term' => 1,
            'max_term' => 6,
            'interest_rate' => 0.02, // 2%
            'interest_method' => 'flat',
            'penalty_rate' => 0.002,
            'grace_period' => 0,
            'processing_fee' => 0.01,
            'insurance_fee' => 0.005,
            'max_loan_to_savings' => 2.00,
            'max_loan_to_share' => 3.00,
            'collateral_required' => false,
            'category' => 'SchoolFees',
            'is_active' => true,
        ]);

        $emLoan = LoanProduct::firstOrCreate(['code' => 'LP-EMERG'], [
            'name' => 'Emergency Loan',
            'description' => 'Fast disbursed loans to handle unforeseen emergencies like medical bills.',
            'min_amount' => 100000,
            'max_amount' => 1500005,
            'min_term' => 1,
            'max_term' => 4,
            'interest_rate' => 0.03, // 3%
            'interest_method' => 'flat',
            'penalty_rate' => 0.0015,
            'grace_period' => 0,
            'processing_fee' => 0.01,
            'insurance_fee' => 0.002,
            'max_loan_to_savings' => 1.50,
            'max_loan_to_share' => 2.00,
            'collateral_required' => false,
            'category' => 'Emergency',
            'is_active' => true,
        ]);

        // 3. Seed Members
        $membersData = [
            [
                'membership_number' => 'MS-2026-0001',
                'full_name' => 'Test Member',
                'dob' => '1990-01-01',
                'gender' => 'M',
                'national_id' => 'CM90012345XYZ',
                'phone' => '0700000001',
                'email' => 'testmember@example.test',
                'occupation' => 'Farmer',
                'employer' => 'Self Employed',
                'monthly_income' => 750000,
                'category' => 'Regular',
                'branch_id' => $branch1->id,
                'status' => 'active',
                'joined_at' => '2024-03-15',
            ],
            [
                'membership_number' => 'MS-2026-0002',
                'full_name' => 'Mukasa Joseph',
                'dob' => '1985-05-12',
                'gender' => 'M',
                'national_id' => 'CM85054321ABC',
                'phone' => '0772111222',
                'email' => 'joseph.mukasa@example.test',
                'occupation' => 'Trader',
                'employer' => 'Mukasa Retail Shop',
                'monthly_income' => 1800000,
                'category' => 'Regular',
                'branch_id' => $branch1->id,
                'status' => 'active',
                'joined_at' => '2023-01-10',
            ],
            [
                'membership_number' => 'MS-2026-0003',
                'full_name' => 'Nakitende Florence',
                'dob' => '1992-09-22',
                'gender' => 'F',
                'national_id' => 'CF92097654DEF',
                'phone' => '0754888999',
                'email' => 'florence.nakitende@example.test',
                'occupation' => 'Teacher',
                'employer' => 'Mubende Primary School',
                'monthly_income' => 600000,
                'category' => 'Regular',
                'branch_id' => $branch2->id,
                'status' => 'active',
                'joined_at' => '2025-02-18',
            ],
            [
                'membership_number' => 'MS-2026-0004',
                'full_name' => 'Atwine Ronald',
                'dob' => '1988-11-30',
                'gender' => 'M',
                'national_id' => 'CM88112233GHI',
                'phone' => '0702444555',
                'email' => 'ronald.atwine@example.test',
                'occupation' => 'Boda Boda Operator',
                'employer' => 'Self Employed',
                'monthly_income' => 1200000,
                'category' => 'Regular',
                'branch_id' => $branch3->id,
                'status' => 'active',
                'joined_at' => '2024-07-01',
            ],
            [
                'membership_number' => 'MS-2026-0005',
                'full_name' => 'Asiimwe Patience',
                'dob' => '1995-07-04',
                'gender' => 'F',
                'national_id' => 'CF95079988JKL',
                'phone' => '0775333222',
                'email' => 'patience.asiimwe@example.test',
                'occupation' => 'Tailor',
                'employer' => 'Patience Fashion Hub',
                'monthly_income' => 950000,
                'category' => 'Regular',
                'branch_id' => $branch1->id,
                'status' => 'active',
                'joined_at' => '2024-11-20',
            ],
            [
                'membership_number' => 'MS-2026-0006',
                'full_name' => 'Mubende Farmers Group',
                'dob' => '2010-06-15',
                'gender' => 'Other',
                'national_id' => null,
                'phone' => '0788222333',
                'email' => 'farmersgroup@example.test',
                'occupation' => 'Cooperative Group',
                'employer' => 'Community Members',
                'monthly_income' => 5000000,
                'category' => 'Group',
                'branch_id' => $branch1->id,
                'status' => 'active',
                'joined_at' => '2023-05-15',
            ]
        ];

        $adminUser = User::where('email', 'admin@gmail.com')->first();
        $adminId = $adminUser ? $adminUser->id : null;

        foreach ($membersData as $mData) {
            $member = Member::updateOrCreate(
                ['membership_number' => $mData['membership_number']],
                $mData
            );

            // Create a corresponding user for dashboard access
            $user = User::updateOrCreate(
                ['email' => $mData['email']],
                [
                    'name' => $mData['full_name'],
                    'password' => Hash::make('password123'),
                ]
            );

            // 4. Seed share account
            $sharesAccount = ShareAccount::firstOrCreate([
                'member_id' => $member->id,
            ], [
                'branch_id' => $member->branch_id,
                'account_number' => 'SH-' . $member->id . '-101',
                'total_shares' => rand(20, 150),
                'share_value' => 5000, // 5000 UGX per share
                'balance' => 0,
                'status' => 'active',
            ]);
            $sharesAccount->balance = $sharesAccount->total_shares * $sharesAccount->share_value;
            $sharesAccount->save();

            // Create transaction entries for shares
            $sharesAccount->transactions()->firstOrCreate([
                'type' => 'purchase',
                'shares' => $sharesAccount->total_shares,
                'amount' => $sharesAccount->balance,
                'share_value_at_time' => 5000,
                'reference' => 'TXN-SH-INIT',
                'description' => 'Initial share purchase upon joining.',
                'method' => 'cash',
            ]);

            // 5. Seed Savings Accounts for each Member
            $savingNormal = SavingsAccount::firstOrCreate([
                'member_id' => $member->id,
                'account_type' => 'Normal',
            ], [
                'branch_id' => $member->branch_id,
                'account_number' => 'SV-' . $member->id . '-201',
                'balance' => 0,
                'interest_rate' => 0.03, // 3%
                'status' => 'active',
            ]);

            // Seed some random transactions to populate the account balance
            $balance = 0;
            $types = ['deposit', 'withdrawal'];
            for ($k = 0; $k < 8; $k++) {
                $type = $k === 0 ? 'deposit' : $types[array_rand($types)];
                $amount = rand(50000, 300000);
                if ($type === 'withdrawal' && $balance < $amount) {
                    $type = 'deposit'; // avoid negative balance
                }

                if ($type === 'deposit') {
                    $balance += $amount;
                } else {
                    $balance -= $amount;
                }

                $createdTime = now()->subDays((8 - $k) * 10)->subHours(rand(1, 12));

                SavingsTransaction::firstOrCreate([
                    'savings_account_id' => $savingNormal->id,
                    'reference' => 'TXN-SV-' . ((8 - $k) * 1000 + $member->id),
                ], [
                    'type' => $type,
                    'amount' => $amount,
                    'balance_after' => $balance,
                    'description' => $type === 'deposit' ? 'Cash deposit at branch counter' : 'Over the counter cash withdrawal',
                    'processed_by' => $adminId,
                    'created_at' => $createdTime,
                    'updated_at' => $createdTime,
                ]);
            }
            $savingNormal->balance = $balance;
            $savingNormal->save();

            // Create target savings
            if (in_array($member->membership_number, ['MS-2026-0001', 'MS-2026-0002', 'MS-2026-0003'])) {
                $savingTarget = SavingsAccount::firstOrCreate([
                    'member_id' => $member->id,
                    'account_type' => 'Target',
                ], [
                    'branch_id' => $member->branch_id,
                    'account_number' => 'SV-' . $member->id . '-209',
                    'balance' => 450000,
                    'interest_rate' => 0.05, // 5%
                    'target_amount' => 1000000,
                    'status' => 'active',
                ]);

                SavingsTransaction::firstOrCreate([
                    'savings_account_id' => $savingTarget->id,
                    'reference' => 'TXN-SVT-' . ($member->id * 2000),
                ], [
                    'type' => 'deposit',
                    'amount' => 450000,
                    'balance_after' => 450000,
                    'description' => 'Target savings deposit',
                    'processed_by' => $adminId,
                    'created_at' => now()->subDays(15),
                ]);
            }

            // 6. Seed Loans
            if ($member->membership_number === 'MS-2026-0001') {
                Loan::firstOrCreate([
                    'member_id' => $member->id,
                    'loan_product_id' => $agriLoan->id,
                ], [
                    'branch_id' => $member->branch_id,
                    'application_number' => 'LN-2026-001',
                    'applied_amount' => 3000000,
                    'approved_amount' => 3000000,
                    'disbursed_amount' => 3000000,
                    'term_months' => 12,
                    'interest_rate' => 0.0800,
                    'purpose' => 'Purchase of maize seeds and fertilizers for the season.',
                    'disbursement_method' => 'cash',
                    'status' => 'disbursed',
                    'credit_score' => 720,
                    'disbursed_at' => now()->subMonths(3),
                    'created_at' => now()->subMonths(3),
                ]);
            }

            if ($member->membership_number === 'MS-2026-0002') {
                Loan::firstOrCreate([
                    'member_id' => $member->id,
                    'loan_product_id' => $bizLoan->id,
                ], [
                    'branch_id' => $member->branch_id,
                    'application_number' => 'LN-2026-002',
                    'applied_amount' => 8000000,
                    'approved_amount' => 8000000,
                    'disbursed_amount' => 8000000,
                    'term_months' => 18,
                    'interest_rate' => 0.1200,
                    'purpose' => 'Restocking retail shop.',
                    'disbursement_method' => 'bank',
                    'status' => 'disbursed',
                    'credit_score' => 690,
                    'disbursed_at' => now()->subMonths(2),
                    'created_at' => now()->subMonths(2),
                ]);
            }

            if ($member->membership_number === 'MS-2026-0003') {
                Loan::firstOrCreate([
                    'member_id' => $member->id,
                    'loan_product_id' => $eduLoan->id,
                ], [
                    'branch_id' => $member->branch_id,
                    'application_number' => 'LN-2026-003',
                    'applied_amount' => 1500000,
                    'approved_amount' => null,
                    'disbursed_amount' => null,
                    'term_months' => 4,
                    'interest_rate' => 0.0600,
                    'purpose' => 'Payment of secondary school fees.',
                    'disbursement_method' => 'cash',
                    'status' => 'pending',
                    'credit_score' => 610,
                    'created_at' => now()->subDays(5),
                ]);
            }
        }
    }
}
