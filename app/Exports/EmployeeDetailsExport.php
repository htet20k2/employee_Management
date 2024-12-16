<?php

namespace App\Exports;

use App\Models\EmployeeDetail;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeDetailsExport implements FromQuery, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    // Fetch data with applied filters
    public function query()
    {
        $query = EmployeeDetail::query();

        if (!empty($this->filters['branch'])) {
            $query->where('branch_id', $this->filters['branch']);
        }

        if (!empty($this->filters['department'])) {
            $query->where('department_id', $this->filters['department']);
        }

        if (!empty($this->filters['duty'])) {
            $query->where('duty_time_id', $this->filters['duty']);
        }

        if (!empty($this->filters['rank'])) {
            $query->where('rank_id', $this->filters['rank']);
        }

        if (!empty($this->filters['is_training'])) {
            $query->where('isTraining', $this->filters['is_training'] === 'Yes' ? 1 : 0);
        }

        return $query->with(['branch', 'department', 'duties', 'rank']);
    }

    public function map($employee): array
    {
        return [
            $employee->id,
            $employee->branch->name ?? 'N/A',
            $employee->department->name ?? 'N/A',
            $employee->duties->status ?? 'N/A',
            $employee->duties->duty ?? 'N/A',
            $employee->rank->rank ?? 'N/A',
            $employee->enroll_date,
            $employee->permanent_date,
            $employee->isTraining ? 'Yes' : 'No',
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Branch Name',
            'Department Name',
            'Duty Status',
            'Duty Time',
            'Rank Name',
            'Enroll Date',
            'Permanent Date',
            'Is Training',

        ];
    }
}
