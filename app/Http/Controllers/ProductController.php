<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Interfaces\Catalog\FilterInterface;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): Response
    {
        try {
            $limit = $request->get('limit') ?? 15;
            return $this->success(
                new ProductCollection(
                    Product::paginate($limit)
                )
            );
        } catch (\Exception $ex) {
            return $this->error($ex->getMessage());
        }
    }

    public function filteredList(Request $request, FilterInterface $catalogFilter , $filter): Response
    {
        try {
            $limit = $request->get('limit') ?? 15;
            $page = $request->get('page') ?? 1;
            return $this->success(
                new ProductCollection(
                    $catalogFilter->processFilter(
                        $filter,
                        Product::limit($limit)->offset($limit * ($page - 1))
                    )
                )
            );
        } catch (\Exception $ex) {
            return $this->error($ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            return $this->success(Product::create($request->toArray()));
        } catch (\Exception $ex) {
            return $this->error($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return Product::find($id)->update($request->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Product::destroy($id);
    }
}
