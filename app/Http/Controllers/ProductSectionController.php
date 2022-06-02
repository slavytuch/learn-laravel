<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductSectionResource;
use App\Models\ProductSection;
use Illuminate\Support\Facades\Log;

class ProductSectionController extends Controller
{
    public function getSection($id)
    {
        Log::info('getting section', ['secton id' => $id]);
        return new ProductSectionResource(ProductSection::find($id));
    }

    public function getSectionList()
    {
        $collection = ProductSectionResource::collection(ProductSection::all()->whereNull('product_section_id'));
        Log::info('getting section list', ['section list' => $collection]);
        return $collection;
    }
}
