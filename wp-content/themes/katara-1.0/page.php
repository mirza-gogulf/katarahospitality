<?php
    get_header();
    get_sidebar('navi');
    global $sub_nav;
    
    the_post();
    
    $page_sub_title = get_post_meta( $post->ID, 'page_sub_title', TRUE );
?>
	<article class="grid_6 content col-span-2">
		<header class="gen-content-header">
		    <h1 class="ttl-36"><?php the_title(); ?></h1>
		    <?php if (is_page( 'our-history' ) ) : ?>
		        <p class="tag-line-16"><?php echo ( $page_sub_title ) ? $page_sub_title: __( 'We are pioneers', "Katara" ); ?></p>
	        <?php elseif (is_page( 'our-management' ) ) : ?>
		        <p class="tag-line-16"><?php echo ( $page_sub_title ) ? $page_sub_title: __( 'We are only as good as our people', "Katara" ); ?></p>
		    <?php elseif ( $page_sub_title ) : ?>
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