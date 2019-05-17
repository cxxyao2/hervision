@component('mail::message')
# Introduction


A small forum. {{ $user->name }} , welcome to share  
-  your book reviews
-  IT tips

@component('mail::button', ['url' => 'http://forumjennifer2019.herokuapp.com/'])
Start Browsing
@endcomponent

@component('mail::panel', ['url' => ''])
bienvenue à tous
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
