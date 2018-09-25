<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width initial-scale=1">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/build/styles.css">

	<!-- SEO Setup -->
	<?php

		global $post;

		// meta title - [seo_title] or [page/post title]
		get_value('seo_title') ? $seo_title = get_value('seo_title') : $seo_title = get_the_title();
		echo "<title>" . $seo_title . "</title>\n";
		echo "<meta property=\"og:title\" content=\"" . $seo_title . "\" />\n";

		// meta description - [seo_description] or [the_excerpt]
		get_value('seo_description') ? $seo_description = get_value('seo_description') : $seo_description = get_the_excerpt();
		if ( $seo_description ) {
			echo "<meta name=\"description\" content=\"" . $seo_description . "\" />\n";
			echo "<meta property=\"og:description\" content=\"" . $seo_description . "\" />\n";
		}

		// meta image & og:image - [seo_image] or [site default]
		get_post_meta($post->ID, 'seo_image', true) ? $seo_image = get_post_meta($post->ID, 'seo_image', true) : $seo_image = site_setting('seo', 'default_image', 0);
		$seo_image = wp_get_attachment_url($seo_image);
		echo "<meta property=\"og:image\" content=\"" . $seo_image . "\" />\n";

		// NO INDEX Option
		if(get_post_meta($post->ID, 'block_search_engine_indexing', true)){
			echo '<meta name="robots" content="noindex"‎>';
			echo '<meta name="googlebot" content="noindex"‎>';
		}
	?>

	<meta property="og:type" content="website">
	<meta property="og:url" content="<?php the_permalink(); ?>">
	<link rel="canonical" href="<?php the_permalink(); ?>">

	<?php part('favicon'); ?>	
</head>
<body itemscope itemtype="https://schema.org/WebPage">
	<?php part('navigation'); ?>
