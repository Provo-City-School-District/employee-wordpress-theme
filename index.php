<?php
get_header();
?>
<main id="mainContent">
	<div class="newsContainer">
		<section class="content postgrid">
			<h1>Employee News</h1>

			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$the_query = new WP_Query(array('posts_per_page' => 18, 'category_name'  => 'employee-news', 'post_type'  => 'post', 'paged'  => $paged));
			if ($the_query->have_posts()) :
				while ($the_query->have_posts()) : $the_query->the_post(); ?>
					<article class="post">
						<a href="<?php the_permalink(); ?>">
							<div class="featured-image">

								<?php
								if (get_field('featured_image', $post_id)) {
								?>
									<img src="<?php echo get_field('featured_image'); ?>" alt="" class="" />
								<?php
								} elseif (has_post_thumbnail()) {
									the_post_thumbnail();
								} else { ?>
									<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/building-image.jpg'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" width="217" height="175">
								<?php } ?>

							</div>
							<h2><?php the_title(); ?></h2>
						</a>
						<header class="postmeta">
							<ul>
								<li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="" /><?php the_time(' F jS, Y') ?></li>
							</ul>
						</header>
						<?php
						echo get_excerpt();
						?>
					</article>

				<?php endwhile; ?>
				<nav class="archiveNav">
					<?php echo paginate_links(array('total' => $the_query->max_num_pages)); ?>
				</nav>
			<?php else :
				echo '<p>No Content Found</p>';
			endif;
			?>
		</section>
	</div>

	<?php get_sidebar('employeeNews'); ?>
</main>
<?php
get_footer();
?>