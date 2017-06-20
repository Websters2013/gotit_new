<?php
$logo = get_field('logo_header', 2);
$social_links = get_field('social_links', 2);
$number = get_field('call_number', 13);
$menu_name = 'menu';
$locations = get_nav_menu_locations();
if( $locations && isset($locations[ $menu_name ]) ){

	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	$menu_items = wp_get_nav_menu_items( $menu );
	$menu_list = ' <!--site__menu-wrap--><ul class="site__menu-wrap">';

	foreach ( (array) $menu_items as $key => $menu_item ){

		$perm = get_the_permalink($menu_item->object_id);
		$active = '';
        //var_dump($menu_item);
		if (is_page( $menu_item->object_id)) {
			$active = ' active ';
		}

		$menu_list .= '<li class="site__menu-item"><a class="'.$active.'" href="'.$perm.'">'.strtolower($menu_item->title).'</a></li>';
	}

	$menu_list .= '</ul><!--/site__menu-wrap-->';

}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">

    <link rel="shortcut icon" href="<?= get_template_directory_uri().'/assets/img/favicon.ico'; ?>">
    <link rel="icon" sizes="16x16 32x32 64x64" href="<?= get_template_directory_uri().'/assets/img/favicon.ico'; ?>">
    <link rel="icon" type="image/png" sizes="196x196" href="<?= get_template_directory_uri().'/assets/img/favicon-192.png'; ?>">
    <link rel="icon" type="image/png" sizes="160x160" href="<?= get_template_directory_uri().'/assets/img/favicon-160.png'; ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= get_template_directory_uri().'/assets/img/favicon-96.png'; ?>">
    <link rel="icon" type="image/png" sizes="64x64" href="<?= get_template_directory_uri().'/assets/img/favicon-64.png'; ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= get_template_directory_uri().'/assets/img/favicon-32.png'; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_directory_uri().'/assets/img/favicon-16.png'; ?>">
    <link rel="apple-touch-icon" href="<?= get_template_directory_uri().'/assets/img/favicon-57.png'; ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= get_template_directory_uri().'/assets/img/favicon-114.png'; ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= get_template_directory_uri().'/assets/img/favicon-72.png'; ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= get_template_directory_uri().'/assets/img/favicon-144.png'; ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= get_template_directory_uri().'/assets/img/favicon-60.png'; ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= get_template_directory_uri().'/assets/img/favicon-120.png'; ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= get_template_directory_uri().'/assets/img/favicon-76.png'; ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= get_template_directory_uri().'/assets/img/favicon-152.png'; ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri().'/assets/img/favicon-180.png'; ?>">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="<?= get_template_directory_uri().'/assets/img/favicon-144.png'; ?>">
    <meta name="msapplication-config" content="<?= get_template_directory_uri().'/assets/img/browserconfig.xml'; ?>">

    <title>Got It Digital</title>

    <?php wp_head(); ?>
</head>
<body data-action="<?php echo admin_url( 'admin-ajax.php' );?>">

<!-- loading -->
<div class="loading active"></div>
<!-- /loading -->

