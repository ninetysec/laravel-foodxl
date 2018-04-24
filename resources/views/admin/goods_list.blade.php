@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        	<div class="table-responsive">
	        	<table class="table table-striped">
	        		<tr>
		        		<th>产品ID</th>
		        		<th>产品名称</th>
		        		<th>产品备注</th>
		        		<th>排序</th>
		        		<th>操作</th>
		        	</tr>
		            @foreach ($data as $goods)
		            <tr>
		            	<td>{{ $goods['goods_id'] }}</td>
		            	<td>{{ $goods['goods_name'] }}</td>
		            	<td>{{ $goods['goods_desc'] }}</td>
		            	<td>{{ $goods['sort_order'] }}</td>
		            	<td><a href="info?id={{ $goods['goods_id'] }}">编辑</a> | <a href="info?id={{ $goods['goods_id'] }}">删除</a></td>
		            </tr>
		            @endforeach
	            </table>
	        </div>
        </div>
    </div>
</div>
@endsection
