<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;
use Illuminate\Support\Facades\DB; 

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        Material::truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            
            ['category' => 'tipe_rumah', 'name' => 'Tipe 30/60', 'price' => 540000000, 'multiplier' => 1.0],
            ['category' => 'tipe_rumah', 'name' => 'Tipe 40/72', 'price' => 720000000, 'multiplier' => 1.3],
            ['category' => 'tipe_rumah', 'name' => 'Tipe 45/85', 'price' => 810000000, 'multiplier' => 1.5],

            ['category' => 'pondasi', 'name' => 'Batu Kali', 'price' => 12000000, 'multiplier' => 1.0],
            ['category' => 'pondasi', 'name' => 'Cakar Ayam', 'price' => 10200000, 'multiplier' => 1.0],
            ['category' => 'pondasi', 'name' => 'Plat Jalur', 'price' => 12500000, 'multiplier' => 1.0],
            ['category' => 'pondasi', 'name' => 'Pondasi Rollag', 'price' => 7200000, 'multiplier' => 1.0],

            ['category' => 'dinding', 'name' => 'Batako', 'price' => 15000000, 'multiplier' => 1.0],
            ['category' => 'dinding', 'name' => 'Bata Ringan (Hebel)', 'price' => 20000000, 'multiplier' => 1.0],
            ['category' => 'dinding', 'name' => 'Bata Merah', 'price' => 25000000, 'multiplier' => 1.0],

            ['category' => 'lantai', 'name' => 'Keramik 60x60', 'price' => 6000000, 'multiplier' => 1.0],
            ['category' => 'lantai', 'name' => 'Granit 60x60', 'price' => 13500000, 'multiplier' => 1.0],
            ['category' => 'lantai', 'name' => 'Marmer', 'price' => 75000000, 'multiplier' => 1.0],
            ['category' => 'lantai', 'name' => 'Batu Alam', 'price' => 12000000, 'multiplier' => 1.0],

            ['category' => 'kaso_reng', 'name' => 'Kaso Kayu', 'price' => 11500000, 'multiplier' => 1.0],
            ['category' => 'kaso_reng', 'name' => 'Kanal Baja Ringan', 'price' => 17500000, 'multiplier' => 1.0],

            ['category' => 'genteng', 'name' => 'Genteng Tanah', 'price' => 22500000, 'multiplier' => 1.0],
            ['category' => 'genteng', 'name' => 'Metal Roof', 'price' => 10000000, 'multiplier' => 1.0],
            ['category' => 'genteng', 'name' => 'Spandek', 'price' => 7500000, 'multiplier' => 1.0],
            ['category' => 'genteng', 'name' => 'Genteng Onduvila', 'price' => 15000000, 'multiplier' => 1.0],
            ['category' => 'genteng', 'name' => 'Genteng Keramik', 'price' => 22500000, 'multiplier' => 1.0],
           
            ['category' => 'plafon', 'name' => 'Triplek', 'price' => 8500000, 'multiplier' => 1.0],
            ['category' => 'plafon', 'name' => 'Gipsum', 'price' => 5250000, 'multiplier' => 1.0],
            ['category' => 'plafon', 'name' => 'GRC', 'price' => 5600000, 'multiplier' => 1.0],
            ['category' => 'plafon', 'name' => 'PVC', 'price' => 14000000, 'multiplier' => 1.0],

            ['category' => 'pintu_jendela', 'name' => 'Kayu Meranti', 'price' => 15000000, 'multiplier' => 1.0],
            ['category' => 'pintu_jendela', 'name' => 'Kayu Jati', 'price' => 45000000, 'multiplier' => 1.0],
            ['category' => 'pintu_jendela', 'name' => 'Aluminium', 'price' => 2500000, 'multiplier' => 1.0],

            ['category' => 'listrik', 'name' => '900 Watt', 'price' => 4500000, 'multiplier' => 1.0],
            ['category' => 'listrik', 'name' => '1300 Watt', 'price' => 5500000, 'multiplier' => 1.0],
            ['category' => 'listrik', 'name' => '2200 Watt', 'price' => 7500000, 'multiplier' => 1.0],

            ['category' => 'pagar', 'name' => 'Hollow Hitam', 'price' => 15000000, 'multiplier' => 1.0],
            ['category' => 'pagar', 'name' => 'Hollow Stainless steel', 'price' => 28000000, 'multiplier' => 1.0],
            ['category' => 'pagar', 'name' => 'Hollow Galvanis', 'price' => 25000000, 'multiplier' => 1.0],

            ['category' => 'warna', 'name' => 'Putih (White)', 'price' => 11200000, 'multiplier' => 1.0],
            ['category' => 'warna', 'name' => 'Abu-abu (Grey)', 'price' => 11200000, 'multiplier' => 1.0],
            ['category' => 'warna', 'name' => 'Krem (Cream)', 'price' => 11200000, 'multiplier' => 1.0],
            ['category' => 'warna', 'name' => 'Biru Langit (Soft Blue)', 'price' => 11200000, 'multiplier' => 1.0],
            ['category' => 'warna', 'name' => 'Hijau Muda (Soft Green)', 'price' => 11200000, 'multiplier' => 1.0],
            ['category' => 'warna', 'name' => 'Merah Hati (Maroon)', 'price' => 11200000, 'multiplier' => 1.0],
            ['category' => 'warna', 'name' => 'Kuning Gading (Ivory)', 'price' => 11200000, 'multiplier' => 1.0],
            ['category' => 'warna', 'name' => 'Coklat Muda (Beige)', 'price' => 11200000, 'multiplier' => 1.0],
        ];

        foreach ($data as $item) {
            Material::create($item);
        }
    }
}