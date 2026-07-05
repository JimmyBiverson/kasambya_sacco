<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Application;
use App\Models\Member;
use App\Models\Branch;
use App\Models\Contact;
use App\Services\MemberNumberService;

echo "Starting simulated approval...\n";

$appRecord = Application::where('status', 'pending')->orderBy('created_at')->first();
if (! $appRecord) {
    echo "No pending applications found.\n";
    exit(0);
}

echo "Found application id={$appRecord->id} email={$appRecord->email}\n";

$existing = Member::where('email', $appRecord->email)
    ->where('dob', $appRecord->date_of_birth)
    ->first();

if ($existing) {
    echo "Member already exists id={$existing->id}\n";
} else {
    echo "Creating member from application...\n";
    $membershipNumber = app(MemberNumberService::class)->generate();

    $branch = Branch::first();
    if (! $branch) {
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
        echo "Created fallback branch id={$branch->id}\n";
    }

    $m = Member::create([
        'membership_number' => $membershipNumber,
        'full_name' => $appRecord->full_name,
        'email' => $appRecord->email,
        'phone' => $appRecord->phone,
        'address' => $appRecord->address,
        'dob' => $appRecord->date_of_birth,
        'occupation' => $appRecord->occupation,
        'employer' => $appRecord->employer,
        'monthly_income' => $appRecord->monthly_income,
        'status' => 'active',
        'joined_at' => now(),
        'branch_id' => $branch->id,
        'category' => 'Regular',
        'gender' => 'Other',
    ]);

    echo "Created member id={$m->id}\n";
}

$appRecord->status = 'approved';
$appRecord->save();

echo "Application status set to approved.\n";

$pendingApplications = Application::where('status', 'pending')->count();
$unreadContacts = Contact::where('is_read', false)->count();
$pendingMembers = Member::where('status', 'pending')->count();

echo "Notification counts:\n";
echo " - pending_applications: {$pendingApplications}\n";
echo " - unread_contacts: {$unreadContacts}\n";
echo " - pending_members: {$pendingMembers}\n";

echo "Done.\n";
