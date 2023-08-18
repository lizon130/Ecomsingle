<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $pending_orders = order::where('status', 'pending')->latest()->get();
        return view('admin.pendingorder', compact('pending_orders'));
    }
}
