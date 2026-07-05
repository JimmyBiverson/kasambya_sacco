<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Membership Certificate — {{ $org_name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
            color: #1a1a1a;
            background: #fff;
        }

        /* ── Header ── */
        .header {
            background: #1a6e3e;
            color: #fff;
            padding: 20px 30px;
            text-align: center;
            border-bottom: 4px solid #f59e0b;
        }
        .header .org-name {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .header .reg-no {
            font-size: 11px;
            margin-top: 4px;
            opacity: 0.85;
        }
        .header .report-title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 8px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* ── Body ── */
        .body {
            padding: 40px 50px;
        }

        .certificate-border {
            border: 3px double #1a6e3e;
            padding: 30px 40px;
            margin-bottom: 30px;
        }

        .certificate-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #1a6e3e;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 25px;
            border-bottom: 1px solid #f59e0b;
            padding-bottom: 10px;
        }

        .certificate-text {
            font-size: 13px;
            line-height: 2;
            text-align: justify;
            margin-bottom: 20px;
        }

        .member-name {
            font-size: 16px;
            font-weight: bold;
            color: #1a6e3e;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .details-table td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            font-size: 12px;
        }
        .details-table td:first-child {
            background: #f4f7f4;
            font-weight: bold;
            width: 40%;
            color: #1a6e3e;
        }

        .seal-area {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        .signature-block {
            text-align: center;
            width: 45%;
        }
        .signature-line {
            border-top: 1px solid #333;
            margin-top: 50px;
            padding-top: 6px;
            font-size: 11px;
            color: #555;
        }

        /* ── Footer ── */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #f4f7f4;
            border-top: 2px solid #1a6e3e;
            padding: 8px 30px;
            font-size: 10px;
            color: #555;
        }
        .footer-inner {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <div class="org-name">{{ $org_name }}</div>
        @if($org_address)
        <div class="reg-no">{{ $org_address }}</div>
        @endif
        <div class="reg-no">Reg. No. {{ $reg_no }}</div>
        <div class="report-title">{{ $report_title }}</div>
    </div>

    {{-- Certificate Body --}}
    <div class="body">
        <div class="certificate-border">
            <div class="certificate-title">Certificate of Membership</div>

            <p class="certificate-text">
                This is to certify that
                <span class="member-name">{{ $member->full_name }}</span>
                is a duly registered member of
                <strong>{{ $org_name }}</strong>
                (Registration No. {{ $reg_no }}), a savings and credit cooperative operating
                in accordance with the laws of the Republic of Uganda.
            </p>

            <p class="certificate-text">
                This certificate is issued as proof of active membership and entitles the
                holder to all rights and privileges accorded to members of {{ $org_name }}.
            </p>

            <table class="details-table">
                <tr>
                    <td>Membership Number</td>
                    <td>{{ $member->membership_number }}</td>
                </tr>
                <tr>
                    <td>Member Category</td>
                    <td>{{ $member->category }}</td>
                </tr>
                <tr>
                    <td>Date of Joining</td>
                    <td>{{ $member->joined_at ? $member->joined_at->format('d F Y') : '—' }}</td>
                </tr>
                <tr>
                    <td>Branch</td>
                    <td>{{ $member->branch?->name ?? '—' }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ ucfirst($member->status) }}</td>
                </tr>
            </table>

            <div class="seal-area">
                <div class="signature-block">
                    <div class="signature-line">Chief Executive Officer</div>
                </div>
                <div class="signature-block">
                    <div class="signature-line">Chairperson, Board of Directors</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
        <div class="footer-inner">
            <span>Generated by: {{ $generated_by }}</span>
            <span>{{ $org_name }} &mdash; Reg. No. {{ $reg_no }}</span>
            <span>{{ $generated_at }}</span>
        </div>
    </div>

</body>
</html>
