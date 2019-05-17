
@if(Session::has('success'))
<!-- 成功提示框 -->
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>succeeded!</strong> {{Session::get('success')}}
</div>
@endif

@if(Session::has('error'))
<!-- 失败提示框 -->
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>failed!</strong> {{Session::get('error')}}
</div>
@endif
