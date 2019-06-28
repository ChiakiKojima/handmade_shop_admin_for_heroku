<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'description', 'price', 'available', 'image'];
    
    // ３桁カンマにするアクセッサ　bladeで　comma_　をつける
    public function getCommaPriceAttribute() {

        return number_format($this->price);

    }
}
