@component('mail::message')
# Hello {{ $user->full_name }}

You can Forgot your password By this Link

@component('mail::button', ['url' => 'http://127.0.0.1:8000/restpassword'])
Click Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
