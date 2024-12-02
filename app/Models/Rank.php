<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    /** @use HasFactory<\Database\Factories\RankFactory> */
    use HasFactory;

    protected $fillable = ['name', 'rank'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
}
