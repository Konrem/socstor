<?php

namespace App\Http\Controllers;

use App\SelectPhoto;
use App\Slider;
use App\News;
use App\Photos;
use App\Albums;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{

    /**
     * Show the application index page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('welcome', [
            'lastNews' => News::lastNew(4),
            'mainInfo' => \App\Block::typeMainInfo()->get(),
            'configs' => \App\Config::find(1),
            'slider' => \App\Slider::where('type', 2)->get(),
        ]);
    }
	/*
	 * Show the application news page.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
    public function news()
    {
        return view('news', [
            'page' => \App\Page::find(7)
        ]);
    }

        /**
     * Return title and photo to front
     * 
     * @param \Illuminate\Http\Request  $request
     * @return Illuminate\Contracts\Routing\ResponseFactory  
     */
    public function albumsVue(Request $request)
    {
        $gallery = \App\Albums::find($request->id);
        $responseData = [];
        foreach ($gallery->photos as $album_content) {
            array_push($responseData,  asset('/storage/' . $album_content->photo) );
        }

        if($request->ajax() ) {
            return response()->json($responseData);
        }
    }
    /**
     * Return next 5 article for vue-component
     * 
     * @param \Illuminate\Http\Request  $request
     * @return Illuminate\Contracts\Routing\ResponseFactory 
     */
    public function loadMore(Request $request)
    {
        $offset = $request->offset;
        $limit = $request->limit;

        $posts = News::offset($offset)->limit($limit)->orderBy('created_at', 'desc')->is_published()->get();
        foreach ($posts as $post) {
            $data = [
                'id' => $post->id,
                'title' => $post->title,
                'fullDateMobile' => $post->fullDateMobile(),
                'month' => $post->getMonth(),
                'day' => $post->getDay(),
                'img' => $post->getPath(),
                'description' => $post->description(),
                'slug' => 'news/' . $post->slug,
            ];
            
            $responseData [] = $data;    
        }
        
        if($request->ajax() ) {
            return response()->json($responseData);
        }
    }
    /**
     * Return count publiched articles
     * 
     * @param \Illuminate\Http\Request  $request 
     * @return Illuminate\Contracts\Routing\ResponseFactory 
     */
    public function endList (Request $request)
    {    
        $countPublishedPosts = News::is_published()->count();
        if($request->ajax() ) {
            return response()->json($countPublishedPosts);
        }
    }

    /**
     * Search
     */
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'nullable|string|max:255',
            'searchOf' => 'nullable|date|before_or_equal:searchBy',
            'searchBy' => [Rule::requiredIf($request->searchOf !== null), 'date', 'after_or_equal:searchOf']
            ]);

        if ($request->search == null && $request->searchOf == null && $request->searchBy == null) {
            return redirect('news')->withErrors($validator)->withInput();
        }

        $article = News::orderBy('created_at', 'desc')
            ->search($request->search, $request->searchOf, $request->searchBy)
            ->paginate(5)
            ->appends( request()->query() );

        $search[0] = $request->search;
        $search[1] = strtotime($request->searchOf);
        $search[1] = date('d.m.Y', $search[1]);
        $search[2] = strtotime($request->searchBy);
        $search[2] = date('d.m.Y', $search[2]);

        return view('search-results', [
            'article' => $article,
            'search_result' => $search
        ]);
    }

    /*
     * Show the application map page.
     *
     */
    public function map()
    {
        return view('map', [
            'map' => \App\Page::find(5),
            'info01' => \App\Block::typeMapBlock()->where('id', 7)->get(),
            'info02' => \App\Block::typeMapBlock()->where('id', 8)->get(),
            'info03' => \App\Block::typeMapBlock()->where('id', 9)->get(),
        ]);
    }

    /**
     * Show the application volunteer page.
     */
    public function volunteer()
    {
    	return view('volunteer', [
            'volonter' => \App\Page::find(3),
            'lastAlbums' => Albums::lastAlbums(6),
        ]);
    }

	/**
     * Show the application scholarship page.
     */
    public function scholarship()
    {
    	return view('scholarship',[
            'sh' => \App\Page::find(4),
            'info1' => \App\Block::typeSocialInfo()->where('id', 4)->get(),
            'info2' => \App\Block::typeSocialInfo()->where('id', 5)->get(),
            'info3' => \App\Block::typeSocialInfo()->where('id', 6)->get(),
        ]);
    }

	/**
     * Show the application albums page.
     */
    public function albums(Request $request, Albums $albums_id)
    {
    	return view('albums', [
            'page' => \App\Page::find(6),
            'albums' => \App\Albums::orderBy('id', 'desc')->paginate(8)
        ]);
    }

	/**
     * Show the application album page.
     */
    public function album(Request $request)
    {
        $album_id = $request->query('id');
        $album = \App\Albums::find($album_id);

        return view('album', [
            'album' => $album_id,
            'header' => $album->title,
        ]);
    }

	/**
     * Show the application social page.
     */
    public function social()
    {
    	return view('social_service', [
            'social' => \App\Page::find(2),
        ]);
    }

    public function getSocialPhoto(Request $request)
    {
        $lastSixPhoto = SelectPhoto::whereNotNull('id')
            ->orderBy('id', 'desc')
            ->take(6)
            ->get();
            $data = [];
        foreach ($lastSixPhoto as $photos) {
           array_push($data, $photos->getPath() );
        }

        if ($request->ajax()) {
            return response()->json($data);   
        }
        
    }

    /**
     * Show the application article page.
     */
    public function cur_news(Request $request, $slug)
    {
        $config =  \App\Config::find(1);
        $appName = $config->name;

        $news = \App\News::where('slug', $slug)->is_published()->firstOrFail();
        $news_id = $news['id'];
        $photos = \App\Photos::get()->where('news_id', $news_id)->toArray();
        array_unshift($photos, [ 'photo' => $news->photo]); 
        return view('cur_news', [
            'news' => $news,
            'appName' => $appName,
            'anotherPhotos' => $photos
        ]);
    }

	/**
     * Show the application department page.
     */
    public function department()
    {
    	return view('department', [
            'departament' => \App\Page::find(1),
            'workers' =>\App\Block::typeEmploee()->get(),
            'config' => \App\Config::find(1)
        ]);
    }

}
