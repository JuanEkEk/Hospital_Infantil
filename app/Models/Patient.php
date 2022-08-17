<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    protected $primaryKey = 'id';
    public $fillable = [
        'full_name',
        'age',
        'sex',
        'birth_date',
        'origin_city',
        'inscription_date',
        'origin_hospital',
        'tutor',
        'tutor_telephone'
    ];
}
