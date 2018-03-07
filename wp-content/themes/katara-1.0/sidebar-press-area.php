<?php
    $subfolder = ( is_arabic() )? 'rtl/': '';
    $current_cat = FALSE;
    if ( isset( $_GET['t'] ) )
    {
        $is_term = term_exists( $_GET['t'], 'asset_category' );

        if ( isset( $is_term['term_id'] ) )
            $current_cat = $is_term['term_id'];
    }
    elseif ( is_singular( 'press-area' ) )
    {
        $the_terms = get_the_terms( get_the_ID(), 'asset_category' );
        foreach( $the_terms as $the_term )
        {
            if ( $the_term->parent != 0 )
            {
                $current_cat = $the_term->term_id;
            }
        }
    }
    else
    {
        $asset_catgory = get_asset_catgory();

        if ( isset( $asset_catgory->term_id ) )
            $current_cat = $asset_catgory->term_id;
    }
?>
<aside class="aside-left">
    <nav role="navi">
        <?php
            $args = array(
                'orderby' => 'slug',
                'order' => 'ASC',
                'hide_empty' => 1,
                'parent' => 0
            );
            $terms = get_terms( 'asset_category', $args );
        ?>
        <ul class="sub-menu" id="menu-category">
            <?php foreach( $terms as $term ) : ?>
                <li>
                    <span class="sub-menu-lvl-1"><?php echo $term->name; ?></span>
                        <?php
                            $args = array(
                                'orderby' => 'slug',
                                'order' => 'ASC',
                                'hide_empty' => 1,
                                'parent' => $term->term_id
                            );
                            $sub_terms = get_terms( 'asset_category', $args );
                        ?>
                    <ul class="sub-menu-list-lvl-3">    
                        <?php foreach( $sub_terms as $sub_term ) : ?>
                            <li>
                                <a class="sub-menu-lvl-3 slidingDoors <?php if ( $current_cat == $sub_term->term_id ) echo 'active'; ?>" href="<?php echo home_url( '/press-area/' ).'?t='.$sub_term->slug; ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/lvl-3-sub-nav-t.png" class="btnT" alt="">
                                    <span class="inlineBlock"><?php echo $sub_term->name; ?></span>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $subfolder; ?>lvl-3-sub-nav-r.png" class="lvl-3-arrow" alt="">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/lvl-3-sub-nav-b.png" class="btnB" alt="">
                                </a>
                            </li>
                    <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</aside>