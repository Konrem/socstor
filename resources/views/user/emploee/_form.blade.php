@push('style')
<link rel="stylesheet" href="{{ asset('css/croppie.css') }}"/>
@endpush

<input type="hidden" name="type" value="2" class="form-control @error('type') is-invalid @enderror">
@error('type')
    <div class="alert alert-danger">{{ $message }}</sdiv>
@enderror

<div class="form-group">
    <label for="title">@lang('messages.pib')</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
        placeholder="@lang('messages.fpib')" value="@if(old('title') ) {{ old('title') }}@else{{ $emploee->title ?? "" }}@endif"
        required
        maxlength="50"
        onkeyup="inputValidation(this.value, 'title_val', '50')"
    >
    <small id="title_val"></small>
</div>

@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="input-group">
    <input type="file" id="upload" accept="image/*">
</div>

@error('img')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<br>
<div class="row">
    
    @isset($emploee->img)
    <div class="col-12 col-md-12 col-lg-6 col-xl-4">
        <img class="photo-edit-square d-block mx-auto" src="{{ $emploee->getPath() }}" />
            <p class="text-center">Існуюче зображення</p>
    </div>
    @endisset
    
    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
        
        <div id="upload-demo"></div>
        <br>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
        <img class="rounded d-block mx-auto photo-edit-square"  id="img-result" />
        <p class="text-center">Нове зображення</p>
    </div>
</div>
<button class="btn btn-outline-primary upload-result mx-auto d-block btn-send">
    <i class="fas fa-cut"></i> Вирізати
</button>

<input type="hidden" name="img" id="img-base-64">

<div class="form-group">
    <label for="description">Зміст</label>
    <textarea class="form-control @error('text') is-invalid @enderror" name="text" id="description" maxlength="150" onkeyup="inputValidation(this.value, 'text_val', '150')"
        >@if( old('text')) {{ old('text')}} @else{{ $emploee->text ?? "" }}@endif</textarea>
        <small id="text_val"></small>
</div>

@error('text')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

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
        url: '/img/img_avatar.png',
        enableExif: true,
        boundary: { width: 300, height: 300 },
        viewport: {
            width: 300,
            height: 300,
            type: "circle"
        }
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
            size: "viewport"
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
