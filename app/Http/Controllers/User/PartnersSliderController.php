<?php

namespace App\Http\Controllers\User;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Rules\IsImage;

class PartnersSliderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('user.partners.index', [
            'partners' => Slider::TypePartners()->orderBy('created_at','desc')->paginate(6),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.partners.create', [
            'partners' => []
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
            'image' => ['required', new IsImage],
            'link'       => 'url|max:255',
            'created_at' => 'timestamp',
            'type' => 'required|integer',
        ]);

        $imageData = Slider::parsePhoto($request->image);

        $path = $imageData['path'];
        $base64 = $imageData['base64'];

        Storage::disk('public')->put( $path, base64_decode($base64) );

        $partners = Slider::create([
            'image'=> $path,
            'link' => $request->link,
            'type' => $request->type,
        ]);


        return redirect()->route('user.partners.show', $partners);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $emploee
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $partner)
    {
        return view('user.partners.show', [
            'partners' => $partner,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $partner)
    {
        return view('user.partners.edit', [
            'partners' => $partner,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Block  $emploee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $partner)
    {
        $dataValidate = $request->validate([
            'image' => [new IsImage],
            'link'       => 'url|max:255',
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
            'type' => 'required|integer',
        ]);

        if ($request->image) {
            $dataImg = Slider::parsePhoto($request->image);
            $path = $dataImg['path'];
            $base64 = $dataImg['base64'];
            Storage::disk('public')->put( $path, base64_decode($base64) );

            if (Storage::disk('public')->exists($partner->image) )  {
                Storage::disk('public')->delete($partner->image);
            }
        } else {
            $path = $partner->image;
        }

        $partner->update([
            'image' => $path,
            'link'  => $request->link,
            'type'  => $request->type,
        ]);
        return redirect()->route('user.partners.show', $partner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Block  $emploee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $partner)
    {
        if (Storage::disk('public')->exists($partner->image) ) {
            Storage::disk('public')->delete($partner->image);
        }
        $partner->delete();

        return redirect()->route('user.partners.index');
    }
}
