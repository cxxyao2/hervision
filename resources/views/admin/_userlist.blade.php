<div id="userTableDiv" >
  @if (!empty($users) )
<table class="table table-hover table-responsive" id="userTbl">
            <thead>
            <tr>
                <th>id</th>
                <th>{{ __('userlist.name') }}</th>
                <th>{{ __('userlist.email') }}</th>
                <th>{{ __('userlist.registerDate') }}</th>
                <th>{{ __('userlist.threads') }}</th>
                <th>{{ __('userlist.status') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr id="{{'rowuserid'.$user->id}}" >
                    <td>{{ $user->id }}</td>
                    <td><a href="/profiles/{{ $user->name }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                     <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y/m/d')}}</td>
                    <td>{{ $user->threads->count() }}</td>

                    @if( $user->locked == 0)
                     <td id="{{'txtLock'.$user->id}}">{{ __('userlist.free') }}<td>
                    @else
                     <td id="{{'txtLock'.$user->id}}" >{{ __('userlist.locked') }}<td>
                    @endif

                    <td>
                        @if( $user->locked == 0)
                         <button id="{{'btnLock'.$user->id}}" class="btn btn-sm btn-primary userLock">锁定</button>
                        @else
                          <button id="{{'btnLock'.$user->id}}" class="btn btn-sm btn-primary userLock">解锁</button>
                        @endif
                        <input  type="hidden"   value="{{ $user->id }}">
                        <button  id="{{'btnDelete'.$user->id}}" class="btn btn-sm btn-secondary userDelete">删除</button>
                        <input  type="hidden"  value="{{ $user->id }}">
                      </td>

                </tr>
            @endforeach
            <tr><td colspan="6" id="userCount"><b>{{ $users->count() }}</b>{{ __('userlist.threads') }}<td></tr>
            </tbody>
        </table>
        @else
          <p>{{ __('userlist.norecords') }}</p>
        @endif
    </div>
