<?php

namespace App\Services;

use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PdfService
{
    /**
     * Generate a PDF from a Blade view with SACCO-branded header/footer data,
     * and return a downloadable inline response.
     *
     * @param  string  $view      Blade view path (e.g. 'pdf.membership-certificate')
     * @param  array   $data      Data to pass to the view
     * @param  string  $filename  File name for the download
     * @return \Illuminate\Http\Response
     */
    public function generate(string $view, array $data, string $filename = 'document.pdf'): Response
    {
        $data = array_merge($this->headerFooterData($data['report_title'] ?? 'Report'), $data);

        $pdf = Pdf::loadView($view, $data)
            ->setPaper('a4', 'portrait');

        return $pdf->download($filename);
    }

    /**
     * Stream a PDF download response.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  string  $filename
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download(string $view, array $data, string $filename): StreamedResponse
    {
        $data = array_merge($this->headerFooterData($data['report_title'] ?? 'Report'), $data);

        $pdf = Pdf::loadView($view, $data)
            ->setPaper('a4', 'portrait');

        $content = $pdf->output();

        return response()->streamDownload(
            function () use ($content) {
                echo $content;
            },
            $filename,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }

    /**
     * Build common SACCO header/footer data injected into every PDF template.
     *
     * @param  string  $reportTitle
     * @return array
     */
    private function headerFooterData(string $reportTitle): array
    {
        return [
            'org_name'      => Setting::get('org_name', 'Mubende SACCO'),
            'org_address'   => Setting::get('org_address', ''),
            'org_phone'     => Setting::get('org_phone', ''),
            'org_email'     => Setting::get('org_email', ''),
            'reg_no'        => Setting::get('org_registration_number', '6682'),
            'org_logo'      => Setting::get('org_logo', ''),
            'report_title'  => $reportTitle,
            'generated_by'  => Auth::user()?->name ?? 'System',
            'generated_at'  => now()->format('d/m/Y H:i:s'),
        ];
    }
}
