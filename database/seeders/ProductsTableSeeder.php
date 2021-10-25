<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = [
            [
                'name' => 'Paket Lengkap Brightening Series',
                'price' => '185000',
                'slug' => 'paket-lengkap-brightening-series',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Lengkap Brightening Basic',
                'price' => '185000',
                'slug' => 'paket-lengkap-brightening-basic',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Hemat Brightening Series',
                'price' => '148500',
                'slug' => 'paket-hemat-brightening-series',
                'stock' => 0,
                'type_pembelian' => 2,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Hemat Brightening Basic',
                'price' => '148500',
                'slug' => 'paket-hemat-brightening-basic',
                'stock' => 0,
                'type_pembelian' => 2,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Day Cream',
                'price' => '51000',
                'slug' => 'day-cream',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Night Cream',
                'price' => '56000',
                'slug' => 'night-cream',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Facial Wash',
                'price' => '51000',
                'slug' => 'facial-wash',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Toner',
                'price' => '45000',
                'slug' => 'toner',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Jelly Whitening',
                'price' => '39000',
                'slug' => 'jelly-whitening',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Serum Vit C',
                'price' => '45000',
                'slug' => 'serum-vit-c',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Acne',
                'price' => '170500',
                'slug' => 'paket-acne',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Day Cream Acne',
                'price' => '45000',
                'slug' => 'day-cream-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Night Cream Acne',
                'price' => '62000',
                'slug' => 'night-cream-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Facial Wash Acne',
                'price' => '51000',
                'slug' => 'facial-wash-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Toner Acne',
                'price' => '51000',
                'slug' => 'toner-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Ultimate With Fleksol',
                'price' => '170500',
                'slug' => 'paket-ultimate-with-fleksol',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Ultimate Series',
                'price' => '170500',
                'slug' => 'paket-ultimate-series',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Day Cream Ultimate',
                'price' => '40000',
                'slug' => 'day-cream-ultimate',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Night Cream Ultimate',
                'price' => '62000',
                'slug' => 'night-cream-ultimate',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Facial Wash Ultimate',
                'price' => '51000',
                'slug' => 'facial-wash-ultimate',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Fleksol',
                'price' => '51000',
                'slug' => 'fleksol',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Beauty Body',
                'price' => '104000',
                'slug' => 'paket-beauty-body',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Body Serum',
                'price' => '70000',
                'slug' => 'body-serum',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Body Scrub',
                'price' => '45000',
                'slug' => 'body-scrub',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Collagen',
                'price' => '80000',
                'slug' => 'collagen',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];

        Product::insert($product);
    }
}
