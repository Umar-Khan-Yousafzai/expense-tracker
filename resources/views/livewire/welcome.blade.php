<div>
    <!-- HEADER -->
    @include('partials.header', ['title' => 'Home'])
    <x-card title="Average Expense" class="shadow-xl">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Total Expenses -->
            <x-stat
                title="Total Expenses"
                :value="number_format($totalExpenses, 2).' RS'"
                icon="o-banknotes"
                color="text-purple-600"
                tooltip="All-time recorded expenses"
            />

            <!-- Current Month Expenses -->
            <x-stat
                title="This Month"
                :value="number_format($currentMonthExpenses, 2).' RS'"
                icon="o-calendar-days"
                color="text-blue-600"
                tooltip="Expenses recorded this month"
            />

            <!-- Unsettled Debts -->
            <x-stat
                title="Unsettled Debts"
                :value="$unsettledDebtsCount"
                icon="o-exclamation-circle"
                color="text-orange-600"
                tooltip="Pending debt transactions"
            />

            <!-- Average Expense -->
            <x-stat
                title="Avg. Expense"
                :value="number_format($averageExpense, 2).' RS'"
                icon="o-scale"
                color="text-green-600"
                tooltip="Average per expense"
            />
        </div>
    </x-card>

    <x-card title="Your Activity Status" class="shadow-xl mt-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Amount Owed to You -->
            <x-stat
                title="Owed to You"
                :value="number_format($owedToUser, 2).' RS'"
                icon="o-arrow-down-circle"
                color="text-green-600"
                tooltip="Total others owe you"
            />

            <!-- Amount You Owe -->
            <x-stat
                title="You Owe"
                :value="number_format($userOwes, 2).' RS'"
                icon="o-arrow-up-circle"
                color="text-red-600"
                tooltip="Total you owe others"
            />

            <!-- Net Balance -->
            <x-stat
                title="Net Balance"
                :value="number_format($netBalance, 2).' RS'"
                icon="o-scale"
                :color="$netBalance >= 0 ? 'text-green-600' : 'text-red-600'"
                tooltip="Your current financial position"
            />
        </div>
    </x-card>

    <!-- FILTER DRAWER -->
    @include('partials.drawer')
</div>
