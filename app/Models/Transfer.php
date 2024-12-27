<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\EmployeeDetail;

class Transfer extends Model
{
    protected $fillable = ['employee_detail_id', 'branch_id', 'department_id', 'rank_id', 'transfer_date', 'status'];

    // Relationship with EmployeeDetail
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
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




