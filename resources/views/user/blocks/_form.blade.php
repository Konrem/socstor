<div class="form-group">
    <label for="inputType" hidden>Відношення</label>
    <select name="type" class="form-control @if( old('type')) {{ old('type')}} @else{{ $block->type ?? "" }}@endif"
        id="inputType" hidden>
        @if(isset($block->id))
            <option value="0" @if ($block->type == 0) selected @endif>Головна</option>
            <option value="1" @if ($block->type == 1) selected @endif>Стипендіальне забезпечення</option>

        @else
            <option value="0">Головна</option>
            <option value="1">Стипендіальне забезпечення</option>
        @endif
    </select>
</div>

@error('type')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="title">@lang('messages.title')</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
        placeholder="Заголовок" value="@if(old('title') ) {{ old('title') }}@else{{ $block->title ?? "" }}@endif" required maxlength="255" onkeyup="inputValidation(this.value, 'title_val', '255')">
    <small id="title_val"></small>
</div>

@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

@if ($block->type == 0)
<div id="image_block">

    <div class="form-group">
        <label for="link">@lang('messages.link')</label>
        <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" id="link"
            placeholder="Посилання" value="@if( old('link')) {{ old('link') }}@else{{ $block->link ?? "" }}@endif" maxlength="255" onkeyup="inputValidation(this.value, 'link_val', '255')">
        <small id="link_val"></small>
    </div>
    @error('link')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @isset($block->img)
        <img class="img-fluid" src="{{ $block->getPath() }}" width="300" id="oldCover">
    @endisset
    
    <div class="mb-3">
        <label for="cover">Оберіть файл для звантаження.</label><br>
        <input class="@error('img') is-invalid @enderror" name="img" id="cover" type="file" accept=".jpg, .jpeg, .png, .svg">
    </div>


    <div class="preview">
        
    </div>

    @error('img')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

</div>
@endif
<div class="form-group">
    <label for="ckeditor">Зміст</label>
    <textarea class="form-control @error('text') is-invalid @enderror" name="text" id="ckeditor"
        >@if( old('text')) {{ old('text')}} @else{{ $block->text ?? "" }}@endif</textarea>
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
<style>
    #image_block {
        display: block;
    }
    #image_block.show {
        display: none;
    }
</style>
    @if ($block->type == 0)
    <script src="{{ asset('js/single-img-preview.js') }}" defer> </script>
    @endif
    <script src="{{ asset('js/cke-config.js') }}" defer></script>
    <script src="{{ asset('js/ckeditor-init.js') }}" defer></script>
    <script src="{{ asset('js/main-block.js')}}" defer>
    </script>
@endpush
