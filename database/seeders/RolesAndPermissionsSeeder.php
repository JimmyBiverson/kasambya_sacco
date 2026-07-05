<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    private array $resources = [
        'member', 'member_document', 'member_beneficiary', 'member_guarantor',
        'loan', 'loan_product', 'loan_collateral', 'loan_approval', 'loan_repayment', 'loan_schedule',
        'branch', 'slide', 'page', 'service', 'faq', 'partner', 'team_member', 'news_event',
        'setting', 'application', 'contact', 'audit_log',
        'savings_account', 'savings_transaction',
        'share_account', 'share_transaction', 'dividend', 'dividend_allocation',
        'chart_of_account', 'journal_entry',
        'department', 'employee', 'payroll_run', 'leave_request', 'attendance',
        'fixed_asset', 'inventory_item', 'investment',
        'mobile_money_transaction', 'sms_log',
        'user', 'role',
    ];

    private array $actions = ['view', 'create', 'edit', 'delete', 'approve', 'export'];

    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach ($this->resources as $resource) {
            foreach ($this->actions as $action) {
                Permission::firstOrCreate(['name' => "{$resource}:{$action}"]);
            }
        }

        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $branchManager = Role::firstOrCreate(['name' => 'Branch Manager']);
        $branchManager->syncPermissions($this->branchManagerPermissions());

        $loanOfficer = Role::firstOrCreate(['name' => 'Loan Officer']);
        $loanOfficer->syncPermissions($this->loanOfficerPermissions());

        $teller = Role::firstOrCreate(['name' => 'Teller']);
        $teller->syncPermissions($this->tellerPermissions());

        $accountant = Role::firstOrCreate(['name' => 'Accountant']);
        $accountant->syncPermissions($this->accountantPermissions());

        $hrOfficer = Role::firstOrCreate(['name' => 'HR Officer']);
        $hrOfficer->syncPermissions($this->hrOfficerPermissions());

        $auditor = Role::firstOrCreate(['name' => 'Auditor']);
        $auditor->syncPermissions($this->auditorPermissions());

        $readOnly = Role::firstOrCreate(['name' => 'Read-Only Viewer']);
        $readOnly->syncPermissions($this->readOnlyPermissions());
    }

    private function branchManagerPermissions(): array
    {
        return collect($this->resources)->flatMap(fn ($r) => [
            "{$r}:view",
            "{$r}:create",
            "{$r}:edit",
            "{$r}:export",
        ])->reject(fn ($p) => str_starts_with($p, 'setting:')
            || str_starts_with($p, 'user:')
            || str_starts_with($p, 'role:')
            || str_starts_with($p, 'audit_log:')
        )->values()->toArray();
    }

    private function loanOfficerPermissions(): array
    {
        return [
            'member:view', 'member:create', 'member:edit',
            'loan:view', 'loan:create', 'loan:edit',
            'loan_product:view',
            'loan_collateral:view', 'loan_collateral:create', 'loan_collateral:edit',
            'loan_approval:view',
            'loan_repayment:view',
            'loan_schedule:view',
            'branch:view',
        ];
    }

    private function tellerPermissions(): array
    {
        return [
            'member:view',
            'loan:view', 'loan_repayment:view', 'loan_repayment:create',
            'savings_account:view', 'savings_account:create', 'savings_account:edit',
            'savings_transaction:view', 'savings_transaction:create',
            'branch:view',
        ];
    }

    private function accountantPermissions(): array
    {
        return collect($this->resources)->flatMap(fn ($r) => [
            "{$r}:view",
            "{$r}:export",
        ])->merge([
            'chart_of_account:view', 'chart_of_account:create', 'chart_of_account:edit', 'chart_of_account:delete',
            'journal_entry:view', 'journal_entry:create', 'journal_entry:edit',
        ])->values()->toArray();
    }

    private function hrOfficerPermissions(): array
    {
        return [
            'department:view', 'department:create', 'department:edit', 'department:delete',
            'employee:view', 'employee:create', 'employee:edit', 'employee:delete',
            'payroll_run:view', 'payroll_run:create', 'payroll_run:edit', 'payroll_run:approve', 'payroll_run:export',
            'leave_request:view', 'leave_request:create', 'leave_request:edit', 'leave_request:approve',
            'attendance:view', 'attendance:create', 'attendance:edit',
            'branch:view',
        ];
    }

    private function auditorPermissions(): array
    {
        return collect($this->resources)->flatMap(fn ($r) => [
            "{$r}:view",
            "{$r}:export",
        ])->values()->toArray();
    }

    private function readOnlyPermissions(): array
    {
        return collect($this->resources)->flatMap(fn ($r) => [
            "{$r}:view",
        ])->values()->toArray();
    }
}
