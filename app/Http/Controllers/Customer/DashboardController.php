<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $ads = Ad::with('category')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('customer.dashboard', compact('ads'));
    }
}
