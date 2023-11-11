<div class="form-group">
    <label for="name">Назва </label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required
        placeholder="Введіть ім'я" value="@if( old('name') ) {{old('name')}}@else{{$config->name ?? '' }}@endif" maxlength="255" onkeyup="inputValidation(this.value, 'name_val', '255')">
        <small id="name_val"></small>
</div>
@error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="description">Опис</label>
    <textarea type="text" class="form-control" name="description" required
    id="description" rows="4" maxlength="1000" onkeyup="inputValidation(this.value, 'description_val', '1000')">@if( old('description') ) {{old('description')}}@else{{$config->description ?? '' }}@endif</textarea>
    <small id="description_val"></small>
</div>

@error('description')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="name">Ключові слова</label>
    <input type="text" class="form-control" name="keywords" id="keywords" required
        value="@if( old('keywords') ) {{old('keywords')}}@else{{$config->keywords ?? '' }}@endif" maxlength="255" onkeyup="inputValidation(this.value, 'keywords_val', '255')">
        <small id="keywords_val"></small>
</div>

@error('keywords')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="name">Телефон</label>
    <input type="text" class="form-control" name="telephone" id="telephone" required
        value="@if( old('telephone') ){{old('telephone')}}@else{{$config->telephone ?? '' }}@endif" maxlength="18" onkeyup="inputValidation(this.value, 'telephone_val', '18')">
        <small id="telephone_val"></small>
</div>
<p class="text-muted">
    Приклад правильного написання телефону +380 (123) 123-321
</p>

@error('telephone')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="email">E-mail</label>
    <input type="text" class="form-control" name="email" id="email" required
        value="@if( old('email') ){{old('email')}}@else{{$config->email ?? '' }}@endif" >
</div>

@error('email')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="email">E-mail Опис</label>
    <input type="text" class="form-control" name="e_description" id="e_description" required
        value="@if( old('e_description') ){{old('e_description')}}@else{{$config->e_description ?? '' }}@endif" maxlength="255">
</div>

@error('e_description')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="description">Адреса</label>
    <textarea type="text" class="form-control" name="address" required
    id="address" rows="4" maxlength="600" onkeyup="inputValidation(this.value, 'address_val', '600')">@if( old('address') ) {{old('address')}}@else{{$config->address ?? '' }}@endif</textarea>
    <small id="address_val"></small>

</div>

@error('address')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="instagram">Instagram</label>
    <input type="text" class="form-control" name="instagram" id="instagram" required
        value="@if( old('instagram') ){{old('instagram')}}@else{{$config->instagram ?? '' }}@endif" maxlength="255" onkeyup="inputValidation(this.value, 'instagram_val', '255')">
        <small id="instagram_val"></small>
</div>

@error('instagram')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="i_description">Instagram опис</label>
    <input type="text" class="form-control" name="i_description" id="i_description" required
        value="@if( old('i_description') ){{old('i_description')}}@else{{$config->i_description ?? '' }}@endif" maxlength="255" onkeyup="inputValidation(this.value, 'i_description_val', '255')">
        <small id="i_description_val"></small>
</div>

@error('i_description')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="facebook">facebook</label>
    <input type="text" class="form-control" name="facebook" id="facebook" required
        value="@if( old('facebook') ){{old('facebook')}}@else{{$config->facebook ?? '' }}@endif" maxlength="255" onkeyup="inputValidation(this.value, 'facebook_val', '255')">
        <small id="facebook_val"></small>
</div>

@error('facebook')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="f_description">Facebook опис</label>
    <input type="text" class="form-control" name="f_description" id="f_description" required
        value="@if( old('f_description') ){{old('f_description')}}@else{{$config->f_description ?? '' }}@endif" maxlength="255" onkeyup="inputValidation(this.value, 'f_description_val', '255')">
        <small id="f_description_val"></small>
</div>

@error('f_description')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="form-group">
    <label for="youtube">youtube</label>
    <input type="text" class="form-control @error('youtube') is-invalid @enderror" name="youtube" id="youtube" required
        value="@if( old('youtube') ){{old('youtube')}}@else{{$config->youtube ?? '' }}@endif" maxlength="255" onkeyup="inputValidation(this.value, 'youtube_val', '255')">
        <small id="youtube_val"></small>
</div>

@error('youtube')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<button class="btn btn-outline-primary" type="submit">Зберегти</button>

@push('down_adm')
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
@endpush
