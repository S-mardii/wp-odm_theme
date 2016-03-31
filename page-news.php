<?php
/*
Template Name: News archive page
*/
?>
<?php
	get_header();
?>
<?php
    $filter_by_lang = strtolower(get_localization_language_by_language_code(qtrans_getLanguage()));
		$paged = get_query_var('paged') ? get_query_var('paged') : 1;

		if (SITE_NAME == "Cambodia"){
				$number_latest_post = 25;
				$args_news = array(
					'post_type' => 'post',
					'tax_query' => array(
						array(
							'taxonomy' => 'language',
							'field'    => 'slug',
							'terms'    => 'khmer',
						),
					),
				);

				query_posts($args_news);
		}else {
				/*$number_latest_post = 25;
				query_posts(array(
					'posts_per_page' => $number_latest_post,
					'post__not_in' => get_option('sticky_posts'),
					'paged' => $paged,
					'post_type' => 'post',
					'post_status' => 'publish'
				));*/
		}
?>
<?php	if(have_posts()) : ?>
				<div class="section-title">
					<div class="container">
						<div class="nine columns">
									<h1><?php the_title() ?></h1>
						</div>
					</div>
				</div>
  			<?php get_template_part('loop'); ?>
<?php
			endif;
			wp_reset_query();
?>

<?php get_footer(); ?>