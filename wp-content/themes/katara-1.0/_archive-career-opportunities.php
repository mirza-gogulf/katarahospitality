<?php
    if ( isset($_GET['search']) )
    {
        global $wp_query, $wp_rewrite, $paged;

        $query_args = $wp_query->query_vars;

        if ( $_GET['search'] == __( 'Search', "Katara" ) )
        {
            $query_args['s'] = '';
        }
        else
        {
            $query_args['s'] = $_GET['search'];
        }

        $job_filter_employment = FALSE;
        $job_filter_level = FALSE;
        $job_filter_department = FALSE;
        $job_filter_location = FALSE;

        if ( isset( $_GET['job-filter-employment'] ) && ! empty( $_GET['job-filter-employment'] ) )
        {
            $job_filter_employment = array(
                'key' => 'job_employment',
                'value' => $_GET['job-filter-employment'] ,
                'compare' => 'IN'
             );
        }

        if ( isset( $_GET['job-filter-level'] ) && ! empty( $_GET['job-filter-level'] ) )
        {
            $job_filter_level = array(
                'key' => 'job_level',
                'value' => $_GET['job-filter-level'] ,
                'compare' => 'IN'
             );
        }

        if ( isset( $_GET['job-filter-department'] ) && ! empty( $_GET['job-filter-department'] ) )
        {
            $job_filter_department = array(
                'key' => 'job_department',
                'value' => $_GET['job-filter-department'] ,
                'compare' => 'IN'
             );
        }

        if ( isset( $_GET['job-filter-location'] ) && ! empty( $_GET['job-filter-location'] ) )
        {
            $job_filter_location = array(
                'key' => 'job_location',
                'value' => $_GET['job-filter-location'] ,
                'compare' => 'IN'
             );
        }

        $meta_query = array( 'relation' => 'AND', $job_filter_employment, $job_filter_level, $job_filter_department, $job_filter_location );
        $query_args['meta_query'] = $meta_query;
        
        $wp_query->query($query_args);
    }

    get_header();
    get_sidebar('careers-search');
