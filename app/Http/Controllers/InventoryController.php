<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    //fetching data and showing in inventory page
    public function showProducts(){
        $products=Inventory::all();
        return view('admin.inventory',compact('products'));
    }
    //inserting data in db
    public function insert(request $request){
      Inventory::create($request->all());
      return redirect()->route('fetch.inventory');
    } 
    public function update(Request $request,$id){
       $product= Inventory::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('fetch.inventory');
    }
}
