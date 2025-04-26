<div>
    @include('partials.header', ['title' => 'Expense Details'])

    <x-card class="shadow-xl">
        <div class="space-y-6">
            <!-- Basic Info -->
            <div class="grid grid-cols-2 gap-4">
                <x-stat
                    title="Amount"
                    :value="number_format($expense->total_amount, 2).' RS'"
                    icon="o-banknotes"
                />
                <x-stat
                    title="Category"
                    :value="$expense->expenseCategory->name"
                    icon="o-tag"
                />
            </div>

            <!-- Payers -->
            <div>
                <h3 class="font-bold text-lg mb-2">Who Paid:</h3>
                <ul class="space-y-2">
                    @foreach($expense->payers as $payer)
                    @php
                    $sharingCount = $expense->sharingParticipants->count();
                    $sharePerPerson = $sharingCount > 0 ? $expense->total_amount / $sharingCount : 0;

                @endphp
                    <li class="flex justify-between items-center p-2  rounded">
                        <div>
                            {{ $payer->name }}
                            @if($payer->pivot->exclude_from_share)
                                <span class="text-xs text-gray-500">(excluded from share)</span>
                            @endif
                        </div>
                        <span class="font-mono">
                            {{ number_format($payer->pivot->amount_paid, 2) }} RS
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Participants -->
            <div>
                <h3 class="font-bold text-lg mb-2">Shared With:</h3>
                <ul class="space-y-2">
                    @foreach($expense->sharingParticipants as $participant)
                    <li class="flex justify-between items-center p-2  rounded">
                        <span>{{ $participant->name }}</span>
                        <span class="font-mono text-gray-600">
                            Owes {{ number_format($participant->pivot->amount, 2) }} RS
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Debts -->
            @if($expense->unsettledDebts->count())
            <div>
                <h3 class="font-bold text-lg mb-2">Unsettled Debts:</h3>
                <x-table :headers="[
                    ['key' => 'borrower', 'label' => 'Borrower'],
                    ['key' => 'lender', 'label' => 'Lender'],
                    ['key' => 'amount', 'label' => 'Amount']
                ]" :rows="$expense->unsettledDebts">
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
        </div>
    </x-card>
</div>
