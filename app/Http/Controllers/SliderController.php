<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliderData = Slider::latest()->get();
        return view('admin.pages.sliderlist', compact('sliderData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.addslider');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:60',
            'image' => 'required|mimes:jpg,jpeg'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/slider', 'public');
        } else {
            return back()->with('error', 'Image upload failed!');
        }

        Slider::create([
            'title' => $request->title,
            'image' => $path
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider Image & Title Add Succussfully!');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $updateSlider = Slider::findOrFail($id);
        return view('admin.pages.sliderupdate', compact('updateSlider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:60',
            'image' => 'nullable|mimes:jpg,jpeg'
        ]);

        // Find the post
        $update = Slider::findOrFail($id);

        // Check if new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image
            if ($update->image) {
                $filePath = public_path('storage/' . $update->image);
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
            }

            // Upload new image
            $path = $request->file('image')->store('uploads/slider', 'public');
            $update->image = $path;
        }

        // Update post data
        $update->title = $request->title;
        $update->save();

        return redirect()->route('slider.index')->with('success', 'Slider Image & Title Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        return redirect()->route('slider.index')->with('success','Slider Image & Title Deleted Successfully');
    }
}
