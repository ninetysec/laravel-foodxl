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
					<h2 class="cursive-font primary-color">订单支付</h2>
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
						</tr>
					</thead>
					<tbody id="goods">
						
					</tbody>
				</table>
			</div>
			<div id='info'>
				
			</div>
			<div class="row" style="padding-top: 5%;float:right;">
				<div class="col-md-2">
					<button type="submit" class="btn btn-default">支付订单</button>
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
		// 获取URL参数
		function getQueryVariable(variable)
		{
		       var query = window.location.search.substring(1);
		       var vars = query.split("&");
		       for (var i=0;i<vars.length;i++) {
		               var pair = vars[i].split("=");
		               if(pair[0] == variable){return pair[1];}
		       }
		       return(false);
		}

	    $(function() {
			// 产品列表
			var id = getQueryVariable('id');
	        $.get("/api/order/info?id="+id, function(data) {
				for(var i = 0;i<data['order_goods'].length;i++){
					$('#goods').append(getGoods(data['order_goods'][i]));
				}
				$('#info').append(getInfo(data));
			});
		});

		function getGoods(obj) {
			var tmp = `<tr><td>`
					+obj.goods_name+`</td><td>`
					+obj.goods_price.replace(/,/,".")+` €</td><td>`
					+obj.goods_number+`</td><td>`
					+((obj.goods_price*obj.goods_number).toFixed(2)).replace(/,/,".")+` €</td></tr>`;
			return tmp;
		}

		function getInfo(obj) {
			var tmp = `<br><ul><li>Name：`
					+obj.contact.name+`</li><li>Phone：`
					+obj.contact.phone+`</li><li>Email：`
					+obj.contact.email+`</li><li>Address：`
					+obj.contact.address+`</li><li>Time：`
					+obj.time+`</li><li>Total：<span style="color:red;">`
					+obj.order_amount.replace(/,/,".")+` €</span></li></ul>`;
			return tmp;
		}
	</script>
</html>

