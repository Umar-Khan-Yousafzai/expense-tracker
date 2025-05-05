<div class="p-4">
    @include('partials.header', ['title' => 'Expense Report'])

    <!-- Filter Card - Improved for dark mode -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 mb-6 ring-1 ring-gray-200 dark:ring-gray-700">
        <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Report Filters</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Period</label>
                <select wire:model.live="period" class="w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    @foreach($periodOptions as $option)
                    <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Add other filters similarly with dark: classes -->
        </div>
    </div>

    <!-- Enhanced Summary Cards - 6 different styles -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @php
        $summary = $this->report()['summary'] ?? [];
        @endphp

        <!-- Card 1: Total Spent (Gradient) -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-4 text-white">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium">Total Spent</h3>
                    <p class="text-2xl font-semibold">RS. {{ number_format($summary['total_spent'] ?? 0, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Card 2: You Owe (Glass Morphism) -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-lg p-4 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">You Owe</h3>
                    <p class="text-2xl font-semibold text-red-600 dark:text-red-400">RS. {{ number_format($summary['total_owed'] ?? 0, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Card 3: You're Owed (Neon) -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">You're Owed</h3>
                    <p class="text-2xl font-semibold text-green-600 dark:text-green-400">RS. {{ number_format($summary['total_receivable'] ?? 0, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Card 4: Net Balance (Animated Gradient) -->
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-pink-500 opacity-10 dark:opacity-5"></div>
            <div class="relative flex items-center">
                <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Net Balance</h3>
                    <p class="text-2xl font-semibold {{ ($summary['net_balance'] ?? 0) >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                        RS. {{ number_format($summary['net_balance'] ?? 0, 2) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Column and Table - Dark Mode Enhanced -->
    <div class="flex flex-col md:flex-row gap-6">
        <!-- Filter Column -->
        <div class="w-full md:w-48 flex-shrink-0">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 sticky top-4 ring-1 ring-gray-200 dark:ring-gray-700">
                <h3 class="font-medium mb-3 text-gray-900 dark:text-gray-100">Filter Debts</h3>
                <ul class="space-y-2">
                    <li>
                        <button wire:click="$set('debtFilter', 'all')"
                            class="w-full text-left px-3 py-2 rounded-lg transition-all {{ $debtFilter === 'all' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-medium' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                            All Debts
                        </button>
                    </li>
                    <li>
                        <button wire:click="$set('debtFilter', 'owed')"
                            class="w-full text-left px-3 py-2 rounded-lg transition-all {{ $debtFilter === 'owed' ? 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 font-medium' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                            You Owe
                        </button>
                    </li>
                    <li>
                        <button wire:click="$set('debtFilter', 'receivable')"
                            class="w-full text-left px-3 py-2 rounded-lg transition-all {{ $debtFilter === 'receivable' ? 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 font-medium' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                            Owes You
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Table with Dark Mode Support -->
        <div class="flex-1 bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden ring-1 ring-gray-200 dark:ring-gray-700">
            <div class="overflow-x-auto">
                <table id="debtsTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Person</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Amount</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @if($debtFilter === 'all' || $debtFilter === 'owed')
                        @foreach($this->report()['debts_owed'] as $person => $debts)
                        @foreach($debts as $debt)
                        <tr class="{{ $debt->is_settled ? 'opacity-70' : '' }} hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $debt->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400">You Owe</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $person }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $debt->expense->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-red-600 dark:text-red-400">- RS. {{ number_format($debt->amount, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $debt->is_settled ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400' : 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400' }}">
                                    {{ $debt->is_settled ? 'Settled' : 'Pending' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                        @endif

                        @if($debtFilter === 'all' || $debtFilter === 'receivable')
                        @foreach($this->report()['debts_receivable'] as $person => $debts)
                        @foreach($debts as $debt)
                        <tr class="{{ $debt->is_settled ? 'opacity-70' : '' }} hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $debt->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">Owes You</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $person }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $debt->expense->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-green-600 dark:text-green-400">+ RS. {{ number_format($debt->amount, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $debt->is_settled ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400' : 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400' }}">
                                    {{ $debt->is_settled ? 'Settled' : 'Pending' }}
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

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#debtsTable').DataTable({
            responsive: true,
            order: [[0, 'desc']],
            pageLength: 25,
            // Dark mode support for DataTables
            initComplete: function() {
                $('.dataTables_filter input').addClass('dark:bg-gray-700 dark:text-white dark:border-gray-600');
                $('.dataTables_length select').addClass('dark:bg-gray-700 dark:text-white dark:border-gray-600');
                $('.dataTables_info').addClass('dark:text-gray-400');
                $('.dataTables_paginate .paginate_button').addClass('dark:text-gray-400 dark:hover:bg-gray-700');
            }
        });
    });
</script>
@endpush
