<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index()
    {
        $title = 'Order Barang';
        return view('logistik.order', compact('title'));
    }
}
