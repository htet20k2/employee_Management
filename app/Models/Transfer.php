<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\EmployeeDetail;

class Transfer extends Model
{
    protected $fillable = [
        'employee_id', 
        'branch_id', 
        'department_id', 
        'rank_id', 
        'transfer_date', 
        'status', 
        'from_branch_id', 
        'from_department_id'
    ];

    // Relationship with EmployeeDetail
    public function employeeDetail()
    {
        return $this->belongsTo(EmployeeDetail::class, 'employee_id', 'employee_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function fromBranch()
    {
        return $this->belongsTo(Branch::class, 'from_branch_id');
    }

    public function fromDepartment()
    {
        return $this->belongsTo(Department::class, 'from_department_id');
    }
}




