<?php

namespace App\Http\Controllers\User;

use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Photos;
use App\Albums;
use Intervention\Image\Response;
use Storage;

class AlbumController extends Controller
{
    // need delete
    public function index(Request $request)
    {
		$album_id = $request->albums;
		$album_title = Albums::where('id', $album_id)->value('title');
        return view('user.album.create', [
			'album_title' => $album_title
		]);
    }

	public function upload(Request $request)
	{
		//dd('exit');
		$image = $request->file('image');

		$imageName = time();
		$extension = $image->getClientOriginalExtension();
		$imageFullName = $imageName . '.' . $extension;
		//$path = $request->file('image')->store('photo', 'public', 'app', 'storage');
		Image::make($image)->save(storage_path('app/public/photo') . '/' . $imageFullName);
		// Image::make($image)->resize(300, 200)->save(storage_path('app/public/cover') . '/' . $imageFullName);
		Photos::create([
			'albums_id' => 42,
			//'albums_id' => $request->albumid,
			'photo'  => 'photo/' . $imageFullName
		]);
		//return Response(200, 200);
		return redirect()->route('user.albums');
	}

	public function destroy(Request $req)
    {
		$image = $req->img;

        if (Storage::disk('public')->exists($image['src']) )  {
			Storage::disk('public')->delete($image['src']);
		}
		Photos::where('id', $image['id'])->delete();

		return Response(200, 200);
	}
}
