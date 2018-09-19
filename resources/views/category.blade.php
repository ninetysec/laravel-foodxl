@include('includes.header')
<body>
	
<div class="gtco-loader"></div>

<div id="page">
@include('includes.nav')

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
		var id = getQueryVariable('id');
		$.get("/api/category/info?id=" + id, function(cat) {
			// 载入分类信息
			$('#menu').append(getCat(cat.cat));
			// 修改背景图
			if (cat.cat.cat_img) {
				$("header").css({"background-image":"url('" + cat.cat.cat_img + "')"});
			}
			// 载入产品列表
			if (JSON.stringify(cat.goods) != "[]") {
				for(var i = 0;i<cat.goods.length;i++) {
					$('#menu').append(getGoods(cat.goods[i]));
					goods.push(cat.goods[i]);
					// if (x == 6) {break;}
				}
			} else {
				$('#catModel').append(`<p>Pas de nourriture.</p>`);
			}
		});
	});

	// modal 窗口
	function modal(id){
		var obj=findGood(id);
		if(obj){
			$('#myModal').modal();
			$('#myContent').html(`
				<div class="fh5co-card-item">
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
			$('#commande').unbind("click").bind("click",function(){
				$.get(`api/cart/add?goods_id=`+id+`&number=1`,function(){
					getNum();
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
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading" id="catModel">
					<h2 class="cursive-font primary-color">`+obj.cat_name+`</h2>
					<p>`+obj.cat_desc+`</p>
				</div>
			</div>`;
		return tmp;
	}
</script>
</html>