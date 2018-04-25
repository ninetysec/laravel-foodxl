@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        	<div class="table-responsive">
	        	<table class="table table-striped">
	        		<tr>
		        		<th>分类ID</th>
		        		<th>分类名称</th>
		        		<th>分类备注</th>
		        		<th>排序</th>
		        		<th>操作</th>
		        	</tr>
		            @foreach ($data as $cat)
		            <tr>
		            	<td>{{ $cat['cat_id'] }}</td>
		            	<td>{{ $cat['cat_name'] }}</td>
		            	<td>{{ $cat['cat_desc'] }}</td>
		            	<td><input type="text" name="sort_order" value="{{ $cat['sort_order'] }}" size="1" /></td>
		            	<td><a href="info?id={{ $cat['cat_id'] }}">编辑</a> | <a href="info?id={{ $cat['cat_id'] }}">删除</a></td>
		            </tr>
		            	@foreach ($cat['son'] as $son)
			            <tr>
			            	<td>{{ $son['cat_id'] }}</td>
			            	<td> |— {{ $son['cat_name'] }}</td>
			            	<td>{{ $son['cat_desc'] }}</td>
			            	<td><input type="text" name="sort_order" value="{{ $son['sort_order'] }}" size="1" /></td>
			            	<td><a href="info?id={{ $son['cat_id'] }}">编辑</a> | <a href="info?id={{ $son['cat_id'] }}">删除</a></td>
			            </tr>
		            	@endforeach
		            @endforeach
	            </table>
	        </div>
        </div>
    </div>
</div>
@endsection
