<div class="min-h-screen bg-gray-900 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Main Login Card with Glassmorphism -->
        <x-card class="backdrop-blur-xl bg-gray-800/40 border border-gray-700/50 shadow-2xl rounded-2xl overflow-hidden p-8">
            
            <!-- Brand Section -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 bg-gray-700/50 backdrop-blur-sm rounded-xl flex items-center justify-center border border-gray-600/50">
                        <x-icon name="o-cube" class="w-8 h-8 text-purple-400" />
                    </div>
                </div>
                
                <h1 class="text-2xl font-bold text-white mb-2">
                    Welcome Back
                </h1>
                <p class="text-gray-400 text-sm">
                    Sign in to continue managing your expenses
                </p>
            </div>

            <!-- Login Form -->
            <x-form wire:submit="login" class="space-y-6">
                <x-errors title="Oops!" description="Please fix the following errors:" icon="o-face-frown" 
                    class="bg-red-900/30 border border-red-700/50 rounded-xl" />
                
                <!-- Email Field -->
                <div class="space-y-2">
                    <x-input 
                        label="Email Address"
                        placeholder="Enter your email address" 
                        wire:model="email" 
                        type="email"
                        class="bg-gray-700/50 backdrop-blur-sm border-gray-600/50 text-white placeholder-gray-400 focus:border-purple-500 focus:ring-purple-500/20 rounded-xl"
                    />
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <x-input 
                        label="Password"
                        placeholder="Enter your password" 
                        wire:model="password" 
                        type="password"
                        class="bg-gray-700/50 backdrop-blur-sm border-gray-600/50 text-white placeholder-gray-400 focus:border-purple-500 focus:ring-purple-500/20 rounded-xl"
                    />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <x-checkbox 
                            wire:model="remember"
                            class="checkbox-sm border-gray-600 bg-gray-700/50 checked:bg-purple-500 checked:border-purple-500"
                        />
                        <label class="ml-2 text-sm text-gray-300">
                            Remember me
                        </label>
                    </div>
                    <div class="text-sm">
                        <span class="text-gray-400 hover:text-purple-400 cursor-pointer transition-colors">
                            Forgot password?
                        </span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <x-slot:actions>
                    <div class="space-y-4 w-full">
                        <!-- Login Button -->
                        <x-button 
                            type="submit" 
                            spinner="login"
                            class="w-full bg-purple-600 hover:bg-purple-700 border-purple-600 hover:border-purple-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300"
                        >
                            Sign In to Dashboard
                        </x-button>
                        
                        <!-- Divider -->
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-600/50"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-gray-800/40 text-gray-400 backdrop-blur-sm rounded-full">
                                    Don't have an account?
                                </span>
                            </div>
                        </div>
                        
                        <!-- Register Link -->
                        <x-button 
                            class="w-full bg-gray-700/50 backdrop-blur-sm border border-gray-600/50 hover:bg-gray-600/50 hover:border-gray-500/50 text-gray-300 hover:text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300" 
                            link="/register"
                        >
                            Create New Account
                        </x-button>
                    </div>
                </x-slot:actions>
            </x-form>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-xs text-gray-500">
                    By signing in, you agree to our 
                    <span class="text-purple-400 hover:underline cursor-pointer">Terms of Service</span> 
                    and 
                    <span class="text-purple-400 hover:underline cursor-pointer">Privacy Policy</span>
                </p>
            </div>
        </x-card>
    </div>
</div>

@push('styles')
<style>
    /* Enhanced glassmorphism */
    .backdrop-blur-xl {
        backdrop-filter: blur(20px);
    }

    /* Ensure all form elements maintain dark theme */
    input, select, textarea {
        color: white !important;
    }

    input::placeholder {
        color: #9ca3af !important;
    }

    /* Custom focus styles for dark mode */
    .focus\:border-purple-500:focus {
        border-color: #8b5cf6 !important;
    }

    .focus\:ring-purple-500\/20:focus {
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2) !important;
    }

    /* Checkbox styles */
    .checkbox:checked {
        background-color: #8b5cf6 !important;
        border-color: #8b5cf6 !important;
    }

    /* Remove any default browser focus outlines */
    *:focus {
        outline: none !important;
    }

    /* Smooth transitions for all interactive elements */
    * {
        transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 200ms;
    }
</style>
@endpush
</div>