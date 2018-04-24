@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('status'))
                <div class="tools-alert tools-alert-green">
                    {{ session('status') }}
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
			        			<input name="parent_id" value="" type="text" class="form-control" />
			        		</div>
			        	</div>
		        		<div class="form-group">
		        			<label class="col-md-4 control-label">排序：</label>
			        		<div class="col-md-4">
			        			<input name="sort_order" value="" type="text" class="form-control" />
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
