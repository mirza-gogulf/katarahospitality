<?php //Get attachment images
$attachment_args = array(
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'post_type' => 'attachment',
	'post_parent' => get_the_ID(),
	'post_mime_type' => 'image',
	'numberposts' => 1,
);
$post_attachments = get_children( $attachment_args );

//get the featured Image URL
$hImg = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'full');

if( empty( $hImg ) ) {  // if no featured Image URL

	foreach ( $post_attachments as $attachment ) { 
		$image = wp_get_attachment_image_src( $attachment->ID, 'full' ); 
		$hImg =  $image[0];
	}
}

if( empty( $hImg ) ) { $hImg = 'http://katara.go-demo.com/wp-content/uploads/2016/02/Hotel-Park.jpg'; }  ?>

<div class="col-lg-4 col-sm-6">
	<div class="hotels-card">

		<?php if ( $hImg ) { ?>
		<div class="image-holder">
			<a href="<?php the_permalink() ?>"><img src="<?php echo aq_resize( $hImg, 382, 310, true, true, true ) ?>" class="img-fluid" alt="image"></a>
		</div>
		<?php } ?>

		<div class="desc">
			<strong><a href="<?php the_permalink() ?>"><?php the_title() ?></a></strong>
		</div>
	</div>
</div>