{{-- Editing the question --}}
<div class="panel panel-default my-1 " v-if= '{{$showFlag}}'  >
  <div class="panel-heading">
    <div class="row">
      <input type="text"  class="form-control" v-model="form.title" />
     </div>
  </div>

    <div class="panel-body" style="border-bottom: 3px  solid  rgb(240,148,2); " >
      <div class="form-group">
        <wysiwyg v-model="form.body" value="form.body"></wysiwyg>
    </div>
    </div>

    <div  id="addtionalProperty" class="hidden panel-body border">
      <label>hi</label>
      <lable>hi2</label>
    </div>


    <div class="panel-footer">
      <div class="level">
        <button class="btn btn-xs btn-primary " @click="editing = true" v-show=" !editing">Edit</button>
        <button class="btn btn-primary btn-xs level-item" @click="update" v-show= " editing" >Update</button>
        <button class="btn btn-xs level-item" @click="editing = false" v-show= " editing" >Cancel</button>

        @can  ('update', $thread)
        <form id="myform"  method="POST" class="ml-auto"  onSubmit="javascript:return window.confirm('Are you sure to delete？Deleted data cannot be recovered')">
           {{ csrf_field() }}
           {{  method_field('DELETE') }}
          <button  type="submit" class="btn btn-xs btn-danger" >Delete</button>
        </form>

          <a class="btn btn-xs btn-info ml-2" href="{{ route('threads.edit',$thread) }}">{{ __('common2.advanced') }}</a>
        @endcan

      </div>

    </div>
  </div>


  {{-- viewing  the question --}}
  <div class="panel panel-default my-1" v-else>
    <div class="panel-heading">

      <div class="row">
        <span class="flex ml-2"> <a href=" {{ $thread->path()  }}" >
          @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
            <strong>
              {{ $thread->title }}
            </strong>
          @else
            {{ $thread->title }}
          @endif
        </a>
      </span>
      <span class="mr-2">{{ __('common2.author') }}{{ $thread->creator->name }}</span>
    </div>

        </div>
          <div class="panel-body" v-html="body" style="border-bottom: 3px  solid  rgb(240,148,2); " >

          </div>

    </div>
