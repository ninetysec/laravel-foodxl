@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="panel panel-default">
            	<div class="bs-example">
		        	<form action="act" method="post" class="form-horizontal" enctype="multipart/form-data">
		        		@csrf
		        		<input name="action" value="update" type="hidden" />
		        		<input name="id" value="{{ $data['cat_id'] }}" type="hidden" />
		        		<br>
		        		<div class="form-group">
		        			<label class="col-md-4 control-label">类名：</label>
			        		<div class="col-md-4">
			        			<input name="name" value="{{ $data['cat_name'] }}" type="text" required="required" class="form-control" />
			        		</div>
			        	</div>
		        		<div class="form-group">
		        			<label class="col-md-4 control-label">备注：</label>
			        		<div class="col-md-4">
			        			<input name="desc" value="{{ $data['cat_desc'] }}" type="text" class="form-control" value="" />
			        		</div>
			        	</div>
		        		<div class="form-group">
		        			<label class="col-md-4 control-label">上级：</label>
			        		<div class="col-md-4">
			        			<select name='parent_id'>
			        				<option value="0">一级分类</option>
			        				@foreach ($cat as $c)
			        				<option value="{{ $c['cat_id'] }}" {{ ($data['parent_id'] == $c['cat_id']) ? 'selected' : '' }}>{{ $c['cat_name'] }}</option>
			        				@endforeach
			        			</select>
			        		</div>
			        	</div>
		        		<div class="form-group">
		        			<label class="col-md-4 control-label">排序：</label>
			        		<div class="col-md-4">
			        			<input name="sort_order" value="{{ $data['sort_order'] }}" type="text" class="form-control" />
			        		</div>
			        	</div>
		        		<div class="form-group">
		        			<label class="col-md-4 control-label">背景图：</label>
			        		<div class="col-md-4">
			        			<input name="image" value="" type="file" accept="image/*" class="form-control">
			        		</div>
			        		<small>建议尺寸：1500x720</small>
			        	</div>
		        		<div class="form-group" style="text-align: center;">
		        			@if($data['cat_img'] != '')
			        			<img src="{{ $data['cat_img'] }}" class="img-thumbnail" width="350">
		        			@endif
			        	</div>
		        		<div class="form-group" style="text-align: center;">
		        			<input type="submit" name="submit" class="btn btn-primary" />
				    	</div>
			    	</form>
		    	</div>
		    </div>
        </div>
    </div>
</div>
@endsection
