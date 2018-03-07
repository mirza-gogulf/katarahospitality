<section class="k-section k-section-news">
	<div class="container">
		<div class="title-holder">
			<h2><?php the_field( 'front_news_section_title' ) ?></h2>
		</div>
		<div class="row">
			<div class="col-lg-6 offset-lg-1 text-holder">
				<p><?php the_field( 'front_news_section_desc' ) ?></p>
			</div>
			<div class="col-lg-10 offset-lg-1">
				<?php $lateNewsQuery = kataraGetPost( 'press_release', '', 3 ); 
				if ( $lateNewsQuery -> have_posts() ) : 
					global $nCount;
					$nCount = 0;
					while ( $lateNewsQuery -> have_posts() ) : $lateNewsQuery -> the_post(); 
						$nCount++;
						get_template_part( "template-parts/loop/loop", "front-news" );
					
					endwhile; 
				else :
					_e( 'No Results Found.', 'katara' );
				endif;

				wp_reset_postdata();?>

				<div class="btn-holder">
					<a href="<?php echo home_url( '/news' ) ?>" class="btn btn-primary-round"><?php _e('read all news', 'katara' ) ?></a>
				</div>
			</div>
		</div>
	</div>
</section>