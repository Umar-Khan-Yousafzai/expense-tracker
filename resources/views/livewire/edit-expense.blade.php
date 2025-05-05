<div>
    @include('partials.header', ['title' => 'Edit Expense'])

    <x-form wire:submit="save" class="p-4">
        <x-card title="Edit Expense" shadow separator>
            <!-- Category + Total Amount -->
            <x-card>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-choices-offline
                            label="Expense Category"
                            wire:model="selectedCategory"
                            :options="$categories"
                            placeholder="Search..."
                            single
                            clearable
                            searchable
                        />
                    </div>
                    <div>
                        <x-input
                            label="Total Amount Paid"
                            wire:model="amount"
                            prefix="RS"
                            hint="Sum of all payments must match this"
                            money
                        />
                    </div>
                </div>
            </x-card>

            <!-- Date + Shared With -->
            <x-card>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-datetime
                            label="Expense Paid at"
                            wire:model="dateTimePaidAt"
                            type="date"
                        />
                    </div>
                    {{-- <div>
                        <x-choices
                            label="Shared With (Participants)"
                            wire:model="expenseSharedWith"
                            :options="$fetchedUsers"
                            placeholder="Select participants..."
                            clearable
                            searchable
                        />
                    </div> --}}
                </div>
            </x-card>

            <!-- Who Paid? -->
            <x-card>
                <div class="space-y-4">
                    <h3 class="font-bold text-gray-700">Who Paid?</h3>

                    @foreach($payers as $index => $payer)
                    <div class="grid grid-cols-12 gap-4 items-end">
                        <div class="col-span-5">
                            <x-choices-offline
                                wire:model="payers.{{$index}}.user_id"
                                :options="$fetchedUsers"
                                placeholder="Select payer..."
                                single
                                searchable
                            />
                        </div>
                        <div class="col-span-3">
                            <x-input
                                wire:model="payers.{{$index}}.amount"
                                prefix="RS"
                                placeholder="Amount paid"
                                money
                            />
                        </div>
                        <div class="col-span-3">
                            <x-checkbox
                                wire:model="payers.{{$index}}.exclude_from_share"
                                label="Exclude from share"

                                class="checkbox-sm"
                            />
                        </div>
                        @if($index > 0)
                        <div class="col-span-1">
                            <x-button
                                wire:click="removePayer({{$index}})"
                                icon="o-trash"
                                class="btn-ghost btn-sm text-error"
                            />
                        </div>
                        @endif
                    </div>
                    @endforeach

                    <x-button
                        wire:click="addPayer"
                        label="+ Add Payer"
                        class="btn-ghost btn-sm"
                        icon="o-plus"
                    />
                </div>
            </x-card>

            <!-- Description -->
            <x-card>
                <x-textarea
                    label="Expense Description"
                    wire:model="description"
                    placeholder="Enter details..."
                    rows="2"
                />
            </x-card>

            <x-slot:actions>
                <x-button label="Update Expense" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-card>
    </x-form>
</div>
