<div class="form-group">
    <label for="title">@lang('messages.title')</label>
    <input type="text" class="form-control @error('first_title') is-invalid @enderror" name="first_title" id="title"
        placeholder="Заголовок" value="@if(old('first_title') ) {{ old('first_title') }}@else{{ $page->first_title ?? "" }}@endif" required maxlength="255" onkeyup="inputValidation(this.value, 'title_val', '255')">
    <small id="title_val"></small>
</div>

@error('first_title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="ckeditor">Зміст</label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="ckeditor">
        @if( old('description')) {{ old('description')}} @else{{ $page->description ?? "" }}@endif
    </textarea>
</div>

@error('description')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="meta_keywords">Пошук по-ключовим словам</label>
    <input
        type="text"
        class="form-control @error('meta_keywords') is-invalid @enderror"
        name="meta_keywords"
        id="meta_keywords"
        placeholder="Напишіть декілька слів, через кому" value="@if ( old('meta_keywords')) {{ old('meta_keywords') }}@else{{ $page->meta_keywords ?? "" }}@endif" 
        required
        maxlength="255"
        onkeyup="inputValidation(this.value, 'keywords_val', '255')"
        >
        <small id="keywords_val"></small>
</div>

@error('meta_keywords')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="meta_description">Короткий опис сторінки</label>
    <input
        type="text"
        class="form-control @error('meta_description') is-invalid @enderror"
        name="meta_description"
        id="meta_description"
        placeholder="Напишіть одне речення"
        value="@if( old('meta_description') ) {{ old('meta_description') }}@else{{ $page->meta_description ?? "" }}@endif" 
        required
        maxlength="255"
        onkeyup="inputValidation(this.value, 'description_val', '255')"
    >
    <small id="description_val"></small>
</div>

@error('meta_description')
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
    <script src="{{ asset('js/cke-config.js') }}" defer></script>
    <script src="{{ asset('js/ckeditor-init.js') }}" defer></script>
@endpush
