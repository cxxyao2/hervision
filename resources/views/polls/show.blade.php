@extends ('layouts.app')
@section ('content')
    @include('polls._showResult',['notExpired' => $notExpired,
    'isNotVoted' => $isNotVoted ])
@endsection
