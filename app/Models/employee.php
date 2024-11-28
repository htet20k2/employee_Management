<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'employee_id';
    
    protected $fillable = [
        'name',
        'phone',
        'email',
        'DOB',
        'sex',
        'NRC',
        'address',
        'township',
        'martial_status',
        'father_name',
        'mother_name',
        'race',
        'religious',
        'blood_type',
        'education',
        'other_qualification',
        'description',
        'status'
    ];

    protected $casts = [
        'DOB' => 'date',
    ];

    // Enum values for reference and validation
    public const SEX_OPTIONS = ['Male', 'Female', 'Other'];
    public const STATUS_OPTIONS = ['Active', 'Inactive', 'On Leave', 'Terminated', 'Suspended'];
    public const MARTIAL_STATUS_OPTIONS = ['Single', 'Married', 'Divorced'];
    public const BLOOD_TYPE_OPTIONS = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
}
