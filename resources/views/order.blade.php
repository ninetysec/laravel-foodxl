	@include('includes.header')
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

	
	<!-- <div class="page-inner"> -->
	@include('includes.nav')
	
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
				<div class="col-md-3">
					<div class="form-group">
						<input type="text" class="form-control" id="phone" placeholder="Your Phone">
					</div>
				</div>
				<div class="col-md-2">
					<button type="submit" class="btn btn-default btn-block" id="search">Search</button>
				</div>
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
			// 订单列表
	        $.get("/api/order/list", function(data) {
				for(var i = 0;i<data.length;i++){
					$('#menu').append(getMenu(data[i]));
				}
			});

			// 搜索订单
			$("#search").click(function(){
				var phone = $("#phone").val();
		        $.get("/api/order/search?phone=" + phone, function(data) {
		        	$("#menu").empty();
					for(var i = 0;i<data.length;i++){
						$('#menu').append(getMenu(data[i]));
					}
				});
			});
		});

		function getMenu(obj) {
			var tmp = `<tr><td>`
					+obj.order_sn+`</td><td>`
					+obj.order_status+`</td><td>`
					+obj.contact.name+`</td><td>`
					+obj.order_amount+`</td><td>`
					+obj.add_time+`</td><td>`
					+`<a href="order_info?id=`+obj.order_id+`">查看</a></td></tr>`;
			return tmp;
		}
	</script>
</html>
