@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        @if (session('status'))
            <div class="tools-alert tools-alert-green">
                {{ session('status') }}
            </div>
        @endif
        <div>
            <div class="col-md-8">
                <div class="row marketing">
                    <input type="hidden" value="{{ $order_id }}" id="order_id" />
                    <div class="col-lg-6">
                        <h4>用户</h4>
                        <p>{{ empty($user_id) ? '匿名' : $user_name }}</p>
                    </div>
                    <div class="col-lg-6">
                        <h4>订单号</h4>
                        <p>{{ $order_sn }}</p>
                    </div>
                    <div class="col-lg-6">
                        <h4>状态</h4>
                        <p>{{ $pay_status_char }}、{{ $order_status_char }}</p>
                    </div>
                    <div class="col-lg-6">
                        <h4>总金额：</h4>
                        <p>{{ $order_amount }}</p>
                    </div>
                    <div class="col-lg-6">
                        <h4>下单时间：</h4>
                        <p>{{ date('Y-m-d H:m:s',$add_time) }}</p>
                    </div>
                    <div class="col-lg-6">
                        <h4>配送地址：</h4>
                        <p>{{ $contact['address'] }}、{{ $contact['name'] }}、{{ $contact['phone'] }}</p>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>菜名</th>
                            <th>规格</th>
                            <th>单价</th>
                            <th>数量</th>
                            <th>总价</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_goods as $goods)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $goods['goods_name'] }}</td>
                            <td>{{ $goods['goods_attr'] }}</td>
                            <td>{{ $goods['goods_price'] }}</td>
                            <td>{{ $goods['goods_number'] }}</td>
                            <td>{{ sprintf("%.2f",$goods['goods_number']*$goods['goods_price']) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    <select id="pay_status">
                        <option value="0" {{ ($pay_status == 0) ? 'selected' : '' }}>未支付</option>
                        <option value="1" {{ ($pay_status == 1) ? 'selected' : '' }}>已支付</option>
                    </select>
                    <select id="order_status">
                        <option value="0" {{ ($order_status == 0) ? 'selected' : '' }}>未发货</option>
                        <option value="1" {{ ($order_status == 1) ? 'selected' : '' }}>已发货</option>
                        <option value="2" {{ ($order_status == 2) ? 'selected' : '' }}>已完成</option>
                        <option value="3" {{ ($order_status == 3) ? 'selected' : '' }}>已取消</option>
                        <option value="4" {{ ($order_status == 4) ? 'selected' : '' }}>退款</option>
                    </select>
                    <button id="order_save" type="submit" class="btn btn-primary">保存订单</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection