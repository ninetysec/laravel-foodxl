@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
    	<div class="table-responsive">
        	<table class="table table-striped">
        		<tr>
	        		<th>分类名称</th>
	        		<th>分类备注</th>
	        		<th>首页</th>
	        		<th>排序</th>
	        		<th>操作</th>
	        	</tr>
	            @foreach ($data as $cat)
	            <tr>
	            	<td>{{ $cat['cat_name'] }}</td>
	            	<td>{{ $cat['cat_desc'] }}</td>
	            	<td>
	            	@if ($cat['index'] == 1)
	            	<a href="act?action=index&id={{ $cat['cat_id'] }}&value=0">隐藏</a>
	            	@else
					<a href="act?action=index&id={{ $cat['cat_id'] }}&value=1">显示</a>
					@endif
	            	</td>
	            	<td><!--<input type="text" name="sort_order" value="{{ $cat['sort_order'] }}" size="1" />-->{{ $cat['sort_order'] }}</td>
	            	<td><a href="info?id={{ $cat['cat_id'] }}">编辑</a> | <a href="act?action=delete&id={{ $cat['cat_id'] }}">删除</a></td>
	            </tr>
	            	@foreach ($cat['son'] as $son)
		            <tr>
		            	<td>&nbsp;&nbsp;&nbsp;&nbsp;|— {{ $son['cat_name'] }}</td>
		            	<td>{{ $son['cat_desc'] }}</td>
		            	<td>
		            	@if ($son['index'] == 1)
		            	<a href="act?action=index&id={{ $son['cat_id'] }}&value=0">隐藏</a>
		            	@else
						<a href="act?action=index&id={{ $son['cat_id'] }}&value=1">显示</a>
						@endif
		            	</td>
		            	<td><!--<input type="text" name="sort_order" value="{{ $son['sort_order'] }}" size="1" />-->{{ $son['sort_order'] }}</td>
		            	<td><a href="info?id={{ $son['cat_id'] }}">编辑</a> | <a href="act?action=delete&id={{ $son['cat_id'] }}">删除</a></td>
		            </tr>
	            	@endforeach
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
