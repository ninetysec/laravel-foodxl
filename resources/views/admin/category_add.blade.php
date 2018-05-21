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
		        	<form action="act" method="post" class="form-horizontal">
		        		@csrf
		        		<input name="action" value="insert" type="hidden" />
		        		<div class="form-group">
		        			<label class="col-md-4 control-label">类名：</label>
			        		<div class="col-md-4">
			        			<input name="name" value="" type="text" required="required" class="form-control" />
			        		</div>
			        	</div>
		        		<div class="form-group">
		        			<label class="col-md-4 control-label">备注：</label>
			        		<div class="col-md-4">
			        			<input name="desc" value="" type="text" class="form-control" />
			        		</div>
			        	</div>
		        		<div class="form-group">
		        			<label class="col-md-4 control-label">上级：</label>
			        		<div class="col-md-4">
			        			<select name='parent_id'>
			        				<option value="0">顶级分类</option>
			        				@foreach ($cat as $c)
			        				<option value="{{ $c['cat_id'] }}">{{ $c['cat_name'] }}</option>
			        				@endforeach
			        			</select>
			        		</div>
			        	</div>
		        		<div class="form-group">
		        			<label class="col-md-4 control-label">排序：</label>
			        		<div class="col-md-4">
			        			<input name="sort_order" value="0" type="text" class="form-control" />
			        		</div>
			        	</div>
		        		<div class="form-group">
		        			<div class="col-md-4 col-md-offset-4">
				    			<input type="submit" name="submit" class="btn btn-primary" />
				    		</div>
				    	</div>
			    	</form>
		    	</div>
		    </div>
        </div>
    </div>
</div>
@endsection
