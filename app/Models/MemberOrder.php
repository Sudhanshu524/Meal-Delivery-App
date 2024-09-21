<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'member_id',
        'meal_id',
        'partner_id',
        'delivery_address',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function members(){
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function partners(){
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }

    public function meals(){
        return $this->belongsTo(Meal::class, 'meal_id', 'id');
    }
}
