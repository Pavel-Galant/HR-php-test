<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['client_email', 'status', 'partner_id'];
    const STATUS_NEW = 0;
	const STATUS_CONFIRMED = 10;
	const STATUS_CLOSED = 20;
    
    public static function getStatuses()
    {
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_CONFIRMED => 'Подтвержден',
            self::STATUS_CLOSED => 'Завершен'
        ];
    }
    
    protected $appends = ['status_title'];
    
    public function getStatusTitleAttribute()
    {
        return self::getStatuses()[$this->status];
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function products()
    {
        //return $this->hasMany(OrderProduct::class);
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')
            ->withPivot('quantity', 'price')
            ->as('extra');
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status)
            ->with(
                'partner', 
                'products',
                'products.vendor'
            );
    }
}
