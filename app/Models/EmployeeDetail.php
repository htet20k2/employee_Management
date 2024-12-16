<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDetail extends Model
{

    protected $fillable = [
        'branch_id', 'department_id', 'rank_id', 'emp_photos', 'duty_status', 
        'duty_time', 'enroll_date', 'permanent_date', 'isTraining'
    ];

    public function branch() {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    
    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }
    
    public function rank() {
        return $this->belongsTo(Rank::class, 'rank_id');
    }

    public function duties()
    {
        return $this->belongsTo(Duty::class, 'duty_time_id');
    }

    public function branchdetail()
    {
        return $this->belongsTo(BranchDetail::class, 'branchdetail_id');
    }
  
    public function departmentdetail()
    {
        return $this->belongsTo(BranchDetail::class, 'departmentdetail_id');
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class, 'employee_detail_id');
    }
}