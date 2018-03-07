<?php
    get_header();
    the_post();
    
    // Logo
    $banner_id = get_post_thumbnail_id( get_the_ID() );
    $banner = wp_get_attachment_image_src( $banner_id, 'size-710-299' );
    $page_sub_title = get_post_meta( $post->ID, 'page_sub_title', TRUE );
?>
<?php get_sidebar('navi'); ?>

    <?php if ( isset( $banner[0] ) ) { ?>
	    <img class="hero-img" src="<?php echo $banner[0]; ?>" alt="" height="299" width="710" />
	<?php } ?>
	
    <article class="grid_6 content col-span-1">
  		<header class="gen-content-header">
  		    <h1 class="ttl-36"><?php the_title(); ?></h1>
  		    <p class="tag-line-16"><?php echo ( $page_sub_title ) ? $page_sub_title: __( 'We are new, yet historic', "Katara" ); ?></p>
  		</header>
  		<?php the_content(); ?>

      <?php if(is_arabic()) { ?>
        <h2 class="sub-ttl-22" style="padding-bottom: 10px;">نبذة عن قطر القابضة وجهاز قطر للإستثمار</h2>
      <?php } else { ?>
        <h2 class="sub-ttl-22" style="padding-bottom: 10px;">About QH and QIA</h2>
      <?php } ?>

      <ul id="board-members" class="grid_6 alpha two-col-list">
        <li class="two-col-list-item">
            <div class="grid_2 alpha">
                <img class="profile-pic" src="<?php echo get_template_directory_uri(); ?>/assets/img/QH-Logo.gif" alt="qatar holding">
            </div>

            <div class="grid_4 omega">
              
              <?php if(is_arabic()) { ?>
                <p>قطر القابضة ذ.م.م. شركة استثمار عالمية تأسست في عام 2006 من قبل جهاز قطر للإستثمار ومرخصة من قبل هيئة مركز قطر للمال. تستثمر قطر القابضة محل
اً ودولياً في الشركات الخاصة والعامة إلى جانب استثمارات مباشرة أخرى.</p>

                <p>تسعى قطر القابضة إلى تحقيق عائدات طويلة الأجل على الأصول لإفادة دولة قطر وتنويع الإقتصاد.</p>

                <p>لزيارة الموقع الإلكتروني لقطر القابضة، يرجى زيارة الرابط التالي: <br/><a href="http://www.qatarholding.qa" target="_blank">http://www.qatarholding.qa</a></p>

              <?php } else { ?>
                <p>Qatar Holding LLC (QH) is a global investment house established in 2006, founded by the Qatar Investment Authority (QIA) and licensed by the Qatar Financial Centre Authority (QFCA). QH invests internationally and locally in strategic private and public equity as well as in other direct investments.</p>
                <p>QH strives to achieve steady long term returns on assets to benefit the State of Qatar and to diversify its economy.</p>
                <p>To visit QH’s website please go to the following link: <br/><a href="http://www.qatarholding.qa" target="_blank">http://www.qatarholding.qa</a></p>
              <?php } ?>

            </div>
            <div class="clearFloat">&nbsp;</div>
        </li>
        <li class="two-col-list-item">
            <div class="grid_2 alpha">
                <img class="profile-pic" src="<?php echo get_template_directory_uri(); ?>/assets/img/qia.gif" alt="qia">
            </div>

            <div class="grid_4 omega">

              <?php if(is_arabic()) { ?>
                <p>تأسس جهاز قطر للإستثمار من قبل دولة قطر في عام 2005 لتعزيز الإقتصاد القط
ي من خلال التنويع في مجموعة أصول جديدة. بناء على تراث الإستثمارات القطرية التي تعود إلى أكثر من ثلاثة عقود
 تساعد محفظتها المتنامية من الإستثمارات الإستراتيجية الطويلة الأجل على دعم الثروة الهائلة للدولة من الموارد الطبيعية.</p>

                <p>تهدف قطر لتصبح مركزاً دولياً رئيسياً لإدارة المال والإستثمار، وهي رؤية تشاركها الحكومة والشعب والمؤسسات.</p>

                <p>تأسست قطر القابضة من قبل جهاز قطر للإستثمار وتمثل الشركة القابضة للإستثمارات الإستراتيجية والمباشرة. تتشارك قطر القابضة وجهاز قطر للإستثمار منصة البنية التحتية ذاتها وخدمات الدعم ذاتها.</p>

                <p>لزيارة الموقع الإلكتروني لجهاز قطر للإستثمار، يرجى زيارة الرابط التالي: <br/><a href="http://www.qia.qa" target="_blank">http://www.qia.qa</a></p>
              <?php } else { ?>
                <p>The QIA was founded by the State of Qatar in 2005 to strengthen the country's economy by diversifying into new asset classes. Building on the heritage of Qatar investments dating back more than three decades, its growing portfolio of long-term strategic investments help complement the state's huge wealth in natural resources.</p>
                <p>Qatar's goal is to become a major international centre for finance and investment management, a vision shared by its government, people and institutions.</p>
                <p>Qatar Holding LLC (QH) was founded by Qatar Investment Authority (QIA) and represents its holding company for strategic and direct investments. QIA and QH share the same infrastructure platform and back office services.</p>
                <p>To visit QIA's website please go to the following link: <br/><a href="http://www.qia.qa" target="_blank">http://www.qia.qa</a></p>
              <?php } ?>

            </div>
            <div class="clearFloat">&nbsp;</div>
        </li>
      </ul>

  	</article>

<?php get_sidebar(); ?>
<?php get_footer(); ?>