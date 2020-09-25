<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Currency extends Controller
{
    function changeCurrency(Request $Req){
        $Req->validate([
            'currency' => 'required',
        ]);

        setcookie('curr',$Req->currency,'/','/');
        return redirect('/');
    }
}
