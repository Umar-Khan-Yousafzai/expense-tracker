<div class="relative">
    <!-- HEADER -->
    @include('partials.header', ['title' => 'Expense Overview'])

    <!-- Animated Background Elements (Theme Aware) -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
        <div class="absolute rounded-full -top-40 -right-40 w-80 h-80 bg-primary/20 opacity-60 animate-pulse"></div>
        <div class="absolute w-64 h-64 rounded-full opacity-50 top-1/2 -left-32 bg-secondary/15 animate-bounce"></div>
        <div class="absolute bottom-0 w-48 h-48 rounded-full right-1/4 bg-accent/10 opacity-40 animate-ping"></div>

        <!-- Floating particles -->
        <div class="absolute w-2 h-2 rounded-full top-1/4 left-1/4 bg-base-content/40 animate-float"></div>
        <div class="absolute w-1 h-1 rounded-full top-3/4 right-1/3 bg-primary/60 animate-float-delayed"></div>
        <div class="absolute w-3 h-3 rounded-full bottom-1/4 left-1/2 bg-secondary/30 animate-float-slow"></div>
    </div>

    <!-- Welcome Section with Glass Effect -->
    <div class="mb-6 border shadow-2xl card bg-base-100/80 backdrop-blur-xl border-base-content/10">
        <div class="card-body">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="mb-2 text-3xl font-bold">Welcome back! 👋</h2>
                    <p class="text-base-content/70">Here's what's happening with your finances today</p>
                </div>
                <div class="hidden md:block">
                    <div class="flex items-center justify-center w-16 h-16 shadow-lg bg-gradient-to-r from-primary to-secondary rounded-2xl">
                        <svg class="w-8 h-8 text-primary-content" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Stats Section -->
    <x-card title="Expense Overview" class="mb-6 border shadow-xl card bg-base-100/80 backdrop-blur-xl border-base-content/10">
        <x-slot:menu>
            <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-primary to-accent rounded-xl">
                <svg class="w-6 h-6 text-primary-content" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
        </x-slot:menu>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <!-- Total Expenses -->
            <div class="transition-all duration-300 group hover:scale-105">
                <div class="border shadow-xl card bg-primary/10 border-primary/30 hover:shadow-2xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-primary/30 rounded-xl">
                                <x-icon name="o-banknotes" class="w-6 h-6 text-primary" />
                            </div>
                            <div class="badge badge-primary badge-outline">All Time</div>
                        </div>
                        <h4 class="mb-1 text-sm font-medium opacity-70">Total Expenses</h4>
                        <p class="text-2xl font-bold">{{ number_format($totalExpenses, 2) }} RS</p>
                        <div class="flex items-center mt-3 text-xs opacity-70">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            All recorded expenses
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Month -->
            <div class="transition-all duration-300 group hover:scale-105">
                <div class="border shadow-xl card bg-secondary/10 border-secondary/30 hover:shadow-2xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-secondary/30 rounded-xl">
                                <x-icon name="o-calendar-days" class="w-6 h-6 text-secondary" />
                            </div>
                            <div class="badge badge-secondary badge-outline">{{ date('M') }}</div>
                        </div>
                        <h4 class="mb-1 text-sm font-medium opacity-70">This Month</h4>
                        <p class="text-2xl font-bold">{{ number_format($currentMonthExpenses, 2) }} RS</p>
                        <div class="flex items-center mt-3 text-xs opacity-70">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            Current month tracking
                        </div>
                    </div>
                </div>
            </div>

            <!-- Unsettled Debts -->
            <div class="transition-all duration-300 group hover:scale-105">
                <div class="border shadow-xl card bg-warning/10 border-warning/30 hover:shadow-2xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-warning/30 rounded-xl">
                                <x-icon name="o-exclamation-circle" class="w-6 h-6 text-warning" />
                            </div>
                            <div class="badge badge-warning badge-outline">Pending</div>
                        </div>
                        <h4 class="mb-1 text-sm font-medium opacity-70">Unsettled Debts</h4>
                        <p class="text-2xl font-bold">{{ $unsettledDebtsCount }}</p>
                        <div class="flex items-center mt-3 text-xs opacity-70">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            Needs attention
                        </div>
                    </div>
                </div>
            </div>

            <!-- Average Expense -->
            <div class="transition-all duration-300 group hover:scale-105">
                <div class="border shadow-xl card bg-success/10 border-success/30 hover:shadow-2xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-success/30 rounded-xl">
                                <x-icon name="o-scale" class="w-6 h-6 text-success" />
                            </div>
                            <div class="badge badge-success badge-outline">Avg</div>
                        </div>
                        <h4 class="mb-1 text-sm font-medium opacity-70">Avg. Expense</h4>
                        <p class="text-2xl font-bold">{{ number_format($averageExpense, 2) }} RS</p>
                        <div class="flex items-center mt-3 text-xs opacity-70">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            Per transaction
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-card>

    <!-- Activity Status Section -->
    <x-card title="Financial Balance" class="mb-6 border shadow-xl card bg-base-100/80 backdrop-blur-xl border-base-content/10">
        <x-slot:menu>
            <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-accent to-primary rounded-xl">
                <svg class="w-6 h-6 text-accent-content" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </x-slot:menu>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Amount Owed to You -->
            <div class="transition-all duration-300 group hover:scale-105">
                <div class="border shadow-xl card bg-success/10 border-success/30 hover:shadow-2xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-success/30 rounded-xl">
                                <x-icon name="o-arrow-down-circle" class="w-6 h-6 text-success" />
                            </div>
                            <div class="w-3 h-3 rounded-full bg-success animate-pulse"></div>
                        </div>
                        <h4 class="mb-1 text-sm font-medium opacity-70">Owed to You</h4>
                        <p class="text-2xl font-bold">{{ number_format($owedToUser, 2) }} RS</p>
                        <div class="flex items-center mt-3 text-xs opacity-70">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Incoming money
                        </div>
                    </div>
                </div>
            </div>

            <!-- Amount You Owe -->
            <div class="transition-all duration-300 group hover:scale-105">
                <div class="border shadow-xl card bg-error/10 border-error/30 hover:shadow-2xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-error/30 rounded-xl">
                                <x-icon name="o-arrow-up-circle" class="w-6 h-6 text-error" />
                            </div>
                            <div class="w-3 h-3 rounded-full bg-error animate-pulse"></div>
                        </div>
                        <h4 class="mb-1 text-sm font-medium opacity-70">You Owe</h4>
                        <p class="text-2xl font-bold">{{ number_format($userOwes, 2) }} RS</p>
                        <div class="flex items-center mt-3 text-xs opacity-70">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Outgoing payments
                        </div>
                    </div>
                </div>
            </div>

            <!-- Net Balance -->
            <div class="transition-all duration-300 group hover:scale-105">
                <div class="card {{ $netBalance >= 0 ? 'bg-success/10 border-success/30' : 'bg-error/10 border-error/30' }} shadow-xl hover:shadow-2xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 {{ $netBalance >= 0 ? 'bg-success/30' : 'bg-error/30' }} rounded-xl flex items-center justify-center">
                                <x-icon name="o-scale" class="w-6 h-6 {{ $netBalance >= 0 ? 'text-success' : 'text-error' }}" />
                            </div>
                            <div class="flex items-center space-x-1">
                                @if($netBalance >= 0)
                                    <div class="w-2 h-2 rounded-full bg-success animate-pulse"></div>
                                    <div class="badge badge-success badge-outline badge-sm">Positive</div>
                                @else
                                    <div class="w-2 h-2 rounded-full bg-error animate-pulse"></div>
                                    <div class="badge badge-error badge-outline badge-sm">Negative</div>
                                @endif
                            </div>
                        </div>
                        <h4 class="mb-1 text-sm font-medium opacity-70">Net Balance</h4>
                        <p class="text-2xl font-bold">{{ number_format($netBalance, 2) }} RS</p>
                        <div class="flex items-center mt-3 text-xs opacity-70">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Overall position
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-card>

    <!-- FILTER DRAWER -->
    @include('partials.drawer')
</div>
