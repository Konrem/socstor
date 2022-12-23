<photo-gallery-upload
    @isset($photos)
        gallery_id="{{$photo_gallery->id}}"
        upload_photos="{{$photos}}"
    @endisset />