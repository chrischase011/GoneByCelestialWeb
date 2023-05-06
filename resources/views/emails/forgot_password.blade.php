@component('mail::message')
# Introduction

You can now change your password by clicking the button below

@component('mail::button', ['url' => $url])
Change Password
@endcomponent

If the button doesn't work, click the URL here: 
{{$url}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