<!-- site -->
<div class="site">

    <!-- site__header -->
    <header class="site__header">

        <!-- site__menu-btn -->
        <button class="site__menu-btn">
            <span></span>
        </button>
        <!-- /site__menu-btn -->

        <!-- site__menu -->
        <div class="site__menu">

            <?= $menu_list; ?>

            <!--site__menu-footer-->
            <div class="site__menu-footer">

                <p class="site__menu-copyright">© <?= date(Y); ?> | <a href="/" target="_blank" class="link-underline"><?= get_field('copyright', 2); ?></a></p>

                <!-- newsletter -->
                <div class="newsletter">

                    <div class="phone-number">
                        <a href="tel:<?= $number; ?>"><?= $number; ?></a>
                    </div>

                    <a href="<?= get_permalink(13); ?>" class="btn">
                        <span><?= get_field('button_contact_title', 2); ?></span>
                    </a>

                </div>
                <!-- /newsletter -->

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

            </div>
            <!--/site__menu-footer-->

        </div>
        <!-- /site__menu -->

        <!-- search-btn -->
        <button class="search-btn">
            <svg width="21px" height="21px" viewBox="0 0 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <!-- Generator: Sketch 44.1 (41455) - http://www.bohemiancoding.com/sketch -->
                <title>Group 2 Copy 2</title>
                <desc>Created with Sketch.</desc>
                <defs></defs>
                <g  stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Services-dedicated" transform="translate(-1354.000000, -65.000000)">
                        <g id="Group-2-Copy-2" transform="translate(1354.000000, 65.000000)">
                            <circle  stroke="#000000" stroke-width="2" cx="8" cy="8" r="7"></circle>
                            <rect id="Rectangle-Copy-2" fill="#000000" transform="translate(16.242641, 16.242641) rotate(45.000000) translate(-16.242641, -16.242641) " x="11.2426407" y="15.2426407" width="10" height="2"></rect>
                        </g>
                    </g>
                </g>
            </svg>
        </button>
        <!-- /search-btn -->

	    <?php if(false) {?>
        <!-- search -->
        <div class="search">

            <!-- search__wrap -->
            <div class="search__wrap">

                <form action="#">
                    <input type="text" placeholder="search here">
                </form>

                <!-- search__found -->
                <dl class="search__found">
                    <dt>Found</dt><dd>0</dd>
                </dl>
                <!-- /search__found -->

                <!-- search__results -->
                <div class="search__results">
                </div>
                <!-- /search__results -->
            </div>
            <!-- /search__wrap -->

            <!--search__footer-->
            <div class="search__footer">

                <p class="search__copyright">© <?= date(Y); ?> | <a href="/" target="_blank" class="link-underline"><?= get_field('copyright', 2); ?></a></p>

                <!-- newsletter -->
                <div class="newsletter">

                    <div class="phone-number">
                        <a href="tel:<?= $number; ?>"><?= $number; ?></a>
                    </div>

                    <a href="<?= get_permalink(13); ?>" class="btn">
                        <span><?= get_field('button_contact_title', 2); ?></span>
                    </a>

                </div>
                <!-- /newsletter -->

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

            </div>
            <!--/search__footer-->

        </div>
        <!-- /search -->
        <?php } ?>

	    <?php if(is_page(13) || is_page(2)) {?>
        <!-- get-in-touch -->
        <div class="get-in-touch">

            <!-- get-in-touch__wrap -->
            <div class="get-in-touch__wrap">
	            <?= do_shortcode('[gravityform id=2 title=false description=false ajax=true]'); ?>
            </div>
            <!-- /get-in-touch__wrap -->

            <!--get-in-touch__footer-->
            <div class="get-in-touch__footer">

                <p class="get-in-touch__copyright">© <?= date(Y); ?> | <a href="/" target="_blank" class="link-underline"><?= get_field('copyright', 2); ?></a></p>

                <!-- newsletter -->
                <div class="newsletter">

                    <div class="phone-number">
                        <a href="tel:<?= $number; ?>"><?= $number; ?></a>
                    </div>

                    <a href="<?= get_permalink(13); ?>" class="btn">
                        <span><?= get_field('button_contact_title', 2); ?></span>
                    </a>

                </div>
                <!-- /newsletter -->

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

            </div>
            <!--/get-in-touch__footer-->

        </div>
        <!-- /get-in-touch -->
        <?php } ?>

        <a href="/" class="logo">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 133 133" style="enable-background:new 0 0 133 133;" xml:space="preserve">
                <g>
                    <path d="M30.8,54.4c0.4,0.1,0.9,0,1.1-0.4c0.2-0.5-0.2-0.9-0.6-1c-0.1,0-0.2-0.1-0.3-0.1c-0.3,0-0.6,0.2-0.7,0.5
                        c-0.1,0.2-0.1,0.4,0,0.6C30.4,54.1,30.6,54.3,30.8,54.4z"/>
                    <path d="M34.7,85c0.2-0.1,0.4-0.3,0.4-0.5c0-0.2,0-0.4-0.1-0.5c-0.3-0.4-0.8-0.4-1.1-0.2c-0.2,0.1-0.3,0.3-0.4,0.5
                        c-0.1,0.2,0,0.4,0.1,0.6C33.9,85.2,34.4,85.2,34.7,85z"/>
                    <path d="M36.8,44.3c0.1-0.2,0.2-0.4,0.1-0.6c0-0.2-0.2-0.4-0.4-0.5c-0.2-0.1-0.4-0.2-0.5-0.2c-0.2,0-0.4,0.1-0.6,0.3
                        c-0.1,0.2-0.2,0.3-0.1,0.5c0,0.2,0.2,0.4,0.4,0.6C36.1,44.7,36.6,44.7,36.8,44.3z"/>
                    <path d="M0,0v133h133V0H0z M124.7,71.9h-6.8c-1.3,12.6-7.3,24.3-16.7,32.9c-9.6,8.7-22,13.5-35,13.5c-28.7,0-52-23.3-52-51.9
                        c0-28.6,23.3-51.9,52-51.9c11.8,0,23.3,4.1,32.5,11.4c9.1,7.3,15.5,17.4,18.1,28.6l0.1,0.3h-1.5l0-0.2
                        c-2.6-10.8-8.8-20.7-17.6-27.7C88.9,20,77.6,16.1,66.2,16.1c-27.9,0-50.5,22.6-50.5,50.4s22.7,50.4,50.5,50.4
                        c12.6,0,24.6-4.7,34-13.1c9.2-8.3,15-19.7,16.3-31.9h-7.1v-1.4h15.4V71.9z M98.4,65.2v0.5c0,7.6-6.2,13.8-13.8,13.8h-6.3V51.4h6.3
                        C92.2,51.4,98.4,57.6,98.4,65.2z M73.9,93v1.4H58.5V93h7V39.9h-7v-1.4h15.4v1.4h-7V93H73.9z M26.8,59.1c0.6-0.4,1.3-0.6,2-0.5
                        c0.8,0.1,1.5,0.5,1.9,1c0.5,0.6,0.7,1.4,0.6,2.2l-0.2,1.9l-5.7-0.6l0.2-1.9C25.8,60.3,26.2,59.6,26.8,59.1z M26.4,56.3
                        c0.1-0.5,0.6-0.7,1-0.6c0.2,0.1,0.4,0.2,0.5,0.4c0.1,0.2,0.2,0.4,0.1,0.6c-0.1,0.4-0.4,0.7-0.8,0.7c-0.1,0-0.1,0-0.2,0
                        c-0.2-0.1-0.4-0.2-0.5-0.4C26.3,56.7,26.3,56.5,26.4,56.3z M34.6,46.9c0.4,0.2,0.4,0.2,0.5,0c0.1-0.1,0.1-0.3,0.2-0.3l0.1-0.3
                        l1.1,0.6l-0.1,0.2c0,0.1-0.1,0.4-0.3,0.6c-0.3,0.5-0.6,0.7-1.1,0.7c-0.3,0-0.6-0.1-0.9-0.3l-1.2-0.7L32.6,48l-1-0.6l0.3-0.5
                        L31,46.4l0.6-1.1l0.9,0.5l0.4-0.7l1,0.6l-0.4,0.7L34.6,46.9z M35,42l0.8-1.1l3.2,2.3l-0.8,1.1l-0.1-0.1c0,0.3-0.1,0.6-0.3,0.8
                        c-0.4,0.5-1,0.8-1.6,0.8c-0.4,0-0.9-0.1-1.2-0.4c-0.5-0.3-0.8-0.8-0.9-1.4c-0.1-0.5,0-1,0.4-1.5c0.2-0.2,0.4-0.4,0.7-0.5L35,42z
                         M31.1,48.5l3.6,1.7l-0.6,1.2l-3.6-1.7L31.1,48.5z M30.6,49c-0.1,0.3-0.4,0.5-0.8,0.5c-0.1,0-0.2,0-0.4-0.1
                        c-0.2-0.1-0.4-0.3-0.4-0.5c-0.1-0.2-0.1-0.4,0-0.6c0.2-0.4,0.7-0.6,1.1-0.4c0.2,0.1,0.4,0.3,0.4,0.5C30.7,48.6,30.7,48.8,30.6,49z
                         M29.1,53c0.1-0.3,0.3-0.5,0.5-0.7l-0.1,0l0.4-1.2l3.7,1.2c0.6,0.2,1,0.5,1.2,1c0.2,0.4,0.1,1-0.1,1.6c-0.2,0.6-0.5,1-1,1.2
                        c-0.2,0.1-0.5,0.2-0.8,0.2c-0.2,0-0.3,0-0.5-0.1l-0.3-0.1l0.4-1c-0.5,0.5-1.3,0.8-2.1,0.5c-0.5-0.2-1-0.6-1.2-1.1
                        C29,54.1,28.9,53.5,29.1,53z M33.1,77.7c-0.1,0.2-0.3,0.4-0.5,0.4c-0.1,0-0.2,0-0.3,0c-0.4,0-0.7-0.2-0.8-0.6
                        c-0.1-0.2-0.1-0.4,0-0.6s0.3-0.4,0.5-0.4c0.4-0.2,0.9,0.1,1.1,0.5C33.2,77.3,33.2,77.5,33.1,77.7z M32.2,56.9l-0.3,1.3L28,57.3
                        l0.3-1.3L32.2,56.9z M26.7,67.3l0.1,1.3l4.4-0.4l0.1,1.3L27,69.9l0.1,1.3l-1.3,0.1l-0.4-3.9L26.7,67.3z M31.6,71.4l0.3,1.4
                        l-5.6,1.1L26,72.5L31.6,71.4z M30.1,80.3l1.1-0.5l0.3,0.7l1.1-0.5c0.3-0.1,0.3-0.2,0.3-0.2c0,0,0-0.1,0-0.2c0-0.1-0.1-0.3-0.2-0.3
                        l-0.2-0.2l1.1-0.5l0.1,0.2c0.1,0.1,0.2,0.3,0.3,0.6c0.1,0.3,0.3,0.6,0.1,1c-0.1,0.3-0.4,0.6-0.9,0.8L32,81.7l0.2,0.5l-1.1,0.5
                        L31,82.2l-1,0.4l-0.5-1.2l1-0.4L30.1,80.3z M32.3,83.8c0.1-0.5,0.5-1,1-1.3c1-0.6,2.2-0.3,2.8,0.7c0.3,0.5,0.4,1,0.2,1.6
                        c-0.1,0.5-0.5,1-1,1.3c-0.3,0.2-0.7,0.3-1.1,0.3c-0.7,0-1.4-0.4-1.8-1C32.3,84.9,32.2,84.3,32.3,83.8z M34.8,88.6l0.2-0.2l0.9,1
                        l-0.1,0.2c-0.3,0.3-0.2,0.9,0.2,1.3c0.6,0.8,1.7,0.6,2.3,0.1c0.4-0.3,0.6-0.7,0.7-1.2c0-0.4-0.1-0.8-0.4-1.2
                        c-0.4-0.5-0.9-0.6-1.3-0.5l0.6,0.7l-1,0.8l-1.9-2.3l1-0.8l0.4,0.5c1.2-0.5,2.4-0.2,3.3,0.8c0.5,0.6,0.8,1.4,0.7,2.1
                        c-0.1,0.8-0.5,1.5-1.1,2c-0.5,0.4-1.2,0.7-2,0.7c-0.8,0-1.6-0.3-2.2-1.1C34.1,90.7,34,89.4,34.8,88.6z M39.6,42.6l-4.2-3.8l0.9-1
                        l4.2,3.8L39.6,42.6z"/>
                    <path d="M33.5,54.5c0.1-0.3,0.1-0.5,0-0.6c-0.1-0.2-0.2-0.3-0.4-0.3l-0.1,0c0.1,0.3,0,0.6,0,0.8c-0.1,0.2-0.2,0.4-0.3,0.6l0.1,0
                        C33.1,55.1,33.4,54.9,33.5,54.5z"/>
                    <path d="M84.5,52.9h-4.9v25.2h4.9c6.8,0,12.4-5.5,12.4-12.4v-0.5C96.9,58.4,91.4,52.9,84.5,52.9z"/>
                    <path d="M30.1,61.7c0.1-0.5-0.1-0.9-0.4-1.2c-0.3-0.3-0.6-0.5-1-0.5c-0.8-0.1-1.6,0.4-1.8,1.4l-0.1,0.6l3.1,0.4L30.1,61.7z"/>
                </g>
            </svg>
        </a>
        <div class="phone-number">
            <a href="tel:<?= $number; ?>"><?= $number; ?></a>
        </div>

    </header>
    <!-- /site__header -->