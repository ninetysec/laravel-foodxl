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
		<!--
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					

					<div class="row row-mt-15em">
						<div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
							<span class="intro-text-small">Hand-crafted by <a href="http://gettemplates.co" target="_blank">GetTemplates.co</a></span>
							<h1 class="cursive-font">Taste all our menu!</h1>	
						</div>
						
					</div>
							
					
				</div>
			</div>
		</div>
		-->
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
						<input type="text" class="form-control" id="address" placeholder="Your Address">
					</div>
				</div>
				<div class="col-md-3" style="float:right;padding-top:3%;">
					<button type="submit" class="btn btn-default btn-block" id="checkout">Checkout</button>
				</div>
				<!--
				<div class="col-md-3" style="float:right;padding-top:3%;">
					<button type="submit" class="btn btn-default btn-block" id="clear">Clear</button>
				</div>
				-->
			</div>
		</div>
	</div>
	<!--
	<div class="gtco-cover gtco-cover-sm" style="background-image: url(images/img_bg_1.jpg)"  data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container text-center">
			<div class="display-t">
				<div class="display-tc">
					<h1>&ldquo; Their high quality of service makes me back over and over again!&rdquo;</h1>
					<p>&mdash; John Doe, CEO of XYZ Co.</p>
				</div>	
			</div>
		</div>
	</div>

	<div id="gtco-subscribe">
		<div class="gtco-container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2 class="cursive-font">Subscribe</h2>
					<p>Be the first to know about the new templates.</p>
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					<form class="form-inline">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label for="email" class="sr-only">Email</label>
								<input type="email" class="form-control" id="email" placeholder="Your Email">
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<button type="submit" class="btn btn-default btn-block">Subscribe</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	-->
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

			// 清除购物车
			$("#clear").click(function(){
				$.get("/api/cart/clear",function(){
					history.go(0);
				});
			});

			// 下单
			$("#checkout").click(function(){
				var id = '';
				var pay_status = $("#pay_status").val();
				var order_status = $("#order_status").val();
				var status = {"pay_status":pay_status,"order_status":order_status};
				var arr = {
					"id" : id,
					"number" : number,
					"_token" : "{{ csrf_token() }}"
				};
				if (name && phone && address && email) {
					arr['status'] = JSON.stringify(status);
					$.ajax({
					        type: "POST",
					        url:'/api/cart/edit',
					        data:arr,
					        dataType:'json',
					        success: function(res) {
								$.get("/api/cart/checkout?id=" + id,function(){
									alert('下单成功');
									location.href='/order';
								});
					        },
					        error: function(msg) {   
					            if (msg.status == 422) {
					                var json=JSON.parse(msg.responseText);
					                json = json.errors;                      
					                for (var item in json) {
					                    for (var i = 0; i < json[item].length; i++) {
					                        alert(json[item][i]);
					                        return; //遇到验证错误，就退出
					                    }
					                }
					            } else {
					                alert('服务器连接失败');
					                return;
					            }
					        }
					    }
					);
				} else {
					alert("请完整填写信息");
				}
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
					+obj.price+` €</td><td><input name="number[]" value='`
					+obj.number+`' type='text' size=3/></td><td>`
					+(obj.price*obj.number).toFixed(2)+` €</td><td>`
					+`<a href="/api/cart/act?action=delete&id=`+obj.id+`" >删除</a></td></tr>`;
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

