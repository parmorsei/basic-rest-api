<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
   
    public function index() {
            
        $items = new Item();
        $items->name = 'test';
        $items->description = 'test';
        $items->save();
        
        return view('welcome');
        
    }
}
