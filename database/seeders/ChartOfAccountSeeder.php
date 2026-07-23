<?php

namespace Database\Seeders;

use App\Models\ChartOfAccount;
use Illuminate\Database\Seeder;

class ChartOfAccountSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            // ─── Assets (1000-1999) ────────────────────────────────────────────
            ['code' => '1010', 'name' => 'Cash & Cash Equivalents',          'type' => 'asset',    'category' => 'current_asset',     'normal_side' => 'debit'],
            ['code' => '1020', 'name' => 'Bank Account - Main',              'type' => 'asset',    'category' => 'current_asset',     'normal_side' => 'debit'],
            ['code' => '1030', 'name' => 'MTN MoMo Wallet',                  'type' => 'asset',    'category' => 'current_asset',     'normal_side' => 'debit'],
            ['code' => '1040', 'name' => 'Airtel Money Wallet',              'type' => 'asset',    'category' => 'current_asset',     'normal_side' => 'debit'],
            ['code' => '1050', 'name' => 'Petty Cash',                       'type' => 'asset',    'category' => 'current_asset',     'normal_side' => 'debit'],
            ['code' => '1100', 'name' => 'Loans Receivable',                 'type' => 'asset',    'category' => 'current_asset',     'normal_side' => 'debit'],
            ['code' => '1101', 'name' => 'Loan Interest Receivable',         'type' => 'asset',    'category' => 'current_asset',     'normal_side' => 'debit'],
            ['code' => '1110', 'name' => 'Staff Loans',                      'type' => 'asset',    'category' => 'current_asset',     'normal_side' => 'debit'],
            ['code' => '1200', 'name' => 'Accounts Receivable',              'type' => 'asset',    'category' => 'current_asset',     'normal_side' => 'debit'],
            ['code' => '1210', 'name' => 'Accrued Income',                   'type' => 'asset',    'category' => 'current_asset',     'normal_side' => 'debit'],
            ['code' => '1300', 'name' => 'Prepayments',                      'type' => 'asset',    'category' => 'current_asset',     'normal_side' => 'debit'],
            ['code' => '1400', 'name' => 'Investments',                      'type' => 'asset',    'category' => 'non_current_asset', 'normal_side' => 'debit'],
            ['code' => '1500', 'name' => 'Fixed Assets',                     'type' => 'asset',    'category' => 'non_current_asset', 'normal_side' => 'debit'],
            ['code' => '1510', 'name' => 'Accumulated Depreciation',         'type' => 'asset',    'category' => 'non_current_asset', 'normal_side' => 'credit'],
            ['code' => '1520', 'name' => 'Computer Equipment',               'type' => 'asset',    'category' => 'non_current_asset', 'normal_side' => 'debit'],
            ['code' => '1530', 'name' => 'Office Furniture',                 'type' => 'asset',    'category' => 'non_current_asset', 'normal_side' => 'debit'],
            ['code' => '1540', 'name' => 'Motor Vehicles',                   'type' => 'asset',    'category' => 'non_current_asset', 'normal_side' => 'debit'],
            ['code' => '1600', 'name' => 'Inventory',                        'type' => 'asset',    'category' => 'current_asset',     'normal_side' => 'debit'],

            // ─── Liabilities (2000-2999) ────────────────────────────────────────
            ['code' => '2010', 'name' => 'Members\' Savings Deposits',       'type' => 'liability', 'category' => 'current_liability',     'normal_side' => 'credit'],
            ['code' => '2100', 'name' => 'Accounts Payable',                 'type' => 'liability', 'category' => 'current_liability',     'normal_side' => 'credit'],
            ['code' => '2110', 'name' => 'Accrued Expenses',                 'type' => 'liability', 'category' => 'current_liability',     'normal_side' => 'credit'],
            ['code' => '2120', 'name' => 'Interest Payable',                 'type' => 'liability', 'category' => 'current_liability',     'normal_side' => 'credit'],
            ['code' => '2200', 'name' => 'Loans Payable',                    'type' => 'liability', 'category' => 'non_current_liability', 'normal_side' => 'credit'],
            ['code' => '2210', 'name' => 'Borrowings',                       'type' => 'liability', 'category' => 'non_current_liability', 'normal_side' => 'credit'],

            // ─── Equity (3000-3999) ─────────────────────────────────────────────
            ['code' => '3010', 'name' => 'Share Capital',                    'type' => 'equity',  'category' => 'equity', 'normal_side' => 'credit'],
            ['code' => '3020', 'name' => 'Retained Earnings',                'type' => 'equity',  'category' => 'equity', 'normal_side' => 'credit'],
            ['code' => '3030', 'name' => 'Revenue Reserves',                 'type' => 'equity',  'category' => 'equity', 'normal_side' => 'credit'],
            ['code' => '3100', 'name' => 'Current Year Earnings',            'type' => 'equity',  'category' => 'equity', 'normal_side' => 'credit'],

            // ─── Income (4000-4999) ─────────────────────────────────────────────
            ['code' => '4010', 'name' => 'Loan Interest Income',             'type' => 'income',  'category' => null, 'normal_side' => 'credit'],
            ['code' => '4020', 'name' => 'Loan Application Fees',            'type' => 'income',  'category' => null, 'normal_side' => 'credit'],
            ['code' => '4030', 'name' => 'Penalty Fees',                     'type' => 'income',  'category' => null, 'normal_side' => 'credit'],
            ['code' => '4040', 'name' => 'Membership Fees',                  'type' => 'income',  'category' => null, 'normal_side' => 'credit'],
            ['code' => '4100', 'name' => 'Investment Income',                'type' => 'income',  'category' => null, 'normal_side' => 'credit'],
            ['code' => '4110', 'name' => 'Bank Interest Income',             'type' => 'income',  'category' => null, 'normal_side' => 'credit'],
            ['code' => '4200', 'name' => 'Other Income',                     'type' => 'income',  'category' => null, 'normal_side' => 'credit'],

            // ─── Expenses (5000-5999) ────────────────────────────────────────────
            ['code' => '5010', 'name' => 'Staff Salaries',                   'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
            ['code' => '5020', 'name' => 'Staff Benefits',                   'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
            ['code' => '5030', 'name' => 'Rent & Utilities',                 'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
            ['code' => '5040', 'name' => 'Office Supplies',                  'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
            ['code' => '5050', 'name' => 'Communication Costs',              'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
            ['code' => '5060', 'name' => 'Transport & Travel',               'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
            ['code' => '5070', 'name' => 'Depreciation Expense',             'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
            ['code' => '5080', 'name' => 'Bank Charges',                     'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
            ['code' => '5090', 'name' => 'Insurance',                        'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
            ['code' => '5100', 'name' => 'Audit & Legal Fees',               'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
            ['code' => '5110', 'name' => 'Training & Capacity Building',     'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
            ['code' => '5120', 'name' => 'Marketing & Promotion',            'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
            ['code' => '5130', 'name' => 'Repairs & Maintenance',            'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
            ['code' => '5140', 'name' => 'Interest Expense',                 'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
            ['code' => '5150', 'name' => 'Loan Loss Provision',              'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
            ['code' => '5200', 'name' => 'Other Expenses',                   'type' => 'expense', 'category' => null, 'normal_side' => 'debit'],
        ];

        foreach ($accounts as $account) {
            ChartOfAccount::firstOrCreate(
                ['code' => $account['code']],
                $account
            );
        }
    }
}
