@include('includes.header')
<body>
	
<div class="gtco-loader"></div>

<div id="page">
<nav class="gtco-nav" role="navigation">
	<div class="gtco-container">
		<div class="row">
			<div class="col-sm-4 col-xs-12">
				<div id="gtco-logo"><a href="/">FoodXL</a></div>
			</div>
			<div class="col-xs-8 text-right menu-1">
				<ul>
					<li class="has-dropdown">
						<a href="services">分类列表</a>
						<ul class="dropdown">
							<li><a href="#">菜单1</a></li>
							<li><a href="#">Wedding Celebration</a></li>
							<li><a href="#">Birthday's Celebration</a></li>
						</ul>
					</li>
					<li><a href="cart">购物车 <span class="label label-info">1</span></a></li>
					<li><a href="contact">联系我们</a></li>
					<li class="btn-cta"><a href="#"><span>预定位置</span></a></li>
				</ul>	
			</div>
		</div>
	</div>
</nav>

<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_1.jpg)" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12 col-md-offset-0 text-left">
				<div class="row row-mt-15em">
					<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
						<h1 class="cursive-font">相约在8月！</h1>	
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<div class="gtco-section">
	<div class="gtco-container" id="menu">
	</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">菜品详情</h4>
      </div>
      <div class="modal-body" id="myContent"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button id="commande" type="button" class="btn btn-primary">添加购物车</button>
      </div>
    </div>
  </div>
</div>

@include('includes.footer')

</body>
<script type="text/javascript">
	var goods =[];
    $(function() {
		// 需要修改 
		// http://test.foodxl.fr:8000/api/category/list

		$.ajaxSetup({async : false});
		$.get("/api/category/list", function(cat) {
			for(var i = 0;i<cat.length;i++){
				$('#menu').append(getCat(cat[i]));
				$.get("/api/category/info?id=" + cat[i]['cat_id'], function(data) {
					// $('#menu').append(getCat(cat[i]));
					for(var x = 0;x<data.length;x++) {
						$('#menu').append(getGoods(data[x]));
						goods.push(data[x]);
						if (x == 6) {break;}
					}
				});
			}
		});
	});

	// modal 窗口
	function modal(id){
		var obj=findGood(id);
		if(obj){
			$('#myModal').modal();
			$('#myContent').html(`
				<div  class="fh5co-card-item" >
					<figure>
						<img src="`+obj.goods_img+`" alt="Image" class="img-responsive">
					</figure>
					<div class="fh5co-text">
						<h2>`+obj.goods_name+`</h2>
						<p>`+obj.goods_desc+`</p>
						<p><span class="price cursive-font">€`+obj.shop_price+`</span></p>
					</div>
				</div>
			`);
			$('#commande').on('click',function(){
				$.get(`api/cart/add?goods_id=`+obj.goods_id+`&number=1`,function(){
					alert('添加成功');
				});
			});
		}
	}

	// 查找 货物信息 因为缺少货物详情api
	function findGood(id){
		for(var i =0;i<goods.length;i++){
			if(goods[i].goods_id==id){
				return goods[i];
			}
		}
	} 

	function getGoods(obj){
		var tmp = `<div class="col-lg-4 col-md-4 col-sm-6">
				<a type="button" class="fh5co-card-item image-popup" onclick="modal(`+obj.goods_id+`);">
					<figure>
						<div class="overlay"><i class="ti-plus"></i></div>
						<img src="`+obj.goods_img+`" alt="Image" class="img-responsive">
					</figure>
					<div class="fh5co-text">
						<h2>`+obj.goods_name+`</h2>
						<p>`+obj.goods_desc+`</p>
						<p><span class="price cursive-font">€`+obj.shop_price+`</span></p>
					</div>
				</a>
			</div>`;
		return tmp;
	}

	function getCat(obj){
		var tmp = `<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2 class="cursive-font primary-color">`+obj.cat_name+`</h2>
					<p>`+obj.cat_desc+`</p>
				</div>
			</div>`;
		return tmp;
	}
</script>
</html>