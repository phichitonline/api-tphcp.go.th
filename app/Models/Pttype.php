<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pttype extends Model
{
    use HasFactory;

    protected $connection= 'mysql_his';

    protected $table = 'pttype';

    protected $fillable = [];
}
