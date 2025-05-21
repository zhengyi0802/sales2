<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paytype extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'name',
        'total',
        'prepay',
        'shipping',
        'staging',
        'remain',
    ];

    public function Promotion()
    {
        return $this->hasMany(HpPromotion::class, 'paytype_id');
    }

    public function Product()
    {
        return $this->hasMany(HpProduct::class, 'paytype_id');
    }

}
