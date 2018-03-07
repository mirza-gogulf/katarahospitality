<?php
    $carousels = get_carousels();
?>
<div class="caro full-width" data-position="0">
    <div class="caro-item-copy">
        <ul class="copy-reel">
            <?php foreach( $carousels as $key => $slide ) : ?>
                <li class="<?php if ($key == 0) echo 'active'; ?>">
                    <p class="ttl-36"><?php echo $slide->caro_title; ?></p>
                    <?php if ( $slide->caro_sub_title != '' ) : ?>
                    <p class="tag-line-16"><?php echo nl2br( $slide->caro_sub_title ); ?></p>
                <?php endif; ?>
                    <p><?php echo $slide->caro_description; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <ul class="img-reel">
        <?php foreach( $carousels as $key => $slide ) : ?>
            <li class="<?php if ($key == 0) echo 'active'; ?>">
                <img src="<?php echo $slide->caro_image; ?>" class="caro-itm-img" width="535" height="320" alt="">
            </li> 
        <?php endforeach; ?>
    </ul>

    <nav class="caro-nav">
        <ul>
            <?php foreach( $carousels as $key => $slide ) : ?>
                <li data-number="<?php echo $key; ?>"><a class="caro-nav-btn hide-text <?php if ($key == 0) echo 'active'; ?>" href="#"><?php echo $key + 1; ?></a></li>
            <?php endforeach; ?>
        </ul>    
    </nav>    
</div>

<?php /*
<div class="caro full-width" data-position="0">
    <div class="caro-item-copy">
        <ul class="copy-reel">
            <li class="active">
                <p class="ttl-36"><?php _e( 'Welcome', "Katara" ); ?></p>
                <p class="tag-line-16"><?php _e( 'We are the past<br/>but we are everything thats next', "Katara" ); ?></p>
                <p><?php _e( 'As Qatar\'s leading hospitality organization, we are well practiced in welcoming guests to our luxury hotels and resorts. It gives us equal pleasure to welcome you to our newly updated website. We hope you enjoy reading about our proud heritage and our aspirations for the future.', "Katara" ); ?></p>
            </li>
            <li>
                <a href="<?php bloginfo( 'url' ); ?>/about-us/" class="ttl-36"><?php _e( 'About Us', "Katara" ); ?></a>
                <p><?php _e( 'Katara Hospitality, previously known as Qatar National Hotels, is a hospitality owner, manager and developer, aiming to become one of the leading hospitality organisations in the world. Our journey has seen us grow steadily at home, then expand across the world, spreading our passion for impeccable standards of service and luxury to the Far East, Africa and throughout Europe. We partner with some of the world\'s finest hotel brands including The Ritz-Carlton, Sheraton, Raffles, Marriott, M&#246;venpick and The B&#252;rgenstock Selection, while we are also developing our own, home-grown Merweb business hotel brand.', "Katara" ); ?></p>
            </li>
            <li>
                <a href="<?php bloginfo( 'url' ); ?>/our-hotels/" class="ttl-36"><?php _e( 'Our Hotels', "Katara" ); ?></a>
                <p><?php _e( 'We have created a rich portfolio of properties, partnering with some of the best brands in the hotel industry. We are proud of our role in bringing them to Qatar and determined to further expand our international portfolio.', "Katara" ); ?></p>
            </li>
        </ul>                
    </div>
    
    <ul class="img-reel">
        <li class="active">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home-heros/welcome.jpg" class="caro-itm-img" width="535" height="321" alt="">
        </li> 
        <li>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home-heros/about-us.jpg" class="caro-itm-img" width="535" height="321" alt="">
        </li> 
        <li>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/home-heros/our-hotels.jpg" class="caro-itm-img" width="535" height="321" alt="">
        </li>
    </ul>
    
    <nav class="caro-nav">
        <ul>
            <li data-number="0"><a class="caro-nav-btn hide-text active" href="#">1</a></li>
            <li data-number="1"><a class="caro-nav-btn hide-text" href="#">2</a></li>
            <li data-number="2"><a class="caro-nav-btn hide-text" href="#">3</a></li>
        </ul>    
    </nav>    
</div>
*/ ?>