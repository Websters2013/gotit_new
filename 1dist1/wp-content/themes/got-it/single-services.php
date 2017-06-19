<?php get_header(); ?>
	<!-- site__content -->
	<main class="site__content">

		<!--dedicated-->
		<div class="dedicated">

			<!--dedicated__hero-->
			<div class="dedicated__hero">

				<!--dedicated__hero-link-->
				<a href="<?= get_permalink(11); ?>" class="dedicated__hero-link link-underline"><?= get_field('button_title_to_services', 11); ?></a>
				<!--/dedicated__hero-link-->

				<!--dedicated__hero-wrap-->
				<div class="dedicated__hero-wrap">

					<div>

						<!--dedicated__hero-title-->
						<h1 class="dedicated__hero-title"><?= get_field('service_title', $post->ID); ?></h1>
						<!--/dedicated__hero-title-->

					</div>

					<!--navigation-down-->
					<span class="navigation-down show">
						<span></span>
					</span>
					<!--/navigation-down-->

				</div>
				<!--/dedicated__hero-wrap-->

				<!--dedicated__hero-pic-->
				<div class="dedicated__hero-pic show" style="background-image: url('<?= get_field('thumbnail_single_page')['url']; ?>')"></div>
				<!--/dedicated__hero-pic-->

			</div>
			<!--/dedicated__hero-->

			<!--dedicated__info-->
			<div class="dedicated__info">

				<?= get_post_field('post_content', $post->ID); ?>

			</div>
			<!--/dedicated__info-->

		</div>
		<!--/dedicated-->

		<!--contact-panel-->
		<div class="contact-panel">

			<!--contact-panel__wrap-->
			<div class="contact-panel__wrap">

				<!--contact-panel__text-->
				<p class="contact-panel__text">
					<?= get_field('content_yellow_tape', 11); ?>
				</p>
				<!--/contact-panel__text-->

				<!--btn-->
				<a href="<?= get_permalink(13); ?>" class="btn"><span><?= get_field('button_title_to_contacts', 11); ?></span></a>
				<!--/btn-->

			</div>
			<!--/contact-panel__wrap-->

		</div>
		<!--/contact-panel-->

	</main>
	<!-- /site__content -->
<?php get_footer(); ?>