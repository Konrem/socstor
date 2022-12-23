<div>
    <h1>Завантаження фотографії</h1>
<image-upload 
    @isset($photos)
        news_id="{{$news->id}}"
        upload_photos="{{$photos}}"
        
    @endisset
/>
{{-- <validation-errors errors="{{$errors}}" ></validation-errors> --}}
</div>

