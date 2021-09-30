<?php

namespace Database\Seeders;

use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $position = [
            [
                'name' => 'General Manager',
                'slug' => 'general-manager',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Kadiv Oprasional',
                'slug' => 'kadiv-oprasional',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Kadiv Creator',
                'slug' => 'kadiv-creator',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Kadiv Klinik',
                'slug' => 'kadiv-klinik',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'SDM',
                'slug' => 'sdm',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Admin Order',
                'slug' => 'admin-order',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Kabag Gudang',
                'slug' => 'kabag-gudang',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Packaging',
                'slug' => 'packaging',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Design Grafis',
                'slug' => 'design-grafis',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Editor',
                'slug' => 'editor',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Leader CS',
                'slug' => 'leader-cs',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'ADV',
                'slug' => 'adv',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Customer Sales',
                'slug' => 'customer-sales',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Customer Sales MP',
                'slug' => 'customer-sales-mp',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Admin Klinik',
                'slug' => 'admin-klinik',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Terapi',
                'slug' => 'terapi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];

        Position::insert($position);
    }
}
