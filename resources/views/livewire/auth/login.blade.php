<div class="md:w-96 mx-auto mt-20">
    <x-card class="p-10 backdrop-blur-xl bg-white/90 dark:bg-gray-800/90 border border-white/20 dark:border-gray-700/50 shadow-2xl rounded-3xl">
        <div class="mb-10">
            <x-app-brand />
            <div class="mt-4 text-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Welcome Back</h2>
                <p class="text-gray-600 dark:text-gray-300 text-sm">Sign in to your account to continue</p>
            </div>
        </div>

        <x-form wire:submit="login" class="space-y-6">
            <x-errors title="Oops!" description="Please fix the following errors:" icon="o-face-frown" />
            
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
                    placeholder="Enter your password" 
                    wire:model="password" 
                    type="password" 
                    icon="o-key"
                    class="rounded-xl border-gray-300 dark:border-gray-600 focus:border-green-500 focus:ring-green-500/20 transition-all duration-200"
                />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <x-checkbox 
                    label="Remember me" 
                    wire:model="remember"
                    class="checkbox-sm"
                />
                <!-- Future: Add forgot password link here -->
                <div class="text-sm">
                    <span class="text-gray-500 dark:text-gray-400">Forgot password?</span>
                </div>
            </div>

            <x-slot:actions>
                <div class="flex flex-col space-y-4 w-full">
                    <!-- Login Button -->
                    <x-button 
                        label="Sign In" 
                        type="submit" 
                        icon="o-arrow-right-on-rectangle" 
                        class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105" 
                        spinner="login" 
                    />
                    
                    <!-- Divider -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">Don't have an account?</span>
                        </div>
                    </div>
                    
                    <!-- Register Link -->
                    <x-button 
                        label="Create Account" 
                        class="w-full btn-ghost border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium py-3 px-6 rounded-xl transition-all duration-200" 
                        icon="o-user-plus" 
                        link="/register" 
                    />
                </div>
            </x-slot:actions>
        </x-form>
    </x-card>
</div>