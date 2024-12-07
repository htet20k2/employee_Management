<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentDetail extends Model
{
    // The table this model refers to, if it's not the default (e.g., `department_details`)
    // protected $table = 'department_details';
    
    public function department() {
        // Correct relationship to the Department model
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function rank() {
        // Correct relationship to the Rank model
        return $this->belongsTo(Rank::class, 'rank_id');
    }

    public function branch() {
        // Make sure to define the relationship with the Branch model as well
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
