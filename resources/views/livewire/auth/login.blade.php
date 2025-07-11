<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-gray-900 dark:via-slate-800 dark:to-gray-900 flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-400/20 dark:bg-blue-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-1/2 -left-32 w-64 h-64 bg-purple-400/20 dark:bg-purple-500/10 rounded-full blur-3xl animate-bounce-slow"></div>
        <div class="absolute bottom-0 right-1/4 w-48 h-48 bg-indigo-400/20 dark:bg-indigo-500/10 rounded-full blur-3xl animate-float"></div>
        
        <!-- Floating particles -->
        <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-blue-400/60 dark:bg-blue-300/40 rounded-full animate-float"></div>
        <div class="absolute top-3/4 right-1/3 w-1 h-1 bg-purple-400/60 dark:bg-purple-300/40 rounded-full animate-float-delayed"></div>
        <div class="absolute bottom-1/4 left-1/2 w-3 h-3 bg-indigo-400/60 dark:bg-indigo-300/40 rounded-full animate-float-slow"></div>
    </div>

    <div class="w-full max-w-md relative perspective-container">
        <!-- Main Login Card with 3D Effect -->
        <div class="card-3d glass-effect rounded-3xl p-8 shadow-2xl border border-white/20 dark:border-gray-700/50 backdrop-blur-xl bg-white/80 dark:bg-gray-800/80 glow-effect">
            <!-- Header decoration -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 rounded-t-3xl"></div>
            
            <!-- Brand Section -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-2xl transform hover:scale-105 transition-all duration-300 card-3d">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                
                <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text text-transparent mb-2">
                    Welcome Back! 👋
                </h1>
                <p class="text-muted-foreground text-sm">
                    Sign in to continue managing your expenses
                </p>
            </div>

            <!-- Login Form -->
            <form wire:submit="login" class="space-y-6">
                @if ($errors->any())
                    <div class="bg-destructive/10 border border-destructive/20 rounded-xl p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-destructive rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-destructive-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-destructive">Authentication Error</h3>
                                <p class="text-sm text-destructive/80">Please check your credentials and try again.</p>
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Email Section -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-foreground">Email Address</label>
                    <div class="relative">
                        <input 
                            type="email"
                            id="email"
                            wire:model="email"
                            placeholder="Enter your email address"
                            class="form-input pl-12"
                            required
                        />
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-muted-foreground">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                    </div>
                    @error('email') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                </div>

                <!-- Password Section -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-foreground">Password</label>
                    <div class="relative">
                        <input 
                            type="password"
                            id="password"
                            wire:model="password"
                            placeholder="Enter your password"
                            class="form-input pl-12"
                            required
                        />
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-muted-foreground">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                    </div>
                    @error('password') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center space-x-2">
                        <input 
                            type="checkbox" 
                            wire:model="remember"
                            class="w-4 h-4 text-primary border-input rounded focus:ring-primary focus:ring-2"
                        />
                        <span class="text-sm text-muted-foreground">Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}" wire:navigate class="text-sm text-primary hover:text-primary/80 transition-colors">
                        Forgot password?
                    </a>
                </div>

                <!-- Info Banner -->
                <div class="bg-primary/10 border border-primary/20 rounded-xl p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-primary">
                            <span class="font-semibold">Secure Login:</span> Your credentials are encrypted and protected.
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <!-- Login Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 btn-3d flex items-center justify-center gap-3"
                        wire:loading.attr="disabled"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <span wire:loading.remove wire:target="login">Sign In to Dashboard</span>
                        <span wire:loading wire:target="login">Signing In...</span>
                    </button>
                    
                    <!-- Divider -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-border"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-background text-muted-foreground rounded-full">
                                Don't have an account?
                            </span>
                        </div>
                    </div>
                    
                    <!-- Register Link -->
                    <a 
                        href="{{ route('register') }}"
                        wire:navigate
                        class="w-full bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 border-2 border-border hover:border-primary text-foreground hover:text-primary font-semibold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 btn-3d flex items-center justify-center gap-3"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        <span>Create New Account</span>
                    </a>
                </div>
            </form>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-xs text-muted-foreground">
                    By signing in, you agree to our 
                    <span class="text-primary hover:underline cursor-pointer">Terms of Service</span> 
                    and 
                    <span class="text-primary hover:underline cursor-pointer">Privacy Policy</span>
                </p>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute -top-4 -left-4 w-24 h-24 bg-gradient-to-br from-blue-400/20 to-purple-500/20 rounded-full blur-xl animate-pulse-slow"></div>
        <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-gradient-to-br from-purple-400/20 to-pink-500/20 rounded-full blur-xl animate-float"></div>
    </div>
</div>