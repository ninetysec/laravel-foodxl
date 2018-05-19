	@include('includes.header')
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

	
	<!-- <div class="page-inner"> -->
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="/">FoodXL</a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li class="active"><a href="cart">Cart</a></li>
						<li><a href="order">Order</a></li>
						<li class="has-dropdown">
							<a href="services">Services</a>
							<ul class="dropdown">
								<li><a href="#">Food Catering</a></li>
								<li><a href="#">Wedding Celebration</a></li>
								<li><a href="#">Birthday's Celebration</a></li>
							</ul>
						</li>
						<li><a href="contact">Contact</a></li>
						<li class="btn-cta"><a href="#"><span>Reservation</span></a></li>
					</ul>	
				</div>
			</div>
			
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/img_bg_1.jpg)" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>

	</header>

	
	
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2 class="cursive-font primary-color">购物车</h2>
				</div>
			</div>
			<style type="text/css">
			table {border-collapse:collapse;width: 100%}

			table,th,td {border: 1px solid black;}
			th,td {padding:15px;}
			</style>
			<div class="row">
				<!-- context -->
				<table>
					<thead>
						<tr>
							<th>菜品名称</th>
							<th>单价</th>
							<th>数量</th>
							<th>小计</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody id="menu">
						
					</tbody>
				</table>
			</div>
			<div class="row" style="padding-top: 5%;">
				<div class="col-md-3">
					<div class="form-group">
						<input type="text" class="form-control" id="name" placeholder="Your Name">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<input type="text" class="form-control" id="phone" placeholder="Your Phone">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<input type="text" class="form-control" id="email" placeholder="Your Email">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<input type="text" class="form-control typeahead" id="address" autocomplete="off" data-provide="typeahead">
					</div>
				</div>
				<div class="col-md-3" style="float:right;padding-top:3%;">
					<button type="submit" class="btn btn-default btn-block" id="checkout">结账</button>
				</div>
				<div class="col-md-3" style="float:right;padding-top:3%;">
					<button type="submit" class="btn btn-default btn-block" id="edit">保存</button>
				</div>
				<div class="col-md-3" style="float:right;padding-top:3%;">
					<button type="submit" class="btn btn-default btn-block" id="clear">Clear</button>
				</div>
			</div>
		</div>
	</div>

	@include('includes.footer')

	</body>
	<script src="http://docker.qfdk.me/static/js/bootstrap3-typeahead.min.js"></script>
	<script type="text/javascript">
	    $(function() {
			// 列表
	        $.get("/api/cart/get", function(data) {
				for(var i = 0;i<data.length;i++){
					$('#menu').append(getMenu(data[i]));
				}
			});
	        
			// 地址
	        $.get("/api/cart/address", function(data) {
				$("#name").val(data['name']);
				$("#phone").val(data['phone']);
				$("#address").val(data['address']);
				$("#email").val(data['email']);
			});

			$("#edit").click(function(){
				var id = '';
				var number = '';
				$('input[name="id"]').each(function(index,item) {
					id = id + $(this).val() + ',';
				});
				$('input[name="number[]"]').each(function(index,item) {
					number = number + $(this).val() + ',';
				});
				var name = $("#name").val();
				var phone = $("#phone").val();
				var address = $("#address").val();
				var email = $("#email").val();
				var values = {"name":name,"phone":phone,"address":address,"email":email};
				var arr = {
					"id" : id,
					"number" : number,
					"_token" : "{{ csrf_token() }}"
				};
				if (name && phone && address) {
					arr['values'] = JSON.stringify(values);
					// arr['values'] = values;
				}
				$.ajax({        
				        type: "POST",
				        url:'/api/cart/edit',
				        data:arr,
				        dataType:'json',
				        success: function(res) {
				            alert('Success');
				        },
				        error : function (msg) {   
				            if (msg.status == 422) {
				                var json=JSON.parse(msg.responseText);
				                json = json.errors;                      
				                for ( var item in json) {
				                    for ( var i = 0; i < json[item].length; i++) {
				                        alert(json[item][i]);
				                        return ; //遇到验证错误，就退出
				                    }
				                }
				            } else {
				                alert('服务器连接失败');
				                return ;
				            }
				        }
				    });
			});

			// 清除购物车
			$("#clear").click(function(){
				$.get("/api/cart/clear",function(){
					history.go(0);
				});
			});

			// 下单
			$("#checkout").click(function(){
				var id = '';
				$("input[name^='id']").each(function(i){
					id = id + this.value + ',';
                }); 
				console.log(id);
				$.get("/api/cart/checkout?id=" + id,function(){
					location.href='/order';
				});
			});
		});
		function getMenu(obj) {
			/*
			var tmp = `<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="`+obj.goods_img+`" class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="`+obj.goods_img+`" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>`+obj.goods_name+`</h2>
							<p>`+obj.attr_value+`</p>
							<p>`+obj.number+`</p>
							<p><span class="price cursive-font">€`+obj.price+`</span></p>
						</div>
					</a>
				</div>`;
			*/
			var tmp = `<tr><td><input name="id" value='`
					+obj.id+`' type='hidden'/>`+obj.goods_name+`</td><td>`
					+obj.price+`</td><td><input name="number[]" value='`
					+obj.number+`' type='text' size=3/></td><td>`
					+obj.price+`</td><td>`
					+`x</td></tr>`;
			return tmp;
		}
		// 地址自动填充
		$('#address').typeahead({
            limit: 10,
            source: function (query, process) {
                return $.get("http://demo.foodxl.fr:2333/?q=" + $('#address').val(), function (data) {
                    return process(data);
                });
            }
		});
		
	</script>
</html>

