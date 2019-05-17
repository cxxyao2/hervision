<div id="threadTableDiv" >
  @if(!empty($threads))
<table class="table table-hover table-responsive "  id="threadsTbl">
            <thead>
            <tr>
                <th style="width:10%;">id</th>
                <th style="width:30%;">{{ __('threadlist.title') }}</th>
                <th style="width:10%;">{{ __('threadlist.creator') }}</th>
                <th style="width:10%;">{{ __('threadlist.creatdate') }}</th>
                <th style="width:10%;">{{ __('threadlist.hits') }}</th>
                <th style="width:10%;">{{ __('threadlist.status') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($threads as $thread)
                <tr id="{{'rowthreadid'.$thread->id}}" >
                    <td>{{ $thread->id }}</td>
                    <td ><a href="{{ $thread->path() }}">
{!!strlen($thread->title) > 30 ? substr($thread->title,0,30) : $thread->title!!}
                    <td>{{ $thread->creator->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($thread->created_at)->format('Y/m/d') }}</td>
                    <td>{{ $thread->visits }}</td>
                    @if( $thread->locked == 0)
                     <td id="{{'threadLock'.$thread->id}}">{{ __('threadlist.free') }}<td>
                    @else
                     <td id="{{'threadLock'.$thread->id}}" >{{ __('threadlist.locked') }}<td>
                    @endif

                    <td>
                        @if( $thread->locked == 0)
                         <button id="{{'btnthreadLock'.$thread->id}}" class="btn btn-sm btn-primary threadLock">{{ __('threadlist.lock') }}</button>
                        @else
                          <button id="{{'btnthreadLock'.$thread->id}}" class="btn btn-sm btn-primary threadLock">{{ __('threadlist.unlock') }}</button>
                        @endif
                        <input  type="hidden"   value="{{ $thread->id }}">
                        <button  id="{{'btnthreadDelete'.$thread->id}}" class="btn btn-sm btn-secondary threadDelete">{{ __('threadlist.delete') }}</button>
                        <input  type="hidden"  value="{{ $thread->id }}">
                      </td>

                </tr>
            @endforeach
            <tr><td colspan="6" id="threadCount"><b>{{ $threads->count() }}</b>{{ __('threadlist.threads') }}<td></tr>
          </tbody>
        </table>
        @else
          <p>{{ __('threadlist.norecords') }}</p>
        @endif
    </div>
