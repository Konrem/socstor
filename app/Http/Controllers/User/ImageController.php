<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use App\Photos;
use App\News;
use GuzzleHttp\Psr7\Response;
use Storage;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    public function index(Request $request)
    {
        return view('user.news.create');
    }

	public function upload(Request $request)
	{
        $dataValidate = $request->validate([
            'image' => 'image|max:10240'
        ]);

		$image = $request->file('image');
		$imageFullName = Photos::generateNameFile($image);

		$width = Image::make($image)->width();
		$height = Image::make($image)->height();
		// $data = getimagesize($image);
		// $width = $data[0];
		// $height = $data[1];

		if ( $width <= 1080 || $height <= 720 ) {
			Image::make($image)
				->save( storage_path('app/public/photo') . '/' . $imageFullName );
		} else {
			Image::make($image)
				->resize(1080, null, function ($constraint) {
					$constraint->aspectRatio();
				})
				->save(storage_path('app/public/photo') . '/' . $imageFullName);
		};

		Log::info('Showing '.$request);
		Photos::create([
			'news_id' => $request->newsid,
			'photo'  => 'photo/' . $imageFullName
		]);
		return Response(200, 200);
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
