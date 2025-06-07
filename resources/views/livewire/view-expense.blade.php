<div class="space-y-6">
    {{-- Page Header --}}
    @include('partials.header', ['title' => 'Expense Details'])

    {{-- Card Wrapper --}}
    <x-card class="shadow-xl bg-base-100 border border-base-300 rounded-2xl p-6 space-y-6">

        {{-- Basic Info --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-stat
                title="Total Amount"
                :value="number_format($expense->total_amount, 2).' RS'"
                icon="o-banknotes"
            />
            <x-stat
                title="Category"
                :value="$expense->expenseCategory->name"
                icon="o-tag"
            />
        </div>

        {{-- Payers --}}
        <div>
            <h3 class="text-lg font-semibold text-base-content mb-2 flex items-center gap-2">
                <x-icon name="o-user-group" class="w-5 h-5 text-primary" />
                Who Paid
            </h3>
            <ul class="divide-y divide-base-300 rounded-lg overflow-hidden border border-base-300">
                @foreach($expense->payers as $payer)
                    @php
                        $sharingCount = $expense->sharingParticipants->count();
                        $sharePerPerson = $sharingCount > 0 ? $expense->total_amount / $sharingCount : 0;
                    @endphp
                    <li class="flex justify-between items-center px-4 py-3 bg-base-200 hover:bg-base-300 transition">
                        <div class="text-sm font-medium">
                            {{ $payer->name }}
                            @if($payer->pivot->exclude_from_share)
                                <span class="ml-1 text-xs text-gray-500">(excluded)</span>
                            @endif
                        </div>
                        <div class="text-sm font-mono text-right">
                            {{ number_format($payer->pivot->amount_paid, 2) }} RS
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Participants --}}
        <div>
            <h3 class="text-lg font-semibold text-base-content mb-2 flex items-center gap-2">
                <x-icon name="o-users" class="w-5 h-5 text-primary" />
                Shared With
            </h3>
            <ul class="divide-y divide-base-300 rounded-lg overflow-hidden border border-base-300">
                @foreach($expense->sharingParticipants as $participant)
                    <li class="flex justify-between items-center px-4 py-3 bg-base-200 hover:bg-base-300 transition">
                        <span class="text-sm font-medium">{{ $participant->name }}</span>
                        <span class="text-sm font-mono text-gray-600">
                            Owes {{ number_format($participant->pivot->amount, 2) }} RS
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Unsettled Debts --}}
        @if($expense->unsettledDebts->count())
        <div>
            <h3 class="text-lg font-semibold text-base-content mb-2 flex items-center gap-2">
                <x-icon name="o-exclamation-circle" class="w-5 h-5 text-warning" />
                Unsettled Debts
            </h3>
            <x-table
                :headers="[
                    ['key' => 'borrower', 'label' => 'Borrower'],
                    ['key' => 'lender', 'label' => 'Lender'],
                    ['key' => 'amount', 'label' => 'Amount']
                ]"
                :rows="$expense->unsettledDebts"
                class="rounded-lg overflow-hidden border border-base-300"
            >
                @scope('cell_borrower', $debt)
                    {{ $debt->borrower->name }}
                @endscope

                @scope('cell_lender', $debt)
                    {{ $debt->lender->name }}
                @endscope

                @scope('cell_amount', $debt)
                    <span class="font-mono">{{ number_format($debt->amount, 2) }} RS</span>
                @endscope
            </x-table>
        </div>
        @endif

    </x-card>
</div>
