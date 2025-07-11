<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-4">
    <!-- HEADER -->
    @include('partials.header', ['title' => 'Expense Management'])

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Enhanced Header Card -->
        <div class="backdrop-blur-xl bg-white/80 dark:bg-gray-800/80 rounded-2xl shadow-2xl border border-white/20 dark:border-gray-700/50 p-6">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg transform hover:scale-105 transition-all duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text text-transparent">
                            💰 Expense Management
                        </h1>
                        <p class="text-muted-foreground">Track, manage, and settle your shared expenses</p>
                    </div>
                </div>
                
                <!-- Add Expense Button -->
                <a href="{{ route('add.expense') }}" wire:navigate
                   class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add New Expense
                </a>
            </div>

            <!-- Search and Filter Controls -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search Input -->
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search"
                        placeholder="🔍 Search expenses..."
                        class="w-full pl-10 pr-4 py-3 border border-input bg-background/50 backdrop-blur-sm text-foreground rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 hover:shadow-md"
                    />
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-muted-foreground">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Status Filter -->
                <select wire:model.live="statusFilter" 
                        class="w-full px-4 py-3 border border-input bg-background/50 backdrop-blur-sm text-foreground rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 hover:shadow-md">
                    <option value="">All Status</option>
                    <option value="settled">✅ Settled</option>
                    <option value="unsettled">⏳ Unsettled</option>
                </select>

                <!-- Bulk Actions -->
                <div class="flex items-center gap-2">
                    @if(count($selectedExpenses) > 0)
                        <button 
                            wire:click="bulkSettle"
                            class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Settle ({{ count($selectedExpenses) }})
                        </button>
                    @else
                        <div class="flex-1 text-center py-3 text-muted-foreground text-sm">
                            Select expenses to bulk settle
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Enhanced Table Card -->
        <div class="backdrop-blur-xl bg-white/80 dark:bg-gray-800/80 rounded-2xl shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 px-6 py-4 border-b border-border">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-foreground">📊 Expense Records</h3>
                    <div class="text-sm text-muted-foreground">
                        Total: {{ $expenses->total() }} expenses
                    </div>
                </div>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-muted/50">
                        <tr>
                            <th class="px-6 py-4 text-left">
                                <input 
                                    type="checkbox" 
                                    wire:model.live="selectAll"
                                    class="w-4 h-4 text-primary border-input rounded focus:ring-primary focus:ring-2"
                                />
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-muted-foreground uppercase tracking-wider">
                                📅 Date
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-muted-foreground uppercase tracking-wider">
                                📝 Description
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-muted-foreground uppercase tracking-wider">
                                💰 Amount
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-muted-foreground uppercase tracking-wider">
                                👥 Participants
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-muted-foreground uppercase tracking-wider">
                                ⚡ Status
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-muted-foreground uppercase tracking-wider">
                                🔧 Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse($expenses as $expense)
                            @php
                                $isSettled = $expense->unsettledDebts->count() === 0;
                                $rowClass = $isSettled 
                                    ? 'bg-green-50/50 dark:bg-green-900/10 hover:bg-green-100/50 dark:hover:bg-green-900/20' 
                                    : 'bg-red-50/50 dark:bg-red-900/10 hover:bg-red-100/50 dark:hover:bg-red-900/20';
                            @endphp
                            <tr class="{{ $rowClass }} transition-all duration-200 group">
                                <!-- Checkbox -->
                                <td class="px-6 py-4">
                                    <input 
                                        type="checkbox" 
                                        wire:model.live="selectedExpenses"
                                        value="{{ $expense->id }}"
                                        class="w-4 h-4 text-primary border-input rounded focus:ring-primary focus:ring-2"
                                    />
                                </td>

                                <!-- Date -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-foreground">
                                        {{ $expense->paid_at->format('M d, Y') }}
                                    </div>
                                    <div class="text-xs text-muted-foreground">
                                        {{ $expense->paid_at->format('h:i A') }}
                                    </div>
                                </td>

                                <!-- Description -->
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-foreground group-hover:text-primary transition-colors">
                                        {{ $expense->description ?: 'No description' }}
                                    </div>
                                    <div class="text-xs text-muted-foreground flex items-center gap-1">
                                        <span class="w-2 h-2 bg-blue-400 rounded-full"></span>
                                        {{ $expense->expenseCategory?->name ?? 'Uncategorized' }}
                                    </div>
                                </td>

                                <!-- Amount -->
                                <td class="px-6 py-4 text-right">
                                    <div class="text-lg font-bold {{ $expense->total_amount > 1000 ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400' }}">
                                        RS {{ number_format($expense->total_amount, 2) }}
                                    </div>
                                </td>

                                <!-- Participants -->
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <!-- Payers -->
                                        <div class="text-xs">
                                            <span class="font-semibold text-green-600 dark:text-green-400">💸 Paid by:</span>
                                            <div class="ml-2">
                                                @foreach($expense->payers as $payer)
                                                    <div class="flex justify-between">
                                                        <span>{{ $payer->name }}</span>
                                                        <span class="font-mono">RS {{ number_format($payer->pivot->amount_paid, 2) }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                        <!-- Shared With -->
                                        <div class="text-xs">
                                            <span class="font-semibold text-blue-600 dark:text-blue-400">👥 Shared:</span>
                                            <div class="ml-2">
                                                @foreach($expense->sharingParticipants->take(2) as $participant)
                                                    <span class="inline-block bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 px-2 py-1 rounded-full text-xs mr-1 mb-1">
                                                        {{ $participant->name }}
                                                    </span>
                                                @endforeach
                                                @if($expense->sharingParticipants->count() > 2)
                                                    <span class="text-muted-foreground">+{{ $expense->sharingParticipants->count() - 2 }} more</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 text-center">
                                    @if($isSettled)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 border border-green-200 dark:border-green-700">
                                            ✅ Settled
                                        </span>
                                    @else
                                        <button 
                                            wire:click="showDebts({{ $expense->id }})"
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 border border-red-200 dark:border-red-700 hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200 cursor-pointer">
                                            ⏳ {{ $expense->unsettledDebts->count() }} Debts
                                        </button>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- View Button -->
                                        <button 
                                            wire:click="viewExpense({{ $expense->id }})"
                                            class="p-2 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-all duration-200 transform hover:scale-105"
                                            title="View Details">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>

                                        @if($expense->user_id == auth()->user()->id)
                                            <!-- Edit Button -->
                                            <button 
                                                wire:click="editExpense({{ $expense->id }})"
                                                class="p-2 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 rounded-lg hover:bg-yellow-200 dark:hover:bg-yellow-900/50 transition-all duration-200 transform hover:scale-105"
                                                title="Edit Expense">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>

                                            <!-- Delete Button -->
                                            <button 
                                                wire:click="confirmDelete({{ $expense->id }})"
                                                class="p-2 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition-all duration-200 transform hover:scale-105"
                                                title="Delete Expense">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="w-16 h-16 bg-muted rounded-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                        </div>
                                        <div class="text-center">
                                            <h3 class="text-lg font-semibold text-foreground mb-2">No expenses found</h3>
                                            <p class="text-muted-foreground mb-4">Start by creating your first expense</p>
                                            <a href="{{ route('add.expense') }}" wire:navigate
                                               class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                                Add First Expense
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Enhanced Pagination -->
            @if($expenses->hasPages())
                <div class="bg-muted/30 px-6 py-4 border-t border-border">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-muted-foreground">
                            Showing {{ $expenses->firstItem() }} to {{ $expenses->lastItem() }} of {{ $expenses->total() }} results
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <!-- Previous Button -->
                            @if($expenses->onFirstPage())
                                <span class="px-3 py-2 text-muted-foreground bg-muted/50 rounded-lg cursor-not-allowed">
                                    ← Previous
                                </span>
                            @else
                                <button wire:click="previousPage" 
                                        class="px-3 py-2 bg-background border border-input text-foreground rounded-lg hover:bg-muted transition-all duration-200">
                                    ← Previous
                                </button>
                            @endif

                            <!-- Page Numbers -->
                            <div class="flex items-center gap-1">
                                @foreach($expenses->getUrlRange(max(1, $expenses->currentPage() - 2), min($expenses->lastPage(), $expenses->currentPage() + 2)) as $page => $url)
                                    @if($page == $expenses->currentPage())
                                        <span class="px-3 py-2 bg-primary text-primary-foreground rounded-lg font-semibold">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <button wire:click="gotoPage({{ $page }})" 
                                                class="px-3 py-2 bg-background border border-input text-foreground rounded-lg hover:bg-muted transition-all duration-200">
                                            {{ $page }}
                                        </button>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Next Button -->
                            @if($expenses->hasMorePages())
                                <button wire:click="nextPage" 
                                        class="px-3 py-2 bg-background border border-input text-foreground rounded-lg hover:bg-muted transition-all duration-200">
                                    Next →
                                </button>
                            @else
                                <span class="px-3 py-2 text-muted-foreground bg-muted/50 rounded-lg cursor-not-allowed">
                                    Next →
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Enhanced Debt Details Modal -->
    @if($showModal && $selectedExpense)
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-white/20 dark:border-gray-700/50 max-w-2xl w-full max-h-[80vh] overflow-hidden">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-4 text-white">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold">💰 Debt Breakdown</h3>
                        <button wire:click="$set('showModal', false)" 
                                class="p-2 hover:bg-white/20 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Content -->
                <div class="p-6 overflow-y-auto max-h-[60vh]">
                    @php
                        $sharingCount = $selectedExpense->sharingParticipants->count();
                        $sharePerPerson = $sharingCount > 0 ? $selectedExpense->total_amount / $sharingCount : 0;
                    @endphp

                    <!-- Summary Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl border border-blue-200 dark:border-blue-800">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                RS {{ number_format($selectedExpense->total_amount, 2) }}
                            </div>
                            <div class="text-sm text-blue-600/80 dark:text-blue-400/80">Total Amount</div>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-xl border border-green-200 dark:border-green-800">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                                RS {{ $sharingCount > 0 ? number_format($sharePerPerson, 2) : 'N/A' }}
                            </div>
                            <div class="text-sm text-green-600/80 dark:text-green-400/80">Per Person ({{ $sharingCount }} people)</div>
                        </div>
                    </div>

                    <!-- Debts Table -->
                    @if($selectedExpense->unsettledDebts->count() > 0)
                        <div class="space-y-3">
                            <h4 class="font-semibold text-foreground mb-3">🔴 Outstanding Debts</h4>
                            @foreach($selectedExpense->unsettledDebts as $debt)
                                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                                                <span class="text-red-600 dark:text-red-400 font-semibold text-sm">
                                                    {{ substr($debt->borrower->name, 0, 2) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="font-medium text-foreground">
                                                    {{ $debt->borrower->name }}
                                                </div>
                                                <div class="text-sm text-muted-foreground">
                                                    owes {{ $debt->lender->name }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-lg font-bold text-red-600 dark:text-red-400">
                                                RS {{ number_format($debt->amount, 2) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-green-600 dark:text-green-400 mb-2">All Settled! 🎉</h3>
                            <p class="text-muted-foreground">All debts for this expense have been settled.</p>
                        </div>
                    @endif
                </div>

                <!-- Modal Footer -->
                <div class="bg-muted/30 px-6 py-4 border-t border-border">
                    <div class="flex justify-end">
                        <button wire:click="$set('showModal', false)" 
                                class="px-4 py-2 bg-background border border-input text-foreground rounded-lg hover:bg-muted transition-all duration-200">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Enhanced Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-white/20 dark:border-gray-700/50 max-w-md w-full">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-red-500 to-pink-600 px-6 py-4 text-white">
                    <h3 class="text-lg font-semibold">🗑️ Confirm Deletion</h3>
                </div>

                <!-- Modal Content -->
                <div class="p-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-foreground mb-2">Delete Expense?</h3>
                        <p class="text-muted-foreground mb-6">
                            This action cannot be undone. All associated debts and settlements will also be removed.
                        </p>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="bg-muted/30 px-6 py-4 border-t border-border flex gap-3">
                    <button wire:click="$set('showDeleteModal', false)" 
                            class="flex-1 px-4 py-2 bg-background border border-input text-foreground rounded-lg hover:bg-muted transition-all duration-200">
                        Cancel
                    </button>
                    <button wire:click="delete({{ $expenseId }})" 
                            class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all duration-200">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>