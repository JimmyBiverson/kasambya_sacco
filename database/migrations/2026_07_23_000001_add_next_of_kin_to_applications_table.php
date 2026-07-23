<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (!Schema::hasColumn('applications', 'next_of_kin_name')) {
                $table->string('next_of_kin_name', 255)->nullable()->after('account_type');
            }
            if (!Schema::hasColumn('applications', 'next_of_kin_contact')) {
                $table->string('next_of_kin_contact', 50)->nullable()->after('next_of_kin_name');
            }
            if (!Schema::hasColumn('applications', 'next_of_kin_relationship')) {
                $table->string('next_of_kin_relationship', 100)->nullable()->after('next_of_kin_contact');
            }
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $columns = ['next_of_kin_name', 'next_of_kin_contact', 'next_of_kin_relationship'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('applications', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
