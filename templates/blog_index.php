<?php
	/* Template Name: Blog Index */
	/* Template Post Type: Page */
?>

<?php part('header'); ?>

	<div class="sections" itemscope itemtype="http://schema.org/Blog">

		<section class="section white hero-post fullScreen">
			<?php
				global $post;
				$promoted_post_id = site_setting('homepage', 'promoted_post', 0)->ID;
				$post = get_post($promoted_post_id, OBJECT);
			?>

			<div class="wrapper middle-height" itemscope itemtype="https://schema.org/BlogPosting">
				<div class="wrapper-thin">
					<h2 class="hero-post-caption"><?php site_setting('homepage', 'small_text_above_hero_post', 1) ?></h2>
					<article>
						
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
						</div>
						<!-- END OF META DATA -->

						<header>
							<h3 class="post-title" itemprop="name headline"><?php the_title(); ?></h3>
							<p class="post-author-and-date">posted <time pubdate="pubdate"><?php the_modified_date('F jS, G:i '); ?></time> by <a target="_blank" href="<?php the_author_meta( 'user_url', $post->post_author ); ?>" rel="author"><?php the_author_meta( 'display_name', $post->post_author ); ?></a></p>
						</header>
						<p class="post-excerpt" itemprop="description"><?php the_excerpt(); ?></p>
						<a href="<?php the_permalink(); ?>" class="post-link" itemprop="url mainEntityOfPage" content="<?php the_permalink(); ?>">Read More</a>
					</article>
				</div>
				<button class="more-posts" data-scroll-target="<?php site_setting('homepage', 'more_posts_button_target', 1) ?>"><?php site_setting('homepage', 'more_posts_btn_text', 1) ?></button>
			</div>
		</section>

		<section class="section light recent-posts">
			<h2 class="caption"><?php site_setting('homepage', 'more_posts_section_title', 1) ?></h2>
			<div class="wrapper">

				<?php
					wp_reset_postdata();
					$posts = get_posts( [ 'numberposts' => 6, 'exclude' => [$promoted_post_id] ] );
					foreach ( $posts as $post ) : setup_postdata($post);
				?>

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
					</div>
					<!-- END OF META DATA -->

					<header>
						<h3 class="post-title" itemprop="name headline"><?php the_title(); ?></h3>
						<p class="post-author-and-date">posted <time pubdate="pubdate"><?php the_modified_date('F jS, G:i '); ?></time> by <a target="_blank" href="<?php the_author_meta( 'user_url', $post->post_author ); ?>" rel="author"><?php the_author_meta( 'display_name', $post->post_author ); ?></a></p>
					</header>
					<p class="post-excerpt" itemprop="description"><?php echo get_the_excerpt(); ?></p>
					<a href="<?php the_permalink(); ?>" class="post-link" itemprop="url mainEntityOfPage" content="<?php the_permalink(); ?>">Read More</a>
				</article>
				
				<?php endforeach; ?>

			</div>
		</section>
	</div>

<?php part('footer'); ?>

<?php // Silence is golden.