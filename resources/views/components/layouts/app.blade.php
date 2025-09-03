<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker - Modern UI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Gradient animations */
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animated-gradient {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c);
            background-size: 400% 400%;
            animation: gradient-shift 15s ease infinite;
        }

        /* Glass effect */
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .glass-dark {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Glow effects */
        .glow-primary {
            box-shadow: 0 0 30px rgba(102, 126, 234, 0.4);
        }

        .glow-success {
            box-shadow: 0 0 30px rgba(34, 197, 94, 0.4);
        }

        .glow-danger {
            box-shadow: 0 0 30px rgba(239, 68, 68, 0.4);
        }

        /* Card hover effects */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-4px);
        }

        /* Sidebar item hover */
        .nav-item {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 0;
            background: linear-gradient(to bottom, #667eea, #764ba2);
            transition: height 0.3s ease;
            border-radius: 0 3px 3px 0;
        }

        .nav-item:hover::before,
        .nav-item.active::before {
            height: 70%;
        }

        .nav-item:hover {
            background: rgba(102, 126, 234, 0.1);
            padding-left: 20px;
        }

        .nav-item.active {
            background: rgba(102, 126, 234, 0.15);
            padding-left: 20px;
        }

        /* Number animations */
        @keyframes countUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .number-animate {
            animation: countUp 0.5s ease-out;
        }

        /* Pulse dot */
        @keyframes pulse-dot {
            0% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
            }
        }

        .pulse-dot {
            animation: pulse-dot 2s infinite;
        }
    </style>
