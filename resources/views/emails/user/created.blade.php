@component('mail::message')
# Здравствуйте {{ $user['name'] }}

{{ $user['role']['description'] }}

@component('mail::table')
| Адрес эл. почты | Пароль |
|:-------- |:--------:|
| {{ $user['email'] }} | {{ $user['password'] }} |
@endcomponent

@component('mail::button', ['url' => url('/login')])
Авторизоваться
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
