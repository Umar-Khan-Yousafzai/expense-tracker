<div class="min-h-screen ">
    <!-- HEADER -->
    @include('partials.header', ['title' => 'Edit Expense'])


    <div class="relative max-w-5xl mx-auto">

        <x-form wire:submit="save" class="relative">
            <x-errors title="Oops!" description="Please, fix them." icon="o-face-frown" />

            <!-- Main Card with enhanced styling -->
            <x-card title="Edit Gathering / Party Expense Information" subtitle="Update details for this expense."
                class="backdrop-blur-sm bg-white/80 dark:bg-slate-800/80 border-0 shadow-2xl rounded-3xl overflow-hidden"
                separator>

                <div
                    class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500">
                </div>
                <div class="space-y-6">
                    <div class="relative">
                        <!-- Section header with icon -->
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Expense Details
                                </h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Category and total amount
                                    information</p>
                            </div>
                        </div>
                        <x-card
                            class="bg-gradient-to-br from-white to-slate-50 dark:from-slate-700 dark:to-slate-800 border border-slate-200/50 dark:border-slate-600/50 shadow-xl rounded-2xl hover:shadow-2xl transition-all duration-300">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <x-choices-offline label="Expense Category" wire:model="selectedCategory"
                                        :options="$categories" placeholder="Search categories..." single clearable
                                        searchable
                                        class="rounded-xl border-slate-300 dark:border-slate-600 focus:border-blue-500 focus:ring-blue-500/20" />
                                </div>
                                <div class="space-y-2">
                                    <x-input label="Total Amount Paid" wire:model="amount" prefix="RS"
                                        hint="Sum of all payments must match this" money
                                        class="rounded-xl border-slate-300 dark:border-slate-600 focus:border-green-500 focus:ring-green-500/20 text-lg font-semibold" />
                                </div>
                            </div>
                        </x-card>
                    </div>
                    <!-- Date + Is Settled Section -->
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Date & Status</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400">When and its settlement status</p>
                            </div>
                        </div>

                        <x-card
                            class="bg-gradient-to-br from-white to-slate-50 dark:from-slate-700 dark:to-slate-800 border border-slate-200/50 dark:border-slate-600/50 shadow-xl rounded-2xl hover:shadow-2xl transition-all duration-300">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <x-datetime label="Expense Paid at" wire:model="dateTimePaidAt" type="date"
                                        class="rounded-xl border-slate-300 dark:border-slate-600 focus:border-green-500 focus:ring-green-500/20" />
                                </div>


                                <div class="flex items-center justify-center">
                                    <div
                                        class="text-center p-4 bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-slate-800 dark:to-slate-700 rounded-xl border border-dashed border-blue-300 dark:border-slate-600 flex-grow">

                                        <svg class="w-8 h-8 text-blue-500 mx-auto mb-2" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div class="flex items-center justify-center">
                                            <x-checkbox label="Is Debt Settled?" wire:model="isSettled"
                                                hint="If checked, this expense will be marked as settled."
                                                class="checkbox-sm mr-2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-card>
                    </div>

                    <div class="relative">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126.1283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Participants</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Who paid and how much?</p>
                            </div>
                        </div>


                        <x-card
                            class="bg-gradient-to-br from-white to-slate-50 dark:from-slate-700 dark:to-slate-800 border border-slate-200/50 dark:border-slate-600/50 shadow-xl rounded-2xl hover:shadow-2xl transition-all duration-300">
                            <div class="space-y-6">
                                <div
                                    class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <p class="text-sm text-blue-800 dark:text-blue-200">
                                            <span class="font-semibold">Pro Tip:</span> Participants who didn't pay will
                                            automatically have 0 amount. Use the "Exclude in Share" option for those not
                                            participating in the split.
                                        </p>
                                    </div>
                                </div>

                                <!-- Dynamic Payers List -->
                                <div class="space-y-4">
                                    @foreach($payers as $index => $payer)

                                    <div class="group relative">

                                        <div
                                            class="bg-gradient-to-r from-slate-50 to-white dark:from-slate-800 dark:to-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl p-4 hover:shadow-lg transition-all duration-300 hover:border-blue-300 dark:hover:border-blue-600">

                                            <div
                                                class="absolute -left-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-lg">
                                                {{ $index + 1 }}
                                            </div>
                                            <div
                                                class="pl-4 space-y-4 lg:space-y-0 lg:grid lg:grid-cols-12 lg:gap-4 lg:items-end">
                                                <!-- Payer Selection (col-span-5 lg) -->
                                                <div class="lg:col-span-5 space-y-2">
                                                    <label
                                                        class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                                        Select Participant
                                                    </label>
                                                    <x-choices-offline wire:model="payers.{{$index}}.user_id"
                                                        :options="$fetchedUsers" placeholder="Choose participant..."
                                                        single searchable
                                                        class="rounded-lg border-slate-300 dark:border-slate-600 focus:border-purple-500 focus:ring-purple-500/20">
                                                    </x-choices-offline>
                                                </div>

                                                <!-- Amount Paid & Exclude (flex gap mobile, cols desktop) -->
                                                <div class="flex gap-3 lg:contents">
                                                    <!-- Amount Paid (col-span-3 lg) -->
                                                    <div class="flex-1 lg:col-span-3 space-y-2">
                                                        <label
                                                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                                            Amount Paid
                                                        </label>
                                                        <x-input wire:model="payers.{{$index}}.amount" prefix="RS"
                                                            placeholder="0.00"  money

                                                            class="rounded-lg border-slate-300 dark:border-slate-600 focus:border-green-500 focus:ring-green-500/20 font-mono"
                                                           />
                                                    </div>

                                                    <!-- Exclude checkbox (col-span-3 lg) -->
                                                    <div class="flex-1 lg:col-span-3 space-y-2">
                                                        <label
                                                            class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2 lg:invisible">
                                                            Options
                                                        </label>
                                                        <div
                                                            class="bg-slate-100 dark:bg-slate-800 rounded-lg p-3 border border-slate-200 dark:border-slate-600 h-full flex flex-col justify-center">
                                                            <x-checkbox
                                                                wire:model="payers.{{$index}}.exclude_from_share"
                                                                label="Exclude in Share" class="checkbox-sm" />

                                                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                                                Skip from split calculation</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Remove Button -->
                                                @if($index > 0)
                                                {{-- Style the remove button wrapper and button like the Add form --}}
                                                <div class="flex justify-end lg:col-span-1 lg:justify-center">
                                                    <x-button wire:click="removePayer({{$index}})" icon="o-trash" {{--
                                                        Apply Add form button styling --}}
                                                        class="btn-ghost btn-sm text-red-500 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all duration-200" />
                                                </div>
                                                @endif
                                            </div> {{-- Close pl-4 lg:grid ... div --}}
                                        </div> {{-- Close bg-gradient-to-r ... payer card div --}}
                                    </div> {{-- Close group relative div --}}
                                    @endforeach
                                </div> {{-- Close space-y-4 dynamic payers list --}}

                                <!-- Add Payer Button -->
                                {{-- Style the Add Payer button container and button like the Add form --}}
                                <div class="text-center">
                                    <x-button wire:click="addPayer" {{-- Apply Add form button styling --}}
                                        class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105"
                                        icon="o-plus">
                                        <span class="ml-2">Add Another Participant</span> {{-- Match button text/icon
                                        gap --}}
                                    </x-button>
                                </div>
                            </div> {{-- Close space-y-6 for participant content --}}
                        </x-card> {{-- Close nested Participants x-card --}}
                    </div> {{-- Close relative Participants div --}}

                    <!-- Description Section -->
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Description</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Add details about this expense</p>
                            </div>
                        </div>

                        {{-- Wrap textarea in styled nested card --}}
                        <x-card
                            class="bg-gradient-to-br from-white to-slate-50 dark:from-slate-700 dark:to-slate-800 border border-slate-200/50 dark:border-slate-600/50 shadow-xl rounded-2xl hover:shadow-2xl transition-all duration-300">
                            <x-textarea label="Expense Description" wire:model="description" {{--
                                wire:model="description" kept --}}
                                placeholder="What was this expense for? (e.g., Birthday party supplies, Restaurant bill, etc.)"
                                {{-- Adjust placeholder --}} hint="Max 100 characters" rows="3" {{-- Adjust rows and
                                hint --}} {{-- Apply Add form styling --}}
                                class="rounded-xl border-slate-300 dark:border-slate-600 focus:border-orange-500 focus:ring-orange-500/20 resize-none" />
                        </x-card>
                    </div> {{-- Close relative Description div --}}

                </div> {{-- Close space-y-6 for main content sections --}}


                <!-- Enhanced Action Section -->
                <x-slot:actions>
                    {{-- Style the actions slot like the Add form --}}
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-slate-200 dark:border-slate-600">
                        <div class="flex-1">
                            <!-- Summary preview - Use 'Ready to Save' style -->
                            <div
                                class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-green-800 dark:text-green-200">Ready to
                                            Update</p> {{-- Adjust text --}}
                                        <p class="text-xs text-green-600 dark:text-green-400">All fields will be
                                            validated automatically</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end"> {{-- Container for button alignment --}}
                            <x-button type="submit" spinner="save" {{-- Spinner matches wire:submit="save" --}} {{--
                                Apply Add form save button styling --}}
                                class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-3">
                                {{-- Add flex, items-center, gap for icon/text --}}
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Update Expense</span> {{-- Adjust button text --}}
                            </x-button>
                        </div>
                    </div> {{-- Close actions flex div --}}
                </x-slot:actions>
            </x-card> {{-- Close main x-card --}}
        </x-form> {{-- Close x-form --}}
    </div> {{-- Close max-w div --}}
</div> {{-- Close main div --}}
