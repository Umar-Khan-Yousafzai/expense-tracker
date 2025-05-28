<div class="relative">
    <!-- HEADER -->
    @include('partials.header', ['title' => 'Expense Overiew'])


        <!-- Animated Background Elements (Theme Aware) -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500/20 dark:bg-purple-400/10 rounded-full opacity-60 dark:opacity-40 animate-pulse"></div>
            <div class="absolute top-1/2 -left-32 w-64 h-64 bg-blue-500/15 dark:bg-blue-400/8 rounded-full opacity-50 dark:opacity-30 animate-bounce"></div>
            <div class="absolute bottom-0 right-1/4 w-48 h-48 bg-indigo-400/10 dark:bg-indigo-300/5 rounded-full opacity-40 dark:opacity-20 animate-ping"></div>

            <!-- Floating particles -->
            <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-gray-400/40 dark:bg-white/20 rounded-full animate-float"></div>
            <div class="absolute top-3/4 right-1/3 w-1 h-1 bg-purple-300/60 dark:bg-purple-200/30 rounded-full animate-float-delayed"></div>
            <div class="absolute bottom-1/4 left-1/2 w-3 h-3 bg-blue-300/30 dark:bg-blue-200/15 rounded-full animate-float-slow"></div>
        </div>
            <!-- Welcome Section with Glass Effect -->
    <div class="backdrop-blur-xl bg-white/80 dark:bg-gray-900/80 border border-gray-200/50 dark:border-white/10 rounded-3xl p-8 shadow-2xl mb-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Welcome back! 👋</h2>
                <p class="text-gray-600 dark:text-gray-300">Here's what's happening with your finances today</p>
            </div>
            <div class="hidden md:block">
                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Stats Section -->
    <x-card title="Expense Overview" class="shadow-xl backdrop-blur-xl bg-white/80 dark:bg-gray-900/80 border border-gray-200/50 dark:border-white/10 rounded-3xl mb-6">
        <x-slot:menu>
            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
        </x-slot:menu>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Expenses -->
            <div class="group hover:scale-105 transition-all duration-300">
                <div class="backdrop-blur-md bg-gradient-to-br from-purple-500/20 to-purple-600/10 dark:from-purple-400/10 dark:to-purple-500/5 border border-purple-300/30 dark:border-purple-200/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-500/30 dark:bg-purple-400/20 rounded-xl flex items-center justify-center">
                            <x-icon name="o-banknotes" class="w-6 h-6 text-purple-600 dark:text-purple-300" />
                        </div>
                        <div class="text-xs text-purple-600 dark:text-purple-300 bg-purple-500/20 dark:bg-purple-400/10 px-2 py-1 rounded-full">All Time</div>
                    </div>
                    <h4 class="text-purple-700 dark:text-purple-200 text-sm font-medium mb-1">Total Expenses</h4>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($totalExpenses, 2) }} RS</p>
                    <div class="mt-3 flex items-center text-xs text-purple-600 dark:text-purple-300">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        All recorded expenses
                    </div>
                </div>
            </div>

            <!-- Current Month -->
            <div class="group hover:scale-105 transition-all duration-300">
                <div class="backdrop-blur-md bg-gradient-to-br from-blue-500/20 to-blue-600/10 dark:from-blue-400/10 dark:to-blue-500/5 border border-blue-300/30 dark:border-blue-200/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-500/30 dark:bg-blue-400/20 rounded-xl flex items-center justify-center">
                            <x-icon name="o-calendar-days" class="w-6 h-6 text-blue-600 dark:text-blue-300" />
                        </div>
                        <div class="text-xs text-blue-600 dark:text-blue-300 bg-blue-500/20 dark:bg-blue-400/10 px-2 py-1 rounded-full">{{ date('M') }}</div>
                    </div>
                    <h4 class="text-blue-700 dark:text-blue-200 text-sm font-medium mb-1">This Month</h4>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($currentMonthExpenses, 2) }} RS</p>
                    <div class="mt-3 flex items-center text-xs text-blue-600 dark:text-blue-300">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        Current month tracking
                    </div>
                </div>
            </div>

            <!-- Unsettled Debts -->
            <div class="group hover:scale-105 transition-all duration-300">
                <div class="backdrop-blur-md bg-gradient-to-br from-orange-500/20 to-orange-600/10 dark:from-orange-400/10 dark:to-orange-500/5 border border-orange-300/30 dark:border-orange-200/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-orange-500/30 dark:bg-orange-400/20 rounded-xl flex items-center justify-center">
                            <x-icon name="o-exclamation-circle" class="w-6 h-6 text-orange-600 dark:text-orange-300" />
                        </div>
                        <div class="text-xs text-orange-600 dark:text-orange-300 bg-orange-500/20 dark:bg-orange-400/10 px-2 py-1 rounded-full">Pending</div>
                    </div>
                    <h4 class="text-orange-700 dark:text-orange-200 text-sm font-medium mb-1">Unsettled Debts</h4>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $unsettledDebtsCount }}</p>
                    <div class="mt-3 flex items-center text-xs text-orange-600 dark:text-orange-300">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        Needs attention
                    </div>
                </div>
            </div>

            <!-- Average Expense -->
            <div class="group hover:scale-105 transition-all duration-300">
                <div class="backdrop-blur-md bg-gradient-to-br from-green-500/20 to-green-600/10 dark:from-green-400/10 dark:to-green-500/5 border border-green-300/30 dark:border-green-200/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-500/30 dark:bg-green-400/20 rounded-xl flex items-center justify-center">
                            <x-icon name="o-scale" class="w-6 h-6 text-green-600 dark:text-green-300" />
                        </div>
                        <div class="text-xs text-green-600 dark:text-green-300 bg-green-500/20 dark:bg-green-400/10 px-2 py-1 rounded-full">Avg</div>
                    </div>
                    <h4 class="text-green-700 dark:text-green-200 text-sm font-medium mb-1">Avg. Expense</h4>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($averageExpense, 2) }} RS</p>
                    <div class="mt-3 flex items-center text-xs text-green-600 dark:text-green-300">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        Per transaction
                    </div>
                </div>
            </div>
        </div>
    </x-card>
        <!-- Activity Status Section -->
        <x-card title="Financial Balance" class="shadow-xl backdrop-blur-xl bg-white/80 dark:bg-gray-900/80 border border-gray-200/50 dark:border-white/10 rounded-3xl mb-6">
            <x-slot:menu>
                <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </x-slot:menu>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Amount Owed to You -->
                <div class="group hover:scale-105 transition-all duration-300">
                    <div class="backdrop-blur-md bg-gradient-to-br from-emerald-500/20 to-emerald-600/10 dark:from-emerald-400/10 dark:to-emerald-500/5 border border-emerald-300/30 dark:border-emerald-200/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-emerald-500/30 dark:bg-emerald-400/20 rounded-xl flex items-center justify-center">
                                <x-icon name="o-arrow-down-circle" class="w-6 h-6 text-emerald-600 dark:text-emerald-300" />
                            </div>
                            <div class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse"></div>
                        </div>
                        <h4 class="text-emerald-700 dark:text-emerald-200 text-sm font-medium mb-1">Owed to You</h4>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($owedToUser, 2) }} RS</p>
                        <div class="mt-3 flex items-center text-xs text-emerald-600 dark:text-emerald-300">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Incoming money
                        </div>
                    </div>
                </div>

                <!-- Amount You Owe -->
                <div class="group hover:scale-105 transition-all duration-300">
                    <div class="backdrop-blur-md bg-gradient-to-br from-red-500/20 to-red-600/10 dark:from-red-400/10 dark:to-red-500/5 border border-red-300/30 dark:border-red-200/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-red-500/30 dark:bg-red-400/20 rounded-xl flex items-center justify-center">
                                <x-icon name="o-arrow-up-circle" class="w-6 h-6 text-red-600 dark:text-red-300" />
                            </div>
                            <div class="w-3 h-3 bg-red-400 rounded-full animate-pulse"></div>
                        </div>
                        <h4 class="text-red-700 dark:text-red-200 text-sm font-medium mb-1">You Owe</h4>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($userOwes, 2) }} RS</p>
                        <div class="mt-3 flex items-center text-xs text-red-600 dark:text-red-300">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Outgoing payments
                        </div>
                    </div>
                </div>

                <!-- Net Balance -->
                <div class="group hover:scale-105 transition-all duration-300">
                    <div class="backdrop-blur-md bg-gradient-to-br from-{{ $netBalance >= 0 ? 'emerald' : 'red' }}-500/20 to-{{ $netBalance >= 0 ? 'emerald' : 'red' }}-600/10 dark:from-{{ $netBalance >= 0 ? 'emerald' : 'red' }}-400/10 dark:to-{{ $netBalance >= 0 ? 'emerald' : 'red' }}-500/5 border border-{{ $netBalance >= 0 ? 'emerald' : 'red' }}-300/30 dark:border-{{ $netBalance >= 0 ? 'emerald' : 'red' }}-200/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-{{ $netBalance >= 0 ? 'emerald' : 'red' }}-500/30 dark:bg-{{ $netBalance >= 0 ? 'emerald' : 'red' }}-400/20 rounded-xl flex items-center justify-center">
                                <x-icon name="o-scale" class="w-6 h-6 text-{{ $netBalance >= 0 ? 'emerald' : 'red' }}-600 dark:text-{{ $netBalance >= 0 ? 'emerald' : 'red' }}-300" />
                            </div>
                            <div class="flex items-center space-x-1">
                                @if($netBalance >= 0)
                                    <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                                    <div class="text-xs text-emerald-600 dark:text-emerald-300">Positive</div>
                                @else
                                    <div class="w-2 h-2 bg-red-400 rounded-full animate-pulse"></div>
                                    <div class="text-xs text-red-600 dark:text-red-300">Negative</div>
                                @endif
                            </div>
                        </div>
                        <h4 class="text-{{ $netBalance >= 0 ? 'emerald' : 'red' }}-700 dark:text-{{ $netBalance >= 0 ? 'emerald' : 'red' }}-200 text-sm font-medium mb-1">Net Balance</h4>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($netBalance, 2) }} RS</p>
                        <div class="mt-3 flex items-center text-xs text-{{ $netBalance >= 0 ? 'emerald' : 'red' }}-600 dark:text-{{ $netBalance >= 0 ? 'emerald' : 'red' }}-300">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Overall position
                        </div>
                    </div>
                </div>
            </div>
        </x-card>

    <!-- FILTER DRAWER -->
    @include('partials.drawer')
</div>
