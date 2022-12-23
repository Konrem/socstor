<?php

namespace App\Http\Controllers\User;

use App\SelectPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\Validator;

class SelectPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = SelectPhoto::all()->toArray();
        return view('user.select-photo.index', [
            'photos' => json_encode($photos)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SelectPhoto  $selectPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(SelectPhoto $selectPhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SelectPhoto  $selectPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(SelectPhoto $selectPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SelectPhoto  $selectPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SelectPhoto $selectPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SelectPhoto  $selectPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(SelectPhoto $selectPhoto)
    {
        //
    }

    public function uploadPhoto(Request $request) {
        $dataValidate = $request->validate([
            'image' => 'image|max:10240'
        ]);

        $image = $request->file('image');
        $width = Image::make($image)->width();
        $height = Image::make($image)->height();
        
		$imageFullName = SelectPhoto::generateNameFile($image);
        
        if ( $width <= 1080 || $height <= 720 ) {
			Image::make($image)
				->save( storage_path('app/public/photo') . '/' . $imageFullName);
		} else {
			Image::make($image)
				->resize(1080, null, function ($constraint) {
					$constraint->aspectRatio();
				})
				->save(storage_path('app/public/photo') . '/' . $imageFullName);
		};
        

        SelectPhoto::create([
            'image'  => 'photo/' . $imageFullName
        ]);

        return Response(200, 200);
    }
    public function destroyPhoto(Request $request) {
        $image = $request->img;

        if (Storage::disk('public')->exists($image['src']) )  {
			Storage::disk('public')->delete($image['src']);
        }

		SelectPhoto::where('id', $image['id'])->delete();

		return Response(200, 200);
    }
}
