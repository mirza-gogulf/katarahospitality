<?php
    $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'names');
    $location = join(", ",wp_get_object_terms( get_the_ID(), 'locations', $args ));
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	    <h3><?php echo $location; ?></h3>
	</header>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>
