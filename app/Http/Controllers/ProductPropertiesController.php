<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductPropertiesRequest;
use App\Http\Requests\UpdateProductPropertiesRequest;
use App\Models\ProductProperties;

class ProductPropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductPropertiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductPropertiesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductProperties  $productProperties
     * @return \Illuminate\Http\Response
     */
    public function show(ProductProperties $productProperties)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductProperties  $productProperties
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductProperties $productProperties)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductPropertiesRequest  $request
     * @param  \App\Models\ProductProperties  $productProperties
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductPropertiesRequest $request, ProductProperties $productProperties)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductProperties  $productProperties
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductProperties $productProperties)
    {
        //
    }
}
