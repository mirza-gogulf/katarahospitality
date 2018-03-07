<div class="inner-content">
	<section class="k-section k-section-about">
		<div class="title-holder">
			<h3><?php the_title() ?></h3>
			<span class="title-info"><?php echo get_post_meta( get_the_ID(), 'page_sub_title', true ) ?></span>
		</div>
		<?php if( has_post_thumbnail() ) { 
		$imgUrl = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) , 'full' ); ?>
		<div class="image-holder">
			<img src="<?php echo $imgUrl ?>" class="img-fluid" alt="">
		</div>
		<?php } ?>
		<div class="text-holder">
			<?php the_content() ?>
		</div>
	</section>
</div>