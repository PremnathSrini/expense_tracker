<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Food'],
            ['name' => 'Entertainment'],
            ['name' => 'Transportation'],
            ['name' => 'Housing'],
            ['name' => 'Health-Care'],
            ['name' => 'Personal-Care'],
            ['name' => 'Education'],
            ['name' => 'Savings / Investments'],
            ['name' => 'Debt / Loans'],
            ['name' => 'Gifts / Donations'],
            ['name' => 'Tax'],
            ['name' => 'Emergency'],
            ['name' => 'Others'],
        ]);
    }
}
