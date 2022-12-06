<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;


    protected $table = 'companies';
    protected $fillable= [
        'name','address','email','dob','type_id','created_by_user'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class,'type_id','id');
    }
}
