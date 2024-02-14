<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status',1)->latest()->get();
        return inertia('Frontend/Index',compact('sliders'));
    }
}
