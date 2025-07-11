<div class="min-h-screen bg-gradient-to-br from-slate-50 via-green-50 to-emerald-100 dark:from-gray-900 dark:via-slate-800 dark:to-gray-900 flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-green-400/20 dark:bg-green-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-1/2 -left-32 w-64 h-64 bg-emerald-400/20 dark:bg-emerald-500/10 rounded-full blur-3xl animate-bounce-slow"></div>
        <div class="absolute bottom-0 right-1/4 w-48 h-48 bg-teal-400/20 dark:bg-teal-500/10 rounded-full blur-3xl animate-float"></div>
    </div>

    <div class="w-full max-w-md relative perspective-container">
        <!-- Main Card with 3D Effect -->
        <div class="card-3d glass-effect rounded-3xl p-8 shadow-2xl border border-white/20 dark:border-gray-700/50 backdrop-blur-xl bg-white/80 dark:bg-gray-800/80 glow-effect">
            <!-- Header decoration -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-green-500 via-emerald-500 to-teal-500 rounded-t-3xl"></div>
            
            <!-- Brand Section -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-2xl transform hover:scale-105 transition-all duration-300 card-3d">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>
                
                <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text text-transparent mb-2">
                    Reset Password 🔐
                </h1>
                <p class="text-muted-foreground text-sm">
                    Enter your new password below
                </p>
            </div>

            <!-- Reset Password Form -->
            <form wire:submit="resetPassword" class="space-y-6">
                @if ($errors->any())
                    <div class="bg-destructive/10 border border-destructive/20 rounded-xl p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-destructive rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-destructive-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-destructive">Reset Error</h3>
                                <p class="text-sm text-destructive/80">Please check the form and try again.</p>
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Email Section (Read-only) -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-foreground">Email Address</label>
                    <div class="relative">
                        <input 
                            type="email"
                            id="email"
                            wire:model="email"
                            class="form-input pl-12 bg-muted cursor-not-allowed"
                            readonly
                        />
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-muted-foreground">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Password Section -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-foreground">New Password</label>
                    <div class="relative">
                        <input 
                            type="password"
                            id="password"
                            wire:model="password"
                            placeholder="Enter your new password"
                            class="form-input pl-12"
                            required
                        />
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-muted-foreground">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-muted-foreground">Minimum 8 characters</p>
                    @error('password') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                </div>

                <!-- Confirm Password Section -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-semibold text-foreground">Confirm New Password</label>
                    <div class="relative">
                        <input 
                            type="password"
                            id="password_confirmation"
                            wire:model="password_confirmation"
                            placeholder="Confirm your new password"
                            class="form-input pl-12"
                            required
                        />
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-muted-foreground">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    @error('password_confirmation') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                </div>

                <!-- Info Banner -->
                <div class="bg-primary/10 border border-primary/20 rounded-xl p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-primary">
                            <span class="font-semibold">Security:</span> Choose a strong password with letters, numbers, and symbols.
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <!-- Reset Password Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 btn-3d flex items-center justify-center gap-3"
                        wire:loading.attr="disabled"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span wire:loading.remove wire:target="resetPassword">Reset Password</span>
                        <span wire:loading wire:target="resetPassword">Resetting...</span>
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
        </div>

        <!-- Decorative Elements -->
        <div class="absolute -top-4 -left-4 w-24 h-24 bg-gradient-to-br from-green-400/20 to-emerald-500/20 rounded-full blur-xl animate-pulse-slow"></div>
        <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-gradient-to-br from-emerald-400/20 to-teal-500/20 rounded-full blur-xl animate-float"></div>
    </div>
</div>