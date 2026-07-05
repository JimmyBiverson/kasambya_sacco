@extends('layouts.app')

@section('content')

<div class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <h1>Careers</h1>
        <p>Join Our Team at Kasambya SACCO</p>
    </div>
</div>

<section class="py-20 bg-black">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Work With Us</h2>
            <p class="text-gray-500 mt-4 text-lg leading-relaxed">At Kasambya SACCO, we believe in investing in our people. We offer a dynamic and supportive work environment where professionals can grow and make a meaningful impact in the community. Join us in our mission to empower members through accessible and affordable financial services.</p>
        </div>

        <div class="mb-16">
            <h3 class="text-2xl font-bold text-white mb-8">Current Openings</h3>
            <div class="space-y-4">
                <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h4 class="text-white font-semibold text-lg">SACCO Manager</h4>
                            <p class="text-gray-500 text-sm mt-1">Kasambya Town, Uganda</p>
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span class="text-xs text-gray-500 border border-zinc-700 px-3 py-1">Full Time</span>
                                <span class="text-xs text-gray-500 border border-zinc-700 px-3 py-1">Management</span>
                            </div>
                            <p class="text-gray-500 text-sm mt-3 leading-relaxed">We are seeking an experienced and dynamic SACCO Manager to provide strategic leadership and oversee all operations of Kasambya SACCO.</p>
                            <div class="mt-3">
                                <h5 class="text-white text-sm font-semibold mb-2">Requirements:</h5>
                                <ul class="space-y-1 text-sm text-gray-500">
                                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Bachelor's degree in Business, Finance, or related field</li>
                                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Minimum 5 years experience in financial management</li>
                                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Strong knowledge of SACCO operations and regulations</li>
                                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Excellent leadership and communication skills</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h4 class="text-white font-semibold text-lg">Credit Officer</h4>
                            <p class="text-gray-500 text-sm mt-1">Kasambya Town, Uganda</p>
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span class="text-xs text-gray-500 border border-zinc-700 px-3 py-1">Full Time</span>
                                <span class="text-xs text-gray-500 border border-zinc-700 px-3 py-1">Credit</span>
                            </div>
                            <p class="text-gray-500 text-sm mt-3 leading-relaxed">Responsible for assessing loan applications, evaluating creditworthiness, and managing the loan portfolio to ensure timely repayment and minimal risk.</p>
                            <div class="mt-3">
                                <h5 class="text-white text-sm font-semibold mb-2">Requirements:</h5>
                                <ul class="space-y-1 text-sm text-gray-500">
                                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Diploma or Degree in Finance, Business, or related field</li>
                                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> 3+ years experience in credit assessment</li>
                                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Knowledge of SACCO lending policies</li>
                                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Strong analytical skills</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h4 class="text-white font-semibold text-lg">ICT Officer</h4>
                            <p class="text-gray-500 text-sm mt-1">Kasambya Town, Uganda</p>
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span class="text-xs text-gray-500 border border-zinc-700 px-3 py-1">Full Time</span>
                                <span class="text-xs text-gray-500 border border-zinc-700 px-3 py-1">Technology</span>
                            </div>
                            <p class="text-gray-500 text-sm mt-3 leading-relaxed">Manage the SACCO's technology infrastructure, maintain the M-SACCO platform, and support digital transformation initiatives.</p>
                            <div class="mt-3">
                                <h5 class="text-white text-sm font-semibold mb-2">Requirements:</h5>
                                <ul class="space-y-1 text-sm text-gray-500">
                                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Degree in Computer Science, IT, or related field</li>
                                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Experience with web technologies and database management</li>
                                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Knowledge of mobile banking platforms</li>
                                    <li class="flex items-baseline gap-2"><span class="text-gray-400">-</span> Problem-solving and analytical skills</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-zinc-800 pt-12">
            <div class="text-center">
                <h3 class="text-2xl font-bold text-white mb-4">How to Apply</h3>
                <p class="text-gray-500 text-lg leading-relaxed max-w-2xl mx-auto mb-8">Interested candidates should submit their CV, cover letter, and academic documents to our office or email them to us. Please indicate the position you are applying for in the subject line.</p>
                <a href="mailto:info@kasambyasacco.com" class="btn-primary text-base px-8 py-3">Apply via Email</a>
            </div>
        </div>
    </div>
</section>

@endsection
