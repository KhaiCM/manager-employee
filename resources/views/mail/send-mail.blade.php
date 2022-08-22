@component('mail::message')
# Reset Password

Reset or change your password.

@component('mail::button', ['url' => env('APP_URL') . '/change-password/'. $token])
Change Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
