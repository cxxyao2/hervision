@extends('layouts.app')

@section('content')
<div>
<h2>模态框实例</h2>
    <!-- 按钮：用于打开模态框 -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
      打开模态框
    </button>

    <!-- 模态框 -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">

          <!-- 模态框头部 -->
          <div class="modal-header">
            <h4 class="modal-title">模态框头部</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- 模态框主体 -->
          <div class="modal-body">
            模态框内容..
          </div>

          <!-- 模态框底部 -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <h3>弹出框实例</h3>
      <a href="#" data-toggle="popover" title="弹出框标题" data-content="弹出框内容">多次点我TODO参考管理画面改正</a>
    </div>

</div>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>

@endsection
