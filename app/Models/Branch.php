<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['branch_name'];
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'branch_details','branch_id','department_id');
    }





}