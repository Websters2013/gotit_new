<?php
/*
Template Name: About
*/
get_header();

$about_letters = get_field('about_letters', 9);
$about_letters = preg_split('//', $about_letters,-1, PREG_SPLIT_NO_EMPTY);
if($about_letters) {
	$logo_letters = '<!-- about-us__letters --><div class="about-us__letters">';
	foreach ($about_letters as $row) {
		$logo_letters .= '<div class="show show_is"><span>'.$row.'</span></div>';
	}
	$logo_letters .= '</div><!-- /about-us__letters -->';
}

$about_thumbnail = '<img src="'.get_the_post_thumbnail_url(9).'" alt="'.get_the_post_thumbnail_caption(9).'">';

$team = get_posts(array(
	'posts_per_page'=> -1,
	'post_type'   => 'team',
	'orderby'     => 'menu_order',
	'order'       => 'ASC',
	'fields'      => 'ids',
	'post_status' => 'publish'
));

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

?>
	<!-- site__content -->
	<main class="site__content">

		<!-- about-us -->
		<div class="about-us about-us_detail">

				<?= $logo_letters; ?>

			<!-- about-us__title -->
			<h3 class="about-us__title">
				<?= get_field('about_title', 9); ?>
			</h3>
			<!-- /about-us__title -->

			<!-- about-us__border -->
			<div class="about-us__border">

				<!-- about-us__border-mask -->
				<span class="about-us__border-mask"></span>
				<!-- /about-us__border-mask -->

				<!-- about-us__border-mask -->
				<span class="about-us__border-mask"></span>
				<!-- /about-us__border-mask -->

			</div>
			<!-- /about-us__border -->

			<!-- about-us__image -->
			<div class="about-us__image"><?= $about_thumbnail; ?></div>
			<!-- /about-us__image -->

			<!-- about-us__content -->
			<div class="about-us__content">
				<?= get_post_field('post_content', 9); ?>
			</div>
			<!-- /about-us__content -->

				<?= $team_string; ?>

		</div>
		<!-- /about-us -->

	</main>
	<!-- /site__content -->
<?php get_footer(); ?>