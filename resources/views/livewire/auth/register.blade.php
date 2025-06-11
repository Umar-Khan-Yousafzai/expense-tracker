<div class="md:w-96 mx-auto mt-20">
    <x-card class="p-10 backdrop-blur-xl bg-white/90 dark:bg-gray-800/90 border border-white/20 dark:border-gray-700/50 shadow-2xl rounded-3xl">
        <div class="mb-10">
            <x-app-brand />
            <div class="mt-4 text-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Create Account</h2>
                <p class="text-gray-600 dark:text-gray-300 text-sm">Join us to start tracking your expenses</p>
            </div>
        </div>

        <x-form wire:submit="register" class="space-y-6">
            <x-errors title="Oops!" description="Please fix the following errors:" icon="o-face-frown" />
            
            <!-- Name Field -->
            <div class="space-y-2">
                <x-input 
                    label="Full Name" 
                    placeholder="Enter your full name" 
                    wire:model="name" 
                    icon="o-user"
                    class="rounded-xl border-gray-300 dark:border-gray-600 focus:border-purple-500 focus:ring-purple-500/20 transition-all duration-200"
                />
            </div>

            <!-- Email Field -->
            <div class="space-y-2">
                <x-input 
                    label="Email Address" 
                    placeholder="Enter your email" 
                    wire:model="email" 
                    icon="o-envelope"
                    type="email"
                    class="rounded-xl border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500/20 transition-all duration-200"
                />
            </div>

            <!-- Password Field -->
            <div class="space-y-2">
                <x-input 
                    label="Password" 
                    placeholder="Create a strong password" 
                    wire:model="password" 
                    type="password" 
                    icon="o-key"
                    hint="Minimum 8 characters"
                    class="rounded-xl border-gray-300 dark:border-gray-600 focus:border-green-500 focus:ring-green-500/20 transition-all duration-200"
                />
            </div>

            <!-- Confirm Password Field -->
            <div class="space-y-2">
                <x-input 
                    label="Confirm Password" 
                    placeholder="Confirm your password" 
                    wire:model="password_confirmation" 
                    type="password" 
                    icon="o-lock-closed"
                    class="rounded-xl border-gray-300 dark:border-gray-600 focus:border-green-500 focus:ring-green-500/20 transition-all duration-200"
                />
            </div>

            <!-- Terms and Privacy Notice -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-sm text-blue-800 dark:text-blue-200">
                        By creating an account, you agree to our terms of service and privacy policy. Your data will be securely stored and used only for expense tracking purposes.
                    </p>
                </div>
            </div>

            <x-slot:actions>
                <div class="flex flex-col space-y-4 w-full">
                    <!-- Register Button -->
                    <x-button 
                        label="Create Account" 
                        type="submit" 
                        icon="o-user-plus" 
                        class="w-full bg-gradient-to-r from-purple-500 to-blue-600 hover:from-purple-600 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105" 
                        spinner="register" 
                    />
                    
                    <!-- Divider -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">Already have an account?</span>
                        </div>
                    </div>
                    
                    <!-- Login Link -->
                    <x-button 
                        label="Sign In Instead" 
                        class="w-full btn-ghost border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium py-3 px-6 rounded-xl transition-all duration-200" 
                        icon="o-arrow-right-on-rectangle" 
                        link="/login" 
                    />
                </div>
            </x-slot:actions>
        </x-form>
    </x-card>
</div>