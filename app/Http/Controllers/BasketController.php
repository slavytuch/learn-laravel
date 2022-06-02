<?php

namespace App\Http\Controllers;

use App\Http\Resources\BasketResource;
use App\Models\Basket;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success(
            BasketResource::collection(
                Basket::where('user_id', auth()->user()->id)->get()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentUserBasket = Basket::where('user_id', auth()->user()->id)->get(
        )->first();
        /*if(!$currentUserBasket) {
            $currentUserBasket = new Basket(['user_id' => auth()->user()->id]);
        }*/

        $productId = $request->toArray()['product_id'];

        if (!$basketItem = $currentUserBasket->products->firstWhere(
            'id',
            $productId
        )) {
            return $this->success(
                $currentUserBasket->products()->attach(
                    [$productId => ['quantity' => 1]]
                )
            );
        }

        $currentUserBasket->products()->updateExistingPivot(
            $productId,
            ['quantity' => $basketItem->pivot->quantity + 1]
        );

        return $this->success($basketItem);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function show(Basket $basket)
    {
        return $this->success($basket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Basket $basket)
    {
        return $this->success($basket->update($request->toArray()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Basket $basket)
    {
        $basket->products()->detach();
        return $this->success($basket->delete());
    }
}
