<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeService
{
    /**
     * Generate a QR code PNG for the given membership number and store it
     * in the public storage disk.
     *
     * The QR image is written to:
     *   storage/app/public/qrcodes/{membershipNumber}.png
     *
     * The method creates the `public/qrcodes` directory if it does not yet
     * exist, then delegates to the SimpleSoftwareIO QrCode library to
     * produce a 300×300 pixel PNG.
     *
     * @param  string  $membershipNumber  e.g. "MS-2025-00001"
     * @return string  Relative path suitable for Storage::url(), e.g. "qrcodes/MS-2025-00001.png"
     */
    public function generate(string $membershipNumber): string
    {
        // Ensure the qrcodes directory exists in the public disk.
        Storage::makeDirectory('public/qrcodes');

        $absolutePath = storage_path('app/public/qrcodes/' . $membershipNumber . '.png');

        // Generate a 300×300 PNG QR code encoding the membership number and
        // write it directly to the resolved absolute path on disk.
        QrCode::format('png')
            ->size(300)
            ->generate($membershipNumber, $absolutePath);

        return 'qrcodes/' . $membershipNumber . '.png';
    }
}
