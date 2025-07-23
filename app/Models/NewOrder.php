<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewOrder extends Model
{
    use HasFactory;

    protected $connection = 'sales';

    protected $fillable = [
        'trade_no',
        'trade_date',
        'name',
        'phone',
        'line_id',
        'email',
        'unified_number',
        'address',
        'project_id',
        'items',
        'payment_method',
        'memo',
        'total',
        'paid',
        'remain',
        'flow',
        'flow1',
        'status',
        'sales_id',
        'created_by',
    ];

    function sales() {
        return $this->belongsTo(Sales::class, 'sales_id');
    }

    function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }

    function Items() {
        return json_decode($this->items);
    }
}
