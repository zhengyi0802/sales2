<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassOrder extends Model
{
    use HasFactory;

    protected $connection = 'sales2';

    protected $fillable = [
        'id',
        'cname',
        'phone',
        'line_id',
        'email',
        'address',
        'cid',
        'invoice',
        'products',
        'price',
        'tax',
        'total',
        'memo',
        'mark',
        'flow',
        'order_date',
        'process_date',
        'outbound_date',
        'arrived_date',
        'status',
        'created_by',
    ];

    function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    function items() {
        $array = json_decode($this->products);
        $items = array();
        $i = 0;
        foreach($array as $item) {
            $product = ProductModel::find($item->product_id);
            $aitem = [
                   'index'        => ++$i,
                   'product_id'   => $item->product_id,
                   'product'      => $product->name.'('.$product->model.')',
                   'amount'       => $item->amount,
                   'single_price' => $item->single_price,
                   'price'        => $item->price,
            ];
            $citem = collect($aitem);
            array_push($items, $citem);
        }
        return $items;
    }
}
