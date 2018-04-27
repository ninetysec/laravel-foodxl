	@include('includes.header')
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

	
	<!-- <div class="page-inner"> -->
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="index">Savory <em>.</em></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="cart">Cart</a></li>
						<li class="active"><a href="order">Order</a></li>
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
					<h2 class="cursive-font primary-color">订单列表</h2>
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
							<th>#</th>
							<th>订单号</th>
							<th>状态</th>
							<th>名称</th>
							<th>总价</th>
							<th>时间</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody id="menu">
						
					</tbody>
				</table>
			</div>
			<div class="row" style="padding-top: 5%;">
				<form class="form-inline">
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
						<button type="submit" class="btn btn-default btn-block" id="edit">Edit</button>
					</div>
				</form>
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
	<script type="text/javascript">
	    $(function() {
			// 需要修改
	        $.get("/api/order/list", function(data) {
	        	/*
				var obj={
					"goods_img":"/uploads/images/2018-04/1523521513.jpg",
					"goods_name": "测试显示",
					"shop_price":25
				}
				*/
				for(var i = 0;i<data.length;i++){
					$('#menu').append(getMenu(data[i]));
					if (i == 6) {break;}
				}
			});
	        /*
			$("#edit").keyup(function(){
				var id = 
				var goods_id = 
				var number = 
				var name = 
				var phone = 
				// var email = 
				var address = 
				var values = {"name":name,"phone":phone,"address":address};
				var arr = {
					"id" : id,
					"goods_id" : goods_id,
					"number" : number,
					"values" : values
				};
		    	$.post("/api/cart/edit",arr,function(data){
		    		console.log(data);
		    	});
			});
			*/
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
			var tmp = `<tr><td>`
					+obj.id+`</td><td>`
					+obj.goods_name+`</td><td>`
					+obj.price+`</td><td>`
					+obj.number+`</td><td>`
					+obj.price+`</td><td>`
					+obj.price+`</td><td>`
					+`x</td></tr>`;
			return tmp;
		}
	</script>
</html>

