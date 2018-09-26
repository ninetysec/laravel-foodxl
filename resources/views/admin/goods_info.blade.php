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
                        <input name="id" value="{{ $data['goods_id'] }}" type="hidden" />
                        <div class="form-group">
                            <label class="col-md-4 control-label">菜名：</label>
                            <div class="col-md-4">
                                <input name="name" value="{{ $data['goods_name'] }}" type="text" required="required" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">备注：</label>
                            <div class="col-md-4">
                                <input name="desc" value="{{ $data['goods_desc'] }}" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">分类：</label>
                            <div class="col-md-4">
                                <select name='cat_id'>
                                    @foreach ($cat as $c)
                                    <option value="{{ $c['cat_id'] }}"  {{ ($data['cat_id'] == $c['cat_id']) ? 'selected' : '' }}>{{ $c['cat_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">上架：</label>
                            <div class="col-md-4">
                                <input name="is_on_sale" value="1" type="checkbox" {{ empty($data['is_on_sale']) ? '' : 'checked="checked"' }} />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">价格：</label>
                            <div class="col-md-4">
                                <input name="price" value="{{ $data['shop_price'] }}" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">排序：</label>
                            <div class="col-md-4">
                                <input name="sort_order" value="{{ $data['sort_order'] }}" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">图片：</label>
                            <div class="col-md-4">
                                <input name="image" value="" type="file" class="form-control" accept="image/*" />
                            </div>
                        </div>
                        <div style="width: 30%;" class="center-block">
                            <img src="/{{ $data['goods_img'] }}" class="img-responsive" alt="Responsive image" />
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