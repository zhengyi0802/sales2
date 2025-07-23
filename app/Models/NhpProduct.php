<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhpProduct extends Model
{
    use HasFactory;

    protected $connection = 'sales2';

    protected $fillable = [
        'project_id',
        'product_id',
        'price',
        'saleses',
        'status',
        'created_by',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

    public function resellers()
    {
        return json_decode($this->saleses);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
