@if($errors->any() )
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<div class="form-group">
    <label for="name">Ім'я</label>
    <input type="text" class="form-control" name="name" id="name"
           placeholder="Введіть ім'я" value="@if( old('name') ) {{old('name')}}@else{{$admin->name ?? '' }}@endif" maxlength="255" onkeyup="inputValidation(this.value, 'name_val', '255')">
    <small id="name_val"></small>
</div>

<div class="form-group">
    <label for="title">Email</label>
    <input type="text" class="form-control" name="email" id="email"
           placeholder="Введіть email" value="@if( old('email') ) {{ old('email')}}@else{{$admin->email ?? '' }}@endif" maxlength="255" onkeyup="inputValidation(this.value, 'email_val', '255')">
    <small id="email_val"></small>
</div>

<div class="form-group">
    <label for="title">Пароль</label>
    <input type="password" class="form-control" name="password" id="password"
           placeholder="Введіть пароль"
    >
</div>

<div class="form-group">
    <label for="title">Підтвердження пароля</label>
    <input type="password" class="form-control" name="password_confirmation" id="title"
           placeholder="Введіть пароль повторно"
    >
</div>

<button class="btn btn-primary" type="submit">Зберегти</button>


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
