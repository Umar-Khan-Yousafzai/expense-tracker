<div>
    <!-- HEADER -->
    @include('partials.header', ['title' => 'View Expenses'])

    <x-card class="shadow-xl">
        <x-table :headers="$headers" :rows="$expenses" with-pagination>

            <!-- Description -->
            @scope('cell_description', $expense)
            <div class="font-bold">{{ $expense->description ?? '—' }}</div>
            <div class="text-xs text-gray-500">{{ $expense->expenseCategory?->name }}</div>
            @endscope

            <!-- Amount -->
            @scope('cell_total_amount', $expense)
            <div class="font-mono {{ $expense->total_amount > 1000 ? 'text-red-500' : 'text-green-500' }}">
                {{ number_format($expense->total_amount, 2) }} RS
            </div>
            @endscope

            <!-- Payers -->
            @scope('cell_payers', $expense)
            <ul class="text-xs space-y-1">
                @foreach($expense->payers as $payer)
                <li class="flex justify-between">
                    <span>
                        {{ $payer->name }}
                        @if($payer->pivot->exclude_from_share)
                            <span class="text-xs text-gray-400">(excluded)</span>
                        @endif
                    </span>
                    <span class="font-mono">{{ number_format($payer->pivot->amount_paid, 2) }} RS</span>
                </li>
                @endforeach
            </ul>
            @endscope

            <!-- Participants -->
            @scope('cell_participants', $expense)
            <ul class="text-xs space-y-1">
                @foreach($expense->sharingParticipants as $participant)
                <li>
                    {{ $participant->name }}
                    <span class="text-gray-500 text-xs">
                        (owes {{ number_format($participant->pivot->amount, 2) }} RS)
                    </span>
                </li>
                @endforeach
            </ul>
            @endscope

            <!-- Debts -->
            @scope('cell_debts', $expense)
            <x-badge value="{{ $expense->unsettledDebts->count() ?: 'Settled' }}"
                class="{{ $expense->unsettledDebts->count() ? 'badge-warning' : 'badge-success' }} cursor-pointer hover:scale-105 transition-transform"
                wire:click="showDebts({{ $expense->id }})" />
            @endscope

            <!-- Actions -->
            @scope('cell_actions', $expense)
            <div class="flex space-x-2">
                <x-button icon="o-eye" wire:click="viewExpense({{ $expense->id }})" spinner class="btn-sm" />
                @if($expense->user_id == auth()->user()->id)
                <x-button icon="o-pencil" wire:click="editExpense({{ $expense->id }})" spinner
                    class="btn-sm btn-primary" />
                <x-button icon="o-trash" wire:click="confirmDelete({{ $expense->id }})" spinner
                    class="btn-sm btn-error" />
                @endif
            </div>
            @endscope

        </x-table>
    </x-card>

    <!-- Debt Details Modal -->
    <x-modal wire:model="showModal" title="Debt Breakdown" class="backdrop-blur" separator size="4xl">
        @if($selectedExpense)
            @php
                $sharingCount = $selectedExpense->sharingParticipants->count();
                $sharePerPerson = $sharingCount > 0 ? $selectedExpense->total_amount / $sharingCount : 0;
            @endphp

            <div class="grid grid-cols-2 gap-4 mb-4">
                <x-stat title="Total Amount"
                    :value="number_format($selectedExpense->total_amount, 2).' RS'"
                    icon="o-banknotes" />

                <x-stat title="Per Person Share"
                    :value="$sharingCount > 0 ? number_format($sharePerPerson, 2).' RS' : 'N/A'"
                    icon="o-user-group"
                    :description="$sharingCount.' sharing participants'" />
            </div>

            <x-table :headers="[
                    ['key' => 'relationship', 'label' => 'Debt Relationship', 'class' => 'w-1/2'],
                    ['key' => 'amount', 'label' => 'Amount', 'class' => 'text-right']
                ]" :rows="$selectedExpense->unsettledDebts" compact>

                @scope('cell_relationship', $debt)
                <div class="flex items-center space-x-2">
                    <div class="flex-1 min-w-0">
                        <div class="font-medium truncate">{{ $debt->borrower->name }}</div>
                        <div class="text-xs text-gray-500 truncate">owes to {{ $debt->lender->name }}</div>
                    </div>
                    <x-icon name="o-arrow-right" class="text-gray-400" />
                </div>
                @endscope

                @scope('cell_amount', $debt)
                <div class="font-mono text-right">
                    {{ number_format($debt->amount, 2) }} <span class="text-gray-500">RS</span>
                </div>
                @endscope
            </x-table>

            @if($selectedExpense->unsettledDebts->isEmpty())
                <x-alert icon="o-check-circle" class="alert-success mt-4">
                    All debts for this expense have been settled!
                </x-alert>
            @endif
        @endif

        <x-slot:actions>
            <x-button label="Close" @click="$wire.showModal = false" />
        </x-slot:actions>
    </x-modal>

    <x-modal wire:model="showDeleteModal" title="Confirm Delete" class="backdrop-blur">
        <div class="font-medium truncate">Are You sure You want to Delete Expense?</div>
        <x-slot:actions>
            <x-button label="Delete" class="btn-error" wire:click='delete({{ $expenseId }})' />
            <x-button label="Cancel" class="btn-warning" @click="$wire.showDeleteModal = false" />
        </x-slot:actions>
    </x-modal>
</div>
