<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $report_title ?? 'Savings Statement' }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10pt; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #1a6e3e; padding-bottom: 10px; }
        .header h1 { color: #1a6e3e; font-size: 16pt; margin: 0 0 4px; }
        .header p { margin: 2px 0; font-size: 8pt; color: #666; }
        .account-info { margin-bottom: 15px; }
        .account-info table { width: 100%; font-size: 9pt; }
        .account-info td { padding: 2px 8px; }
        .account-info .label { font-weight: bold; width: 140px; color: #555; }
        table.transactions { width: 100%; border-collapse: collapse; font-size: 8pt; margin-top: 10px; }
        table.transactions th { background: #1a6e3e; color: white; padding: 6px 8px; text-align: left; }
        table.transactions td { padding: 4px 8px; border-bottom: 1px solid #e0e0e0; }
        table.transactions tr:nth-child(even) { background: #f9f9f9; }
        .amount { text-align: right; font-family: 'DejaVu Sans Mono', monospace; }
        .total-row { font-weight: bold; background: #e8f5e9 !important; }
        .footer { position: fixed; bottom: 0; left: 0; right: 0; text-align: center; font-size: 7pt; color: #999; border-top: 1px solid #ccc; padding-top: 4px; }
        .page-number:before { content: "Page " counter(page); }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $org_name ?? 'Mubende SACCO' }}</h1>
        <p>Registration No: {{ $reg_no ?? '6682' }} | {{ $report_title ?? 'Savings Account Statement' }}</p>
        <p>{{ $org_address ? $org_address . ' | ' : '' }}{{ $org_phone ? 'Tel: ' . $org_phone . ' | ' : '' }}Generated: {{ now()->format('d/m/Y H:i') }} | by: {{ $generated_by ?? auth()->user()?->name ?? 'System' }}</p>
    </div>

    <div class="account-info">
        <table>
            <tr><td class="label">Account Number:</td><td>{{ $account->account_number }}</td></tr>
            <tr><td class="label">Member:</td><td>{{ $account->member?->full_name ?? 'N/A' }}</td></tr>
            <tr><td class="label">Account Type:</td><td>{{ $account->account_type }}</td></tr>
            <tr><td class="label">Period:</td><td>{{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</td></tr>
        </table>
    </div>

    <table class="transactions">
        <thead>
            <tr>
                <th>Date</th>
                <th>Reference</th>
                <th>Description</th>
                <th>Type</th>
                <th class="amount">Amount (UGX)</th>
                <th class="amount">Balance (UGX)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="5"><strong>Opening Balance</strong></td>
                <td class="amount">{{ number_format($opening_balance) }}</td>
            </tr>

            @forelse($transactions as $tx)
                <tr>
                    <td>{{ $tx->created_at->format('d/m/Y') }}</td>
                    <td>{{ $tx->reference ?? '—' }}</td>
                    <td>{{ $tx->description ?? '—' }}</td>
                    <td>{{ ucfirst($tx->type) }}</td>
                    <td class="amount">{{ number_format($tx->amount) }}</td>
                    <td class="amount">{{ number_format($tx->balance_after) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #999;">No transactions in this period</td>
                </tr>
            @endforelse

            @php $closingBalance = $transactions->last()?->balance_after ?? $opening_balance; @endphp
            <tr class="total-row">
                <td colspan="5"><strong>Closing Balance</strong></td>
                <td class="amount">{{ number_format($closingBalance) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        {{ $org_name ?? 'Mubende SACCO' }} (Reg: {{ $reg_no ?? '6682' }}) — {{ $report_title ?? 'Statement' }} — Generated {{ now()->format('d/m/Y H:i') }} — <span class="page-number"></span>
    </div>
</body>
</html>