</head>
<body class="overflow-hidden text-gray-100 bg-gray-950">
    <!-- Background gradient mesh -->
    <div class="fixed inset-0 opacity-30">
        <div class="absolute top-0 bg-purple-800 rounded-full -left-4 w-96 h-96 mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 bg-blue-800 rounded-full -right-4 w-96 h-96 mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute bg-pink-800 rounded-full -bottom-8 left-20 w-96 h-96 mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative flex h-screen">
        <!-- Compact Sidebar -->
        <aside class="flex flex-col w-64 border-r border-gray-800 glass-dark">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-800">
                <div class="flex items-center space-x-3">
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl animated-gradient">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold">ExpenseAI</h1>
                        <p class="text-xs text-gray-500">Smart Tracking</p>
                    </div>
                </div>
            </div>

            <!-- User Profile Mini -->
            <div class="p-4 mx-4 mt-4 border border-gray-800 rounded-xl glass">
                <div class="flex items-center space-x-3">
                    <div class="flex items-center justify-center w-10 h-10 text-sm font-bold rounded-full bg-gradient-to-br from-purple-500 to-pink-500">
                        UF
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate">Umer Farooq</p>
                        <p class="text-xs text-gray-500 truncate">Premium Account</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <a href="#" class="flex items-center px-4 py-3 space-x-3 text-sm rounded-lg nav-item active">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 space-x-3 text-sm text-gray-400 rounded-lg nav-item hover:text-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    <span>Expenses</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 space-x-3 text-sm text-gray-400 rounded-lg nav-item hover:text-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Add Expense</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 space-x-3 text-sm text-gray-400 rounded-lg nav-item hover:text-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Share Expense</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 space-x-3 text-sm text-gray-400 rounded-lg nav-item hover:text-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1m3-2V8a2 2 0 00-2-2H8a2 2 0 00-2 2v7m3-2h6l2 2H7l2-2z"></path>
                    </svg>
                    <span>Reports</span>
                </a>
            </nav>

            <!-- Bottom Actions -->
            <div class="p-4 border-t border-gray-800">
                <button class="w-full px-4 py-2 text-sm transition-colors rounded-lg glass hover:bg-gray-800">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Settings</span>
                    </span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Bar -->
            <header class="px-8 py-4 border-b border-gray-800 glass-dark">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold">Dashboard</h2>
                        <p class="mt-1 text-sm text-gray-400">Tuesday, August 19, 2025</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Search -->
                        <div class="relative">
                            <input type="text" placeholder="Search transactions..." class="w-64 px-4 py-2 pl-10 text-sm border border-gray-700 rounded-lg glass focus:border-purple-500 focus:outline-none">
                            <svg class="absolute w-4 h-4 text-gray-500 left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>

                        <!-- Quick Actions -->
                        <button class="p-2 transition-colors rounded-lg glass hover:bg-gray-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </button>

                        <!-- Theme Toggle -->
                        <button class="flex items-center px-4 py-2 space-x-2 text-sm transition-colors rounded-lg glass hover:bg-gray-800">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                            <span>Dark</span>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="flex-1 p-8 overflow-y-auto">
                <!-- Welcome Card -->
                <div class="p-6 mb-8 text-white rounded-2xl animated-gradient">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="mb-2 text-3xl font-bold">Welcome back, Umer! 👋</h3>
                            <p class="text-white/80">Your financial overview for August 2025</p>
                        </div>
                        <div class="text-right">
                            <p class="mb-1 text-sm text-white/60">Net Balance</p>
                            <p class="text-4xl font-bold">₨ 5,752.01</p>
                        </div>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
                    <!-- Total Expenses -->
                    <div class="p-6 border border-gray-800 card-hover glass rounded-2xl">
                        <div class="flex items-start justify-between mb-4">
                            <div class="p-3 rounded-xl bg-purple-500/20">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xs text-gray-500">All Time</span>
                        </div>
                        <p class="mb-1 text-2xl font-bold number-animate">₨ 128,038.13</p>
                        <p class="text-sm text-gray-400">Total Expenses</p>
                        <div class="flex items-center mt-4 text-xs text-green-400">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            <span>12% from last month</span>
                        </div>
                    </div>

                    <!-- This Month -->
                    <div class="p-6 border border-gray-800 card-hover glass rounded-2xl">
                        <div class="flex items-start justify-between mb-4">
                            <div class="p-3 rounded-xl bg-pink-500/20">
                                <svg class="w-6 h-6 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="text-xs text-gray-500">Aug 2025</span>
                        </div>
                        <p class="mb-1 text-2xl font-bold number-animate">₨ 7,300.00</p>
                        <p class="text-sm text-gray-400">This Month</p>
                        <div class="flex items-center mt-4 text-xs text-red-400">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                            </svg>
                            <span>8% from last month</span>
                        </div>
                    </div>

                    <!-- Unsettled Debts -->
                    <div class="p-6 border border-gray-800 card-hover glass rounded-2xl">
                        <div class="flex items-start justify-between mb-4">
                            <div class="p-3 rounded-xl bg-yellow-500/20">
                                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="w-2 h-2 bg-yellow-400 rounded-full pulse-dot"></div>
                        </div>
                        <p class="mb-1 text-2xl font-bold number-animate">73</p>
                        <p class="text-sm text-gray-400">Unsettled Debts</p>
                        <div class="mt-4">
                            <div class="w-full h-2 bg-gray-800 rounded-full">
                                <div class="h-2 bg-yellow-400 rounded-full" style="width: 73%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Average Expense -->
                    <div class="p-6 border border-gray-800 card-hover glass rounded-2xl">
                        <div class="flex items-start justify-between mb-4">
                            <div class="p-3 rounded-xl bg-green-500/20">
                                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <span class="text-xs text-gray-500">Per Transaction</span>
                        </div>
                        <p class="mb-1 text-2xl font-bold number-animate">₨ 1,561.44</p>
                        <p class="text-sm text-gray-400">Avg. Expense</p>
                        <div class="flex items-center mt-4 text-xs text-gray-500">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                            </svg>
                            <span>Stable trend</span>
                        </div>
                    </div>
                </div>

                <!-- Financial Balance Section -->
                <div class="mb-8">
                    <h3 class="flex items-center mb-6 text-xl font-bold">
                        <span class="mr-3">Financial Balance</span>
                        <div class="flex-1 h-px bg-gradient-to-r from-gray-800 to-transparent"></div>
                    </h3>

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                        <!-- Owed to You -->
                        <div class="p-6 border card-hover glass rounded-2xl border-green-900/50 glow-success">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="p-3 rounded-xl bg-green-500/20">
                                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-400">Owed to You</p>
                                        <p class="text-xs text-gray-500">Incoming money</p>
                                    </div>
                                </div>
                                <div class="w-2 h-2 bg-green-400 rounded-full pulse-dot"></div>
                            </div>
                            <p class="text-3xl font-bold text-green-400">₨ 18,862.68</p>
                            <div class="pt-4 mt-4 border-t border-gray-800">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-gray-500">From 12 people</span>
                                    <span class="text-green-400">View details →</span>
                                </div>
                            </div>
                        </div>

                        <!-- You Owe -->
                        <div class="p-6 border card-hover glass rounded-2xl border-red-900/50 glow-danger">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="p-3 rounded-xl bg-red-500/20">
                                        <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-400">You Owe</p>
                                        <p class="text-xs text-gray-500">Outgoing payments</p>
                                    </div>
                                </div>
                                <div class="w-2 h-2 bg-red-400 rounded-full pulse-dot"></div>
                            </div>
                            <p class="text-3xl font-bold text-red-400">₨ 13,110.67</p>
                            <div class="pt-4 mt-4 border-t border-gray-800">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-gray-500">To 8 people</span>
                                    <span class="text-red-400">Pay now →</span>
                                </div>
                            </div>
                        </div>

                        <!-- Net Balance -->
                        <div class="p-6 border card-hover glass rounded-2xl border-purple-900/50 glow-primary">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="p-3 rounded-xl bg-purple-500/20">
                                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-400">Net Balance</p>
                                        <p class="text-xs text-gray-500">Overall position</p>
                                    </div>
                                </div>
                                <div class="badge badge-success badge-sm">Positive</div>
                            </div>
                            <p class="text-3xl font-bold text-purple-400">₨ 5,752.01</p>
                            <div class="pt-4 mt-4 border-t border-gray-800">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-gray-500">Healthy finances</span>
                                    <span class="text-purple-400">Analytics →</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold">Recent Transactions</h3>
                        <button class="text-sm text-purple-400 hover:text-purple-300">View all →</button>
                    </div>

                    <div class="overflow-hidden border border-gray-800 glass rounded-2xl">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-800">
                                        <th class="p-4 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">Transaction</th>
                                        <th class="p-4 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">Category</th>
                                        <th class="p-4 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">Date</th>
                                        <th class="p-4 text-xs font-medium tracking-wider text-right text-gray-400 uppercase">Amount</th>
                                        <th class="p-4 text-xs font-medium tracking-wider text-center text-gray-400 uppercase">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-800">
                                    <tr class="transition-colors hover:bg-gray-900/50">
                                        <td class="p-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-500/20">
                                                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium">Grocery Shopping</p>
                                                    <p class="text-xs text-gray-500">Carrefour Market</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <span class="px-2 py-1 text-xs text-blue-400 rounded-lg bg-blue-500/20">Food & Dining</span>
                                        </td>
                                        <td class="p-4 text-sm text-gray-400">Aug 19, 2025</td>
                                        <td class="p-4 text-sm font-medium text-right">₨ 2,450.00</td>
                                        <td class="p-4 text-center">
                                            <span class="px-2 py-1 text-xs text-green-400 rounded-lg bg-green-500/20">Settled</span>
                                        </td>
                                    </tr>
                                    <tr class="transition-colors hover:bg-gray-900/50">
                                        <td class="p-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-purple-500/20">
                                                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium">Electricity Bill</p>
                                                    <p class="text-xs text-gray-500">LESCO</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <span class="px-2 py-1 text-xs text-purple-400 rounded-lg bg-purple-500/20">Utilities</span>
                                        </td>
                                        <td class="p-4 text-sm text-gray-400">Aug 18, 2025</td>
                                        <td class="p-4 text-sm font-medium text-right">₨ 3,200.00</td>
                                        <td class="p-4 text-center">
                                            <span class="px-2 py-1 text-xs text-yellow-400 rounded-lg bg-yellow-500/20">Pending</span>
                                        </td>
                                    </tr>
                                    <tr class="transition-colors hover:bg-gray-900/50">
                                        <td class="p-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-500/20">
                                                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium">Dinner Split</p>
                                                    <p class="text-xs text-gray-500">With Ahmed, Ali, Sara</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <span class="px-2 py-1 text-xs text-green-400 rounded-lg bg-green-500/20">Shared</span>
                                        </td>
                                        <td class="p-4 text-sm text-gray-400">Aug 17, 2025</td>
                                        <td class="p-4 text-sm font-medium text-right">₨ 1,650.00</td>
                                        <td class="p-4 text-center">
                                            <span class="px-2 py-1 text-xs text-green-400 rounded-lg bg-green-500/20">Settled</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <button class="p-6 transition-all border border-gray-800 glass rounded-2xl hover:border-purple-500 group">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 transition-colors rounded-xl bg-purple-500/20 group-hover:bg-purple-500/30">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div class="text-left">
                                <p class="font-medium">Add Expense</p>
                                <p class="text-xs text-gray-500">Record new transaction</p>
                            </div>
                        </div>
                    </button>

                    <button class="p-6 transition-all border border-gray-800 glass rounded-2xl hover:border-green-500 group">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 transition-colors rounded-xl bg-green-500/20 group-hover:bg-green-500/30">
                                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="text-left">
                                <p class="font-medium">Split Bill</p>
                                <p class="text-xs text-gray-500">Share with friends</p>
                            </div>
                        </div>
                    </button>

                    <button class="p-6 transition-all border border-gray-800 glass rounded-2xl hover:border-blue-500 group">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 transition-colors rounded-xl bg-blue-500/20 group-hover:bg-blue-500/30">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1m3-2V8a2 2 0 00-2-2H8a2 2 0 00-2 2v7m3-2h6l2 2H7l2-2z"></path>
                                </svg>
                            </div>
                            <div class="text-left">
                                <p class="font-medium">Export Report</p>
                                <p class="text-xs text-gray-500">Download statements</p>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </main>
    </div>

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</body>
</html>
