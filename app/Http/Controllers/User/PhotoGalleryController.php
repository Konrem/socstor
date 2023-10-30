<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Albums;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Photos;
use Image;
use Illuminate\Support\Facades\Validator;
use App\Rules\IsImage;


class PhotoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.photo-gallery.index', [
            'galleries' => Albums::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.photo-gallery.create', [
            'photo_gallery' => [],
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
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'preview' => ['required', new IsImage]
        ]);

        $imageData = Albums::parsePhoto($request->preview);

        $path = $imageData['path'];
        $base64 = $imageData['base64'];

        Storage::disk('public')->put( $path, base64_decode($base64) );

        $albums = Albums::create([
            'title' => $request->title,
            'preview' => $path,
        ]);

        $album_id = $albums->id;

        return response($album_id, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($path)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Albums  $photo_gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Albums $photo_gallery)
    {
        $album_id = $photo_gallery->id;

        $photos = Photos::where('albums_id', $album_id)->get(['id', 'photo'])->toArray();

        return view('user.photo-gallery.edit', [
            'photo_gallery' => $photo_gallery,
            'photos' => json_encode($photos),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   \App\Albums  $photo_gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Albums $photo_gallery)
    {
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'preview' => ['nullable', new IsImage],
        ]);

        $dataToSave = [
            'title'=> $request->title,
        ];

        if ($request->preview) {
            if (Storage::disk('public')->exists($photo_gallery->preview) )  {
                Storage::disk('public')->delete($photo_gallery->preview);
            }
            $imageData = Albums::parsePhoto($request->preview);
            $path = $imageData['path'];
            $base64 = $imageData['base64'];

            $dataToSave['preview'] = $path;

            Storage::disk('public')->put( $path, base64_decode($base64) );
        } else {
            $dataToSave['preview'] = $photo_gallery->preview;
        }

        Albums::where('id', $photo_gallery->id)->update($dataToSave);


        return Response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Albums  $photo_gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Albums $photo_gallery)
    {
        $album_id = $photo_gallery->id;

        $photos = Photos::where('albums_id', $album_id)->get(['id','photo'])->toArray();

        $ids = array_column($photos, 'id');
        $paths = array_column($photos, 'photo');

        Storage::disk('public')->delete($paths);
        Photos::destroy($ids);

        if (Storage::disk('public')->exists($photo_gallery->preview) )  {
            Storage::disk('public')->delete($photo_gallery->preview);
        }

        $photo_gallery->delete();

        return redirect()->route('user.photo-gallery.index');
    }

    /**
     * upload photo to gallery
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadPhoto(Request $request)
    {
        $dataValidate = $request->validate([
            'image' => 'image|max:10240'
        ]);

        $image = $request->file('image');
        $width = Image::make($image)->width();
        $height = Image::make($image)->height();
        
		$imageFullName = Photos::generateNameFile($image);
        
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
        

        Photos::create([
            'albums_id' => $request->galleryId,
            'photo'  => 'photo/' . $imageFullName
        ]);

        return Response(200, 200);
    }

    /**
     * Delete photo from gallery
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyPhoto(Request $request)
    {
		$image = $request->img;

        if (Storage::disk('public')->exists($image['src']) )  {
			Storage::disk('public')->delete($image['src']);
        }

		Photos::where('id', $image['id'])->delete();

		return Response(200, 200);
	}
}
