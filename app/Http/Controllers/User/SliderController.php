<?php

namespace App\Http\Controllers\User;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Rules\IsImage;

class SliderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('user.slider.index', [
            'slider' => Slider::typeSlider()->paginate(6),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.slider.create', [
            'slider' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $dataValidate = $request->validate([
            // 'title' => 'required|string|max:50',
            'image' => ['required', new IsImage],
            'description' => 'required|string|max:180',
            'link'       => 'max:100',
            'created_at' => 'timestamp',
            'type' => 'required|integer',
        ]);

        $imageData = Slider::parsePhoto($request->image);

        $path = $imageData['path'];
        $base64 = $imageData['base64'];

        Storage::disk('public')->put( $path, base64_decode($base64) );

        $slider = Slider::create([
            // 'title' => $request->title,
            'image' => $path,
            'description' => $request->description,
            'link'       => $request->link,
            'type' => $request->type,
        ]);

        return redirect()->route('user.slider.show', $slider);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Block  $emploee
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return view('user.slider.show', [
            'slider' => $slider,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('user.slider.edit', [
            'slider' => $slider,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Block  $emploee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {

        $dataValidate = $request->validate([
            // 'title' => 'required|string|max:50',
            'image' => ['nullable', new IsImage],
            'description' => 'required|string|max:200',
            'link'       => 'max:100',
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
            'type' => 'required|integer',
        ]);
        
        if ($request->image) {
            $dataImg = Slider::parsePhoto($request->image);
            $path = $dataImg['path'];
            $base64 = $dataImg['base64'];
            Storage::disk('public')->put( $path, base64_decode($base64) );

            if (Storage::disk('public')->exists($slider->image) )  {
                Storage::disk('public')->delete($slider->image);
            }
        } else {
            $path = $slider->image;
        }

        $slider->update([
            // 'title' => $request->title,
            'image' => $path,
            'description' => $request->description,
            'link' => $request->link,
            'type' => $request->type,
        ]);
        
        return redirect()->route('user.slider.show', $slider);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Block  $emploee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if (Storage::disk('public')->exists($slider->image) ) {
            Storage::disk('public')->delete($slider->image);
        }
        $slider->delete();

        return redirect()->route('user.slider.index');
    }
}
