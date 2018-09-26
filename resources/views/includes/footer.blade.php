<footer id="gtco-footer" role="contentinfo" style="background-image: url(images/img_bg_1.jpg)" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="gtco-container">
		<div class="row row-pb-md">
			<div class="col-md-12 text-center">
				<div class="gtco-widget">
					<h3>Get In Touch</h3>
					<ul class="gtco-quick-contact">
						<li><a href="#"><i class="icon-phone"></i>01.47.94.89.20</a></li>
						<li><a href="#"><i class="icon-mail2"></i>5 parvis Pierre de Coubertin - 92600 Asnières-sur-Seine</a></li>
						<li><a href="#"><i class="icon-chat"></i>foodxl.moshimo@gmail.com</a></li>
					</ul>
				</div>
				<div class="gtco-widget">
					<h3>Get Social</h3>
					<ul class="gtco-social-icons">
						<li><a href="#"><i class="icon-twitter"></i></a></li>
						<li><a href="#"><i class="icon-facebook"></i></a></li>
						<li><a href="#"><i class="icon-linkedin"></i></a></li>
						<li><a href="#"><i class="icon-dribbble"></i></a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-12 text-center copyright">
				<p><small class="block">&copy; 2018 FOODXL. All Rights Reserved.</small></p>
			</div>

		</div>

		

	</div>
</footer>
<!-- </div> -->

</div>

<div class="gototop js-top">
	<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

<!-- jQuery -->
<script src="http://docker.qfdk.me/static/js/jquery.min.js"></script>

<!-- jQuery Easing -->
<script src="js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="js/jquery.waypoints.min.js"></script>
<!-- Carousel -->
<script src="js/owl.carousel.min.js"></script>
<!-- countTo -->
<script src="js/jquery.countTo.js"></script>

<!-- Stellar Parallax -->
<script src="js/jquery.stellar.min.js"></script>

<!-- Magnific Popup -->
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/magnific-popup-options.js"></script>

<script src="js/moment.min.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>


<!-- Main -->
<script src="js/main.js"></script>

<script type="text/javascript">
	// 获取购物车数量
	function getNum(){
		$.get("/api/cart/info", function(cart) {
			// console.log(cat.num);
			$('#cart span').text(cart.num);
		});
	}
	// 插入导航栏下拉分类
	function getCatTop(obj){
		var tmp = `<li><a href="category?id=`+obj.cat_id+`">`+obj.cat_name+`</a></li>`;
		return tmp;
	}
	// 插入导航栏下拉分类
	function getCatSon(obj){
		var tmp = `<li><a href="category?id=`+obj.cat_id+`">&nbsp;&nbsp;&nbsp;&nbsp;|—&nbsp;`+obj.cat_name+`</a></li>`;
		return tmp;
	}
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
		$.get("/api/category/list", function(cat) {
			// console.log(cat);
			for(var i = 0;i<cat.length;i++){
				$('nav ul li ul').append(getCatTop(cat[i]));
				for (var x = 0; x<cat[i]['son'].length; x++) {
					$('nav ul li ul').append(getCatSon(cat[i]['son'][x]));
				}
			}
			//$('#cart span').text(cat.num);
		});
		getNum();
	});
</script>