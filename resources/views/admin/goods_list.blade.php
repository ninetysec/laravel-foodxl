@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
    	<div class="table-responsive">
        	<table class="table table-striped">
        		<tr>
	        		<th>产品ID</th>
	        		<th>产品名称</th>
	        		<th>分类</th>
	        		<th>价格</th>
	        		<th>上架</th>
	        		<th>排序</th>
	        		<th>操作</th>
	        	</tr>
	            @foreach ($data as $goods)
	            <tr>
	            	<td>{{ $goods['goods_id'] }}</td>
	            	<td>{{ $goods['goods_name'] }}</td>
	            	<td>{{ $goods['cat_name'] }}</td>
	            	<td><!--<input type="text" name="shop_price" value="{{ $goods['shop_price'] }}" size="2" />-->{{ $goods['shop_price'] }}</td>
	            	<td><input type="checkbox" name="is_on_sale" id="is_on_sale" {{ empty($goods['is_on_sale']) ? '' : "checked='checked'" }}/></td>
	            	<td><!--<input type="text" name="sort_order" value="{{ $goods['sort_order'] }}" size="1" />-->{{ $goods['sort_order'] }}</td>
	            	<td><a href="info?id={{ $goods['goods_id'] }}">编辑</a> | <a href="act?action=delete&id={{ $goods['goods_id'] }}">删除</a></td>
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
