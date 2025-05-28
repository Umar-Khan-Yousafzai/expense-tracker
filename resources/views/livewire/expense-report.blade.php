@php
use Carbon\Carbon;
@endphp

<div
    class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-4">
    @include('partials.header', ['title' => 'Expense Report'])

    <!-- Enhanced Filter Card with Glassmorphism -->
    <div class="backdrop-blur-xl bg-white/70 dark:bg-gray-800/70 rounded-2xl shadow-2xl border border-white/20 dark:border-gray-700/50 p-6 mb-8 transition-all duration-300 hover:shadow-3xl">
        <div class="flex items-center mb-6">
            <div class="p-3 rounded-xl bg-gradient-to-r from-blue-500 to-purple-600 text-white mr-4 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z" />
                </svg>
            </div>
            <h2
                class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text text-transparent">
                Report Filters</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Period Filter -->
            <div class="group">
                <label
                    class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                    📅 Period
                </label>
                <select wire:model.live="period"
                    class="w-full border-2 border-gray-200 dark:border-gray-600 rounded-xl shadow-sm bg-white/80 dark:bg-gray-700/80 text-gray-900 dark:text-gray-100 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-200 backdrop-blur-sm hover:shadow-md">
                    @foreach($periodOptions as $option)
                    <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Custom Date Range (Show when period is 'custom') -->
            @if($period === 'custom')
            <div class="group animate-fade-in">
                <label
                    class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                    📅 Date From
                </label>
                <input type="date" wire:model.live="dateFrom"
                    class="w-full border-2 border-gray-200 dark:border-gray-600 rounded-xl shadow-sm bg-white/80 dark:bg-gray-700/80 text-gray-900 dark:text-gray-100 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-200 backdrop-blur-sm hover:shadow-md">
            </div>

            <div class="group animate-fade-in">
                <label
                    class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                    📅 Date To
                </label>
                <input type="date" wire:model.live="dateTo"
                    class="w-full border-2 border-gray-200 dark:border-gray-600 rounded-xl shadow-sm bg-white/80 dark:bg-gray-700/80 text-gray-900 dark:text-gray-100 focus:border-red-500 focus:ring-4 focus:ring-red-500/20 transition-all duration-200 backdrop-blur-sm hover:shadow-md">
            </div>
            @endif

            <!-- Add other filters with enhanced styling -->
            <div class="group">
                <label
                    class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                    🏷️ Category
                </label>
                <select wire:model.live="category"
                    class="w-full border-2 border-gray-200 dark:border-gray-600 rounded-xl shadow-sm bg-white/80 dark:bg-gray-700/80 text-gray-900 dark:text-gray-100 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 transition-all duration-200 backdrop-blur-sm hover:shadow-md">
                    <option value="">All Categories</option>
                    <!-- Add your category options here -->
                </select>
            </div>
        </div>
    </div>

    <!-- Enhanced Summary Cards with Micro-animations -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @php
        $summary = $this->report()['summary'] ?? [];
        @endphp

        <!-- Card 1: Total Spent (Animated Gradient) -->
        <div
            class="group relative overflow-hidden bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-700 rounded-2xl shadow-2xl p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-3xl hover:-translate-y-2">
            <div
                class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-600 opacity-0 group-hover:opacity-20 transition-opacity duration-300">
            </div>
            <div class="relative flex items-center">
                <div
                    class="p-4 rounded-2xl bg-white/20 backdrop-blur-sm group-hover:bg-white/30 transition-all duration-300 group-hover:rotate-12 group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium opacity-90 mb-1">💰 Total Spent</h3>
                    <p class="text-3xl font-bold tracking-tight">RS. {{ number_format($summary['total_spent'] ?? 0, 2)
                        }}</p>
                    <div class="mt-2 text-xs opacity-75">📊 All Expenses</div>
                </div>
            </div>
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16 group-hover:scale-150 transition-transform duration-500">
            </div>
        </div>

        <!-- Card 2: You Owe (Glassmorphism with Pulse) -->
        <div
            class="group relative backdrop-blur-xl bg-white/80 dark:bg-gray-800/80 rounded-2xl shadow-2xl p-6 border border-white/20 dark:border-gray-700/50 transform transition-all duration-300 hover:scale-105 hover:shadow-3xl hover:-translate-y-2">
            <div
                class="absolute inset-0 bg-gradient-to-br from-red-500/10 to-pink-500/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            </div>
            <div class="relative flex items-center">
                <div
                    class="p-4 rounded-2xl bg-gradient-to-br from-red-100 to-pink-100 dark:from-red-900/40 dark:to-pink-900/40 text-red-600 dark:text-red-400 group-hover:animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">⏰ You Owe</h3>
                    <p class="text-3xl font-bold text-red-600 dark:text-red-400 tracking-tight">RS. {{
                        number_format($summary['total_owed'] ?? 0, 2) }}</p>
                    <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">💳 Outstanding</div>
                </div>
            </div>
        </div>

        <!-- Card 3: You're Owed (Neon Glow) -->
        <div
            class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-6 border-l-4 border-green-500 transform transition-all duration-300 hover:scale-105 hover:shadow-3xl hover:-translate-y-2 hover:shadow-green-500/25">
            <div
                class="absolute inset-0 bg-gradient-to-r from-green-500/5 to-emerald-500/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            </div>
            <div class="relative flex items-center">
                <div
                    class="p-4 rounded-2xl bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/40 dark:to-emerald-900/40 text-green-600 dark:text-green-400 group-hover:shadow-lg group-hover:shadow-green-500/25 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">✅ You're Owed</h3>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400 tracking-tight">RS. {{
                        number_format($summary['total_receivable'] ?? 0, 2) }}</p>
                    <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">💚 Receivable</div>
                </div>
            </div>
        </div>

        <!-- Card 4: Net Balance (Dynamic Gradient) -->
        <div
            class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-6 overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-3xl hover:-translate-y-2">
            <div
                class="absolute inset-0 bg-gradient-to-r from-purple-500 to-pink-500 opacity-10 dark:opacity-5 group-hover:opacity-20 transition-opacity duration-300">
            </div>
            <div
                class="absolute inset-0 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
            </div>
            <div class="relative flex items-center">
                <div
                    class="p-4 rounded-2xl bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-purple-900/40 dark:to-indigo-900/40 text-purple-600 dark:text-purple-400 group-hover:rotate-6 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">⚖️ Net Balance</h3>
                    <p
                        class="text-3xl font-bold tracking-tight {{ ($summary['net_balance'] ?? 0) >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                        RS. {{ number_format($summary['net_balance'] ?? 0, 2) }}
                    </p>
                    <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">📈 Overall</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Net Balances Section -->
    <div
        class="backdrop-blur-xl bg-white/80 dark:bg-gray-800/80 rounded-2xl shadow-2xl p-6 mb-8 border border-white/20 dark:border-gray-700/50">
        <div class="flex items-center mb-6">
            <div class="p-3 rounded-xl bg-gradient-to-r from-indigo-500 to-blue-600 text-white mr-4 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <h2
                class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text text-transparent">
                💰 Net Balances ({{ $this->getPeriodDescription($this->filters) }})
            </h2>
        </div>

        <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600">
                    <tr>
                        <th scope="col"
                            class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            👤 Person
                        </th>
                        <th scope="col"
                            class="px-6 py-4 text-right text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            💸 You Owe
                        </th>
                        <th scope="col"
                            class="px-6 py-4 text-right text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            💰 Owes You
                        </th>
                        <th scope="col"
                            class="px-6 py-4 text-right text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            ⚖️ Net Balance
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($this->netBalances as $person => $balance)
                    <tr
                        class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 dark:hover:from-gray-700/50 dark:hover:to-gray-600/50 transition-all duration-200 group">
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-gray-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            {{ $person }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                            @if($balance['you_owe'] > 0)
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400">
                                - RS. {{ number_format($balance['you_owe'], 2) }}
                            </span>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                            @if($balance['owes_you'] > 0)
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">
                                + RS. {{ number_format($balance['owes_you'], 2) }}
                            </span>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-bold">
                            @if($balance['net_balance'] > 0)
                            <span class="text-green-600 dark:text-green-400">
                                🟢 {{ $person }} owes you RS. {{ number_format($balance['net_balance'], 2) }}
                            </span>
                            @elseif($balance['net_balance'] < 0) <span class="text-red-600 dark:text-red-400">
                                🔴 You owe {{ $person }} RS. {{ number_format(abs($balance['net_balance']), 2) }}
                                </span>
                                @else
                                <span class="text-gray-500 dark:text-gray-400">
                                    ✅ All settled
                                </span>
                                @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Enhanced Filter and Table Section -->
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Enhanced Filter Sidebar -->
        <div class="w-full lg:w-64 flex-shrink-0">
            <div
                class="backdrop-blur-xl bg-white/80 dark:bg-gray-800/80 rounded-2xl shadow-2xl p-6 sticky top-4 border border-white/20 dark:border-gray-700/50">
                <div class="flex items-center mb-4">
                    <div class="p-2 rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 text-white mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-gray-100">Filter Debts</h3>
                </div>

                <div class="space-y-3">
                    <button wire:click="$set('debtFilter', 'all')"
                        class="w-full group relative overflow-hidden text-left px-4 py-3 rounded-xl transition-all duration-300 {{ $debtFilter === 'all' ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg transform scale-105' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 hover:scale-102' }}">
                        <div class="flex items-center">
                            <span class="mr-3">📊</span>
                            <span class="font-medium">All Debts</span>
                        </div>
                        @if($debtFilter === 'all')
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-500 opacity-20"></div>
                        @endif
                    </button>

                    <button wire:click="$set('debtFilter', 'owed')"
                        class="w-full group relative overflow-hidden text-left px-4 py-3 rounded-xl transition-all duration-300 {{ $debtFilter === 'owed' ? 'bg-gradient-to-r from-red-500 to-pink-600 text-white shadow-lg transform scale-105' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 hover:scale-102' }}">
                        <div class="flex items-center">
                            <span class="mr-3">💸</span>
                            <span class="font-medium">You Owe</span>
                        </div>
                        @if($debtFilter === 'owed')
                        <div class="absolute inset-0 bg-gradient-to-r from-red-400 to-pink-500 opacity-20"></div>
                        @endif
                    </button>

                    <button wire:click="$set('debtFilter', 'receivable')"
                        class="w-full group relative overflow-hidden text-left px-4 py-3 rounded-xl transition-all duration-300 {{ $debtFilter === 'receivable' ? 'bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-lg transform scale-105' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 hover:scale-102' }}">
                        <div class="flex items-center">
                            <span class="mr-3">💰</span>
                            <span class="font-medium">Owes You</span>
                        </div>
                        @if($debtFilter === 'receivable')
                        <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-emerald-500 opacity-20"></div>
                        @endif
                    </button>
                </div>
            </div>
        </div>

        <!-- Enhanced Table -->
        <div
            class="flex-1 backdrop-blur-xl bg-white/80 dark:bg-gray-800/80 rounded-2xl shadow-2xl overflow-hidden border border-white/20 dark:border-gray-700/50">
            <div class="overflow-x-auto">
                <table id="debtsTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                📅 Date
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                🏷️ Type
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                👤 Person
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                📝 Description
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-right text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                💰 Amount
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                ⚡ Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @if($debtFilter === 'all' || $debtFilter === 'owed')
                        @foreach($this->report()['debts_owed'] as $person => $debts)
                        @foreach($debts as $debt)
                        <tr
                            class="{{ $debt->is_settled ? 'opacity-60' : '' }} hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 dark:hover:from-red-900/10 dark:hover:to-pink-900/10 transition-all duration-200 group">
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ Carbon::parse($debt->expense_date)->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-red-100 to-pink-100 dark:from-red-900/30 dark:to-pink-900/30 text-red-800 dark:text-red-400 border border-red-200 dark:border-red-700">
                                    💸 You Owe
                                </span>
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-gray-100 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                                {{ $person }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 max-w-xs truncate group-hover:text-gray-900 dark:group-hover:text-gray-100 transition-colors">
                                {{ $debt->expense->description }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400 border border-red-200 dark:border-red-700">
                                    - RS. {{ number_format($debt->amount, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $debt->is_settled ? 'bg-gradient-to-r from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 text-green-800 dark:text-green-400 border border-green-200 dark:border-green-700' : 'bg-gradient-to-r from-yellow-100 to-orange-100 dark:from-yellow-900/30 dark:to-orange-900/30 text-yellow-800 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-700' }}">
                                    {{ $debt->is_settled ? '✅ Settled' : '⏳ Pending' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                        @endif

                        @if($debtFilter === 'all' || $debtFilter === 'receivable')
                        @foreach($this->report()['debts_receivable'] as $person => $debts)
                        @foreach($debts as $debt)
                        <tr
                            class="{{ $debt->is_settled ? 'opacity-60' : '' }} hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 dark:hover:from-green-900/10 dark:hover:to-emerald-900/10 transition-all duration-200 group">
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ Carbon::parse($debt->expense_date)->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 text-green-800 dark:text-green-400 border border-green-200 dark:border-green-700">
                                    💰 Owes You
                                </span>
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-gray-100 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                                {{ $person }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 max-w-xs truncate group-hover:text-gray-900 dark:group-hover:text-gray-100 transition-colors">
                                {{ $debt->expense->description }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 border border-green-200 dark:border-green-700">
                                    + RS. {{ number_format($debt->amount, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $debt->is_settled ? 'bg-gradient-to-r from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 text-green-800 dark:text-green-400 border border-green-200 dark:border-green-700' : 'bg-gradient-to-r from-yellow-100 to-orange-100 dark:from-yellow-900/30 dark:to-orange-900/30 text-yellow-800 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-700' }}">
                                    {{ $debt->is_settled ? '✅ Settled' : '⏳ Pending' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.3s ease-out;
    }

    /* Custom scrollbar */
    .overflow-x-auto::-webkit-scrollbar {
        height: 6px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    .dark .overflow-x-auto::-webkit-scrollbar-track {
        background: #374151;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: linear-gradient(to right, #3b82f6, #8b5cf6);
        border-radius: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to right, #2563eb, #7c3aed);
    }

    /* Hover scale utilities */
    .hover\:scale-102:hover {
        transform: scale(1.02);
    }

    /* Shadow utilities */
    .shadow-3xl {
        box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
    }

    /* Glass effect enhancement */
    .backdrop-blur-xl {
        backdrop-filter: blur(20px);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#debtsTable').DataTable({
            responsive: true,
            order: [[0, 'desc']],
            pageLength: 10,
            dom: '<"flex flex-col sm:flex-row justify-between items-center mb-4"<"flex items-center"l><"flex items-center"f>>rtip',
            language: {
                search: "",
                searchPlaceholder: "🔍 Search transactions...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ transactions",
                paginate: {
                    previous: "← Previous",
                    next: "Next →"
                }
            },
            initComplete: function() {
                // Enhanced dark mode support
                $('.dataTables_filter input').addClass('px-4 py-2 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white/80 dark:bg-gray-700/80 text-gray-900 dark:text-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all backdrop-blur-sm');
                $('.dataTables_length select').addClass('px-3 py-2 rounded-lg border-2 border-gray-200 dark:border-gray-600 bg-white/80 dark:bg-gray-700/80 text-gray-900 dark:text-white focus:border-blue-500 transition-all backdrop-blur-sm');
                $('.dataTables_info').addClass('text-sm text-gray-600 dark:text-gray-400 font-medium');
                $('.dataTables_paginate .paginate_button').addClass('px-3 py-2 mx-1 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-blue-900/30 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-200');
                $('.dataTables_paginate .paginate_button.current').addClass('bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg');

                // Add search icon
                $('.dataTables_filter').prepend('<div class="relative">');
                $('.dataTables_filter input').wrap('<div class="relative"></div>');
                $('.dataTables_filter input').before('<div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></div>');
                $('.dataTables_filter input').addClass('pl-10');
            }
        });

        // Add loading animation for Livewire updates
        document.addEventListener('livewire:load', function () {
            Livewire.hook('message.sent', (message, component) => {
                // Add loading state
                document.body.classList.add('cursor-wait');
            });

            Livewire.hook('message.processed', (message, component) => {
                // Remove loading state
                document.body.classList.remove('cursor-wait');

                // Reinitialize DataTable if needed
                if ($.fn.DataTable.isDataTable('#debtsTable')) {
                    $('#debtsTable').DataTable().destroy();
                }
                $('#debtsTable').DataTable({
                    responsive: true,
                    order: [[0, 'desc']],
                    pageLength: 10,
                    // ... same configuration as above
                });
            });
        });
    });
</script>
@endpush
