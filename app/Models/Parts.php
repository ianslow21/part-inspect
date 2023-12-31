<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parts extends Model
{
    use HasFactory;

    protected $table = 'parts';
    protected $fillable = ['part_number','part_name','supplier','dimension','judgement','foto'];
}