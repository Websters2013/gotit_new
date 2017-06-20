<?php
/*
Template Name: Home
*/
get_header();

$contacts = get_field('contacts', 13);
$contacts_string = '';
if (!empty($contacts)) {
	$contacts_string = '<!--contact__map-location--><div class="contact__map-location">';
	$map_json = '{"icon": "http://'.$_SERVER['HTTP_HOST'].'/img/map_icon.png","zoom": 11,"places":[';
	foreach ($contacts as $row) {
		$map_json .= '{"lat": "'.$row['place_latitude'].'","lng": "'.$row['place_longitude'].'"}, ';
		$contacts_string .= '<!--contact__map-location-item-->
						<a href="http://www.google.com/maps/place/'.$row['place_latitude'].','.$row['place_longitude'].'" target="_blank" class="contact__map-location-item link-underline link-underline_bold">
							'.$row['city_name'].'
						</a>
						<!--/contact__map-location-item-->';
	}
	$map_json = substr($map_json, 0 , -2);
	$map_json .= ']}';
	$contacts_string .= '</div><!--/contact__map-location-->';
}

$home_thumbnail = '<img src="'.get_the_post_thumbnail_url(2).'" alt="'.get_the_post_thumbnail_caption(2).'">';

$team = get_field('team', 2);
$team_count = count($team);
$count = 0;
$team_string = '';
if(!empty($team)) {
	$team_string = '<!-- about-us__wrap --><div class="about-us__wrap">';
	$team_string_1 = '<!-- about-us__column --><div class="about-us__column">';
	$team_string_2 = '<!-- about-us__column --><div class="about-us__column">';
	$team_string_3 = '<!-- about-us__column --><div class="about-us__column">';
	foreach ($team as $row) {

		$title = explode(' ', get_the_title($row));
		$title = $title[0].'<span>'.$title[1].'</span>';

		$team_string_row = '<!-- about-us__item -->
                    <div class="about-us__item">
						<!-- about-us__item-thumb -->
						<span class="about-us__item-thumb" style="background-image: url('.get_the_post_thumbnail_url($row).'"></span>
						<!-- /about-us__item-thumb -->
						<!-- about-us__item-name -->
						<dl class="about-us__item-name">
							<dt>
								'.$title.'
							</dt>
							<dd>'.get_field('position', $row).'</dd>
						</dl>
						<!-- /about-us__item-name -->
					</div>
					<!-- /about-us__item -->';

		switch ($count%3) {
			case 0:
				$team_string_1 .= $team_string_row;
				break;
			case 1:
				$team_string_2 .= $team_string_row;
				break;
			case 2:
				$team_string_3 .= $team_string_row;
				break;
		}
		$count++;
	}
	$team_string_and .= '</div><!-- /about-us__column -->';
	$team_string_1 .= $team_string_and;
	$team_string_2 .= $team_string_and;
	$team_string_3 .= $team_string_and;
	if ($team_count === 2) {
		$team_string_3 = '';
	} elseif($team_count === 1) {
		$team_string_2 = '';
		$team_string_3 = '';
	}

	$team_string .= $team_string_1.$team_string_2.$team_string_3.'</div><!-- /about-us__wrap -->';
}

$project = get_posts(array(
	'posts_per_page'=> -1,
	'post_type'   => 'project',
	'orderby'     => 'menu_order',
	'order'       => 'ASC',
	'fields'      => 'ids',
	'post_status' => 'publish'
));
$project_string = '';
if(!empty($project)) {
	$project_string = '<!-- case-preview__wrap --><div class="case-preview__wrap">';
    foreach ($project as $row) {
	    $project_string .= '<!-- case-preview__item -->
				<span class="case-preview__item">
                        <span class="case-preview__info">
                            <span>'.get_the_title($row).'</span>
                        </span>
					<img src="'.get_the_post_thumbnail_url($row).'" alt="'.get_the_title($row).'">
				</span>
				<!-- /case-preview__item -->';
    }
	$project_string .= '</div><!-- /case-preview__wrap -->';
}

