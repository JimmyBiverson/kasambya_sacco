<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class MemberNumberService
{
    /**
     * Generate the next unique membership number in the format MS-YYYY-NNNNN.
     *
     * Opens a database transaction and acquires a row-level lock on the
     * member_number_sequences row for the current year (or creates the row if
     * this is the first registration of the year). The counter is incremented
     * and saved inside the transaction, guaranteeing uniqueness even under
     * highly concurrent calls.
     *
     * Examples:
     *   MS-2025-00001  (first registration of 2025)
     *   MS-2025-00042  (42nd registration of 2025)
     *
     * @return string  e.g. "MS-2025-00001"
     */
    public function generate(): string
    {
        $memberNumber = null;

        DB::transaction(function () use (&$memberNumber) {
            $year = (int) date('Y');

            // Lock the row for the current year, or create it if it doesn't exist.
            // lockForUpdate() prevents other transactions from reading/modifying
            // this row until our transaction commits, ensuring sequential counters.
            $sequence = DB::table('member_number_sequences')
                ->where('year', $year)
                ->lockForUpdate()
                ->first();

            if ($sequence === null) {
                // First registration of this year — insert the initial row.
                DB::table('member_number_sequences')->insert([
                    'year'          => $year,
                    'last_sequence' => 1,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);

                $next = 1;
            } else {
                $next = $sequence->last_sequence + 1;

                DB::table('member_number_sequences')
                    ->where('year', $year)
                    ->update([
                        'last_sequence' => $next,
                        'updated_at'    => now(),
                    ]);
            }

            $memberNumber = sprintf('MS-%d-%05d', $year, $next);
        });

        return $memberNumber;
    }
}
