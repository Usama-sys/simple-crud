<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';
    protected $fillable= [
        'type_name'
    ];

    // public function company(){
    //     return $this->hasOne(Company::class,'type_id');
    // }
}
