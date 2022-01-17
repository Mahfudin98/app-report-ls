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
            // shopee
            [
                'name' => 'Paket Lengkap Brightening Series',
                'price' => '185000',
                'weight' => 330,
                'slug' => 'paket-lengkap-brightening-series',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Lengkap Brightening Basic',
                'price' => '185000',
                'weight' => 330,
                'slug' => 'paket-lengkap-brightening-basic',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Hemat Brightening Series',
                'price' => '148500',
                'weight' => 250,
                'slug' => 'paket-hemat-brightening-series',
                'stock' => 0,
                'type_pembelian' => 2,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Hemat Brightening Basic',
                'price' => '148500',
                'weight' => 250,
                'slug' => 'paket-hemat-brightening-basic',
                'stock' => 0,
                'type_pembelian' => 2,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Day Cream',
                'price' => '51000',
                'weight' => 33,
                'slug' => 'day-cream',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Night Cream',
                'price' => '56000',
                'weight' => 33,
                'slug' => 'night-cream',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Facial Wash',
                'price' => '51000',
                'weight' => 125,
                'slug' => 'facial-wash',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Toner',
                'price' => '45000',
                'weight' => 83,
                'slug' => 'toner',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Jelly Whitening',
                'price' => '39000',
                'weight' => 29,
                'slug' => 'jelly-whitening',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Serum Vit C',
                'price' => '45000',
                'weight' => 33,
                'slug' => 'serum-vit-c',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Acne',
                'price' => '170500',
                'weight' => 330,
                'slug' => 'paket-acne',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Day Cream Acne',
                'price' => '45000',
                'weight' => 33,
                'slug' => 'day-cream-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Night Cream Acne',
                'price' => '62000',
                'weight' => 33,
                'slug' => 'night-cream-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Facial Wash Acne',
                'price' => '51000',
                'weight' => 125,
                'slug' => 'facial-wash-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Toner Acne',
                'price' => '51000',
                'weight' => 83,
                'slug' => 'toner-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Ultimate With Fleksol',
                'price' => '170500',
                'weight' => 330,
                'slug' => 'paket-ultimate-with-fleksol',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 1,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Ultimate Series',
                'price' => '170500',
                'weight' => 330,
                'slug' => 'paket-ultimate-series',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 1,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Day Cream Ultimate',
                'price' => '40000',
                'weight' => 33,
                'slug' => 'day-cream-ultimate',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Night Cream Ultimate',
                'price' => '62000',
                'weight' => 33,
                'slug' => 'night-cream-ultimate',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Facial Wash Ultimate',
                'price' => '51000',
                'weight' => 125,
                'slug' => 'facial-wash-ultimate',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Fleksol',
                'price' => '51000',
                'weight' => 330,
                'slug' => 'fleksol',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Beauty Body',
                'price' => '104000',
                'weight' => 330,
                'slug' => 'paket-beauty-body',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 1,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Body Serum',
                'price' => '70000',
                'weight' => 330,
                'slug' => 'body-serum',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Body Scrub',
                'price' => '45000',
                'weight' => 330,
                'slug' => 'body-scrub',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Collagen',
                'price' => '80000',
                'weight' => 150,
                'slug' => 'collagen',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Shopee',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            // lazada
            [
                'name' => 'Paket Lengkap Brightening Series',
                'price' => '185000',
                'weight' => 330,
                'slug' => 'paket-lengkap-brightening-series',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Lengkap Brightening Basic',
                'price' => '185000',
                'weight' => 330,
                'slug' => 'paket-lengkap-brightening-basic',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Hemat Brightening Series',
                'price' => '148500',
                'weight' => 250,
                'slug' => 'paket-hemat-brightening-series',
                'stock' => 0,
                'type_pembelian' => 2,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Hemat Brightening Basic',
                'price' => '148500',
                'weight' => 250,
                'slug' => 'paket-hemat-brightening-basic',
                'stock' => 0,
                'type_pembelian' => 2,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Day Cream',
                'price' => '51000',
                'weight' => 33,
                'slug' => 'day-cream',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Night Cream',
                'price' => '56000',
                'weight' => 33,
                'slug' => 'night-cream',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Facial Wash',
                'price' => '51000',
                'weight' => 125,
                'slug' => 'facial-wash',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Toner',
                'price' => '45000',
                'weight' => 83,
                'slug' => 'toner',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Jelly Whitening',
                'price' => '39000',
                'weight' => 29,
                'slug' => 'jelly-whitening',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Serum Vit C',
                'price' => '45000',
                'weight' => 33,
                'slug' => 'serum-vit-c',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Acne',
                'price' => '170500',
                'weight' => 330,
                'slug' => 'paket-acne',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Day Cream Acne',
                'price' => '45000',
                'weight' => 33,
                'slug' => 'day-cream-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Night Cream Acne',
                'price' => '62000',
                'weight' => 33,
                'slug' => 'night-cream-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Facial Wash Acne',
                'price' => '51000',
                'weight' => 125,
                'slug' => 'facial-wash-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Toner Acne',
                'price' => '51000',
                'weight' => 83,
                'slug' => 'toner-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Ultimate With Fleksol',
                'price' => '170500',
                'weight' => 330,
                'slug' => 'paket-ultimate-with-fleksol',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 1,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Ultimate Series',
                'price' => '170500',
                'weight' => 330,
                'slug' => 'paket-ultimate-series',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 1,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Day Cream Ultimate',
                'price' => '40000',
                'weight' => 33,
                'slug' => 'day-cream-ultimate',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Night Cream Ultimate',
                'price' => '62000',
                'weight' => 33,
                'slug' => 'night-cream-ultimate',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Facial Wash Ultimate',
                'price' => '51000',
                'weight' => 125,
                'slug' => 'facial-wash-ultimate',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Fleksol',
                'price' => '51000',
                'weight' => 330,
                'slug' => 'fleksol',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Beauty Body',
                'price' => '104000',
                'weight' => 330,
                'slug' => 'paket-beauty-body',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 1,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Body Serum',
                'price' => '70000',
                'weight' => 330,
                'slug' => 'body-serum',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Body Scrub',
                'price' => '45000',
                'weight' => 330,
                'slug' => 'body-scrub',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Collagen',
                'price' => '80000',
                'weight' => 150,
                'slug' => 'collagen',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Lazada',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            // Iklan Adv
            [
                'name' => 'Paket Lengkap Brightening Series',
                'price' => '185000',
                'weight' => 330,
                'slug' => 'paket-lengkap-brightening-series',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Lengkap Brightening Basic',
                'price' => '185000',
                'weight' => 330,
                'slug' => 'paket-lengkap-brightening-basic',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Hemat Brightening Series',
                'price' => '148500',
                'weight' => 250,
                'slug' => 'paket-hemat-brightening-series',
                'stock' => 0,
                'type_pembelian' => 2,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Hemat Brightening Basic',
                'price' => '148500',
                'weight' => 250,
                'slug' => 'paket-hemat-brightening-basic',
                'stock' => 0,
                'type_pembelian' => 2,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Day Cream',
                'price' => '51000',
                'weight' => 33,
                'slug' => 'day-cream',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Night Cream',
                'price' => '56000',
                'weight' => 33,
                'slug' => 'night-cream',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Facial Wash',
                'price' => '51000',
                'weight' => 125,
                'slug' => 'facial-wash',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Toner',
                'price' => '45000',
                'weight' => 83,
                'slug' => 'toner',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Jelly Whitening',
                'price' => '39000',
                'weight' => 29,
                'slug' => 'jelly-whitening',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Serum Vit C',
                'price' => '45000',
                'weight' => 33,
                'slug' => 'serum-vit-c',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Acne',
                'price' => '170500',
                'weight' => 330,
                'slug' => 'paket-acne',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Day Cream Acne',
                'price' => '45000',
                'weight' => 33,
                'slug' => 'day-cream-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Night Cream Acne',
                'price' => '62000',
                'weight' => 33,
                'slug' => 'night-cream-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Facial Wash Acne',
                'price' => '51000',
                'weight' => 125,
                'slug' => 'facial-wash-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Toner Acne',
                'price' => '51000',
                'weight' => 83,
                'slug' => 'toner-acne',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Ultimate With Fleksol',
                'price' => '170500',
                'weight' => 330,
                'slug' => 'paket-ultimate-with-fleksol',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 1,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Ultimate Series',
                'price' => '170500',
                'weight' => 330,
                'slug' => 'paket-ultimate-series',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 1,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Day Cream Ultimate',
                'price' => '40000',
                'weight' => 33,
                'slug' => 'day-cream-ultimate',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Night Cream Ultimate',
                'price' => '62000',
                'weight' => 33,
                'slug' => 'night-cream-ultimate',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Facial Wash Ultimate',
                'price' => '51000',
                'weight' => 125,
                'slug' => 'facial-wash-ultimate',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Fleksol',
                'price' => '51000',
                'weight' => 330,
                'slug' => 'fleksol',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paket Beauty Body',
                'price' => '104000',
                'weight' => 330,
                'slug' => 'paket-beauty-body',
                'stock' => 0,
                'type_pembelian' => 1,
                'type_product' => 1,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Body Serum',
                'price' => '70000',
                'weight' => 330,
                'slug' => 'body-serum',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Body Scrub',
                'price' => '45000',
                'weight' => 330,
                'slug' => 'body-scrub',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 1,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Collagen',
                'price' => '80000',
                'weight' => 150,
                'slug' => 'collagen',
                'stock' => 0,
                'type_pembelian' => 0,
                'type_product' => 0,
                'origin_order' => 'Iklan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];

        Product::insert($product);
    }
}
