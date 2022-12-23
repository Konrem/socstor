@push('style')
    <link rel="stylesheet" href="{{ asset('css/croppie.css') }}"/>
@endpush

<section class="loader dis" id="loader">
    <div id="cube-loader">
        <div class="caption" id="caption">
            <div class="cube-loader">
                <div class="cube loader-1"></div>
                <div class="cube loader-2"></div>
                <div class="cube loader-4"></div>
                <div class="cube loader-3"></div>
            </div>
        </div>
    </div>
</section>

<label for="">Статус</label>
<select name="published" class="form-control">
    @if(isset($news->id))
    <option value="0" @if ($news->published == 0) selected="" @endif>Не опубліковано</option>
    <option value="1" @if ($news->published == 1) selected="" @endif>Опубліковано</option>
    @else
    <option value="0">Не опубліковано</option>
    <option value="1">Опубліковано</option>
    @endif
</select>


<div class="form-group">
    <label for="title">Заголовок</label>
    <input maxlength="255" onkeyup="inputValidation(this.value, 'title_val', '255')" type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Заголовок новини" value="{{$news->title ?? ""}}">
    <small id="title_val"></small>
</div>

<div class="title_error alert alert-danger d-none"></div>


<div class="form-group">
    <input type="hidden" class="form-control" name="slug" placeholder="Посилання на новину" value="{{$news->slug ?? ""}}" readonly="">
</div>


<div class="input-group">
    <input type="file" id="upload" accept=".jpg, .jpeg, .png"/>
</div>
<div class="photo_error alert alert-danger d-none"></div>
<br>
<div class="row">
    
    @isset($news->photo)
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
        <img class="photo-edit d-block mx-auto" src="{{ $news->getPath() }}" />
            <p class="text-center">Існуюче зображення</p>
    </div>
    @endisset
    
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
        
        <div id="upload-demo"></div>
        <br>

    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
        <img class="img-responsive rounded mx-auto d-block photo-edit"  id="img-result"/>
        <p class="text-center">Нове зображення</p>
    </div>   
</div>
<button class="btn btn-outline-primary upload-result mx-auto d-block btn-send">
    <i class="fas fa-cut"></i> Вирізати
</button>

<input type="hidden" name="photo" id="img-base-64">


<div class="form-group">
    <label for="ckeditor">Текст новини</label>
    <textarea name="text" id="ckeditor" class="form-control @error('text') is-invalid @enderror" required>{{$news->text ?? ""}}</textarea>
</div>

<div class="text_error alert alert-danger d-none"></div>


<div class="form-group">
    <label for="meta_description">Короткий опис новини</label>
    <input maxlength="255" onkeyup="inputValidation(this.value, 'description_val', '255')" type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="meta_description" placeholder="Короткий опис новини" value="{{$news->meta_description ?? ""}}">
    <small id="description_val"></small>
</div>

<div class="meta_description_error alert alert-danger d-none"></div>


<div class="form-group">
    <label for="meta_keywords">Пошук по-ключовим словам</label>
    <input maxlength="255" onkeyup="inputValidation(this.value, 'keywords_val', '255')" type="text" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords" id="meta_keywords" placeholder="Пошук по-ключовим словам, через кому" value="{{$news->meta_keywords ?? ""}}">    
    <small id="keywords_val"></small>
</div>


<div class="meta_keywords_error alert alert-danger d-none"></div>


<input type="submit" class="btn btn-primary submit-news" id="submit-news" name="submit-news"  value="Зберегти">


@push('down')
    <script>
        const inputValidation = (str, id, howMutch) => {
            const lng = str.length;
            id = document.getElementById(id);
            id.innerHTML = `${lng} символів з ${howMutch}`;
            if (lng == howMutch) {
                id.classList.add('new_alert', 'new_danger');
            }else {
                id.classList.remove('new_alert', 'new_danger');
            }
        };
    </script>
    <script src="{{ asset('js/cke-config.js') }}" defer></script>
    <script src="{{ asset('js/ckeditor-init.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/croppie.min.js')}}" defer> </script>
    <script>
        $(function() {

        function demoUpload() {
            var $uploadCrop;

            function readFile(input) {
            if (input.files && input.files[0]) {
                console.log('Read file');
                var reader = new FileReader();

                reader.onload = function(e) {
                $(".upload-demo").addClass("ready");
                $uploadCrop
                    .croppie("bind", {
                    url: e.target.result
                    })
                    .then(function() {
                    console.log("jQuery bind complete");
                    });
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                swal("Sorry - you're browser doesn't support the FileReader API");
            }
        }

        $uploadCrop = $("#upload-demo").croppie({
            url: '/img/mount.jpg',
            enableExif: true,
            boundary: { width: 320, height: 220 },
            viewport: {
                width: 300,
                height: 200,
                type: "square"
            },
            showZoomer: true,
            enableOrientation: true,
            mouseWheelZoom: 'ctrl'
        });

        $("#upload").on("change", function() {
            readFile(this);
        });
        $(".upload-result").on("click", function(ev) {
            ev.preventDefault();
        $uploadCrop
            .croppie("result", {
            type: "canvas",
            format: 'jpeg',
            size: {
                width: 1080,
                height: null,
            }
            })
            .then(function(resp) {
            popupResult({
                src: resp
            });
            });
        });
    }
    demoUpload();
    });

    function popupResult(result) {
        $('#img-result').attr('src', result.src);
        $('#img-base-64').attr('value', result.src);
    }
    </script>
@endpush          