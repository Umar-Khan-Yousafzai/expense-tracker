@php
use Carbon\Carbon;
@endphp

<div
    class="min-h-screen p-4 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    @include('partials.header', ['title' => 'Expense Report'])
    <div class="mb-4 text-right">
        <form action="{{ route('send.expense.report') }}" method="POST">
            @csrf
            <input type="hidden" name="period" value="{{ $period }}">
            <input type="hidden" name="start_date" value="{{ $start_date }}">
            <input type="hidden" name="end_date" value="{{ $end_date }}">
            <input type="hidden" name="status" value="{{ $status }}">
            <input type="hidden" name="debtFilter" value="{{ $debtFilter }}">
            <button type="submit" class="inline-block px-6 py-3 font-semibold text-white transition-all duration-200 shadow-lg rounded-xl bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 hover:shadow-xl">
                📧 Send Report to Email
            </button>
        </form>
    </div>
    <!-- Enhanced Filter Card with Glassmorphism -->
    <div class="p-6 mb-8 transition-all duration-300 border shadow-2xl backdrop-blur-xl bg-white/70 dark:bg-gray-800/70 rounded-2xl border-white/20 dark:border-gray-700/50 hover:shadow-3xl">
        <div class="flex items-center mb-6">
            <div class="p-3 mr-4 text-white shadow-lg rounded-xl bg-gradient-to-r from-blue-500 to-purple-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z" />
                </svg>
            </div>
            <h2
                class="text-2xl font-bold text-transparent bg-gradient-to-r from-gray-800 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text">
                Report Filters</h2>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
            <!-- Period Filter -->
            <div class="group">
                <label
                    class="block mb-2 text-sm font-semibold text-gray-700 transition-colors dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">
                    📅 Period
                </label>
                <select wire:model.live="period"
                    class="w-full text-gray-900 transition-all duration-200 border-2 border-gray-200 shadow-sm dark:border-gray-600 rounded-xl bg-white/80 dark:bg-gray-700/80 dark:text-gray-100 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 backdrop-blur-sm hover:shadow-md">
                    @foreach($periodOptions as $option)
                    <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Custom Date Range (Show when period is 'custom') -->
            @if($period === 'custom')
            <div class="group animate-fade-in">
                <label
                    class="block mb-2 text-sm font-semibold text-gray-700 transition-colors dark:text-gray-300 group-hover:text-green-600 dark:group-hover:text-green-400">
                    📅 Date From
                </label>
                <input type="date" wire:model.live="dateFrom"
                    class="w-full text-gray-900 transition-all duration-200 border-2 border-gray-200 shadow-sm dark:border-gray-600 rounded-xl bg-white/80 dark:bg-gray-700/80 dark:text-gray-100 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 backdrop-blur-sm hover:shadow-md">
            </div>

            <div class="group animate-fade-in">
                <label
                    class="block mb-2 text-sm font-semibold text-gray-700 transition-colors dark:text-gray-300 group-hover:text-red-600 dark:group-hover:text-red-400">
                    📅 Date To
                </label>
                <input type="date" wire:model.live="dateTo"
                    class="w-full text-gray-900 transition-all duration-200 border-2 border-gray-200 shadow-sm dark:border-gray-600 rounded-xl bg-white/80 dark:bg-gray-700/80 dark:text-gray-100 focus:border-red-500 focus:ring-4 focus:ring-red-500/20 backdrop-blur-sm hover:shadow-md">
            </div>
            @endif

            <!-- Add other filters with enhanced styling -->
            <div class="group">
                <label
                    class="block mb-2 text-sm font-semibold text-gray-700 transition-colors dark:text-gray-300 group-hover:text-purple-600 dark:group-hover:text-purple-400">
                    🏷️ Category
                </label>
                <select wire:model.live="category"
                    class="w-full text-gray-900 transition-all duration-200 border-2 border-gray-200 shadow-sm dark:border-gray-600 rounded-xl bg-white/80 dark:bg-gray-700/80 dark:text-gray-100 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 backdrop-blur-sm hover:shadow-md">
                    <option value="">All Categories</option>
                    <!-- Add your category options here -->
                </select>
            </div>
        </div>
    </div>

    <!-- Enhanced Summary Cards with Micro-animations -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
        @php
        $summary = $this->report()['summary'] ?? [];
        @endphp

        <!-- Card 1: Total Spent (Animated Gradient) -->
        <div
            class="relative p-6 overflow-hidden text-white transition-all duration-300 transform shadow-2xl group bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-700 rounded-2xl hover:scale-105 hover:shadow-3xl hover:-translate-y-2">
            <div
                class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-r from-blue-400 to-purple-600 group-hover:opacity-20">
            </div>
            <div class="relative flex items-center">
                <div
                    class="p-4 transition-all duration-300 rounded-2xl bg-white/20 backdrop-blur-sm group-hover:bg-white/30 group-hover:rotate-12 group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="mb-1 text-sm font-medium opacity-90">💰 Total Spent</h3>
                    <p class="text-3xl font-bold tracking-tight">RS. {{ number_format($summary['total_spent'] ?? 0, 2)
                        }}</p>
                    <div class="mt-2 text-xs opacity-75">📊 All Expenses</div>
                </div>
            </div>
            <div
                class="absolute top-0 right-0 w-32 h-32 transition-transform duration-500 translate-x-16 -translate-y-16 rounded-full bg-white/10 group-hover:scale-150">
            </div>
        </div>

        <!-- Card 2: You Owe (Glassmorphism with Pulse) -->
        <div
            class="relative p-6 transition-all duration-300 transform border shadow-2xl group backdrop-blur-xl bg-white/80 dark:bg-gray-800/80 rounded-2xl border-white/20 dark:border-gray-700/50 hover:scale-105 hover:shadow-3xl hover:-translate-y-2">
            <div
                class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-br from-red-500/10 to-pink-500/10 rounded-2xl group-hover:opacity-100">
            </div>
            <div class="relative flex items-center">
                <div
                    class="p-4 text-red-600 rounded-2xl bg-gradient-to-br from-red-100 to-pink-100 dark:from-red-900/40 dark:to-pink-900/40 dark:text-red-400 group-hover:animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="mb-1 text-sm font-semibold text-gray-700 dark:text-gray-300">⏰ You Owe</h3>
                    <p class="text-3xl font-bold tracking-tight text-red-600 dark:text-red-400">RS. {{
                        number_format($summary['total_owed'] ?? 0, 2) }}</p>
                    <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">💳 Outstanding</div>
                </div>
            </div>
        </div>

        <!-- Card 3: You're Owed (Neon Glow) -->
        <div
            class="relative p-6 transition-all duration-300 transform bg-white border-l-4 border-green-500 shadow-2xl group dark:bg-gray-800 rounded-2xl hover:scale-105 hover:shadow-3xl hover:-translate-y-2 hover:shadow-green-500/25">
            <div
                class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-r from-green-500/5 to-emerald-500/5 rounded-2xl group-hover:opacity-100">
            </div>
            <div class="relative flex items-center">
                <div
                    class="p-4 text-green-600 transition-all duration-300 rounded-2xl bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/40 dark:to-emerald-900/40 dark:text-green-400 group-hover:shadow-lg group-hover:shadow-green-500/25">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="mb-1 text-sm font-semibold text-gray-700 dark:text-gray-300">✅ You're Owed</h3>
                    <p class="text-3xl font-bold tracking-tight text-green-600 dark:text-green-400">RS. {{
                        number_format($summary['total_receivable'] ?? 0, 2) }}</p>
                    <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">💚 Receivable</div>
                </div>
            </div>
        </div>

        <!-- Card 4: Net Balance (Dynamic Gradient) -->
        <div
            class="relative p-6 overflow-hidden transition-all duration-300 transform bg-white shadow-2xl group dark:bg-gray-800 rounded-2xl hover:scale-105 hover:shadow-3xl hover:-translate-y-2">
            <div
                class="absolute inset-0 transition-opacity duration-300 bg-gradient-to-r from-purple-500 to-pink-500 opacity-10 dark:opacity-5 group-hover:opacity-20">
            </div>
            <div
                class="absolute inset-0 transition-opacity duration-500 opacity-0 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 rounded-2xl group-hover:opacity-100">
            </div>
            <div class="relative flex items-center">
                <div
                    class="p-4 text-purple-600 transition-transform duration-300 rounded-2xl bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-purple-900/40 dark:to-indigo-900/40 dark:text-purple-400 group-hover:rotate-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="mb-1 text-sm font-semibold text-gray-700 dark:text-gray-300">⚖️ Net Balance</h3>
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
        class="p-6 mb-8 border shadow-2xl backdrop-blur-xl bg-white/80 dark:bg-gray-800/80 rounded-2xl border-white/20 dark:border-gray-700/50">
        <div class="flex items-center mb-6">
            <div class="p-3 mr-4 text-white shadow-lg rounded-xl bg-gradient-to-r from-indigo-500 to-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <h2
                class="text-2xl font-bold text-transparent bg-gradient-to-r from-gray-800 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text">
                💰 Net Balances ({{ $this->getPeriodDescription($this->filters) }})
            </h2>
        </div>

        <div class="overflow-hidden border border-gray-200 rounded-xl dark:border-gray-700">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600">
                    <tr>
                        <th scope="col"
                            class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-600 uppercase dark:text-gray-300">
                            👤 Person
                        </th>
                        <th scope="col"
                            class="px-6 py-4 text-xs font-bold tracking-wider text-right text-gray-600 uppercase dark:text-gray-300">
                            💸 You Owe
                        </th>
                        <th scope="col"
                            class="px-6 py-4 text-xs font-bold tracking-wider text-right text-gray-600 uppercase dark:text-gray-300">
                            💰 Owes You
                        </th>
                        <th scope="col"
                            class="px-6 py-4 text-xs font-bold tracking-wider text-right text-gray-600 uppercase dark:text-gray-300">
                            ⚖️ Net Balance
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @foreach($this->netBalances as $person => $balance)
                    <tr
                        class="transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 dark:hover:from-gray-700/50 dark:hover:to-gray-600/50 group">
                        <td
                            class="px-6 py-4 text-sm font-semibold text-gray-900 transition-colors whitespace-nowrap dark:text-gray-100 group-hover:text-blue-600 dark:group-hover:text-blue-400">
                            {{ $person }}
                        </td>
                        <td class="px-6 py-4 text-sm text-right whitespace-nowrap">
                            @if($balance['you_owe'] > 0)
                            <span
                                class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full dark:bg-red-900/30 dark:text-red-400">
                                - RS. {{ number_format($balance['you_owe'], 2) }}
                            </span>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-right whitespace-nowrap">
                            @if($balance['owes_you'] > 0)
                            <span
                                class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-400">
                                + RS. {{ number_format($balance['owes_you'], 2) }}
                            </span>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-right whitespace-nowrap">
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
    <div class="flex flex-col gap-8 lg:flex-row">
        <!-- Enhanced Filter Sidebar -->
        <div class="flex-shrink-0 w-full lg:w-64">
            <div
                class="sticky p-6 border shadow-2xl backdrop-blur-xl bg-white/80 dark:bg-gray-800/80 rounded-2xl top-4 border-white/20 dark:border-gray-700/50">
                <div class="flex items-center mb-4">
                    <div class="p-2 mr-3 text-white rounded-lg bg-gradient-to-r from-blue-500 to-purple-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
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
            class="flex-1 overflow-hidden border shadow-2xl backdrop-blur-xl bg-white/80 dark:bg-gray-800/80 rounded-2xl border-white/20 dark:border-gray-700/50">
            <div class="overflow-x-auto">
                <table id="debtsTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-600 uppercase dark:text-gray-300">
                                📅 Date
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-600 uppercase dark:text-gray-300">
                                🏷️ Type
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-600 uppercase dark:text-gray-300">
                                👤 Person
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-600 uppercase dark:text-gray-300">
                                📝 Description
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-bold tracking-wider text-right text-gray-600 uppercase dark:text-gray-300">
                                💰 Amount
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-xs font-bold tracking-wider text-left text-gray-600 uppercase dark:text-gray-300">
                                ⚡ Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @if($debtFilter === 'all' || $debtFilter === 'owed')
                        @foreach($this->report()['debts_owed'] as $person => $debts)
                        @foreach($debts as $debt)
                        <tr
                            class="{{ $debt->is_settled ? 'opacity-60' : '' }} hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 dark:hover:from-red-900/10 dark:hover:to-pink-900/10 transition-all duration-200 group">
                            <td
                                class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                {{ Carbon::parse($debt->expense_date)->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-xs font-bold text-red-800 border border-red-200 rounded-full bg-gradient-to-r from-red-100 to-pink-100 dark:from-red-900/30 dark:to-pink-900/30 dark:text-red-400 dark:border-red-700">
                                    💸 You Owe
                                </span>
                            </td>
                            <td
                                class="px-6 py-4 text-sm font-semibold text-gray-900 transition-colors whitespace-nowrap dark:text-gray-100 group-hover:text-red-600 dark:group-hover:text-red-400">
                                {{ $person }}
                            </td>
                            <td
                                class="max-w-xs px-6 py-4 text-sm text-gray-700 truncate transition-colors dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-gray-100">
                                {{ $debt->expense->description }}
                            </td>
                            <td class="px-6 py-4 text-sm text-right whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-xs font-bold text-red-800 bg-red-100 border border-red-200 rounded-full dark:bg-red-900/30 dark:text-red-400 dark:border-red-700">
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
                                class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                {{ Carbon::parse($debt->expense_date)->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-xs font-bold text-green-800 border border-green-200 rounded-full bg-gradient-to-r from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 dark:text-green-400 dark:border-green-700">
                                    💰 Owes You
                                </span>
                            </td>
                            <td
                                class="px-6 py-4 text-sm font-semibold text-gray-900 transition-colors whitespace-nowrap dark:text-gray-100 group-hover:text-green-600 dark:group-hover:text-green-400">
                                {{ $person }}
                            </td>
                            <td
                                class="max-w-xs px-6 py-4 text-sm text-gray-700 truncate transition-colors dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-gray-100">
                                {{ $debt->expense->description }}
                            </td>
                            <td class="px-6 py-4 text-sm text-right whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-xs font-bold text-green-800 bg-green-100 border border-green-200 rounded-full dark:bg-green-900/30 dark:text-green-400 dark:border-green-700">
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
                $('.dataTables_filter input').before('<div class="absolute text-gray-400 transform -translate-y-1/2 left-3 top-1/2"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></div>');
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
