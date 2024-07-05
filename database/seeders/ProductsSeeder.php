<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $today = date('Y-m-d H:i:s');
        $dataArr = [
            ['name'=> 'Book', 'image_url'=>"", 'created_at'=>$today, 'updated_at'=>$today],
            ['name'=> 'Pen', 'image_url'=>"", 'created_at'=>$today, 'updated_at'=>$today],
            ['name'=> 'Ball', 'image_url'=>"", 'created_at'=>$today, 'updated_at'=>$today],
            ['name'=> 'Bat', 'image_url'=>"", 'created_at'=>$today, 'updated_at'=>$today],
            ['name'=> 'Clothes', 'image_url'=>"", 'created_at'=>$today, 'updated_at'=>$today],
            ['name'=> 'Charger', 'image_url'=>"", 'created_at'=>$today, 'updated_at'=>$today],
            ['name'=> 'Laptop', 'image_url'=>"", 'created_at'=>$today, 'updated_at'=>$today],
            ['name'=> 'Mobile', 'image_url'=>"", 'created_at'=>$today, 'updated_at'=>$today],
            ['name'=> 'Bag', 'image_url'=>"", 'created_at'=>$today, 'updated_at'=>$today],
            ['name'=> 'Cycle', 'image_url'=>"", 'created_at'=>$today, 'updated_at'=>$today],
        ];
        Products::insert($dataArr);
    }
}
