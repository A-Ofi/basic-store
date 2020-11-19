<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemForm;
use App\Models\Item;

class ItemAdminController extends Controller
{
    public function update(ItemForm $request, Item $item){
        $item->fill($request->validated())->save();
        return redirect()->route('item', [$item]);
    }

    public function create(ItemForm $request){
        $item = new Item();
        $item->fill($request->validated());
        $item->user_id = $request->input(('user_id'));
        $item->save();
        return redirect()->route('item', [$item]);
    }
}
