<?php
    get_header();
    get_sidebar('navi');
    the_post();

    $attachment_args = array(
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_type' => 'attachment',
		'post_parent' => get_the_ID(),
		'post_mime_type' => 'image'
	);
    $post_attachments = get_children( $attachment_args );

    $page_sub_title = get_post_meta( $post->ID, 'page_sub_title', TRUE );
?>

	<?php if ( $post_attachments ) : ?>
	    <?php if(count($post_attachments) > 1) { ?>
    	<div class="grid_9 omega caro hotel-caro marginTop20" data-position="0">
    	    <ul class="reel">
                <?php $pos1 = 0; foreach ( $post_attachments as $attachment ) : $image = wp_get_attachment_image_src( $attachment->ID, 'size-710-299' ); $src = $image[0]; ?>
                    <li <?php if($pos1==0){ echo 'class="active"'; } ?>><img src="<?php echo $src; ?>" width="710" height="299" alt="<?php the_title(); ?>"></li>
                <?php $pos1++;  endforeach; ?>
            </ul>
            <nav class="caro-nav">
                <ul>
                    <?php $pos = 0; foreach ( $post_attachments as $attachment ) : ?>
                        <li data-number="<?php echo $pos; ?>"><a class="caro-nav-btn hide-text <?php echo ($pos == 0)? 'active' : ''; ?>" href="#"><?php echo $pos; ?></a></li>
                    <?php $pos++; endforeach; ?>
                </ul>    
            </nav>
        </div>
        <?php } else { ?>
            <?php $pos1 = 0; foreach ( $post_attachments as $attachment ) : $image = wp_get_attachment_image_src( $attachment->ID, 'size-710-299' ); $src = $image[0]; ?>
                <img src="<?php echo $src; ?>" class="hero-img" width="710" height="299" alt="<?php the_title(); ?>">
            <?php $pos1++;  endforeach; ?>
        <?php } ?>
    <?php endif; ?>

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