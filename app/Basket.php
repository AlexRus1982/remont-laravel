<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    /**
     * Связь «многие ко многим» таблицы `baskets` с таблицей `products`
     */
    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
