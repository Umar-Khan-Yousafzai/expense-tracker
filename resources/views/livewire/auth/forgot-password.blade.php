<div class="min-h-screen bg-gradient-to-br from-slate-50 via-orange-50 to-red-100 dark:from-gray-900 dark:via-slate-800 dark:to-gray-900 flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-orange-400/20 dark:bg-orange-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-1/2 -left-32 w-64 h-64 bg-red-400/20 dark:bg-red-500/10 rounded-full blur-3xl animate-bounce-slow"></div>
        <div class="absolute bottom-0 right-1/4 w-48 h-48 bg-yellow-400/20 dark:bg-yellow-500/10 rounded-full blur-3xl animate-float"></div>
    </div>

    <div class="w-full max-w-md relative perspective-container">
        <!-- Main Card with 3D Effect -->
        <div class="card-3d glass-effect rounded-3xl p-8 shadow-2xl border border-white/20 dark:border-gray-700/50 backdrop-blur-xl bg-white/80 dark:bg-gray-800/80 glow-effect">
            <!-- Header decoration -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-orange-500 via-red-500 to-pink-500 rounded-t-3xl"></div>
            
            @if(!$emailSent)
                <!-- Brand Section -->
                <div class="text-center mb-8">
                    <div class="flex justify-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center shadow-2xl transform hover:scale-105 transition-all duration-300 card-3d">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text text-transparent mb-2">
                        Forgot Password? 🔑
                    </h1>
                    <p class="text-muted-foreground text-sm">
                        No worries! Enter your email and we'll send you a reset link
                    </p>
                </div>

                <!-- Forgot Password Form -->
                <form wire:submit="sendResetLink" class="space-y-6">
                    @if ($errors->any())
                        <div class="bg-destructive/10 border border-destructive/20 rounded-xl p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-destructive rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-destructive-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-destructive">Error</h3>
                                    <p class="text-sm text-destructive/80">Please check your email and try again.</p>
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

                    <!-- Info Banner -->
                    <div class="bg-primary/10 border border-primary/20 rounded-xl p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-sm text-primary">
                                <span class="font-semibold">Reset Instructions:</span> We'll send you a secure link to reset your password.
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-4">
                        <!-- Send Reset Link Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 btn-3d flex items-center justify-center gap-3"
                            wire:loading.attr="disabled"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            <span wire:loading.remove wire:target="sendResetLink">Send Reset Link</span>
                            <span wire:loading wire:target="sendResetLink">Sending...</span>
                        </button>
                        
                        <!-- Back to Login Link -->
                        <a 
                            href="{{ route('login') }}"
                            wire:navigate
                            class="w-full bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 border-2 border-border hover:border-primary text-foreground hover:text-primary font-semibold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 btn-3d flex items-center justify-center gap-3"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span>Back to Login</span>
                        </a>
                    </div>
                </form>
            @else
                <!-- Success State -->
                <div class="text-center">
                    <div class="flex justify-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-2xl animate-bounce">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text text-transparent mb-4">
                        Check Your Email! 📧
                    </h1>
                    <p class="text-muted-foreground mb-6">
                        We've sent a password reset link to <strong>{{ $email }}</strong>
                    </p>

                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4 mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-sm text-green-800 dark:text-green-200">
                                <span class="font-semibold">Email Sent!</span> Check your inbox and spam folder for the reset link.
                            </p>
                        </div>
                    </div>

                    <a 
                        href="{{ route('login') }}"
                        wire:navigate
                        class="w-full bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 border-2 border-border hover:border-primary text-foreground hover:text-primary font-semibold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 btn-3d flex items-center justify-center gap-3"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Back to Login</span>
                    </a>
                </div>
            @endif
        </div>

        <!-- Decorative Elements -->
        <div class="absolute -top-4 -left-4 w-24 h-24 bg-gradient-to-br from-orange-400/20 to-red-500/20 rounded-full blur-xl animate-pulse-slow"></div>
        <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-gradient-to-br from-red-400/20 to-pink-500/20 rounded-full blur-xl animate-float"></div>
    </div>
</div>