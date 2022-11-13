<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();

        $data = [
            [
                'name' => 'Samsung Galexy S21',
                'slug' => 'Samsung-Galexy-S21',
                'description' => 'About Samsung Galexy S21 Description',
                'price' => '24900.00',
                'image' => 'https://via.placeholder.com/800x600.png/008876?text=samsung',
                'user_id' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        Product::insert($data);

        Product::factory(4999)->create();

    }
}