$services = get_field('services', 2);
$services_string = '';
if(!empty($services)) {
    $services_string = '<!--swiper-wrapper--><div class="swiper-wrapper">';
	$services_button_title = get_field('services_button_title', 2);
    foreach ($services as $row) {
        $image_slider = get_field('thumbnail_slider', $row);
	    $services_string .= '<!--swiper-slide-->
						<div class="swiper-slide">

							<!--services__item-->
							<div class="services__item">

								<!--services__item-pic-->
								<img class="services__item-pic" src="'.$image_slider['url'].'" alt="'.$image_slider['alt'].'">
								<!--/services__item-pic-->

								<!--services__item-info-->
								<div class="services__item-info">

									<!--services__item-title-->
									<h4 class="services__item-title">'.get_the_title($row).'</h4>
									<!--/services__item-title-->

									<!--services__item-info-wrap-->
									<div class="services__item-info-wrap">

										<!--services__item-text-->
										<p class="services__item-text">'.get_field('service_slider_excerpt', $row).'</p>
										<!--/services__item-text-->

										<!--btn-->
										<a href="'.get_permalink($row).'" class="btn"><span>'.$services_button_title.'</span></a>
										<!--/btn-->

									</div>
									<!--/services__item-info-wrap-->

								</div>
								<!--/services__item-info-->

							</div>
							<!--/services__item-->

						</div>
						<!--/swiper-slide-->';
    }
	$services_string .= '</div><!--/swiper-wrapper-->';
}
?>
	<!-- site__content -->
	<main class="site__content">

		<!-- hero -->
		<div class="hero">

			<!-- hero__title -->
			<div class="hero__title" data-text="<?= get_field('text_animation_top',2); ?>"></div>
			<!-- /hero__title -->

			<!-- hero__ban -->
			<div class="hero__ban">
				<?= $home_thumbnail; ?>
			</div>
			<!-- /hero__ban -->

			<!-- hero__services -->
			<a href="<?= get_field('button_url',2); ?>" class="hero__services">
                    <span class="hero__services-wrap"><?= get_field('button_title',2); ?></span>
			</a>
			<!-- /hero__services -->

			<!-- hero__title -->
			<div class="hero__title on-top" data-text="<?= get_field('text_animation_bottom', 2); ?>"></div>
			<!-- /hero__title -->

		</div>
		<!-- /hero -->

		<!-- about-us -->
		<div class="about-us">

			<!-- badge -->
			<dl class="badge">
				<dt><?= get_field('team_letter', 2); ?></dt>
				<dd>
					<?= get_field('team_title', 2); ?>
				</dd>
			</dl>
			<!-- /badge -->

			<?= $team_string; ?>

			<!-- btn -->
			<a href="#" class="btn btn_plus get-in-touch-btn"><span>+</span></a>
			<!-- /btn -->

		</div>
		<!-- /about-us -->

		<!-- case-preview -->
		<div class="case-preview">

			<!-- badge -->
			<dl class="badge">
				<dt><?= get_field('project_letter', 2); ?></dt>
				<dd>
					<?= get_field('project_title',2); ?>
				</dd>
			</dl>
			<!-- /badge -->
            <?= $project_string; ?>


		</div>
		<!-- /case-preview -->

		<!-- services -->
		<div class="services">

			<!-- badge -->
			<dl class="badge">
				<dt><?= get_field('services_letter', 2); ?></dt>
				<dd>
					<?= get_field('services_title', 2); ?>
				</dd>
			</dl>
			<!-- /badge -->

			<!-- services__wrap -->
			<div class="services__wrap">

				<!--swiper-container-->
				<div class="swiper-container">

                    <?= $services_string; ?>


				</div>
				<!--/swiper-container-->

				<!--services__btns-->
				<div class="services__btns">

					<!--swiper-pagination-->
					<div class="swiper-pagination"></div>
					<!--/swiper-pagination-->

					<!--swiper-button-next-->
					<div class="swiper-button-next">
						<svg width="53px" height="14px" viewBox="0 0 53 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<g  stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<g  transform="translate(-1240.000000, -3972.000000)" stroke="#000000">
									<g  transform="translate(150.000000, 3431.000000)">
										<g id="arrow" transform="translate(1090.000000, 542.000000)">
											<path d="M0.5,6 L51.5,6"  stroke-linecap="square"></path>
											<polyline  transform="translate(47.000000, 6.000000) rotate(-45.000000) translate(-47.000000, -6.000000) " points="51 2 51 10 43 10"></polyline>
										</g>
									</g>
								</g>
							</g>
						</svg>
					</div>
					<!--/swiper-button-next-->

					<!--swiper-button-prev-->
					<div class="swiper-button-prev">
						<svg width="54px" height="12px" viewBox="0 0 54 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<g  stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<g  transform="translate(-149.000000, -3973.000000)" stroke="#000000">
									<g  transform="translate(150.000000, 3431.000000)">
										<g id="arrow-copy" transform="translate(26.500000, 548.000000) scale(-1, 1) translate(-26.500000, -548.000000) translate(0.000000, 542.000000)">
											<path d="M0.5,6 L51.5,6"  stroke-linecap="square"></path>
											<polyline  transform="translate(47.000000, 6.000000) rotate(-45.000000) translate(-47.000000, -6.000000) " points="51 2 51 10 43 10"></polyline>
										</g>
									</g>
								</g>
							</g>
						</svg>
					</div>
					<!--/swiper-button-prev-->

				</div>
				<!--/services__btns-->

			</div>
			<!-- /services__wrap -->

		</div>
		<!-- /services -->

		<!-- contact -->
		<div class="contact">

			<!-- contact__title -->
			<h2 class="contact__title"><?= get_field('contact_title', 2); ?></h2>
			<!-- /contact__title -->

			<!--contact__wrap-->
			<div class="contact__wrap">

				<!-- contact__map -->
				<div class="contact__map" data-map='<?= $map_json ?>'></div>
				<!-- /contact__map -->

				<?= $contacts_string; ?>

			</div>
			<!--/contact__wrap-->

		</div>
		<!-- /contact -->

	</main>
	<!-- /site__content -->
<?php get_footer(); ?>