<?php

namespace App\Http\Controllers\User;

use App\News;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Photos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Rules\KeyWords;
use App\Rules\IsImage;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.news.index', [
            'new' => News::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
        return view('user.news.create', [
            'news'       => [],
            'categories' => Category::with('children')->where('parent_id', '0')->get(),
            'delimiter'  => '',
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
            'published' => 'required|boolean',
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'photo' => ['required', new IsImage],
            'slug' => 'max:255',
            'created_at' => 'timestamp',
            'meta_keywords' => ['required','string','max:255', new KeyWords],
            'meta_description'=> 'required|string|max:255',
        ]);
        
        $dataImg = News::parsePhoto($request->photo);
        $path = $dataImg['path'];
        $base64 = $dataImg['base64'];
        Storage::disk('public')->put($path, base64_decode($base64) );

        $news = News::create([
            'published' => $request->published,
            'title' => $request->title,
            'text' => $request->text,
            'photo' => $path,
            'slug' => $request->slug,
            'meta_keywords' => $request->meta_keywords,
            'meta_description'=> $request->meta_description,
        ]);

        // Categories
        if ($request->categories) {
            $news->categories()->attach($request->categories);
        }

        return response($news->id, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $path)
    {
        return view('user.news._form', ['photo' => $path]);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $news_id = $news->id;
        $photos = Photos::where('news_id', $news_id)->get(['id', 'photo'])->toArray();
    
        return view('user.news.edit', [
            'news' => $news,
            'categories' => Category::with('children')->where('parent_id', 0)->get(),
            'photos' => json_encode($photos),
            'delimiter' => '',
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $validateData = $request->validate([
            'published' => 'required|boolean',
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'photo' => ['nullable',new IsImage],
            'slug' => 'max:255',
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
            'meta_keywords' => ['required','string','max:255', new KeyWords],
            'meta_description' => 'required|string|max:255',
        ]);
        
        $dataToSave = [
            'published' => $request->published,
            'title' => $request->title,
            'slug' => $request->slug,
            'text' => $request->text,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ];

        if($request->photo) {
            $dataImg = News::parsePhoto($request->photo);
            $path = $dataImg['path'];
            $base64 = $dataImg['base64'];
            Storage::disk('public')->put($path, base64_decode($base64) );
            $dataToSave['photo'] = $path;
        } else {
            $dataToSave['photo'] = $news->photo;
        }

        News::where('slug', $request->slug)->update($dataToSave);

        $news = News::where('slug', $request->slug)->get()[0];
        // $news->update($request->except('slug'));
        // Categories
        $news->categories()->detach();
        
        if($request->categories) {
            $news->categories()->attach($request->categories);
        }

        return Response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */

    public function destroy(News $news)
    {
        $news->categories()->detach();
        
        if (Storage::disk('public')->exists($news->photo) )  {
            Storage::disk('public')->delete($news->photo);
        }
        $news->delete();

        return redirect()->route('user.news.index');
    }
}
