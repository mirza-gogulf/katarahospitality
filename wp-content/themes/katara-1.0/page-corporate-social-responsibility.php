<?php
    get_header();
    get_sidebar('navi');
    global $sub_nav;
    
    the_post();
    
    // Logo
    $banner_id = get_post_thumbnail_id( get_the_ID() );
    $banner = wp_get_attachment_image_src( $banner_id, 'size-710-299' );
    $page_sub_title = get_post_meta( $post->ID, 'page_sub_title', TRUE );
?>
	<?php if ( isset( $banner[0] ) ) { ?>
	    <img class="hero-img" src="<?php echo $banner[0]; ?>" alt="" width="710" />
	<?php } ?>

	<article class="grid_6 content col-span-2">
		<header class="gen-content-header">
		    <h1 class="ttl-36"><?php the_title(); ?></h1>
		    <?php if ( $page_sub_title ) : ?>
		        <p class="tag-line-16"><?php echo $page_sub_title; ?></p>
		    <?php endif; ?>
		</header>
		<div class="cms-content">
		    <?php the_content(); ?>
		</div>
	</article>
<?php
    get_sidebar();
    get_footer();
?>