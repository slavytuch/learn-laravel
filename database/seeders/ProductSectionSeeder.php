<?php

namespace Database\Seeders;

use App\Models\ProductSection;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_sections')->insert([
            'name' => 'Main',
            'code' => 'main',
            'created_at' => Carbon::now()
        ]);
        DB::table('product_sections')->insert([
            'name' => 'Secondary First',
            'product_section_id' => DB::table('product_sections')
                ->where('code', '=', 'main')->get(['id'])->first()->id,
            'code' => 'secondary_first',
            'created_at' => Carbon::now()
        ]);
        DB::table('product_sections')->insert([
            'name' => 'Secondary Second',
            'product_section_id' => DB::table('product_sections')
                ->where('code', '=', 'main')->get(['id'])->first()->id,
            'code' => 'secondary_second',
            'created_at' => Carbon::now()
        ]);
    }
}
