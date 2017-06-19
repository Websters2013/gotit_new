<?php
/*
Template Name: Services
*/
get_header();
$title = explode(' ', get_the_title(11));
$title_string = '';
foreach ($title as $row) {
	$title_string .= ucfirst($row).' ';
}

$services = get_posts(array(
	'posts_per_page'=> -1,
	'post_type'   => 'services',
	'orderby'     => 'menu_order',
	'order'       => 'ASC',
	'fields'      => 'ids',
	'post_status' => 'publish'
));

if(!empty($services)) {
	$nav_services = '<!--navigation-controls--><ul class="navigation-controls show">';
	$list_services = '<!--our-services__list--><div class="our-services__list">';
	$count = 0;
	foreach ($services as $row) {
		$slug = get_post_field( 'post_name', $row );
		$title_post = get_the_title($row);
		$nav_services .= '<li><!--navigation-controls__btn-->
			<a class="navigation-controls__btn" href="#'.$slug.'">'.$title_post.'</a>
		<!--/navigation-controls__btn--></li>';
		$list_services .= '<!--our-services__item-->
					<div id="'.$slug.'" class="our-services__item navigation-item">

						
						<!--our-services__item-notice-->
						<a href="'.get_permalink($row).'" class="our-services__item-notice">'.$title_post.'</a>
						<!--/our-services__item-notice-->

						<!--our-services__item-pic-->
						<a href="'.get_permalink($row).'" class="our-services__item-pic paralax" data-distance="200">
						    <img src="'.get_the_post_thumbnail_url($row).'" alt="'.$slug.'">
						</a>
						<!--/our-services__item-pic-->
						

						<!--our-services__item-text-->
						<div class="our-services__item-text show">

							<!--our-services__item-title-->
							<h2 class="our-services__item-title show">'.get_field('service_title', $row).'</h2>
							<!--/our-services__item-title-->
							'.get_field('service_excerpt', $row).'
						</div>
						<!--/our-services__item-text-->

					</div>
					<!--/our-services__item-->';
		if($count < 1) {
			$btn_down = get_post_field( 'post_name', $row );
		}
		$count++;
	}
	$nav_services .= '</ul><!--/navigation-controls-->';
	$list_services .= '</div><!--/our-services__list-->';
}
?>

	<!-- site__content -->
	<main class="site__content">

		<!--our-services-->
		<div class="our-services">

			<!--our-services__wrap-->
			<div class="our-services__wrap">

				<!--our-services__hero-->
				<div class="our-services__hero">

					<!--our-services__hero-wrap-->
					<div class="our-services__hero-wrap">

						<div>

							<!--our-services__hero-title-->
							<h1 class="our-services__hero-title">
								<?= $title_string; ?>
							</h1>
							<!--/our-services__hero-title-->

						</div>

						<!--navigation-down-->
						<a href="#<?= $btn_down; ?>" class="navigation-down show">
							<span></span>
						</a>
						<!--/navigation-down-->

					</div>
					<!--/our-services__hero-wrap-->

						<?= $nav_services; ?>

				</div>
				<!--/our-services__hero-->

				<?= $list_services; ?>

			</div>
			<!--/our-services__wrap-->

		</div>
		<!--/our-services-->

	</main>
	<!-- /site__content -->
<?php get_footer(); ?>