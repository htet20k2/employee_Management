<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['department_name'];

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_details');
    }
}
