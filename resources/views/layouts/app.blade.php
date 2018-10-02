<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style type="text/css">
    body {
        padding-top: 70px;
    }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">FoodXL</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">分类 <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/admin/category/list">列表</a></li>
                                <li><a href="/admin/category/add">添加</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">产品 <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/admin/goods/list">列表</a></li>
                                <li><a href="/admin/goods/add">添加</a></li>
                            </ul>
                        </li>
                        <li><a href="/admin/order/list">订单</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">设置 <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">后台密码</a></li>
                                <li><a href="#">网站设置</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/admin">管理面板</a></li>
                        <li class="active"><a href="/admin/logout">退出 <span class="sr-only">(current)</span></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript">
    $("#is_on_sale").change(function() { 
        if ($('#is_on_sale').attr('checked')) {
            alert('选中');
        } else {
            alert('未选中');
        }
    });

    $("#order_save").click(function() {
        var id = $("#order_id").val();
        var pay_status = $("#pay_status").val();
        var order_status = $("#order_status").val();
        var status = {"pay_status":pay_status,"order_status":order_status};
        var arr = {"action":"status","id":id,"status":JSON.stringify(status),"_token":"{{ csrf_token() }}"};
        console.log(arr);
        $.ajax({
            type: 'POST',
            url: 'act',
            data: arr,
            dataType: 'json',
            success: function(res) {
                alert('保存成功');
                location.href = 'list';
            },
            error: function(msg) {
                if (msg.status == 422) {
                    var json = JSON.parse(msg.responseText);
                    json = json.errors;                      
                    for (var item in json) {
                        for (var i = 0; i < json[item].length; i++) {
                            alert(json[item][i]);
                            return; //遇到验证错误，就退出
                        }
                    }
                }
            }
        });
    });
    </script>
</body>
</html>
