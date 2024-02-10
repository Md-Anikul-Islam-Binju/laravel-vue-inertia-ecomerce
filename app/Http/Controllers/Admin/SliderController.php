<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    public function index()
    {
        return inertia('Admin/Slider/Show');
    }

    public function create()
    {
        return inertia('Admin/Slider/Create');
    }


    public function store(Request $request)
    {

       $request->validate([
           'image' => 'required|file|mimes:jpg,jpeg,png'
       ]);
       $slider = new Slider();
       if($request->image)
       {
           $slider->image = $request->file('image')->store('public/images/slider');
       }
       $slider->title = $request->title;
       $slider->position = $request->position;
       $slider->save();
       return redirect()->route('slider.show');

    }
}
