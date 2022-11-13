<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
        'user_id'
    ];

    /**
     * Relationship to Users
     */
    public function users()
    {
        // การ join ตารางนี้กับตาราง users เพื่อดึงข้อมูลผู้ใช้มาใช้งาน ถ้าเอาข้อมูล users มาทั้งตารางก็ไม่ต้องมี select
        return $this->belongsTo('App\Models\User','user_id')->select(['id','fullname','avatar']);
    }

}
