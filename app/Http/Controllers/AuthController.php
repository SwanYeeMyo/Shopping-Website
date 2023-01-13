<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            $category = Category::all();
            $products = Product::all();
            $users = User::where('role', 'user')->get();
            return \redirect()->route('dashboard');

        } else {
            return \redirect()->route('user#home');
        }
    }
}
