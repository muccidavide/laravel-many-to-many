@component('mail::message')
# Introduction

Ciao Admin, il post {{$postSlug}} è statto modificato
 
@component('mail::button', ['url' => $postUrl ])
Review Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
