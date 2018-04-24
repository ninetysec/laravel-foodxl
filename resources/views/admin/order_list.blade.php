@extends('layouts.app')

@section('content')
<div class="container">
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
		            	<td>{{ ($order['pay_status'] == 1) ? '已支付' : '未支付'}}、{{ ($order['order_status'] == 1) ? '已完成' : '未完成'}}</td>
		            	<td>{{ $order['contact']['name'] }}</td>
		            	<td>{{ $order['order_amount'] }}</td>
		            	<td>{{ date('Y-m-d H:m:s',$order['add_time']) }}</td>
		            	<td><a href="info?id={{ $order['order_id'] }}">编辑</a> | <a href="info?id={{ $order['order_id'] }}">删除</a></td>
		            </tr>
		            @endforeach
	            </table>
	        </div>
        </div>
    </div>
</div>
@endsection
