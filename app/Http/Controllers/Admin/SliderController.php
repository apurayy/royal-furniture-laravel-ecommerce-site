<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->paginate(20);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $image = $this->uploadImage($request->file('image'));

        Slider::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $image,
            'link' => $request->link,
            'button_text' => $request->button_text,
            'status' => $request->status,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $image = $slider->image;
        if ($request->hasFile('image')) {
            if ($slider->image) {
                File::delete(public_path('uploads/' . $slider->image));
            }
            $image = $this->uploadImage($request->file('image'));
        }

        $slider->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $image,
            'link' => $request->link,
            'button_text' => $request->button_text,
            'status' => $request->status,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image) {
            File::delete(public_path('uploads/' . $slider->image));
        }
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully.');
    }

    private function uploadImage($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        return $filename;
    }
}
