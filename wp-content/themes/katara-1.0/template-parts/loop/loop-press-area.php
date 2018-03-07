<?php 
$nImg = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'full'); ?>

<div class="card news-card d-flex align-items-stretch flex-row">
	<div class="card-body d-flex flex-column justify-content-between">
		<h5 class="card-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a><span class="date"><?php echo get_the_date(); ?></span></h5>

		<?php $attachment_args = array(
                                        'orderby' => 'menu_order',
                                        'order' => 'ASC',
                                        'post_type' => 'attachment',
                                        'post_parent' => get_the_ID(),
                                        'exclude' => get_post_thumbnail_id(),
                                        'numberposts' => 1
                                    );
        $post_attachments = get_children( $attachment_args );
        $rekeyed_array = array_values( $post_attachments );
        $dl_link = '';
        if( $rekeyed_array ){
        $dl_link = $rekeyed_array[0]; 
    	}

    	if( $dl_link ) { ?>

		<div class="card-bottom d-flex justify-content-between">
			<ul class="tag-cloud d-flex">
				<?php echo sprintf('<li><a href="%s">%s</a></li>', $dl_link->guid, 'download' ); ?>

			</ul>
		</div>
		<?php } ?>

	</div>
	<?php if ( $nImg ) { ?>
	<div class="image-holder">
		<a href="<?php the_permalink() ?>"><img class="img-fluid" src="<?php echo aq_resize( $nImg, 503, 303, true, true, true ) ?>" alt="Card image"></a>
	</div>
	<?php } ?>

</div>
