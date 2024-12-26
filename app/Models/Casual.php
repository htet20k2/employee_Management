<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casual extends Model
{

    use HasFactory;
    protected $guarded =[];
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id'); // Specify foreign and local keys
    }
    
}
