<!-- site__footer -->
<footer class="site__footer">

	<!-- site__footer-logo -->
	<div class="site__footer-logo">
		<?= get_field('copyright', 2); ?>
	</div>
	<!-- /site__footer-logo -->

	<!-- social -->
	<div class="social">

		<?php
		if( have_rows('socials_list', 2) ) {
			while( have_rows('socials_list', 2) ) {
				the_row(2);
				$social_image = get_sub_field_object('social_image', 2);
				$value = $social_image['value'];
				//var_dump($social_image);
				echo '<!-- social__item --><a class="social__item" href="'.get_sub_field('social_url', 2)
				     .'" target="_blank" title="'.$social_image['choices'][$value].'">';
				set_query_var( 'social_image', $value );
				get_template_part( '/contents/content', 'social_switch');
				echo '</a><!-- /social__item -->';

			}
		}
		?>

	</div>
	<!-- /social -->

    <!-- newsletter -->
    <div class="newsletter">
			<?= do_shortcode('[gravityform id=1 title=false description=false ajax=true]'); ?>
    </div>
    <!-- /newsletter -->

	<p class="site__footer-copyright">© <?= date(Y); ?> | <a href="/" target="_blank" class="link-underline"><?= get_field('copyright', 2); ?></a></p>

</footer>
<!-- /site__footer -->

</div>
<!-- /site -->

<?php wp_footer(); ?>
</body>
</html>