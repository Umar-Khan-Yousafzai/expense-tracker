<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Services\ReportService;
use Mary\Traits\Toast;

class ExpenseReport extends Component
{
    use Toast;

    // Filters
    public $period = 'month';

    public $start_date;

    public $end_date;

    public $status = 'all';

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
            'id'   => 'month',
            'name' => 'Last Month',
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

    protected $reportService;

    protected $rules = [
        'period' => 'required|in:week,month,year,custom',
        'start_date' => 'required_if:period,custom|date|before_or_equal:end_date',
        'end_date' => 'required_if:period,custom|date|after_or_equal:start_date',
        'status' => 'required|in:all,settled,unsettled'
    ];

    public function boot(ReportService $reportService)
    {
        $this->reportService = $reportService;
        $this->setDefaultDates();
    }//end boot()
    public function mount()
    {
        $this->setDefaultDates();
    }


    public function updatedPeriod($value)
    {
        // When period changes (except custom), set appropriate dates
        if ($value !== 'custom') {
            $this->start_date = match($value) {
                'week' => now()->subWeek()->format('Y-m-d'),
                'month' => now()->subMonth()->format('Y-m-d'),
                'year' => now()->subYear()->format('Y-m-d'),
                default => now()->format('Y-m-d')
            };
            $this->end_date = now()->format('Y-m-d');
        }

        $this->validate();
    }
    protected function setDefaultDates()
    {
        $this->start_date = now()->subMonth()->format('Y-m-d');
        $this->end_date   = now()->format('Y-m-d');
    }//end setDefaultDates()

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
        ];
    }//end filters()


    #[Computed]
    public function report()
    {
        return $this->reportService->generate(auth()->user(), $this->filters);
    }//end report()


    public function render()
    {
        return view('livewire.expense-report', [
            'expenses' => $this->report['daily_expenses'] ?? [],
            'debts'    => $this->report['debts_receivable'] ?? [],
            'owed'     => $this->report['debts_owed'] ?? [],
        ]);
    }//end render()


}//end class
