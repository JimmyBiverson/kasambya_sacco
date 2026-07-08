<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Loan Agreement — {{ $loan->application_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
            color: #1a1a1a;
            background: #fff;
        }

        /* ── Header ── */
        .header {
            background: #1a6e3e;
            color: #fff;
            padding: 16px 30px;
            border-bottom: 4px solid #f59e0b;
        }
        .header-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .org-name { font-size: 18px; font-weight: bold; letter-spacing: 1px; }
        .header .org-sub  { font-size: 10px; margin-top: 3px; opacity: 0.85; }
        .header .doc-title {
            font-size: 13px;
            font-weight: bold;
            text-align: right;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header .doc-ref { font-size: 10px; text-align: right; margin-top: 4px; opacity: 0.85; }

        /* ── Body ── */
        .body { padding: 24px 30px 80px; }

        .section-title {
            font-size: 11px;
            font-weight: bold;
            color: #fff;
            background: #1a6e3e;
            padding: 5px 10px;
            margin: 20px 0 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table.info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }
        table.info td {
            padding: 5px 8px;
            border: 1px solid #ddd;
            vertical-align: top;
        }
        table.info td.label {
            background: #f4f7f4;
            font-weight: bold;
            color: #1a6e3e;
            width: 30%;
            white-space: nowrap;
        }
        table.info td.value { width: 20%; }

        /* Schedule table */
        table.schedule {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin-top: 6px;
        }
        table.schedule th {
            background: #1a6e3e;
            color: #fff;
            padding: 5px 6px;
            text-align: right;
            white-space: nowrap;
        }
        table.schedule th:first-child { text-align: left; }
        table.schedule td {
            padding: 4px 6px;
            border-bottom: 1px solid #eee;
            text-align: right;
        }
        table.schedule td:first-child { text-align: left; }
        table.schedule tr:nth-child(even) td { background: #f9fafb; }
        table.schedule tfoot td {
            font-weight: bold;
            background: #f4f7f4;
            border-top: 2px solid #1a6e3e;
        }

        /* Summary box */
        .summary-box {
            border: 2px solid #1a6e3e;
            border-radius: 4px;
            padding: 12px 16px;
            margin: 16px 0;
            background: #f4f7f4;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
            font-size: 11px;
        }
        .summary-row .lbl { color: #555; }
        .summary-row .val { font-weight: bold; color: #1a6e3e; }

        /* Collateral table */
        table.collateral {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        table.collateral th {
            background: #1a6e3e;
            color: #fff;
            padding: 5px 8px;
            text-align: left;
        }
        table.collateral td {
            padding: 5px 8px;
            border-bottom: 1px solid #eee;
        }
        table.collateral tr:nth-child(even) td { background: #f9fafb; }

        /* Terms text */
        .terms { font-size: 10px; line-height: 1.6; color: #333; margin-top: 6px; }
        .terms li { margin-bottom: 4px; }

        /* Signatures */
        .sig-table { width: 100%; margin-top: 40px; border-collapse: collapse; }
        .sig-table td { width: 50%; padding: 0 20px; vertical-align: bottom; }
        .sig-line { border-top: 1px solid #333; padding-top: 6px; font-size: 10px; color: #555; }

        /* ── Footer ── */
        .footer {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            background: #f4f7f4;
            border-top: 2px solid #1a6e3e;
            padding: 7px 30px;
            font-size: 9px;
            color: #555;
        }
        .footer-inner { display: flex; justify-content: space-between; }
    </style>
</head>
<body>

{{-- ── Header ── --}}
<div class="header">
    <div class="header-inner">
        <div style="display:flex;align-items:center;gap:10px;">
            @php $logoPath = $org_logo ? public_path('storage/' . $org_logo) : null; @endphp
            @if($logoPath && file_exists($logoPath))
                <img src="{{ $logoPath }}" alt="{{ $org_name }}" style="max-height: 45px; width: auto;">
            @endif
            <div>
                <div class="org-name">{{ $org_name }}</div>
                @if($org_address)<div class="org-sub">{{ $org_address }}</div>@endif
                <div class="org-sub">
                    Reg. No. {{ $reg_no }}
                    @if($org_phone) &nbsp;|&nbsp; {{ $org_phone }} @endif
                    @if($org_email) &nbsp;|&nbsp; {{ $org_email }} @endif
                </div>
            </div>
        </div>
        <div>
            <div class="doc-title">{{ $report_title }}</div>
            <div class="doc-ref">Ref: {{ $loan->application_number }}</div>
            <div class="doc-ref">Date: {{ now()->format('d/m/Y') }}</div>
        </div>
    </div>
</div>

<div class="body">

    {{-- ── Borrower Details ── --}}
    <div class="section-title">Borrower Details</div>
    <table class="info">
        <tr>
            <td class="label">Full Name</td>
            <td class="value">{{ $loan->member?->full_name ?? '—' }}</td>
            <td class="label">Membership No.</td>
            <td class="value">{{ $loan->member?->membership_number ?? '—' }}</td>
        </tr>
        <tr>
            <td class="label">National ID</td>
            <td class="value">{{ $loan->member?->national_id ?? '—' }}</td>
            <td class="label">Phone</td>
            <td class="value">{{ $loan->member?->phone ?? '—' }}</td>
        </tr>
        <tr>
            <td class="label">Address</td>
            <td class="value">{{ $loan->member?->address ?? '—' }}, {{ $loan->member?->district ?? '' }}</td>
            <td class="label">Branch</td>
            <td class="value">{{ $loan->branch?->name ?? $loan->member?->branch?->name ?? '—' }}</td>
        </tr>
    </table>

    {{-- ── Loan Terms ── --}}
    <div class="section-title">Loan Terms</div>
    <table class="info">
        <tr>
            <td class="label">Loan Product</td>
            <td class="value">{{ $loan->loanProduct?->name ?? '—' }}</td>
            <td class="label">Application No.</td>
            <td class="value">{{ $loan->application_number }}</td>
        </tr>
        <tr>
            <td class="label">Principal Amount</td>
            <td class="value">UGX {{ number_format((int)($loan->approved_amount ?? $loan->applied_amount)) }}</td>
            <td class="label">Term</td>
            <td class="value">{{ $loan->term_months }} months</td>
        </tr>
        <tr>
            <td class="label">Interest Rate</td>
            <td class="value">{{ number_format((float)($loan->interest_rate ?? $loan->loanProduct?->interest_rate ?? 0), 2) }}% per annum</td>
            <td class="label">Interest Method</td>
            <td class="value">{{ ucfirst($loan->loanProduct?->interest_method ?? 'flat') }}</td>
        </tr>
        <tr>
            <td class="label">Disbursement Method</td>
            <td class="value">{{ ucwords(str_replace('_', ' ', $loan->disbursement_method ?? 'cash')) }}</td>
            <td class="label">Purpose</td>
            <td class="value">{{ $loan->purpose ?? '—' }}</td>
        </tr>
        @if($loan->loanProduct?->processing_fee > 0 || $loan->loanProduct?->insurance_fee > 0)
        <tr>
            <td class="label">Processing Fee</td>
            <td class="value">{{ number_format((float)($loan->loanProduct?->processing_fee ?? 0), 2) }}%</td>
            <td class="label">Insurance Fee</td>
            <td class="value">{{ number_format((float)($loan->loanProduct?->insurance_fee ?? 0), 2) }}%</td>
        </tr>
        @endif
    </table>

    {{-- ── Repayment Summary ── --}}
    <div class="section-title">Repayment Summary</div>
    <div class="summary-box">
        <div class="summary-row">
            <span class="lbl">Monthly Instalment</span>
            <span class="val">UGX {{ number_format($summary['monthly_instalment']) }}</span>
        </div>
        <div class="summary-row">
            <span class="lbl">Total Interest Payable</span>
            <span class="val">UGX {{ number_format($summary['total_interest']) }}</span>
        </div>
        <div class="summary-row">
            <span class="lbl">Total Amount Repayable</span>
            <span class="val">UGX {{ number_format($summary['total_repayable']) }}</span>
        </div>
    </div>

    {{-- ── Repayment Schedule ── --}}
    <div class="section-title">Repayment Schedule</div>
    <table class="schedule">
        <thead>
            <tr>
                <th>#</th>
                <th>Due Date</th>
                <th>Principal (UGX)</th>
                <th>Interest (UGX)</th>
                <th>Instalment (UGX)</th>
                <th>Balance (UGX)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedule as $i => $row)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $row['due_date'] }}</td>
                <td>{{ number_format($row['principal_due']) }}</td>
                <td>{{ number_format($row['interest_due']) }}</td>
                <td>{{ number_format($row['total_due']) }}</td>
                <td>{{ number_format($row['balance']) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">Totals</td>
                <td>{{ number_format(array_sum(array_column($schedule, 'principal_due'))) }}</td>
                <td>{{ number_format(array_sum(array_column($schedule, 'interest_due'))) }}</td>
                <td>{{ number_format(array_sum(array_column($schedule, 'total_due'))) }}</td>
                <td>—</td>
            </tr>
        </tfoot>
    </table>

    {{-- ── Collateral ── --}}
    @if($loan->collaterals && $loan->collaterals->isNotEmpty())
    <div class="section-title">Collateral / Security</div>
    <table class="collateral">
        <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Description</th>
                <th style="text-align:right">Est. Value (UGX)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loan->collaterals as $i => $col)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $col->type }}</td>
                <td>{{ $col->description }}</td>
                <td style="text-align:right">{{ number_format((int)$col->estimated_value) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    {{-- ── Terms & Conditions ── --}}
    <div class="section-title">Terms and Conditions</div>
    <div class="terms">
        <ol>
            <li>The Borrower agrees to repay the loan in {{ $loan->term_months }} equal monthly instalments of UGX {{ number_format($summary['monthly_instalment']) }} on or before the due date of each month.</li>
            <li>Interest will be computed using the <strong>{{ ucfirst($loan->loanProduct?->interest_method ?? 'flat') }}</strong> method at a rate of {{ number_format((float)($loan->interest_rate ?? $loan->loanProduct?->interest_rate ?? 0), 2) }}% per annum.</li>
            <li>A penalty charge of {{ $loan->loanProduct?->penalty_rate ?? 0 }}% per day will be applied on any overdue amount after a grace period of {{ $loan->loanProduct?->grace_period ?? 0 }} day(s).</li>
            <li>The Borrower authorises {{ $org_name }} to offset any savings or share balances held in their accounts against outstanding loan obligations in the event of default.</li>
            <li>All collateral listed above is pledged as security for this loan and shall remain so until the loan is fully repaid.</li>
            <li>Early repayment is permitted; interest will be rebated on a pro-rata basis in accordance with the SACCO's policy.</li>
            <li>This agreement is governed by the laws of the Republic of Uganda and the rules of {{ $org_name }} (Reg. No. {{ $reg_no }}).</li>
        </ol>
    </div>

    {{-- ── Signatures ── --}}
    <table class="sig-table">
        <tr>
            <td>
                <div style="height:45px;"></div>
                <div class="sig-line">
                    Borrower's Signature<br>
                    Name: {{ $loan->member?->full_name ?? '—' }}<br>
                    Date: ____________________
                </div>
            </td>
            <td>
                <div style="height:45px;"></div>
                <div class="sig-line">
                    For {{ $org_name }}<br>
                    Name: ____________________<br>
                    Date: ____________________
                </div>
            </td>
        </tr>
    </table>

</div>

{{-- ── Footer ── --}}
<div class="footer">
    <div class="footer-inner">
        <span>Generated by: {{ $generated_by }}</span>
        <span>{{ $org_name }} &mdash; Reg. No. {{ $reg_no }} &mdash; {{ $report_title }}</span>
        <span>{{ $generated_at }}</span>
    </div>
</div>

</body>
</html>
