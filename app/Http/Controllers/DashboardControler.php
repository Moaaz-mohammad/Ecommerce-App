<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardControler extends Controller
{
    public function customersIndex() {
        $users = User::orderBy('email_verified_at','DESC')->get();
        return view('dashboard.customer.index', compact('users'));
    }
}
