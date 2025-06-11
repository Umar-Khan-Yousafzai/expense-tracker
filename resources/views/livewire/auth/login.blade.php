<div class="min-h-screen bg-gradient-to-br from-gray-900 via-slate-800 to-gray-900 flex items-center justify-center p-4">
    <div class="w-full max-w-md relative">
        <!-- Main Login Card -->
        <x-card class="backdrop-blur-xl bg-gray-800/90 border border-gray-700/50 shadow-2xl rounded-3xl overflow-hidden p-8">
            <!-- Header decoration -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
            
            <!-- Brand Section -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-2xl transform hover:scale-105 transition-all duration-300">
                        <x-icon name="o-cube" class="w-10 h-10 text-white" />
                    </div>
                </div>
                
                <h1 class="text-3xl font-bold bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent mb-2">
                    Welcome Back! 👋
                </h1>
                <p class="text-gray-400 text-sm">
                    Sign in to continue managing your expenses
                </p>
            </div>

            <!-- Login Form -->
            <x-form wire:submit="login" class="space-y-6">
                <x-errors title="Oops!" description="Please fix the following errors:" icon="o-face-frown" 
                    class="bg-red-900/30 border border-red-700 rounded-xl" />
                
                <!-- Email Section -->
                <div class="relative">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-slate-200">Email Address</h3>
                            <p class="text-xs text-slate-400">Enter your registered email</p>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <x-input 
                            placeholder="Enter your email address" 
                            wire:model="email" 
                            type="email"
                            class="rounded-xl border-slate-600 focus:border-blue-500 focus:ring-blue-500/20 transition-all duration-200 pl-12 py-4 text-base bg-gray-700/80 backdrop-blur-sm text-white placeholder-gray-400"
                        />
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Password Section -->
                <div class="relative">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-slate-200">Password</h3>
                            <p class="text-xs text-slate-400">Enter your secure password</p>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <x-input 
                            placeholder="Enter your password" 
                            wire:model="password" 
                            type="password"
                            class="rounded-xl border-slate-600 focus:border-green-500 focus:ring-green-500/20 transition-all duration-200 pl-12 py-4 text-base bg-gray-700/80 backdrop-blur-sm text-white placeholder-gray-400"
                        />
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Remember Me & Options -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <x-checkbox 
                            wire:model="remember"
                            class="checkbox-sm rounded border-2 border-gray-600 focus:border-purple-500 focus:ring-purple-500/20"
                        />
                        <label class="ml-2 text-sm text-gray-300 font-medium">
                            Remember me
                        </label>
                    </div>
                    <div class="text-sm">
                        <span class="text-gray-400 hover:text-purple-400 cursor-pointer transition-colors">
                            Forgot password?
                        </span>
                    </div>
                </div>

                <!-- Info Banner -->
                <div class="bg-gradient-to-r from-blue-900/30 to-indigo-900/30 border border-blue-800 rounded-xl p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-blue-200">
                            <span class="font-semibold">Secure Login:</span> Your credentials are encrypted and protected with industry-standard security measures.
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <x-slot:actions>
                    <div class="space-y-4 w-full">
                        <!-- Login Button -->
                        <x-button 
                            type="submit" 
                            spinner="login"
                            class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-3"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Sign In to Dashboard</span>
                        </x-button>
                        
                        <!-- Divider -->
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-600"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-gray-800/90 text-gray-400 backdrop-blur-sm rounded-full">
                                    Don't have an account?
                                </span>
                            </div>
                        </div>
                        
                        <!-- Register Link -->
                        <x-button 
                            class="w-full bg-gradient-to-r from-gray-700 to-gray-600 border-2 border-gray-600 hover:border-purple-500 text-gray-300 hover:text-purple-400 font-semibold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-3 backdrop-blur-sm" 
                            link="/register"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            <span>Create New Account</span>
                        </x-button>
                    </div>
                </x-slot:actions>
            </x-form>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-xs text-gray-400">
                    By signing in, you agree to our 
                    <span class="text-purple-400 hover:underline cursor-pointer">Terms of Service</span> 
                    and 
                    <span class="text-purple-400 hover:underline cursor-pointer">Privacy Policy</span>
                </p>
            </div>
        </x-card>

        <!-- Decorative Elements -->
        <div class="absolute -top-4 -left-4 w-24 h-24 bg-gradient-to-br from-blue-400/20 to-purple-500/20 rounded-full blur-xl"></div>
        <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-gradient-to-br from-purple-400/20 to-pink-500/20 rounded-full blur-xl"></div>
    </div>
</div>

@push('styles')
<style>
    /* Enhanced glassmorphism */
    .backdrop-blur-xl {
        backdrop-filter: blur(20px);
    }

    /* Custom focus states */
    input:focus {
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }

    /* Smooth transitions for all interactive elements */
    * {
        transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 200ms;
    }
</style>
@endpush
</invoke>