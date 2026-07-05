@extends('layouts.app')

@section('content')

<div class="page-header">
    <div class="max-w-7xl mx-auto px-4">
        <h1>Loan Products</h1>
        <p>Affordable loans designed to help you achieve your goals</p>
    </div>
</div>

<section class="py-12 bg-black border-t border-zinc-900">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <p class="text-gray-500 text-lg leading-relaxed">Kasambya SACCO offers a variety of loan products designed to meet the diverse needs of our members. Whether you need capital for your business, school fees for your children, or a loan to acquire an asset, we have you covered. Our loans come with competitive interest rates, flexible repayment terms, and quick approval processes.</p>
    </div>
</section>

<section class="py-20 bg-black border-t border-zinc-900">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold text-white">Our Loan Products</h2>
            <p class="text-gray-500 mt-3 text-lg">Affordable loans designed to help you achieve your goals and improve your livelihood.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">💰</div>
                <h3 class="text-white font-semibold text-lg mb-3">Business Loan</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Capital for your business, shop, or trading enterprise. Boost your inventory, expand operations, and grow your venture with flexible financing terms.</p>
                <ul class="space-y-1 text-sm text-gray-500 border-t border-zinc-800 pt-4">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Up to 10 million UGX</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Competitive interest rates</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Flexible repayment up to 24 months</li>
                </ul>
            </div>
            <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">🏠</div>
                <h3 class="text-white font-semibold text-lg mb-3">Housing Loan</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Build, purchase, or renovate your home. Achieve your dream of owning a house with our affordable housing loan facility.</p>
                <ul class="space-y-1 text-sm text-gray-500 border-t border-zinc-800 pt-4">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Up to 20 million UGX</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Long-term repayment options</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Land purchase &amp; construction</li>
                </ul>
            </div>
            <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">🎓</div>
                <h3 class="text-white font-semibold text-lg mb-3">School Fees Loan</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Never let school fees stand in the way of your child's education. Pay tuition fees conveniently and repay in affordable installments.</p>
                <ul class="space-y-1 text-sm text-gray-500 border-t border-zinc-800 pt-4">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Up to 5 million UGX</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Term-based repayment</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>All education levels covered</li>
                </ul>
            </div>
            <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">⚡</div>
                <h3 class="text-white font-semibold text-lg mb-3">Automatic Loan</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">A pre-approved loan facility based on your savings and share deposits. Access funds instantly with minimal paperwork.</p>
                <ul class="space-y-1 text-sm text-gray-500 border-t border-zinc-800 pt-4">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Backed by your savings</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Quick disbursement</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>No collateral required</li>
                </ul>
            </div>
            <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">🚨</div>
                <h3 class="text-white font-semibold text-lg mb-3">Emergency Loan</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Quick funds for unexpected emergencies such as medical expenses, urgent repairs, or family emergencies. Fast approval when you need it most.</p>
                <ul class="space-y-1 text-sm text-gray-500 border-t border-zinc-800 pt-4">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Same-day disbursement</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Up to 3 million UGX</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Minimal requirements</li>
                </ul>
            </div>
            <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">💼</div>
                <h3 class="text-white font-semibold text-lg mb-3">Asset Acquisition Loan</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Acquire productive assets such as machinery, equipment, vehicles, or household goods. Build your asset base with our financing.</p>
                <ul class="space-y-1 text-sm text-gray-500 border-t border-zinc-800 pt-4">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Up to 15 million UGX</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Asset-backed financing</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Extended repayment period</li>
                </ul>
            </div>
            <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">🌱</div>
                <h3 class="text-white font-semibold text-lg mb-3">Environmental Loan</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Finance eco-friendly projects including tree planting, renewable energy, sustainable farming, and environmental conservation initiatives.</p>
                <ul class="space-y-1 text-sm text-gray-500 border-t border-zinc-800 pt-4">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Green project financing</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Reduced interest rates</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Technical support included</li>
                </ul>
            </div>
            <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">🌾</div>
                <h3 class="text-white font-semibold text-lg mb-3">Farming &amp; Livestock Loan</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Finance your farming and livestock activities including crop production, cattle rearing, poultry, piggery, goat farming, and farm equipment purchase.</p>
                <ul class="space-y-1 text-sm text-gray-500 border-t border-zinc-800 pt-4">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Up to 10 million UGX</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Season-based repayment</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Farm inputs &amp; stock financing</li>
                </ul>
            </div>
            <div class="border border-zinc-800 p-6 hover:border-zinc-600 transition-colors">
                <div class="text-3xl mb-4">🚌</div>
                <h3 class="text-white font-semibold text-lg mb-3">Transport Loan</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Financing for boda boda motorcycles, taxis, buses, and other transport vehicles. Start or expand your transport business today.</p>
                <ul class="space-y-1 text-sm text-gray-500 border-t border-zinc-800 pt-4">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Up to 15 million UGX</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Vehicle financing</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>Insurance included</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-16 border-t border-zinc-900 bg-black">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Need a Loan?</h2>
        <p class="text-gray-400 text-xl font-semibold mb-1">Call us today: <a href="tel:+2560775125122" class="text-white hover:text-gray-300">+256 0775 125 122</a></p>
        <p class="text-gray-500 mb-8 text-lg">Apply for a loan today and get the funds you need to achieve your goals.</p>
        <a href="{{ route('application') }}" class="btn-primary text-base px-10 py-3">Apply Now</a>
    </div>
</section>

@endsection
