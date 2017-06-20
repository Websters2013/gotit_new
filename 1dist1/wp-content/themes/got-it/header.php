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

        <a href="/" class="logo">
            <svg width="80px" height="76px" viewBox="0 0 80 76" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                    <polygon id="path-1" points="0.0202531646 75.101739 79.9638819 75.101739 79.9638819 0.0357081921 0.0202531646 0.0357081921"></polygon>
                </defs>
                <g  stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g  transform="translate(-676.000000, -36.000000)">
                        <g id="GID_Logo_Black-Copy-2" transform="translate(676.000000, 36.000000)">
                            <g id="Group-3">
                                <mask id="mask-2" fill="white">
                                    <use xlink:href="#path-1"></use>
                                </mask>
                                <g id="Clip-2"></g>
                                <path d="M47.2344304,27.4724007 L50.9458228,27.4724007 C56.0162025,27.4724007 60.141097,31.5892858 60.141097,36.6494061 L60.141097,37.0000875 C60.141097,42.0602078 56.0162025,46.1770929 50.9458228,46.1770929 L47.2344304,46.1770929 L47.2344304,27.4724007 Z M60.8162025,37.0000875 L60.8162025,36.6494061 C60.8162025,31.2173816 56.3885232,26.7986613 50.9458228,26.7986613 L46.5593249,26.7986613 L46.5593249,46.8508323 L50.9458228,46.8508323 C56.3885232,46.8508323 60.8162025,42.432112 60.8162025,37.0000875 Z M43.0200844,18.0400481 L43.0200844,17.3663087 L32.2183966,17.3663087 L32.2183966,18.0400481 L37.2816878,18.0400481 L37.2816878,57.0579853 L32.2183966,57.0579853 L32.2183966,57.7317248 L43.0200844,57.7317248 L43.0200844,57.0579853 L37.9567932,57.0579853 L37.9567932,18.0400481 L43.0200844,18.0400481 Z M79.9638819,41.3302111 L75.0467511,41.3302111 C73.1537553,60.2761019 57.0933333,75.1219512 37.6192405,75.1219512 C16.8759494,75.1219512 0,58.2798119 0,37.5784928 C0,16.8771738 16.8759494,0.0357081921 37.6192405,0.0357081921 C55.4224473,0.0357081921 70.3767089,12.4419468 74.2578903,29.046593 L73.5628692,29.046593 C69.6948523,12.8172197 55.0484388,0.709447665 37.6192405,0.709447665 C17.24827,0.709447665 0.675105485,17.249078 0.675105485,37.5784928 C0.675105485,57.9085814 17.24827,74.4482117 37.6192405,74.4482117 C56.7210127,74.4482117 72.4779747,59.9041977 74.36827,41.3302111 L69.1621941,41.3302111 L69.1621941,40.6564716 L79.9638819,40.6564716 L79.9638819,41.3302111 L79.9638819,41.3302111 Z" id="Fill-1" fill="#0A0A08" mask="url(#mask-2)"></path>
                            </g>
                            <path d="M16.1978059,54.190887 L15.0470886,52.8130898 L15.4740928,52.4576922 L15.7400844,52.776371 C16.4985654,52.3630318 17.347173,52.4708301 18.0175527,53.2735907 C18.8091139,54.2212053 18.5279325,55.3736367 17.7400844,56.0291852 C16.9522363,56.6843968 15.7380591,56.7194313 14.9741772,55.8048299 C14.4040506,55.1223318 14.4091139,54.2619665 14.8854008,53.7886646 L15.2864135,54.2690408 C15.0416878,54.5567276 15.0659916,55.0482205 15.4011814,55.4494324 C15.9196624,56.0706201 16.7642194,56.0133523 17.3323207,55.5403872 C17.9004219,55.0677589 18.1367089,54.2821787 17.5385654,53.5663305 C17.1274262,53.0741638 16.5670886,53.042835 16.1620253,53.2810019 L16.6251477,53.8354894 L16.1978059,54.190887" id="Fill-4" fill="#0A0A08"></path>
                            <path d="M14.0448945,49.9035459 C13.6732489,50.1241956 13.5061603,50.5614525 13.737384,50.950537 C13.9635443,51.330863 14.4283544,51.3945313 14.8,51.1742185 C15.1716456,50.9542426 15.3387342,50.5169857 15.1129114,50.1366597 C14.8810127,49.7469015 14.4165401,49.6839068 14.0448945,49.9035459 Z M15.1000844,51.6795231 C14.4870886,52.0426687 13.6945148,51.9038784 13.2867511,51.2176747 C12.8735865,50.5220387 13.1311392,49.7613869 13.7444726,49.3982413 C14.3578059,49.0357694 15.1500422,49.1745598 15.5632068,49.8701958 C15.9709705,50.5563994 15.7134177,51.3170513 15.1000844,51.6795231 L15.1000844,51.6795231 Z" id="Fill-5" fill="#0A0A08"></path>
                            <path d="M13.8362869,46.5948113 C13.8886076,46.6712808 13.974346,46.8218615 14.0455696,46.9791797 C14.1633755,47.23958 14.3463291,47.7371366 13.5729958,48.0844493 L12.5046414,48.5654993 L12.6798312,48.9535732 L12.2318987,49.1550213 L12.0567089,48.7666105 L11.3623629,49.0792256 L11.1203376,48.5436028 L11.8146835,48.2309876 L11.5770464,47.7054709 L12.0253165,47.5040227 L12.262616,48.0298764 L13.2081013,47.6040731 C13.6070886,47.4251952 13.6006751,47.2796675 13.5051477,47.0684502 C13.4673418,46.9849065 13.3978059,46.8565591 13.3633755,46.8073761 L13.8362869,46.5948113" id="Fill-6" fill="#0A0A08"></path>
                            <path d="M12.5735021,45.5939713 C12.492827,45.3652368 12.6119831,45.1176375 12.841519,45.0374625 C13.0659916,44.9589719 13.3137553,45.0782238 13.3944304,45.3072952 C13.4730802,45.5309767 13.3535865,45.7782391 13.1294515,45.8567297 C12.8999156,45.9369047 12.6518143,45.8176528 12.5735021,45.5939713" id="Fill-7" fill="#0A0A08"></path>
                            <polyline id="Fill-8" fill="#0A0A08" points="8.73113924 42.7201356 8.60962025 42.0898523 12.3233755 41.3773729 12.444557 42.0076561 8.73113924 42.7201356"></polyline>
                            <polyline id="Fill-9" fill="#0A0A08" points="8.85940928 39.9153582 8.94852321 40.8437712 8.39459916 40.8963229 8.15662447 38.4172985 8.71054852 38.3637362 8.80033755 39.2982128 12.0104641 38.9909876 12.0695359 39.608133 8.85940928 39.9153582"></polyline>
                            <path d="M8.78548523,34.3937263 L11.4366245,34.6958985 L11.5054852,34.0955966 C11.6010127,33.2601597 11.0008439,32.7087039 10.3301266,32.6325714 C9.65907173,32.5561019 8.94987342,32.9579875 8.85400844,33.7937613 L8.78548523,34.3937263 Z M8.3014346,33.7304298 C8.4435443,32.4883911 9.4521519,31.8921317 10.4023629,32.0009406 C11.3522363,32.1087389 12.2005063,32.9162157 12.0583966,34.1589281 L11.9189873,35.374691 L8.16236287,34.9465296 L8.3014346,33.7304298 L8.3014346,33.7304298 Z" id="Fill-10" fill="#0A0A08"></path>
                            <path d="M10.0570464,30.7717029 L10.1893671,30.1993613 L12.6423629,30.7626075 L12.5103797,31.3349491 L10.0570464,30.7717029 Z M8.80135021,30.1848759 C8.8556962,29.9487302 9.08894515,29.8032024 9.32556962,29.8571016 C9.5571308,29.9106639 9.70329114,30.1434409 9.64894515,30.3795866 C9.59561181,30.6106792 9.36236287,30.7565438 9.13080169,30.7033184 C8.89417722,30.6487455 8.74801688,30.4166422 8.80135021,30.1848759 L8.80135021,30.1848759 Z" id="Fill-11" fill="#0A0A08"></path>
                            <path d="M11.8281857,28.9334048 C12.2376371,29.0721951 12.6791561,28.9152138 12.8222785,28.4964847 C12.9684388,28.0676496 12.7145992,27.6741857 12.3054852,27.5347216 C11.8963713,27.3959313 11.4545148,27.5539232 11.3080169,27.9820847 C11.1655696,28.4004769 11.4194093,28.7946145 11.8281857,28.9334048 Z M13.8079325,27.4131117 C14.2069198,27.5485333 14.4516456,27.7681724 14.5610127,28.0504692 C14.6700422,28.3327661 14.6491139,28.6787313 14.5134177,29.0769113 C14.377384,29.4750913 14.1556118,29.7243749 13.9037975,29.8604703 C13.651308,29.9972394 13.3711392,30.0157673 13.1152743,29.9460352 L13.3066667,29.3841365 C13.5729958,29.4407306 13.8727426,29.3144045 14.0104641,28.9118451 C14.1620253,28.4675139 14.0648101,28.1326654 13.6148523,27.9793897 L13.1750211,27.8301564 C13.3647257,28.0599016 13.4018565,28.4203522 13.3076793,28.6959116 C13.0605907,29.4205184 12.3139241,29.718985 11.6388186,29.4902505 C10.9633755,29.2605053 10.5545992,28.5689117 10.8016878,27.8446418 C10.8955274,27.5687455 11.1449789,27.3056502 11.4359494,27.2399606 L11.1135865,27.1301411 L11.3036287,26.5739692 L13.8079325,27.4131117 L13.8079325,27.4131117 Z" id="Fill-12" fill="#0A0A08"></path>
                            <path d="M11.8886076,25.2527661 L12.1360338,24.7205119 L14.4185654,25.7765985 L14.1711392,26.3095264 L11.8886076,25.2527661 Z M10.7817722,24.4200241 C10.8840506,24.2000481 11.1419409,24.1060615 11.3623629,24.208133 C11.5780591,24.3075096 11.6725738,24.5652149 11.5702954,24.7851909 C11.4703797,25.0001137 11.2121519,25.0944373 10.9967932,24.9950607 C10.7763713,24.8929892 10.6818565,24.634947 10.7817722,24.4200241 L10.7817722,24.4200241 Z" id="Fill-13" fill="#0A0A08"></path>
                            <path d="M15.6914768,23.4158154 C15.6604219,23.5034015 15.5888608,23.6613934 15.5034599,23.8113004 C15.3616878,24.0595734 15.0666667,24.4995253 14.3301266,24.0811331 L13.3120675,23.502054 L13.1007595,23.871937 L12.6737553,23.6290539 L12.8847257,23.2595078 L12.2231224,22.8828875 L12.5147679,22.3725298 L13.1763713,22.7488133 L13.4622785,22.2475511 L13.8892827,22.4900973 L13.6033755,22.9916964 L14.5043038,23.5034015 C14.8843882,23.7200087 14.9981435,23.6290539 15.1129114,23.4279427 C15.158481,23.3481046 15.2212658,23.2167254 15.2411814,23.1601312 L15.6914768,23.4158154" id="Fill-14" fill="#0A0A08"></path>
                            <path d="M16.1920675,20.4826906 C15.8427004,20.2286908 15.3738397,20.2485661 15.1068354,20.6150804 C14.8462447,20.9721623 14.9718143,21.4235678 15.3211814,21.6768938 C15.6705485,21.9308936 16.1394093,21.9113551 16.4,21.5539363 C16.6670042,21.1874221 16.5414346,20.7366904 16.1920675,20.4826906 Z M15.5206751,19.2689489 L17.5561181,20.7467965 L17.2094515,21.2217828 L16.9346835,21.0216822 C17.0474262,21.2972416 16.9762025,21.6519654 16.8043882,21.8874374 C16.3530802,22.506604 15.5513924,22.5712829 14.9748523,22.1518801 C14.3983122,21.7334879 14.2129958,20.9526239 14.6643038,20.3334573 C14.8357806,20.0979853 15.1520675,19.9207919 15.4494515,19.9440359 L15.174346,19.7439353 L15.5206751,19.2689489 L15.5206751,19.2689489 Z" id="Fill-15" fill="#0A0A08"></path>
                            <polyline id="Fill-16" fill="#0A0A08" points="15.4440506 17.4319983 15.8366245 16.9937307 18.6562025 19.509137 18.2636287 19.9470677 15.4440506 17.4319983"></polyline>
                        </g>
                    </g>
                </g>
            </svg>
        </a>
        <div class="phone-number">
            <a href="tel:<?= $number; ?>"><?= $number; ?></a>
        </div>

    </header>
    <!-- /site__header -->