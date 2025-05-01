<?php

namespace App;

trait DebtFilter
{
    /**
     * Applies Filter for report.
     *
     * @param  mixed $query
     * @param  mixed $filters
     * @return mixed
     */
    public function applyFilters($query, $filters)
    {
        // Date filters
        if ($filters['period'] === 'custom') {
            $query->whereBetween('created_at', [
                $filters['start_date'],
                $filters['end_date'],
            ]);
        } else {
            $query->where('created_at', '>=', now()->sub($filters['period']));
        }

        // Status filter
        if ($filters['status'] !== 'all') {
            $filters['status'] === 'settled' ? $query->settled() : $query->unsettled();
        }

        return $query;
    }//end applyFilters()


}//end trait
