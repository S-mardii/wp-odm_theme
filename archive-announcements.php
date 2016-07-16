<?php get_header();?>

<div class="section-title main-title">

	<section class="container">
		<header class="row">
			<div class="eight columns">
				<h2><?php _e('Announcements','odm') ?></h2>
			</div>
      <div class="eight columns">
				<?php get_template_part('section', 'query-actions'); ?>
			</div>
		</header>
	</section>

	<section class="container">

		<div class="row">
			<?php while (have_posts()) : the_post();
				odm_get_template('post-list-single-4-cols',array(
					"post" => get_post()
			),true);
			endwhile; ?>
		</div>
	</section>

	<section class="container">
		<div class="row">
			<div class="sixteen columns">
				<?php odm_get_template('pagination',array(),true); ?>
			</div>
		</div>
	</section>

</div>


<?php get_footer(); ?>