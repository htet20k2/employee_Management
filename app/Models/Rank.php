<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_details', 'rank_id', 'department_id');
    }
}
