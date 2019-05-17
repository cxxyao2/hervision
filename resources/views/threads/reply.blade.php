
<reply :attributes="{{ $reply }}" inline-template v-cloak>
<div  id="reply-{{ $reply->id }}"    class="panel panel-default">
  <div class="panel-heading">
    <div class="level">
      <h5 class="flex">
        <a href="/profiles/{{ $reply->owner->name }}">{{ $reply->owner->name }}
        </a> said: {{ $reply->created_at->diffForHumans() }}...
    </h5>
    <div>

      @if (Auth::check())
        <div>
          <favorite :reply="{{ $reply }}" ></favorite>
        </div>
      @endif



    </div>
  </div>


  <div class="panel-body">
      <div v-if="editing">
        <div class="form-group">
            <textarea class="form-control" v-model="body">{{ $reply->body }}</textarea>
            <button class="btn btn-primary btn-xs " @click="update">update</button>
            <button class="btn btn-secondary btn-xs" @click="editing = false">cancel</button>

        </div>
      </div>

      <div v-else v-text="body">
      </div>
  </div>

     @can  ('update', $reply)
    <div class="panel-footer level">
      <button class="btn btn-xs btn-primary " @click="editing = true">Edit</button>
      <button class="btn btn-xs btn-danger " @click="destroy">Delete</button>

    </div>
    @endcan


    </div>
  </div>
</reply>
