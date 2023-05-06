@component('mail::message')
# Introduction

Dear {{$name}},

{{$message}}

@component('mail::button', ['url' => $url])
Click here to verify
@endcomponent

If the button didn't work, click the URL here: {{$url}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
