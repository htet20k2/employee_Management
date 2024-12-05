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
        return $this->belongsTo(Branch::class, 'branch_details','branch_id');
    }

    public function rank()
{
    return $this->belongsToMany(Rank::class, 'department_details','rank_id');
}

}