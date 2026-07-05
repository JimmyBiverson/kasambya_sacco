@extends('layouts.app')

@section('content')

<div class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <h1>Financial Reports</h1>
        <p>Transparency and accountability in our financial reporting</p>
    </div>
</div>

<div class="border-b border-zinc-900 bg-black">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ url('/') }}" class="text-gray-400 hover:text-white transition-colors">Home</a>
        <span class="text-zinc-700">/</span>
        <span>Kasambya SACCO</span>
        <span class="text-zinc-700">/</span>
        <span class="text-white font-semibold">Financial Reports</span>
    </div>
</div>

<section class="py-16 bg-black">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-6">Financial <span class="text-gray-300">Transparency</span></h2>
        <p class="text-gray-500 text-lg leading-relaxed mb-4">At Kasambya SACCO, we believe that transparency and accountability are fundamental to building and maintaining the trust of our members. As a member-owned financial cooperative, we are committed to keeping our members informed about the financial health and performance of the SACCO.</p>
        <p class="text-gray-500 text-lg leading-relaxed mb-8">Below, you will find our financial reports including annual reports, audited financial statements, quarterly summaries, and special reports. These documents provide a comprehensive overview of our financial position, operational performance, and the stewardship of member resources.</p>
        <div class="border-l-4 border-zinc-700 bg-zinc-900/50 p-6 text-left">
            <p class="text-gray-400 text-sm"><strong class="text-gray-300">Our Commitment:</strong> We adhere to the highest standards of financial reporting and are subject to regular audits by independent auditors and oversight by the Registrar of Cooperative Societies. Members are encouraged to review these reports and contact us with any questions.</p>
        </div>
    </div>
</section>

<section class="py-16 bg-black border-t border-zinc-900">
    <div class="max-w-5xl mx-auto px-4">
        <div class="border border-zinc-800">
            <div class="bg-zinc-900 border-b border-zinc-800 px-6 py-5">
                <h3 class="text-white font-bold text-lg">Download Financial Reports</h3>
                <p class="text-gray-500 text-sm mt-1">Access our latest financial reports and statements</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-zinc-800 bg-black">
                            <th class="text-left text-gray-400 font-semibold px-6 py-4 uppercase tracking-wider text-xs">Year</th>
                            <th class="text-left text-gray-400 font-semibold px-6 py-4 uppercase tracking-wider text-xs">Report Type</th>
                            <th class="text-left text-gray-400 font-semibold px-6 py-4 uppercase tracking-wider text-xs">Description</th>
                            <th class="text-left text-gray-400 font-semibold px-6 py-4 uppercase tracking-wider text-xs">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $reports = [
                                ['year' => '2025', 'type' => 'Annual Report', 'desc' => 'Annual report for the 2025 financial year including performance highlights and member statistics.'],
                                ['year' => '2025', 'type' => 'Audited Statements', 'desc' => 'Audited financial statements for 2025 including balance sheet, income statement, and cash flows.'],
                                ['year' => '2024', 'type' => 'Annual Report', 'desc' => 'Comprehensive annual report for 2024 covering all SACCO operations and performance.'],
                                ['year' => '2024', 'type' => 'Audited Statements', 'desc' => '2024 audited financial statements with independent auditor\'s report and notes.'],
                                ['year' => '2024', 'type' => 'Q4 Report', 'desc' => 'Fourth quarter performance report for the 2024 financial year.'],
                                ['year' => '2023', 'type' => 'Annual Report', 'desc' => 'Annual report for 2023 with complete financial and operational review.'],
                                ['year' => '2023', 'type' => 'Audited Statements', 'desc' => '2023 audited financial statements with detailed notes and auditor opinions.'],
                                ['year' => '2022', 'type' => 'Special Report', 'desc' => 'Special report on SACCO growth, membership trends, and financial performance 2018–2022.'],
                            ];
                        @endphp
                        @foreach($reports as $report)
                        <tr class="border-b border-zinc-800 hover:bg-zinc-900/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="flex items-center gap-2 text-gray-300">
                                    <svg class="w-4 h-4 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    {{ $report['year'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="border border-zinc-700 text-gray-400 text-xs px-3 py-1">{{ $report['type'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $report['desc'] }}</td>
                            <td class="px-6 py-4">
                                <a href="#" onclick="event.preventDefault(); alert('Download placeholder - PDF not yet uploaded.');" class="border border-zinc-700 text-gray-400 hover:border-white hover:text-white transition-colors px-4 py-2 text-xs font-semibold inline-flex items-center gap-1.5">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                    Download
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-black border-t border-zinc-900">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold text-white">Our Reporting Commitment</h2>
            <p class="text-gray-500 mt-3 text-lg">How we ensure financial transparency and accountability</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-14 h-14 border border-zinc-700 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h4 class="text-white font-semibold mb-2">Independent Audits</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Our financial statements are audited annually by independent external auditors to ensure accuracy and compliance with accounting standards.</p>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-14 h-14 border border-zinc-700 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h4 class="text-white font-semibold mb-2">Regulatory Oversight</h4>
                <p class="text-gray-500 text-sm leading-relaxed">We are regulated by the Registrar of Cooperative Societies and comply with all statutory reporting requirements and governance standards.</p>
            </div>
            <div class="border border-zinc-800 p-6 text-center hover:border-zinc-600 transition-colors">
                <div class="w-14 h-14 border border-zinc-700 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                </div>
                <h4 class="text-white font-semibold mb-2">Member Access</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Members have the right to access financial reports and can request additional information at any time through our head office.</p>
            </div>
        </div>
    </div>
</section>

@endsection
