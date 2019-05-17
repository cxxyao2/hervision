@extends('layouts.app')
@section('content')

@if ((Auth::check()) && (( Auth::user()->id == $profileUser->id )|| Auth::user()->isAdmin()))

  <div class="page-header">
    <h1>
        {{ $profileUser->name}}
        <small>Since {{ $profileUser->created_at->diffForHumans() }} </small>
    </h1>
  </div>

  @foreach ($profileUser->threads as $thread)
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="level">
              <span class="flex">
                <a href="#">{{ $thread->creator->name }}</a> posted:
                {{ $thread->title}}
              </span>
              <span>
                {{  $thread->created_at->diffForHumans() }}
              </span>

              <div class="panel-body">
                {{ $thread->body }}
            </div>
          </div>
        </div>
      </div>
      @else
        <p>{{ __('profile.noRights') }}</p>
        <a href="{{ url('/') }}">{{ __('profile.backtop') }}</a>
      @endif

  @endforeach
@endsection
