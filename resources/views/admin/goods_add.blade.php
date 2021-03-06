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
                        <input name="action" value="insert" type="hidden" />
                        <div class="form-group">
                            <label class="col-md-4 control-label">菜名：</label>
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
                            <label class="col-md-4 control-label">分类：</label>
                            <div class="col-md-4">
                                <select name='cat_id'>
                                    @foreach ($cat as $c)
                                    <option value="{{ $c['cat_id'] }}">{{ $c['cat_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">上架：</label>
                            <div class="col-md-4">
                                <input name="is_on_sale" value="1" type="checkbox" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">价格：</label>
                            <div class="col-md-4">
                                <input name="price" value="" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">排序：</label>
                            <div class="col-md-4">
                                <input name="sort_order" value="0" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">图片：</label>
                            <div class="col-md-4">
                                <input name="image" value="" type="file" class="form-control" accept="image/*" />
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