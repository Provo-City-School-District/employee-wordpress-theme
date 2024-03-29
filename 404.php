<?php
get_header();
?>
<main id="mainContent">

	<section class="content page">
		<?php custom_breadcrumbs(); ?>
		<div class="postwrapper">
			<article class="activePost">
				<h1>404 Page not Found</h1>
				<h2>Oops! The web page you&#39;re looking for can&#39;t be found.</h2>
				<div class="grid404">
				<script id="cludo-404-script" data-cid="10000352" data-eid="10000520">
					(function() {
						var s = document.createElement('script');
						s.type = 'text/javascript';
						s.async = true;
						s.src = 'https://customer.cludo.com/scripts/404/cludo-404.js';
						var x = document.getElementsByTagName('script')[0];
						x.parentNode.insertBefore(s, x);
					})();
				</script>
				<img id="image404" class="" src="https://globalassets.provo.edu/image/404/404error1.jpg" alt="" />
				<!--[if lte IE 9]>
					<script src="https://api.cludo.com/scripts/xdomain.js" slave="https://api.cludo.com/proxy.html"></script>
					<![endif]-->	
				</div>
				
			
				
				<div class="clear"></div>
			</article>
		</div>
	</section>
	<?php get_sidebar('employeeNews'); ?>
</main>

<?php
get_footer();
?>