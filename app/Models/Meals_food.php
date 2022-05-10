<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Meals_food  extends Authenticatable implements JWTSubject
{
    protected $table = 'meals_food';

    protected $fillable = [
        'meals_food_id',
        'meal_id',
        'food_id',
        'quantity_weight',
        'quantity_str'
    ];
    use HasFactory;


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
