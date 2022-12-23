@push('style')
<link rel="stylesheet" href="{{ asset('css/croppie.css') }}"/>
@endpush
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
<label for="title">Заголовок до альбому</label>
    <input type="text"
        class="form-control @error('title') is-invalid @enderror"
        name="title"
        id="title"
        placeholder="Заголовок до альбому"
        value="@if( old('title') ) {{ old('title') }}@else{{ $photo_gallery->title ?? "" }}@endif"
        maxlength="255"
        onkeyup="inputValidation(this.value, 'title_val', '255')"
    >
    <small id="title_val"></small>
</div>

<div class="title_error alert alert-danger d-none"></div>


<div class="input-group">
    <input type="file" id="upload" accept=".jpg, .jpeg, .png"/>
</div>


<br>
<div class="row">
    
    @isset($photo_gallery->preview)
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
        <img class="photo-edit d-block mx-auto" src="{{ asset('/storage/' . $photo_gallery->preview) }}" />
            <p class="text-center">Існуюче зображення</p>
    </div>
    @endisset
    
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
        
        <div id="upload-demo"></div>
        <br>

    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
        <img class="img-responsive rounded d-block mx-auto photo-edit" id="img-result"/>
        <p class="text-center">Нове зображення</p>
    </div>   
</div>
<button class="btn btn-outline-primary upload-result mx-auto d-block btn-send" >
    <i class="fas fa-cut"></i> Вирізати
</button>

<input type="hidden" name="preview" id="img-base-64">
<div class="preview_error alert alert-danger d-none"></div>

<br>

@include('user.photo-gallery._gallery')

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
            size: { width: 610, height: 380 }
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