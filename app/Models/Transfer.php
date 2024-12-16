<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'employee_detail_id', 'branch_id', 'department_id', 'rank_id', 
        'start_date', 'end_date'
    ];

    public function employeeDetail()
    {
        return $this->belongsTo(EmployeeDetail::class, 'employee_detail_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }
}
