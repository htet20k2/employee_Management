<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentDetail extends Model
{
    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function rank() {
        return $this->belongsTo(Rank::class, 'rank_id');
    }
}