?>

    <section class="grid_6 content col-span-1">
        <header class="gen-content-header">
            <h1 class="ttl-36"><?php echo __( post_type_archive_title('', false), "Katara" ); ?></h1>
            <p class="tag-line-16"><?php echo __( 'We are constantly developing talent', "Katara" ); ?></p>
            <p><?php echo __( 'Katara Hospitality takes great pride in the high quality of its people. They are, after all, the backbone of our operation and without constantly striving for impeccably high standards we wouldn\'t have such an enviable reputation. To further this aim we have a rigorous program of talent development in place. If you have the energy and ambition to work for one of the region\'s premier organisations, and in doing so further develop your talent, please send your r&#233;sum&#233; with a covering letter to the address below.', "Katara" ); ?></p>
        </header>

        <?php if ( have_posts() ) : ?>
            
            <ul class="grid_6 alpha one-col-list press-list">
                <?php
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( "modules/post", "career" ); 
                    endwhile;
                ?>
            </ul>
            <?php katara_content_nav( 'nav-below' ); ?>

        <?php else : ?>
            <ul>
                <li class="one-col-list-item career-li" id="carrer-<?php the_ID(); ?>">
                    <h2 class="sub-ttl-22"><?php echo __( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', "Katara" ); ?></h2>
                </li>
            </ul>
        <?php endif; ?>

        <?php if(!is_arabic()): ?>
	        <p class="recruit-disclaim"><a href="#recruit-pop" class="open-popup-link">Recruitment Scams</a></p>

	        <div id="recruit-pop" class="white-popup mfp-hide">
	        	<h1 class="ttl-36"><span>Recruitment</span> Scams</h1>	
	        	<p>This is an important notice on fraudulent communications that have been made to job seekers by individuals falsely pretending to recruit on behalf of Katara Hospitality or to affiliate with Katara Hospitality.</p>

	        	<p>We've been made aware of recent incidents where unauthorized vacancy advertisements are being circulated on the internet using Katara Hospitality’s name with the intent to obtain personal and financial information and/or to pay upfront application and processing fees.</p>

				<p>Please note that these communications are fraudulent. Katara Hospitality vacancies are announced only on Katara Hospitality’s official corporate website, our official LinkedIn and CatererGlobal page. Katara Hospitality engages recruiting agencies to help identify candidates for specific positions; however, there should be no cost to you as a job-seeker. Neither Katara Hospitality, nor any of the recruitment agencies that recruit on Katara Hospitality’s behalf ask for any fees of any kind or upfront payments at any point in the recruitment process. Candidates who are successful in gaining a job offer from Katara Hospitality are required to go through the formal recruitment process. All candidates are interviewed prior to offer, face to face, or by Telephone, at a minimum.</p>

				<p>If you receive such proposals, do not disclose your personal or financial details, or make any payments requested by such emails or other communication to secure employment at Katara Hospitality.</p>

				<p>If you believe you have been the victim of one of these recruiting scams, you are advised to contact your local law enforcement agency and provide any details you may have from the senders (email addresses, phone/fax details, etc.).</p>

				<p>Should you have any doubts about the authenticity of any email, letter, or telephone communication from, for, or on behalf of Katara Hospitality, please contact us via;<a href="http://www.katarahospitality.com/contact-us/">http://www.katarahospitality.com/contact-us/</a> before disclosing any personal details.</p>

				<p>We regret any inconvenience caused by these unauthorized and fraudulent activities which are beyond our control. We reject any responsibility or liability as a result of a fake job announcement, offer or a scam on the internet.</p>
	        </div>
    	<?php else: ?>
	        <p class="recruit-disclaim"><a href="#recruit-pop" class="open-popup-link">إشعار تحذيري</a></p>

	        <div id="recruit-pop" class="white-popup mfp-hide">
	        	<h1 class="ttl-36"><span>إإشعار تحذيري</span></h1>	
	        	<p>هذا إشعار هام حول الاتصالات الاحتيالية التي يتم إجراؤها على الباحثين عن عمل، وذلك من قبل الأفراد الذين يتظاهرون بتوفير وظائف شاغرة  بالنيابة عن كتارا للضيافة أو لتسهيل الانضمام إلى كتارا للضيافة.</p>

	        	<p>لقد تم إعلامنا ببعض حالات نشر إعلانات حول وظائف شاغرة غير مرخص بها، والاحتيالات التي يجري تداولها على الإنترنت باستخدام إسم كتارا للضيافة بهدف الحصول على معلومات معينة من الأفراد أو طلب المال من الأشخاص الراغبين في العمل لدى شركتنا.</p>

				<p>نحيطكم علماً بأن هذه الإعلانات مزورة، حيث يتم الإعلان عن وظائف شاغرة لدى كتارا للضيافة على الموقع الرسمي للشركة فقط، وعلى صفحتي "لينكد إن" و "كاتيرر غلوبال" الرسميتان. كما تتعاون كتارا للضيافة مع وكالات التوظيف للمساعدة في تحديد المرشحين لمناصب محددة، ولا ينبغي أن تكون هناك أي تكلفة للباحثين عن عمل. كما لا يحق لشركة كتارا للضيافة، أو أي من الوكالات المصرحة بعملية التوظيف بالنيابة عن كتارا للضيافة أن تطلب أي رسوم من أي نوع، أو رسوم مدفوعة مقدماً في أي وقت خلال عملية التوظيف. والمطلوب من المرشحين الذين نجحوا في الحصول على عرض عمل من كتارا للضيافة أن يمروا بجميع مراحل عملية التوظيف الرسمية للشركة، كما يتم مقابلة جميع المرشحين قبل العرض، وجها لوجه، أو عن طريق الهاتف، كحد أدنى.</p>

				<p>إذا تلقيتم مثل هذه العروض، يرجى عدم الإفصاح عن أية معلومات لشخصية أو مالية، أو  إجراء أي مدفوعات تطلب منكم من خلال رسائل إلكترونية أو غيرها من وسائل الإتصال التي من شأنها أن تؤمن لكم وظيفة في شركة كتارا للضيافة.</p>

				<p>وإذا كنتم تعتقدون أنكم ضحية لاحتيال في عملية التوظيف، فنحن نشجعكم على الاتصال بالوكالة القانونية المحلية للتحقيق فيها، وتزويدها بأي تفاصيل متعلقة بالمرسل (البريد الإلكتروني، هاتف/ فاكس، وغيرها من التفاصيل).</p>

				<p>إذا كان لديكم أي شكوك حول صحة البريد إلكتروني، أو الرسالة، أو الاتصال الهاتفي من، لـ، أو بالنيابة عن كتارا الضيافة، يرجى الاتصال بنا عبر <a href="http://ar.katarahospitality.com/contact-us"> قبل الكشف عن أي تفاصيل شخصية.</a></p>

				<p> نأسف لأية إزعاج ناجم عن هذه الأنشطة غير المرخصة وغير المرغوبة والتي تحدث خارج نطاق سيطرتنا. نحن لا نتحمل المسؤولية عن نتائج نشر أو عرض إعلان وظيفة وهمية، أو عن أية عملية احتيال على شبكة الإنترنت.</p>
	        </div>    		
    	<?php endif; ?>
    </section><!-- #primary -->

<?php
    get_sidebar( 'careers' );
    get_footer();
?>