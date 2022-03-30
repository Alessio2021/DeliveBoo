<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Dish;

class OrderController extends Controller
{
    public function index()
    {
        $restaurantOrders = Order::orderBy('created_at')->with('dishes')->whereHas('dishes', function (Builder $query) {
            $query->where('user_id', Auth::id());
        })->paginate(7);

        return view('admin.orders.index', ['restaurantOrders' => $restaurantOrders]);
    }

    public function show($id)
    {
        $restaurantOrder = Order::where('id', $id)->with('dishes')->whereHas('dishes', function (Builder $query) {
            $query->where('user_id', Auth::id());
        })->first();

        if (!empty($restaurantOrder->id)) {
            return view('admin.orders.show', ['restaurantOrder' => $restaurantOrder]);
        } else {
            return redirect()->route('admin.orders.index');
        }
    }
}
