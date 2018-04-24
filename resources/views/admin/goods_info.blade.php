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
                        <input name="action" value="update" type="hidden" />
                        <input name="id" value="{{ $goods_id }}" type="hidden" />
                        <div class="form-group">
                            <label class="col-md-4 control-label">菜名：</label>
                            <div class="col-md-4">
                                <input name="name" value="{{ $goods_name }}" type="text" required="required" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">备注：</label>
                            <div class="col-md-4">
                                <input name="desc" value="{{ $goods_desc }}" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">分类：</label>
                            <div class="col-md-4">
                                <input name="cat_id" value="{{ $cat_id }}" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">上架：</label>
                            <div class="col-md-4">
                                <input name="is_on_sale" value="1" type="checkbox" {{ empty($is_on_sale) ? '' : 'checked="checked"' }} />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">价格：</label>
                            <div class="col-md-4">
                                <input name="price" value="{{ $shop_price }}" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">排序：</label>
                            <div class="col-md-4">
                                <input name="sort_order" value="{{ $sort_order }}" type="text" class="form-control" />
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