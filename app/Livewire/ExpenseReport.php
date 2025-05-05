<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Services\ReportService;
use Carbon\Carbon;
use Mary\Traits\Toast;

class ExpenseReport extends Component
{
    use Toast;

    // Filters
    public $period = 'last_month';
    public $start_date;
    public $end_date;
    public $status = 'all';
    public $debtFilter = 'all'; // New debt filter property

    /**
     * Period Options
     *
     * @var array
     */
    public $periodOptions = [
        [
            'id'   => 'week',
            'name' => 'Last Week',
        ],
        [
            'id'   => 'last_month',
            'name' => 'Last Month',
        ],
        [
            'id'   => 'current_month',
            'name' => 'Current Month',
        ],
        [
            'id'   => 'year',
            'name' => 'Last Year',
        ],
        [
            'id'   => 'custom',
            'name' => 'Custom Date',
        ],
    ];

    public $statusOptions = [
        [
            'id'   => 'all',
            'name' => 'All Records',
        ],
        [
            'id'   => 'settled',
            'name' => 'Settled Only',
        ],
        [
            'id'   => 'unsettled',
            'name' => 'Unsettled Only',
        ],
    ];

    // New debt filter options
    public $debtFilterOptions = [
        [
            'id'   => 'all',
            'name' => 'All Debts',
        ],
        [
            'id'   => 'owed',
            'name' => 'You Owe',
        ],
        [
            'id'   => 'receivable',
            'name' => 'Owes You',
        ],
    ];

    protected $reportService;

    protected $rules = [
        'period' => 'required|in:week,month,year,custom',
        'start_date' => 'required_if:period,custom|date|before_or_equal:end_date',
        'end_date' => 'required_if:period,custom|date|after_or_equal:start_date',
        'status' => 'required|in:all,settled,unsettled',
        'debtFilter' => 'required|in:all,owed,receivable' // New validation rule
    ];

    public function boot(ReportService $reportService)
    {
        $this->reportService = $reportService;
        $this->setDefaultDates();
    }

    public function mount()
    {
        $this->setDefaultDates();
    }
    public function updatedPeriod($value)
    {
        if ($value !== 'custom') {
            $now = now();

            if ($value === 'week') {
                $this->start_date = $now->copy()->subWeek()->format('Y-m-d');
                $this->end_date = $now->format('Y-m-d');
            } elseif ($value === 'last_month') {
                $lastMonth = $now->copy()->subMonth();
                $this->start_date = $lastMonth->startOfMonth()->format('Y-m-d');
                $this->end_date = $lastMonth->endOfMonth()->format('Y-m-d');
            } elseif ($value === 'current_month') {
                $this->start_date = $now->copy()->startOfMonth()->format('Y-m-d');
                $this->end_date = $now->copy()->endOfMonth()->format('Y-m-d');
            } elseif ($value === 'year') {
                $this->start_date = $now->copy()->subYear()->format('Y-m-d');
                $this->end_date = $now->format('Y-m-d');
            } else {
                $this->start_date = $now->format('Y-m-d');
                $this->end_date = $now->format('Y-m-d');
            }
        }

        $this->validate();
    }
    protected function setDefaultDates()
    {
        $this->updatedPeriod($this->period);
    }

    public function updated()
    {
        // Validate whenever any filter changes
        $this->validate();
    }

    #[Computed]
    public function filters()
    {
        return [
            'period'     => $this->period,
            'start_date' => $this->start_date,
            'end_date'   => $this->end_date,
            'status'     => $this->status,
            'debtFilter' => $this->debtFilter, // Include debt filter in filters
        ];
    }

    #[Computed]
    public function report()
    {
        return $this->reportService->generate(auth()->user(), $this->filters);
    }

    #[Computed]
    public function netBalances()
    {
        return $this->report['net_balances'] ?? collect();
    }
    // In App\Livewire\ExpenseReport.php

    private function getPeriodDescription(array $filters): string
    {
        if ($filters['period'] === 'custom') {
            $start = Carbon::parse($filters['start_date'])->format('M d, Y');
            $end = Carbon::parse($filters['end_date'])->format('M d, Y');
            return "$start to $end";
        }

        return match ($filters['period']) {
            'week' => 'Last Week (' . Carbon::parse($this->start_date)->format('M d') . ' - ' .
                Carbon::parse($this->end_date)->format('M d, Y') . ')',
            'last_month' => 'Last Month (' . Carbon::parse($this->start_date)->format('M Y') . ')',
            'current_month' => 'Current Month (' . Carbon::parse($this->start_date)->format('M Y') . ')',
            'year' => 'Last Year (' . Carbon::parse($this->start_date)->format('Y') . ')',
            default => 'Period: ' . ucfirst($filters['period'])
        };
    }
    #[Computed]
    public function filteredDebts()
    {
        $report = $this->report;

        if ($this->debtFilter === 'owed') {
            return [
                'debts_owed' => $report['debts_owed'] ?? [],
                'debts_receivable' => []
            ];
        }

        if ($this->debtFilter === 'receivable') {
            return [
                'debts_owed' => [],
                'debts_receivable' => $report['debts_receivable'] ?? []
            ];
        }

        return [
            'debts_owed' => $report['debts_owed'] ?? [],
            'debts_receivable' => $report['debts_receivable'] ?? []
        ];
    }

    public function render()
    {
        return view('livewire.expense-report', [
            'expenses' => $this->report['daily_expenses'] ?? [],
            'debts'    => $this->filteredDebts['debts_receivable'] ?? [],
            'owed'     => $this->filteredDebts['debts_owed'] ?? [],
        ]);
    }
}
