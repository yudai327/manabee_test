<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;

class ManageItemController extends Controller
{
    function showItemList()
    {
        $item_list = Item::orderBy("id", "asc")->paginate(10);
        return view("admin.item.item_list", [
            "item_list" => $item_list
        ]);
    }
    function showItemDetail($id)
    {
        $item = Item::findOrFail($id);

        return view("admin.item.item_detail", compact('item'));
    }



}
