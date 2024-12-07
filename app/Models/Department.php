<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['department_name'];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function ranks()
    {
        return $this->belongsToMany(Rank::class, 'department_details', 'department_id', 'rank_id');
    }

    public function departmentDetails() {
        // One department can have many department details (employees, etc.)
        return $this->hasMany(DepartmentDetail::class, 'department_id', 'branch_id');
    }
}
