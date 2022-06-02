<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mainSectionId = DB::table(
            'product_sections'
        )->where('code', '=', 'main')
            ->get(['id'])->first()->id;
        $secondaryFirstSectionId = DB::table(
            'product_sections'
        )->where('code', '=', 'secondary_first')
            ->get(['id'])->first()->id;
        Product::factory()->count(10)->state(
            new Sequence(
                [
                    'product_section_id' => $mainSectionId
                ],
                [
                    'product_section_id' => $secondaryFirstSectionId
                ],
                ['product_section_id' => null],
            )
        )->create();
    }
}
