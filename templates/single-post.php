<?php
	/* Template Name: Single Post Page */
	/* Template Post Type: Post */

	global $post;
?>

<?php part('header'); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div class="sections single-post">
		<div class="section white single-post-section">
			<div class="wrapper-thin">

				<ol class="breadcrumbs" vocab="http://schema.org/" typeof="BreadcrumbList">
					<li property="itemListElement" typeof="ListItem">
						<a property="item" typeof="WebPage" href="<?php echo site_url(); ?>">
							<span property="name">Webra Homepage</span>
						</a>
						<meta property="position" content="1">
					</li>
					<li property="itemListElement" typeof="ListItem">
						<a property="item" typeof="WebPage" title="Webra posts" href="<?php echo site_url() . '/posts/'; ?>">
							<span property="name">Posts</span>
						</a>
						<meta property="position" content="2">
					</li>
					<li property="itemListElement" typeof="ListItem">
						<a property="item" typeof="WebPage" href="<?php the_permalink(); ?>">
							<span property="name"><?php the_title(); ?></span>
						</a>
						<meta property="position" content="3">
					</li>
				</ol>

				<article itemscope itemtype="https://schema.org/BlogPosting">

					<!-- META DATA -->
					<div style="display:none;">
						<div itemscope itemprop="author" itemtype="http://schema.org/Person">
							<div itemprop="name" content="<?php the_author_meta( 'display_name', $post->post_author ); ?>"></div>
							<div itemprop="url" content="<?php the_author_meta( 'user_url', $post->post_author ); ?>"></div>
						</div>
						<div itemscope itemprop="publisher" itemtype="http://schema.org/Organization">
							<div itemprop="name" content="Webra"></div>
							<div itemprop="url" content="<?php echo site_url(); ?>"></div>
							<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
								<img itemprop="url" content="<?php echo imageUrlFromID(site_setting('navigation', 'logo', 0)); ?>" alt="LOGO" />
								<meta itemprop="width" value="1585" />
								<meta itemprop="height" value="432" />
							</div>   
						</div>
						<meta itemprop="datePublished" content="<?php echo get_the_date('Y-m-d'); ?>">
						<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>">
						<?php get_post_meta($post->ID, 'seo_image', true) ? $post_image = wp_get_attachment_url(get_post_meta($post->ID, 'seo_image', true)) : $post_image = wp_get_attachment_url(site_setting('seo', 'default_image', 0)); ?>
						<meta itemprop="image" content="<?php echo $post_image ?>">
						<meta itemprop="mainEntityOfPage" content="<?php the_permalink(); ?>">
					</div>
					<!-- END OF META DATA -->

					<header>
						<h1 class="post-title" itemprop="name headline"><?php the_title(); ?></h1>
						<p class="post-author-and-date">posted <time pubdate="pubdate"><?php the_modified_date('F jS, G:i '); ?></time> by <a target="_blank" href="<?php the_author_meta( 'user_url', $post->post_author ); ?>" rel="author"><?php the_author_meta( 'display_name', $post->post_author ); ?></a></p>
						<p class="post-excerpt" itemprop="description"><?php echo get_the_excerpt(); ?></p>
					</header>
					<div class="post-content"><?php the_content(); ?></div>
				</article>

				<div class="post-social-icons">
					<h4 class="post-social-icons-heading">Spread the word!</h4>
					<ul>
						<li class="facebook">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank">
								<img src="<?php static_image('social_icons/facebook.png'); ?>" alt="facebook logo">
								<span>Share on Facebook</span>
							</a>
						</li>
						<li class="twitter">
							<a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>" target="_blank">
								<img src="<?php static_image('social_icons/twitter.png'); ?>" alt="twitter logo">
								<span>Share on Twitter</span>
							</a>
						</li>
						<li class="whatsapp">
							<a href="https://api.whatsapp.com/send?text=<?php echo encodeURIComponent(get_the_title()) . '%20-%20' . encodeURIComponent(get_permalink()); ?>" target="_blank">
								<img src="<?php static_image('social_icons/whatsapp.png'); ?>" alt="whatsapp logo">
								<span>Share on Whatsapp</span>
							</a>
						</li>
						<li class="mail">
							<a href="mailto:someone@somewhere.com?subject=<?php echo encodeURIComponent(get_the_title()). "&body=" . encodeURIComponent(get_permalink()); ?>" target="_blank">
								<img src="<?php static_image('social_icons/email.png'); ?>" alt="gmail logo">
								<span>Share by Email</span>
							</a>
						</li>
					</ul>
				</div>

				<div class="post-about-the-author">
					<img class="post-about-the-author-img" src="<?php static_image('yakir_reznik.jpg'); ?>" alt="">
					<h5 class="post-about-the-author-heading">About the author</h4>
					<h4 class="post-about-the-author-name"><?php the_author_meta( 'display_name', $post->post_author ); ?></h5>
					<p class="post-about-the-author-desc"><?php the_author_meta( 'description', $post->post_author ); ?></p>
					<a href="mailto:<?php the_author_meta( 'user_email', $post->post_author ); ?>" class="post-about-the-author-mail" target="_blank">
						<img src="<?php static_image('social_icons/email.png'); ?>" alt="gmail logo">
						<span>Send me an email</span>
					</a>
					<a href="<?php the_author_meta( 'user_url', $post->post_author ); ?>" rel="author" class="post-about-the-author-facebook" target="_blank">
						<img src="<?php static_image('social_icons/facebook.png'); ?>" alt="facebook logo">
						<span>Hit me up on facebook</span>
					</a>
				</div>

			</div>
		</div>
	</div>

<?php endwhile; endif; ?>

<?php part('footer'); ?>
