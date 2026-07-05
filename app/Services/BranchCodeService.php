<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class BranchCodeService
{
    /**
     * Generate a unique branch code in the format "MS-{3LETTER}".
     *
     * Takes the branch name, derives a 3-letter uppercase abbreviation from
     * the first letters of each word (e.g. "Mubende Town Council" → "MTC"),
     * then checks uniqueness against the branches table. If a conflict exists,
     * appends an incrementing numeric suffix (e.g. "MS-MTC2", "MS-MTC3").
     */
    public function generate(string $name): string
    {
        $abbreviation = $this->abbreviate($name);

        $base = 'MS-' . $abbreviation;

        // Check if the base code already exists
        $exists = DB::table('branches')->where('code', $base)->exists();

        if (! $exists) {
            return $base;
        }

        // Find the highest existing suffix counter for this abbreviation
        $counter = 2;
        do {
            $candidate = $base . $counter;
            $exists = DB::table('branches')->where('code', $candidate)->exists();
            $counter++;
        } while ($exists);

        return $base . ($counter - 1);
    }

    /**
     * Derive a 3-letter uppercase abbreviation from a branch name.
     *
     * Splits on whitespace, takes up to 3 words, uses the first letter of
     * each. If fewer than 3 words are available, pads with the first letter
     * of the name (or 'X') to always produce exactly 3 characters.
     */
    private function abbreviate(string $name): string
    {
        $words = preg_split('/\s+/', trim($name), -1, PREG_SPLIT_NO_EMPTY);

        $letters = array_map(
            fn (string $word): string => strtoupper(substr($word, 0, 1)),
            $words
        );

        // Ensure exactly 3 characters
        while (count($letters) < 3) {
            $letters[] = count($letters) > 0 ? $letters[0] : 'X';
        }

        return implode('', array_slice($letters, 0, 3));
    }
}
