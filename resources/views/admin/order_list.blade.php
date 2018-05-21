@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
    	<div class="table-responsive">
        	<table class="table table-striped">
        		<tr>
	        		<th>ID</th>
	        		<th>订单号</th>
	        		<th>状态</th>
	        		<th>名称</th>
	        		<th>总价</th>
	        		<th>时间</th>
	        		<th>操作</th>
	        	</tr>
	            @foreach ($data as $order)
	            <tr>
	            	<td>{{ $order['order_id'] }}</td>
	            	<td>{{ $order['order_sn'] }}</td>
	            	<td>{{ $order['pay_status_char'] }}、{{ $order['order_status_char'] }}</td>
	            	<td>{{ $order['contact']['name'] }}</td>
	            	<td>{{ $order['order_amount'] }}</td>
	            	<td>{{ date('Y-m-d H:m:s',$order['add_time']) }}</td>
	            	<td><a href="info?id={{ $order['order_id'] }}">编辑</a> | <a href="act?action=delete&id={{ $order['order_id'] }}">删除</a></td>
	            </tr>
	            @endforeach
            </table>
        </div>
        @if ($paged['page'] > 1)
        	<a href="list?page={{ $paged['page'] - 1 }}&per_page=10" style="float: left;">上一页</a>
		@endif
		@if ($paged['page'] < ceil($paged['total']/$paged['per_page']))
        	<a href="list?page={{ $paged['page'] + 1 }}&per_page=10" style="float: right;">下一页</a>
        @endif
    </div>
</div>
@endsection
