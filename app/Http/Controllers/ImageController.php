<?php

namespace App\Http\Controllers;

use App\Models\image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    public function index()
    {
        return view('imageupload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required| Image |mimes:jpeg,png,gif,svg|max:2048',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        image::create(['name' => $imageName]);
        return response()->json('image upload successfully');
    }
}
