<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id']; // Izinkan semua kolom diisi kecuali ID

    // Relasi: Satu Order punya banyak detail material
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
