<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 flex items-center justify-center p-4">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500/20 dark:bg-purple-400/10 rounded-full opacity-60 dark:opacity-40 animate-pulse"></div>
        <div class="absolute top-1/2 -left-32 w-64 h-64 bg-blue-500/15 dark:bg-blue-400/8 rounded-full opacity-50 dark:opacity-30 animate-bounce"></div>
        <div class="absolute bottom-0 right-1/4 w-48 h-48 bg-indigo-400/10 dark:bg-indigo-300/5 rounded-full opacity-40 dark:opacity-20 animate-ping"></div>
        
        <!-- Floating particles -->
        <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-gray-400/40 dark:bg-white/20 rounded-full animate-float"></div>
        <div class="absolute top-3/4 right-1/3 w-1 h-1 bg-purple-300/60 dark:bg-purple-200/30 rounded-full animate-float-delayed"></div>
        <div class="absolute bottom-1/4 left-1/2 w-3 h-3 bg-blue-300/30 dark:bg-blue-200/15 rounded-full animate-float-slow"></div>
    </div>

    <div class="w-full max-w-md relative">
        <!-- Main Login Card -->
        <x-card class="backdrop-blur-xl bg-white/80 dark:bg-gray-800/80 border-0 shadow-2xl rounded-3xl overflow-hidden p-8">
            <!-- Header decoration -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
            
            <!-- Brand Section -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-2xl transform hover:scale-105 transition-all duration-300">
                        <x-icon name="o-cube" class="w-10 h-10 text-white" />
                    </div>
                </div>
                
                <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text text-transparent mb-2">
                    Welcome Back! 👋
                </h1>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Sign in to continue managing your expenses
                </p>
            </div>

            <!-- Login Form -->
            <x-form wire:submit="login" class="space-y-6">
                <x-errors title="Oops!" description="Please fix the following errors:" icon="o-face-frown" 
                    class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl" />
                
                <!-- Email Section -->
                <div class="relative">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Email Address</h3>
                            <p class="text-xs text-slate-600 dark:text-slate-400">Enter your registered email</p>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <x-input 
                            placeholder="Enter your email address" 
                            wire:model="email" 
                            type="email"
                            class="rounded-xl border-slate-300 dark:border-slate-600 focus:border-blue-500 focus:ring-blue-500/20 transition-all duration-200 pl-12 py-4 text-base bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm"
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
                            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Password</h3>
                            <p class="text-xs text-slate-600 dark:text-slate-400">Enter your secure password</p>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <x-input 
                            placeholder="Enter your password" 
                            wire:model="password" 
                            type="password"
                            class="rounded-xl border-slate-300 dark:border-slate-600 focus:border-green-500 focus:ring-green-500/20 transition-all duration-200 pl-12 py-4 text-base bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm"
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
                            class="checkbox-sm rounded border-2 border-gray-300 dark:border-gray-600 focus:border-purple-500 focus:ring-purple-500/20"
                        />
                        <label class="ml-2 text-sm text-gray-700 dark:text-gray-300 font-medium">
                            Remember me
                        </label>
                    </div>
                    <div class="text-sm">
                        <span class="text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 cursor-pointer transition-colors">
                            Forgot password?
                        </span>
                    </div>
                </div>

                <!-- Info Banner -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-blue-800 dark:text-blue-200">
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
                                <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-white/80 dark:bg-gray-800/80 text-gray-500 dark:text-gray-400 backdrop-blur-sm rounded-full">
                                    Don't have an account?
                                </span>
                            </div>
                        </div>
                        
                        <!-- Register Link -->
                        <x-button 
                            class="w-full bg-gradient-to-r from-white to-gray-50 dark:from-gray-700 dark:to-gray-600 border-2 border-gray-300 dark:border-gray-600 hover:border-purple-400 dark:hover:border-purple-500 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400 font-semibold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-3 backdrop-blur-sm" 
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
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    By signing in, you agree to our 
                    <span class="text-purple-600 dark:text-purple-400 hover:underline cursor-pointer">Terms of Service</span> 
                    and 
                    <span class="text-purple-600 dark:text-purple-400 hover:underline cursor-pointer">Privacy Policy</span>
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
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    @keyframes float-delayed {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }
    
    @keyframes float-slow {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-6px); }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    .animate-float-delayed {
        animation: float-delayed 4s ease-in-out infinite 1s;
    }
    
    .animate-float-slow {
        animation: float-slow 5s ease-in-out infinite 2s;
    }

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