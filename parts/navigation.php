<div id="navigation">
	<div class="wrapper-thin" itemscope itemtype="https://schema.org/SiteNavigationElement">
		<a id="logo" href="<?php echo site_url(); ?>" title="webra homepage">
			<img src="<?php echo imageUrlFromID(site_setting('navigation', 'logo', 0)); ?>" alt="Webra homepage">
		</a>
		<button id="burger-button">
			<i></i>
			<i></i>
			<i></i>
		</button>
		
		<?php
			// add microdata to links in navigation
			function add_menu_atts( $atts, $item, $args ) {
				$atts['itemprop'] = 'url';
				return $atts;
			}
			add_filter( 'nav_menu_link_attributes', 'add_menu_atts', 10, 3 );

			// add active class to nav items
			add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
			function special_nav_class ($classes, $item) {
				if (in_array('current-menu-item', $classes) ){
					$classes[] = 'active ';
				}
				return $classes;
			}
			
			$args = [
				"menu" => "Header Navigation",
				"menu_class" => 'wp_menu',
				"container" => "",
				"link_before" => "",
				"link_after" => ""
			];
			wp_nav_menu($args);
		?>

	</div>
</div>