<?php
    get_header();
    the_post();
    get_sidebar('navi');
    global $sub_nav;
?>
		
		<article class="grid_6 content col-span-1">
    		<header class="gen-content-header">
    		    <h1 class="ttl-36">Brand Assets</h1>
    		    <p class="tag-line-16">Wordmark logos</p>
    		</header>
    		
    		<ul class="file-thumb-list">
    		    <li></li>
    		    <li></li>
    		    <li></li>
    		    <li></li>
    		    <li></li>
    		    <li></li>
    		    <li></li>
    		</ul>    
    		
    		<?php the_content(); ?>
    	</article>
<?php
    get_sidebar();
    get_footer();
?>