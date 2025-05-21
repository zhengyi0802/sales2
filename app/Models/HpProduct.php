<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HpProduct extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'model_no',
        'model_name',
        'proj_id',
        'type',
        'paytype',
        'paytype_id',
        'price',
        'shipping_price',
        'prepay_price',
        'stage_price',
        'staging',
        'protfolio',
        'image_path',
        'status',
    ];

    public function promotions()
    {
        return $this->hasMany(HpPromotion::class, 'product_id');
    }

    public function Paytype()
    {
        return $this->belongsTo(Paytype::class, 'paytype_id');
    }

}
