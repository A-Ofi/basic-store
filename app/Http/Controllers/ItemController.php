<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemForm;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function create(ItemForm $request)
    {
        $item = new Item();
        $item->fill($request->validated());
        $item->user_id = $request->user()->id;
        $item->saveOrFail();
        $item->fresh();
        return response($item->toJson());
    }

    public function update(ItemForm $request, Item $item)
    {
        $item->fill($request->validated())->saveOrFail();
        return response($item->toJson());
    }

    public function delete(Request $request, Item $item)
    {
        return $request->user()->can('delete', $item) ?
            ($item->delete() ? 
                response(['Item Deleted'], 200)
                :
                response(['Failed'], 500)) 
            :
            response(['forbidden'], 403);
    }

    public function addToCart(Request $request, Item $item)
    {
        $user = $request->user();
        if($user->cant('addToCart', $item)){
            return response(["can't add your own item"], 400);
        }
        try{
        $request->user()->cart()->attach($item);
        }catch(Exception $e){
            return response(['Item already added in cart'], 200);
        }
        return response(['Item added to cart'], 200);
    }

    public function removeFromCart(Request $request, Item $item)
    {
        $request->user()->cart()->detach($item);
        return response(['Item deleted from cart'], 200);
    }

}
