<?php

	function part($part_name) {
		require_once get_template_directory() . '/parts/' . $part_name . '.php';
	}

	function encodeURIComponent($str) {
		$revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
		return strtr(rawurlencode($str), $revert);
	}

	function image_alt_by_url( $image_url ) {
		global $wpdb;

		if( empty( $image_url ) ) {
			return false;
		}

		$query_arr  = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid='%s';", strtolower( $image_url ) ) );
		$image_id   = ( ! empty( $query_arr ) ) ? $query_arr[0] : 0;

		return get_post_meta( $image_id, '_wp_attachment_image_alt', true );
	}

	function unp($str){
		return strip_tags($str, '<br> <br /> <br/> <strong> <span> <ul> <li>');
	}

	function unpp($str){
		echo strip_tags($str, '<br> <br /> <br/> <strong> <span> <ul> <li>');
	}

	function site_setting($group, $item, $print = false){
		

		$settings_group = get_posts( array( 'name' => $group, 'post_type' => 'site_settings' ) );
		if( ! $settings_group ) { return false; } // If group not found then return false

		$value = get_value($item, $settings_group[0]->ID);
		if ( ! $value ) { return false; }

		if( $print ) {
			echo $value;
		} else {
			return $value;
		}
	}

	function imageUrlFromID($id){
		return wp_get_attachment_url( $id );
	}

	function static_image($filename){
		echo get_template_directory_uri() . '/build/img/' . $filename; 
	}
?>


<?php # Generate Sitemap.xml file
	add_action("save_post", "gen_sitemap");
	
	function gen_sitemap(){
		$path = get_template_directory() .'/sitemap.xml';
		$sitemap_file = fopen($path, "w") or die("Can't open sitemap.xml!");		
		fwrite($sitemap_file, "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9' xmlns:image='http://www.google.com/schemas/sitemap-image/1.1'>\n");
		
		$exclude = [];

		# Fill Exclude Array with pages and posts that has "block search engine crwalers" set to "true"
		foreach(get_pages(['meta_key' => 'exclude_from_sitemap', 'meta_value' => true ]) as $page){
			$exclude[] = $page->post_id;
		}
		foreach(get_posts(['meta_key' => 'exclude_from_sitemap', 'meta_value' => true ]) as $item){
			$exclude[] = $item->ID;
		}

		$pages = get_pages(array('exclude' => implode(",", $exclude)));

		# Write Pages to file
		foreach($pages as $page) {
			fwrite($sitemap_file, "\t<url>\n\t\t<loc>" . get_page_link( $page->ID ) . "</loc>\n\t\t<lastmod>" . get_the_modified_date( 'Y-m-d', $page->ID ) . "</lastmod>\n\t</url>\n");
		}

		
		# Write Posts to file
		$args = array('posts_per_page' => 999999, 'exclude' => implode(",", $exclude));
		$posts = get_posts($args);
		foreach($posts as $post) {
			fwrite($sitemap_file, "\t<url>\n\t\t<loc>" . get_permalink( $post->ID ) . "</loc>\n\t\t<lastmod>" . get_the_modified_date( 'Y-m-d', $post->ID ) . "</lastmod>\n\t</url>\n");
		}

		# Close file
		fwrite($sitemap_file, "</urlset>\n");
		fclose($sitemap_file);
	}
?>
