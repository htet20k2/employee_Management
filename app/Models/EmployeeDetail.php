<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDetail extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'department_id',
        'duty_time_id',
        'rank_id',
    ];

    public function branch() {
        return $this->belongsTo(Branch::class, 'branch_id')->withDefault();
    }

    public function department() {
        return $this->belongsTo(Department::class, 'department_id')->withDefault();
    }

    public function duties() {
        return $this->belongsTo(Duty::class, 'duty_time_id')->withDefault();
    }

    public function rank() {
        return $this->belongsTo(Rank::class, 'rank_id')->withDefault();
    }

    
}

