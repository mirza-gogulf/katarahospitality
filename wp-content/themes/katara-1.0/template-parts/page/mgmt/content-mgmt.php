<?php // get member datas

$board_args = array(
       'post_parent' => get_the_ID(),
       'post_type' => 'page',
       'orderby' => 'menu_order',
       'order' => 'ASC',
       'nopaging' => TRUE
    );
$board_loop = new WP_Query( $board_args ); 

//print_r($board_loop);
 $rowcount = count($board_loop->posts);
 ?>
 <input type="hidden" value="<?php echo $rowcount;?>" name="total_member" id="total_member">
<div class="inner-content">
	<section class="k-section k-section-management">
		<div class="title-holder">
			<h3><?php the_title() ?>
		</div>

		<?php $i = 0; if( $board_loop->have_posts() )  : ?>
		<div class="b-management">

			<?php $c = 0;
			
			while( $board_loop->have_posts() ) : $board_loop->the_post();

			$memImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'full'); 
			$memDesig = get_post_meta( get_the_ID(), 'page_sub_title', true );

			if( $c > 0 && $c % 3 == 0 ) { echo '</div>'; }

			if( $c == 0 || ( $c > 0 && $c % 3 == 0) ) { ?>

			<div class="b-management-row d-flex justify-content-between flex-wrap">
				<div class="loader-wrap">
					<img src="<?php echo KATARA_IMG. '/loader1.gif' ?>" class="loader" alt="loader">
				</div>

				<div class="b-management-detail align-items-start flex-wrap">
					<div class="b-management-detail-left">
						<div class="b-management-title">
							<div class="name"></div>
							<div class="managenent-post"></div>
						</div>
						<div class="text-holder-wrap">
							<div class="text-holder">
								<p></p>
							</div>							
						</div>

						<div class="btn-holder">
							<a href="#" class="btn btn-primary-square det-prev" data-p="0"><?php _e('prev', 'katara')?></a>
							<a href="#" class="btn btn-primary-square det-next" data-p="0"><?php _e('next', 'katara')?></a>
						</div>
					</div>
					<div class="b-management-detail-right">
						<div class="image-holder">
							<img src="<?php echo KATARA_IMG ?>/img-management.jpg" class="img-fluid" alt="image">
						</div>
					</div>
				</div>

			<?php } ?>

				<div class="b-management-card" id="m-<?php echo ($c + 1) ?>">
					<div class="b-management-image">
						<a href="#">
						<?php if( $memImg ) { 
							//echo $memImg; 
								echo '<img class="img-fluid" src="'. aq_resize( $memImg, 363, 290, true, true, true ) .'" alt="'. get_the_title() .'">';
							} ?>
						</a>
						
					</div>
					<div class="b-management-desc">
						<strong class="name"><?php the_title() ?></strong>
						<span class="post"><?php echo $memDesig ?></span>
					</div>
					<div class="m-desc" style="display: none;">
						<div class="text-holder"><?php the_content() ?></div>
						<?php if( get_the_content() ){ ?>
							<button class="btn btn-primary-square btn-mgmt-readmore"><?php _e('Read More', 'katara')?></button>
						<?php } ?>
					</div>
				</div>
				
			<?php
			$c++;
			$i++;
			endwhile; ?>

		</div>

		<?php endif; 
		wp_reset_postdata(); ?>
	</section>
</div>

