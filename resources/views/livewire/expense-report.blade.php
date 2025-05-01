<div>
    @include('partials.header', ['title' => 'Expense Report'])

    <!-- Filter Card -->
    <x-card title="Report Filters" shadow separator class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Period Select -->
            <x-select label="Period" wire:model.live="period" :options="$periodOptions"
                      option-value="id" option-label="name" inline />

            <!-- Custom Date Range -->
            <x-datetime label="From Date" wire:model="start_date" type="date"
                        :disabled="$period !== 'custom'" inline />
            <x-datetime label="To Date" wire:model="end_date" type="date"
                        :disabled="$period !== 'custom'" inline />

            <!-- Status Filter -->
            <x-select label="Record Status" wire:model.live="status" :options="$statusOptions"
                      placeholder="Filter by status..." inline />
        </div>
    </x-card>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        @php
            $summary = $this->report()['summary'] ?? [];
        @endphp

        <x-stat title="Total Spent" value="{{ number_format($summary['total_spent'] ?? 0, 2) }}"
                icon="o-banknotes" description="Your total spending" color="text-primary" />
        <x-stat title="You Owe" value="{{ number_format($summary['total_owed'] ?? 0, 2) }}"
                icon="o-arrow-trending-down" description="Total debts to others" color="text-error" />
        <x-stat title="You're Owed" value="{{ number_format($summary['total_receivable'] ?? 0, 2) }}"
                icon="o-arrow-trending-up" description="Total owed to you" color="text-success" />
        <x-stat title="Net Balance" value="{{ number_format($summary['net_balance'] ?? 0, 2) }}"
                icon="o-scale"
                :description="($summary['net_balance'] ?? 0) >= 0 ? 'You are net positive' : 'You are net negative'"
                :color="($summary['net_balance'] ?? 0) >= 0 ? 'text-success' : 'text-error'" />
    </div>

    <!-- Daily Expenses -->
    <x-card title="Daily Expenses" shadow separator class="mb-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-2 px-4 w-32">Date</th>
                        <th class="text-left py-2 px-4">Description</th>
                        <th class="text-left py-2 px-4 w-48">Category</th>
                        <th class="text-right py-2 px-4 w-32">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->report()['daily_expenses'] as $day)
                        <tr class="border-b border-gray-100 bg-gray-50 font-bold">
                            <td class="py-2 px-4">{{ $day['date'] }}</td>
                            <td class="py-2 px-4">TOTAL FOR DAY</td>
                            <td class="py-2 px-4"></td>
                            <td class="py-2 px-4 text-right">RS. {{ number_format($day['total_amount'], 2) }}</td>
                        </tr>

                        @foreach($day['expenses'] as $expense)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-2 px-4"></td>
                                <td class="py-2 px-4">{{ $expense->description }}</td>
                                <td class="py-2 px-4">{{ $expense->expenseCategory->name ?? 'Uncategorized' }}</td>
                                <td class="py-2 px-4 text-right">RS. {{ number_format($expense->total_amount, 2) }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-card>

    <!-- Combined Debts Table -->
    <x-card title="Debts     Overview" shadow separator class="mb-6">
        <x-tabs label-div-class="bg-primary/5 rounded w-fit p-2">
            <x-tab selected name="all" label="All Debts">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-2 px-4 w-32">Date</th>
                                <th class="text-left py-2 px-4 w-24">Type</th>
                                <th class="text-left py-2 px-4">Person</th>
                                <th class="text-left py-2 px-4">Description</th>
                                <th class="text-right py-2 px-4 w-32">Amount</th>
                                <th class="text-left py-2 px-4 w-24">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($this->report()['debts_owed'] as $person => $debts)
                                @foreach($debts as $debt)
                                    <tr class="border-b border-gray-100 {{ $debt->is_settled ? 'opacity-70' : '' }}">
                                        <td class="py-2 px-4">{{ $debt->created_at->format('Y-m-d') }}</td>
                                        <td class="py-2 px-4">
                                            <x-badge value="You Owe" class="bg-error/10 text-error" />
                                        </td>
                                        <td class="py-2 px-4">{{ $person }}</td>
                                        <td class="py-2 px-4">{{ $debt->expense->description }}</td>
                                        <td class="py-2 px-4 text-right text-error">- RS. {{ number_format($debt->amount, 2) }}</td>
                                        <td class="py-2 px-4">
                                            <x-badge :value="$debt->is_settled ? 'Settled' : 'Pending'"
                                                     :class="$debt->is_settled ? 'bg-success/10 text-success' : 'bg-warning/10 text-warning'" />
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                            @foreach($this->report()['debts_receivable'] as $person => $debts)
                                @foreach($debts as $debt)
                                    <tr class="border-b border-gray-100 {{ $debt->is_settled ? 'opacity-70' : '' }}">
                                        <td class="py-2 px-4">{{ $debt->created_at->format('Y-m-d') }}</td>
                                        <td class="py-2 px-4">
                                            <x-badge value="Owes You" class="bg-success/10 text-success" />
                                        </td>
                                        <td class="py-2 px-4">{{ $person }}</td>
                                        <td class="py-2 px-4">{{ $debt->expense->description }}</td>
                                        <td class="py-2 px-4 text-right text-success">+ RS. {{ number_format($debt->amount, 2) }}</td>
                                        <td class="py-2 px-4">
                                            <x-badge :value="$debt->is_settled ? 'Settled' : 'Pending'"
                                                     :class="$debt->is_settled ? 'bg-success/10 text-success' : 'bg-warning/10 text-warning'" />
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-tab>

            <x-tab name="owed" label="You Owe">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-2 px-4 w-32">Date</th>
                                <th class="text-left py-2 px-4">To</th>
                                <th class="text-left py-2 px-4">Description</th>
                                <th class="text-right py-2 px-4 w-32">Amount</th>
                                <th class="text-left py-2 px-4 w-24">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($this->report()['debts_owed'] as $person => $debts)
                                <tr class="border-b border-gray-100 bg-gray-50 font-bold">
                                    <td class="py-2 px-4">TOTAL</td>
                                    <td class="py-2 px-4">{{ $person }}</td>
                                    <td class="py-2 px-4"></td>
                                    <td class="py-2 px-4 text-right text-error">- RS. {{ number_format($debts->sum('amount'), 2) }}</td>
                                    <td class="py-2 px-4"></td>
                                </tr>

                                @foreach($debts as $debt)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 {{ $debt->is_settled ? 'opacity-70' : '' }}">
                                        <td class="py-2 px-4">{{ $debt->created_at->format('Y-m-d') }}</td>
                                        <td class="py-2 px-4">{{ $person }}</td>
                                        <td class="py-2 px-4">{{ $debt->expense->description }}</td>
                                        <td class="py-2 px-4 text-right text-error">- RS. {{ number_format($debt->amount, 2) }}</td>
                                        <td class="py-2 px-4">
                                            <x-badge :value="$debt->is_settled ? 'Settled' : 'Pending'"
                                                     :class="$debt->is_settled ? 'bg-success/10 text-success' : 'bg-warning/10 text-warning'" />
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-tab>

            <x-tab name="receivable" label="Owes You">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-2 px-4 w-32">Date</th>
                                <th class="text-left py-2 px-4">From</th>
                                <th class="text-left py-2 px-4">Description</th>
                                <th class="text-right py-2 px-4 w-32">Amount</th>
                                <th class="text-left py-2 px-4 w-24">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($this->report()['debts_receivable'] as $person => $debts)
                                <tr class="border-b border-gray-100 bg-gray-50 font-bold">
                                    <td class="py-2 px-4">TOTAL</td>
                                    <td class="py-2 px-4">{{ $person }}</td>
                                    <td class="py-2 px-4"></td>
                                    <td class="py-2 px-4 text-right text-success">+ RS. {{ number_format($debts->sum('amount'), 2) }}</td>
                                    <td class="py-2 px-4"></td>
                                </tr>

                                @foreach($debts as $debt)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 {{ $debt->is_settled ? 'opacity-70' : '' }}">
                                        <td class="py-2 px-4">{{ $debt->created_at->format('Y-m-d') }}</td>
                                        <td class="py-2 px-4">{{ $person }}</td>
                                        <td class="py-2 px-4">{{ $debt->expense->description }}</td>
                                        <td class="py-2 px-4 text-right text-success">+ RS. {{ number_format($debt->amount, 2) }}</td>
                                        <td class="py-2 px-4">
                                            <x-badge :value="$debt->is_settled ? 'Settled' : 'Pending'"
                                                     :class="$debt->is_settled ? 'bg-success/10 text-success' : 'bg-warning/10 text-warning'" />
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-tab>
        </x-tabs>
    </x-card>
</div>
