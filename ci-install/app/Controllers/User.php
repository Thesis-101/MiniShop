<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function index()
    {
        $userData['avatar'] = session()->get('avatar');
        return view('user/profile',$userData);
    }
}
