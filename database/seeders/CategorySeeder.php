<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $datas = ['comic', 'fiksi', 'mysteri', 'romance', 'action', 'fantasy'];
        foreach ($datas as $data) {
            Category::insert([
                'name' => $data,
            ]);
        }
    }
}
