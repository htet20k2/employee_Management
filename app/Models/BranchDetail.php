<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchDetail extends Model
{
    public function branch() {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }
    
}
