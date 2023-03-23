<?php

namespace App\Controllers;

use App\Filters\AuthFilter;
use App\Models\Item;

class Home extends BaseController
{

    public function index()
    {
        $items = new Item();
        $data['items'] = $items->findAll();
        return view('welcome_message',$data);
    }


}
