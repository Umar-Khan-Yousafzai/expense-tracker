<x-modal title="Debt Details" class="backdrop-blur" wire:model.defer="expense">
    @if($expense)
        <x-list>
            @forelse($expense->unsettledDebts as $debt)
                <x-list-item :item="$debt">
                    <x-slot:value>
                        <div class="flex justify-between">
                            <span>
                                {{ $debt->borrower->name }} owes
                                {{ $debt->lender->name }}
                            </span>
                            <span class="font-bold">{{ $debt->amount }} RS</span>
                        </div>
                    </x-slot:value>
                </x-list-item>
            @empty
                <x-alert icon="o-check" class="alert-success">
                    All debts settled!
                </x-alert>
            @endforelse
        </x-list>
    @endif
</x-modal>
