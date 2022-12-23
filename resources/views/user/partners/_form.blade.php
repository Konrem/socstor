@push('style')
<link rel="stylesheet" href="{{ asset('css/croppie.css') }}"/>
@endpush

<input type="hidden" name="type" value="2" class="form-control @error('type') is-invalid @enderror">
@error('type')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="link">Посилання на партнера</label>
    <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" id="link"
        placeholder="Посилання на партнера" value="@if(old('link') ) {{ old('link') }}@else{{ $partners->link ?? "" }}@endif"
        required
        maxlength="255"
        onkeyup="inputValidation(this.value, 'link_val', '255')"
    >
    <small id="link_val"></small>
</div>

@error('link')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="input-group">
    <input type="file" id="upload" accept=".jpg, .jpeg, .png"/>
</div>

@error('image')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<br>
<div class="row">
    
    @isset($partners->image)
     <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
        <img class="photo-edit d-block mx-auto" src="{{ $partners->getPath() }}" />
            <p class="text-center">Існуюче зображення</p>
    </div>
    @endisset
    
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
        <div id="upload-demo"></div>
        <br>
   </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
        <img class="img-responsive rounded mx-auto d-block photo-edit" id="img-result"/>
        <p class="text-center">Нове зображення</p>
    </div>   
</div>
<button class="btn btn-outline-primary upload-result mx-auto d-block btn-send">
    <i class="fas fa-cut"></i> Вирізати
</button>

<input type="hidden" name="image" id="img-base-64">


<button type="submit" class="btn btn-outline-primary">Зберегти</button>

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
            // enableResize: true,
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
            size: { width: 170, height: 115 }
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
