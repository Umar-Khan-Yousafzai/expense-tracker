<div class="flex items-center justify-center min-h-screen p-4 overflow-hidden  bg-slate-800">

    {{-- Background blur elements --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute rounded-full -top-40 -right-40 w-80 h-80 bg-blue-500/10 blur-3xl animate-pulse"></div>
        <div class="absolute w-64 h-64 delay-1000 rounded-full top-1/2 -left-32 bg-purple-500/10 blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 w-48 h-48 delay-500 rounded-full right-1/4 bg-indigo-500/10 blur-3xl animate-pulse"></div>

        <div class="absolute w-2 h-2 rounded-full top-1/4 left-1/4 bg-blue-400/40 animate-pulse"></div>
        <div class="absolute w-1 h-1 delay-300 rounded-full top-3/4 right-1/3 bg-purple-400/40 animate-pulse"></div>
        <div class="absolute w-3 h-3 delay-700 rounded-full bottom-1/4 left-1/2 bg-indigo-400/40 animate-pulse"></div>
    </div>

    <div class="relative w-full max-w-md lg:max-w-lg">
        <div class="p-6 border shadow-2xl bg-slate-800 rounded-2xl sm:p-8 lg:p-10 border-slate-700/50">

            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 rounded-t-2xl"></div>

            {{-- Branding --}}
            <div class="mb-8 text-center">
                <div class="flex justify-center mb-6">
                    <div class="flex items-center justify-center w-16 h-16 shadow-lg sm:w-20 sm:h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl">
                        <x-icon name="o-currency-dollar" class="w-5 h-5 text-slate-400" />
                    </div>
                </div>
                <h1 class="mb-2 text-2xl font-bold text-white sm:text-3xl lg:text-4xl">Welcome Back! 👋</h1>
                <p class="text-sm text-slate-400 sm:text-base">Sign in to continue managing your expenses</p>
            </div>

            {{-- Form --}}
            <form wire:submit.prevent="login" class="space-y-6">

                @if ($errors->has('email'))
                    <div class="p-4 border bg-red-500/10 border-red-500/20 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 bg-red-500 rounded-lg">
                                <x-icon name="s-exclamation-circle" class="w-5 h-5 text-white" />
                            </div>
                            <div>
                                <h3 class="font-semibold text-red-400">Authentication Error</h3>
                                <p class="text-sm text-red-300">Please check your credentials and try again.</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Email --}}
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-slate-300">Email Address</label>
                    <div class="relative">
                        <input type="email" id="email" wire:model.defer="email" placeholder="Enter your email address"
                               class="w-full py-3 pl-12 pr-4 text-sm text-white border sm:py-4 bg-slate-700 border-slate-600 rounded-xl placeholder-slate-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 focus:outline-none sm:text-base" />
                        <div class="absolute transform -translate-y-1/2 left-4 top-1/2 text-slate-400">
                            <x-icon name="o-envelope" class="w-5 h-5 text-slate-400" />
                        </div>
                    </div>
                </div>

                {{-- Password --}}
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-slate-300">Password</label>
                    <div class="relative">
                        <input :type="$showPassword ? 'text' : 'password'" wire:model.defer="password" id="password"
                               class="w-full py-3 pl-12 pr-12 text-sm text-white border sm:py-4 bg-slate-700 border-slate-600 rounded-xl placeholder-slate-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 focus:outline-none sm:text-base"
                               placeholder="Enter your password" />
                        <div class="absolute transform -translate-y-1/2 left-4 top-1/2 text-slate-400">
                            <x-icon name="o-lock-closed" class="w-5 h-5 text-slate-400" />
                        </div>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="remember"
                               class="w-4 h-4 text-purple-500 rounded bg-slate-700 border-slate-600 focus:ring-purple-500 focus:ring-2" />
                        <span class="text-sm text-slate-400">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-purple-400 transition-colors hover:text-purple-300">Forgot password?</a>
                </div>

                {{-- Info --}}
                <div class="p-4 border bg-blue-500/10 border-blue-500/20 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 bg-blue-500 rounded-lg">
                            <x-icon name="o-information-circle" class="w-5 h-5 text-slate-400" />
                        </div>
                        <p class="text-sm text-blue-300">
                            <span class="font-semibold">Secure Login:</span> Your credentials are encrypted and protected.
                        </p>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="space-y-4">
                    <button type="submit"
                            class="flex items-center justify-center w-full gap-3 px-6 py-3 text-sm font-bold text-white transition-all duration-300 shadow-lg bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 sm:py-4 sm:px-8 rounded-xl hover:shadow-xl sm:text-base">

                            <x-icon name="s-arrow-left-end-on-rectangle" class="w-5 h-5 text-slate-400" />

                        <span>Sign In to Dashboard</span>
                    </button>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-600"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 rounded-full bg-slate-800 text-slate-400">Don't have an account?</span>
                        </div>
                    </div>

                    <a href="#"
                       class="flex items-center justify-center w-full gap-3 px-6 py-3 text-sm font-semibold transition-all duration-300 border bg-slate-700 border-slate-600 hover:border-purple-500 hover:bg-slate-600 text-slate-300 hover:text-white sm:py-4 sm:px-8 rounded-xl sm:text-base">
                        {{-- <x-icons.user-plus class="w-5 h-5" /> --}}
                        <x-icon name="s-user-plus" class="w-5 h-5 text-slate-400" />
                        <span>Create New Account</span>
                    </a>
                </div>
            </form>

            <div class="mt-8 text-xs text-center sm:text-sm text-slate-500">
                By signing in, you agree to our
                <span class="text-purple-400 cursor-pointer hover:text-purple-300 hover:underline">Terms of Service</span>
                and
                <span class="text-purple-400 cursor-pointer hover:text-purple-300 hover:underline">Privacy Policy</span>
            </div>
        </div>

        <div class="absolute w-16 h-16 rounded-full -top-4 -left-4 sm:w-24 sm:h-24 bg-gradient-to-br from-blue-400/20 to-purple-500/20 blur-xl animate-pulse"></div>
        <div class="absolute w-20 h-20 delay-1000 rounded-full -bottom-4 -right-4 sm:w-32 sm:h-32 bg-gradient-to-br from-purple-400/20 to-pink-500/20 blur-xl animate-pulse"></div>
    </div>
</div>
