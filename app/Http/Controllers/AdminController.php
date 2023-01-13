<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //dashboard
    public function dashboard(Request $request)
    {

        if (Auth::user()->role == 'admin') {
            $category = Category::all();
            $products = Product::all();
            $orders = Order::all();
            $users = User::where('role', 'user')->get();
            return view('admin.Dashboard.dashboard', compact('category', 'products', 'users', 'orders'));

        } else {
            return \redirect()->route('user#home');
        }

    }
    public function index(Request $request)
    {
        $admin = User::where('id', Auth::user()->id)->first();
        return view('admin.Dashboard.admin');
    }
    public function update(Request $request)
    {
        \logger($request->all());

        $data = $this->getRequestData($request);
        if ($request->hasFile('image')) {
            if (Auth::user()->image == null) {
                $fileName = uniqid() . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public', $fileName);
                $data['image'] = $fileName;
                User::where('id', Auth::user()->id)->update($data);
                return \redirect()->route('admin#profile')->with(['success' => ' Update Success ']);

            } else {
                $dbImage = User::where('id', Auth::user()->id)->first();
                $dbImage = $dbImage->image;
                if ($dbImage != null) {
                    Storage::delete('public/' . $dbImage);
                }
                $fileName = uniqid() . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public', $fileName);
                $data['image'] = $fileName;
                User::where('id', Auth::user()->id)->update($data);
                return \redirect()->route('admin#profile')->with(['success' => ' Update Success']);

            }
        } else {
            User::where('id', Auth::user()->id)->update($data);
            return \redirect()->route('admin#profile')->with(['success' => ' Update Success']);

        }
    }
    //chgPassword
    public function changePassword(Request $request)
    {
        \logger($request->all());
        $this->getPaswordValidaiton($request);
        $currentId = Auth::user()->id;
        $oldPw = User::select('password')->where('id', $currentId)->first();
        $oldHashPw = $oldPw->password;
        $newHashPw = [
            'password' => Hash::make($request->newPassword),
        ];
        if (Hash::check($request->oldPassword, $oldHashPw)) {
            User::where('id', $currentId)->update($newHashPw);
            return \redirect()->route('dashboard')->with(['success' => 'Password Update Success']);
        } else {
            return \redirect()->route('admin#profile')->with(['success' => 'password Update Fail']);
        }

    }
    //user
    public function users()
    {
        $users = User::when(request('Key'), function ($query) {
            $searchKey = request('Key');
            $query->where('name', 'like', '%' . $searchKey . '%');
        })->where('role', 'user')->get();
        return view('admin.Dashboard.user', compact('users'));
    }
    private function getValidation($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ])->validate();
    }
    //password Validation
    private function getPaswordValidaiton($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ])->validate();

    }
    private function getRequestData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
        ];
    }
}
