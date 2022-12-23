<!-- to iterate over the collection categories -->
@foreach ($categories as $category)

    <option value="{{$category->id ?? ""}}" 
     

        @isset($news->id)

            @foreach ($news->categories as $category_news)
                @if ($category->id == $category_news->id)
                    selected="selected"
                @endif
            @endforeach
        
        @endisset

        >
        {!! $delimiter ?? "" !!}{{$category->title ?? ""}}
    </option>

    @if (count($category->children) > 0)

        @include('user.news._categories', [
            'categories' => $category->children,
            'delimiter'  => ' - ' . $delimiter
        ])

    @endif
@endforeach