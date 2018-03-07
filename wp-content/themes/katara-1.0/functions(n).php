<?php
    // ----- SET GLOBALS FOR LANGUAGES ----- //
    define("EN_SITE_ID", 1);
    define("AR_SITE_ID", 2);
    define( 'NO_REPLY', 'no-reply@katarahospitality.com' );
    define( 'CDN_URL', 'http://static.katara.dev' );

    if (!current_user_can('administrator')) {
        add_filter('show_admin_bar', '__return_false');
    }

    if(is_arabic())
    {
        require('libraries/I18N/Arabic.php'); 
        $Ar = new I18N_Arabic('Date');


        function ar_date( $the_date, $d, $before = null, $after = null )
        {
            global $Ar;

            $time = strtotime($the_date);
            
            $fix = $Ar->dateCorrection($time);
            $Ar->setMode(2); 
            $date = $Ar->date('d M Y', $time, $fix);

            return find_and_replace_arabic_numbers($date);
        }

        add_filter('the_date', 'ar_date', 1, 4);
        add_filter('the_time', 'ar_date', 1, 4);
    }

    
    /**
     * Tell WordPress to run katara_setup() when the 'after_setup_theme' hook is run.
     */
    add_action( 'after_setup_theme', 'katara_setup' );

    if ( ! function_exists( 'katara_setup' ) ):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     *
     * To override katara_setup() in a child theme, add your own katara_setup to your child theme's
     * functions.php file.
     *
     * @uses load_theme_textdomain() For translation/localization support.
     * @uses add_editor_style() To style the visual editor.
     * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
     *
     * @since Twenty Eleven 1.0
     */
    function katara_setup() {

        /* Make Twenty Eleven available for translation.
         * Translations can be added to the /languages/ directory.
         * If you're building a theme based on Twenty Eleven, use a find and replace
         * to change 'twentyeleven' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'twentyeleven', TEMPLATEPATH . '/languages' );

        $locale = get_locale();
        $locale_file = TEMPLATEPATH . "/languages/$locale.php";
        if ( is_readable( $locale_file ) )
            require_once( $locale_file );

        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();


        // This theme uses wp_nav_menu() in one location.
        register_nav_menu( 'primary', __( 'Primary Menu', 'twentyeleven' ) );

        // This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
        add_theme_support( 'post-thumbnails' );
        
        // Image sizes
        add_image_size( 'size-960-321', 960, 321, TRUE );
        add_image_size( 'size-710-299', 710, 299, TRUE ); // Single hotel images
        add_image_size( 'size-710-189', 710, 189, TRUE ); // About Us page banner
        add_image_size( 'size-535-321', 535, 321, TRUE );
        add_image_size( 'size-280-129', 280, 129, TRUE ); // small front page images
        add_image_size( 'size-220-82', 220, 82, TRUE ); // Hotel images for sidebar
        add_image_size( 'size-143-143', 143, 143, TRUE ); // our board, Our Executives images
        add_image_size( 'size-80-80', 80, 80, TRUE ); // Hotel Logo
        
        // Remove Admin Bar for subscriber
        if ( ! is_admin() && is_user_logged_in() )
        {
            $current_user = wp_get_current_user();

            if ( isset($current_user->roles) && in_array( "subscriber", $current_user->roles ) )
            {
                show_admin_bar( FALSE );
            }
        }

        // Remove /blog prefix
        global $wp_rewrite;
        $wp_rewrite->front = str_replace("/blog", "", $wp_rewrite->front );
        $wp_rewrite->permalink_structure = str_replace("/blog", "", $wp_rewrite->permalink_structure );
    }
    endif; // katara_setup

    /**
     * Display navigation to next/previous pages when applicable
     * Modded from twentyeleven_content_nav to katara_content_nav
     */
    function katara_content_nav( $nav_id )
    {
        global $wp_query;

        if ( $wp_query->max_num_pages > 1 ) : ?>
            <nav id="<?php echo $nav_id; ?>">
                <p class="prev"><?php next_posts_link( __( 'Previous', 'twentyeleven' ) ); ?></p>

                <p class="next"><?php previous_posts_link( __( 'Newer', 'twentyeleven' ) ); ?></p>

            </nav><!-- #nav-above -->
        <?php endif;
    }

    // -------------------------------------------------------------------------

    define( 'SUCCESS_RESPONSE', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquet tincidunt risus, dignissim convallis mi elementum in. Pellentesque vel massa dolor. Nunc id ipsum enim.</p><p>A member of our team will be in touch shortly.</p>' );
    
    // ------------------------------------------------------------------------
    
    /**
     * Saves request information for 'Press Office', the information is saved
     * into the kat_access table. Perhaps we could replace the kat_table with a
     * custom post_type.
     *
     * @uses    check_request_access() Check if email has already request access
     * @param   string $access_firstname
     * @param   string $access_lastname
     * @param   string $access_company
     * @param   string $access_email
     * @param   string $access_message
     * @return  array
     */
    function apply_career( $application_firstname, $application_lastname, $application_nationality, $application_dob, $application_country, $application_city, $application_mobile, $application_number, $application_education, $application_experience, $application_resume, $application_intent, $application_job_id )
    {
        $contact_from = get_bloginfo('name').' <'.NO_REPLY.'>';

        $career = compact( 'application_firstname', 'application_lastname', 'application_nationality', 'application_dob', 'application_country', 'application_city', 'application_mobile', 'application_number', 'application_education', 'application_experience', 'application_resume', 'application_intent', 'application_job_id' );
        global $wpdb;
        $wpdb->insert( 'kat_careers', $career );
        $data = array(
           'success' => TRUE,
           'message' => SUCCESS_RESPONSE
        );

        $view_id = $wpdb->insert_id;

        $contact_to = get_option( 'contact_job' );

        if ( $contact_to == '' )
            $contact_to = get_bloginfo( 'admin_email' );

        $contact_name = $application_firstname.' '.$application_lastname;
        $contact_subject = get_bloginfo('name').' : '.get_the_title($application_job_id).' Application';
        $contact_message = 'An application has been received from '.$contact_name."\r\n\r\n";
        $contact_message .= 'Go directly to this section here - '.admin_url( 'admin.php?page=job-applications&view_id='.$view_id )."\r\n";

        form_mail_to( $contact_from, $contact_to, $contact_subject, $contact_message );

        return $data;
    }

    // ------------------------------------------------------------------------

    /**
     * The function is used to to handle the save the form data when a  visiter
     * requests access to the 'Press Office', displays a json response
     *
     * @uses    request_press_office()
     */
    function ajax_request_press_office()
    {
        $data = array(
           'success' => FALSE,
           'message' => ''
        );
        
        $access_firstname = ( isset( $_POST['access_firstname'] ) && $_POST['access_firstname'] != '' ) ? $_POST['access_firstname']: FALSE;
        $access_lastname = ( isset( $_POST['access_lastname'] ) && $_POST['access_lastname'] != '' ) ? $_POST['access_lastname']: FALSE;
        $access_company = ( isset( $_POST['access_company'] ) && $_POST['access_company'] != '' ) ? $_POST['access_company']: FALSE;
        $access_email = ( isset( $_POST['access_email'] ) && $_POST['access_email'] != '' ) ? $_POST['access_email']: FALSE;
        $access_message = ( isset( $_POST['access_message'] ) && $_POST['access_message'] != '' ) ? $_POST['access_message']: FALSE;

        if  ( ! $access_firstname || ! $access_lastname || ! $access_company || ! $access_email || ! $access_message )
        {
            $data['message'] = '<p>'.__( 'All fields should be filled in.', "Katara" ).'</p>';
            echo json_encode($data);
            die;
        }

        $data = request_press_office( $access_firstname, $access_lastname, $access_company, $access_email, $access_message );

        echo json_encode($data);
        die;
    }
    add_action('wp_ajax_request_press_office', 'ajax_request_press_office');
    add_action('wp_ajax_nopriv_request_press_office', 'ajax_request_press_office');

    // ------------------------------------------------------------------------

    /**
     * Saves request information for 'Press Office', the information is saved
     * into the kat_access table. Perhaps we could replace the kat_table with a
     * custom post_type.
     *
     * @uses    check_request_access() Check if email has already request access
     * @param   string $access_firstname
     * @param   string $access_lastname
     * @param   string $access_company
     * @param   string $access_email
     * @param   string $access_message
     * @return  array
     */
    function request_press_office( $access_firstname, $access_lastname, $access_company, $access_email, $access_message )
    {
        $print = compact( 'access_firstname', 'access_lastname', 'access_company', 'access_email', 'access_message' );

        $data = array(
           'success' => FALSE,
           'message' => ''
        );
        
        $access_type = 1;

        if ( ! is_email( $access_email ) )
        {
            $data['message'] = '<p class="error">'.__( 'The email address entered is not valid.', "Katara" ).'</p>';
        }
        elseif ( check_request_access( $access_email, $access_type ) )
        {
            $data['message'] = '<p class="error">.'.__( 'You have already requested access.', "Katara" ).'</p>';
        }
        else
        {
            $access = compact( 'access_firstname', 'access_lastname', 'access_company', 'access_email', 'access_message', 'access_type' );
            global $wpdb;
            $wpdb->insert( 'kat_access', $access );
            $data = array(
               'success' => TRUE,
               'message' => SUCCESS_RESPONSE
            );

            $view_id = $wpdb->insert_id;

            $contact_from = get_bloginfo('name').' <'.NO_REPLY.'>';

            $contact_to = get_option( 'contact_press_email' );

            if ( $contact_to == '' )
                $contact_to = get_bloginfo( 'admin_email' );

            $contact_name = $access_firstname.' '.$access_lastname;
            $contact_subject = 'Request access : Press Office';
            $contact_message = 'Access Request has been received from '.$contact_name."\r\n\r\n";
            $contact_message .= 'Go directly to this section here - '.admin_url('admin.php?page=request-access&view_id='.$view_id )."\r\n";

            form_mail_to( $contact_from, $contact_to, $contact_subject, $contact_message );
        }

        return $data;
    }
    
    // ----------------------------------------------------------------------------

    /**
     * The function is used to to handle the save the form data when a  visiter
     * requests access to the 'Careers', displays a json response
     *
     * @uses    request_careers()
     */
    function ajax_request_careers()
    {
        $data = array(
           'success' => FALSE,
           'message' => ''
        );
        
        $access_firstname = ( isset( $_POST['access_firstname'] ) && $_POST['access_firstname'] != '' ) ? $_POST['access_firstname']: FALSE;
        $access_lastname = ( isset( $_POST['access_lastname'] ) && $_POST['access_lastname'] != '' ) ? $_POST['access_lastname']: FALSE;
        $access_email = ( isset( $_POST['access_email'] ) && $_POST['access_email'] != '' ) ? $_POST['access_email']: FALSE;

        if  ( ! $access_firstname || ! $access_lastname || ! $access_email )
        {
            $data['message'] = '<p>'.__( 'All fields should be filled in.', "Katara" ).'</p>';
            echo json_encode($data);
            die;
        }

        $data = request_careers( $access_firstname, $access_lastname, $access_email );

        echo json_encode($data);
        die;
    }
    add_action('wp_ajax_request_careers', 'ajax_request_careers');
    add_action('wp_ajax_nopriv_request_careers', 'ajax_request_careers');

    // ------------------------------------------------------------------------
    /**
     * Saves request information for 'Careers', the information is saved
     * into the kat_access table. Perhaps we could replace the kat_table with a
     * custom post_type.
     *
     * @uses    check_request_access() Check if email has already request access
     * @param   string $access_firstname
     * @param   string $access_lastname
     * @param   string $access_email
     * @return  array
     */
    function request_careers( $access_firstname, $access_lastname, $access_email )
    {
        $data = array(
           'success' => FALSE,
           'message' => ''
        );
        
        $access_type = 2;

        if ( ! is_email( $access_email ) )
        {
            $data['message'] = '<p class="error">'.__( 'The email address entered is not valid.', "Katara" ).'</p>';
        }
        elseif ( check_request_access( $access_email, $access_type ) )
        {
            $data['message'] = '<p class="error">'.__( 'You have already requested access.', "Katara" ).'</p>';
        }
        else
        {
            $access = compact( 'access_firstname', 'access_lastname', 'access_email', 'access_type' );
            global $wpdb;
            $wpdb->insert( 'kat_access', $access );
            $data = array(
               'success' => TRUE,
               'message' => SUCCESS_RESPONSE
            );

            $view_id = $wpdb->insert_id;

            $contact_from = get_bloginfo('name').' <'.NO_REPLY.'>';

            $contact_to = get_option( 'contact_career' );

            if ( $contact_to == '' )
                $contact_to = get_bloginfo( 'admin_email' );
            
            $contact_name = $access_firstname.' '.$access_lastname;
            $contact_subject = 'Request access : Careers';
            $contact_message = 'Access Request has been received from '.$contact_name."\r\n\r\n";
            $contact_message .= 'Go directly to this section here'.' - '.admin_url('admin.php?page=request-access&view_id='.$view_id )."\r\n";

            form_mail_to( $contact_from, $contact_to, $contact_subject, $contact_message );
        }

        return $data;
    }
    
    // -------------------------------------------------------------------------

    /**
     * Saves request information for 'Tenders', the information is saved
     * into the kat_access table. Perhaps we could replace the kat_table with a
     * custom post_type.
     *
     * @uses    check_request_access() Check if email has already request access
     * @param   string $access_firstname
     * @param   string $access_lastname
     * @param   string $access_company
     * @param   string $access_job_title
     * @param   string $access_email
     * @param   string $access_message
     * @param   string $access_document
     * @return  array
     */
    function request_tenders( $access_firstname, $access_lastname, $access_company, $access_job_title, $access_email, $access_message, $access_document )
    {
        $data = array(
           'success' => FALSE,
           'message' => ''
        );
        
        $access_type = 3;

        if ( ! is_email( $access_email ) )
        {
            $data['message'] = '<p class="error">'.__( 'The email address entered is not valid.', "Katara" ).'</p>';
        }
        elseif ( check_request_access( $access_email, $access_type ) )
        {
            $data['message'] = '<p class="error">'.__( 'You have already requested access.', "Katara" ).'</p>';
        }
        else
        {
            $access = compact( 'access_firstname', 'access_lastname', 'access_company', 'access_job_title', 'access_email', 'access_message', 'access_document', 'access_type' );
            global $wpdb;
            $wpdb->insert( 'kat_access', $access );
            $data = array(
               'success' => TRUE,
               'message' => SUCCESS_RESPONSE
            );

            $view_id = $wpdb->insert_id;

            $contact_from = get_bloginfo('name').' <'.NO_REPLY.'>';

            $contact_to = get_option( 'contact_tender' );

            if ( $contact_to == '' )
                $contact_to = get_bloginfo( 'admin_email' );

            $contact_name = $access_firstname.' '.$access_lastname;
            $contact_subject = 'Request access : Tenders' ;
            $contact_message = 'Access Request has been received from '.$contact_name."\r\n\r\n";
            $contact_message .= 'Go directly to this section here - '.admin_url('admin.php?page=request-access&view_id='.$view_id )."\r\n";

            form_mail_to( $contact_from, $contact_to, $contact_subject, $contact_message );
        }

        return $data;
    }

    // -------------------------------------------------------------------------

    /**
     * check if email address has already requested access
     *
     * @param   string $email
     * @param   string $access_type
     * @return  bool
     */
    function check_request_access( $email, $access_type )
    {
        global $wpdb;

        $sql = "SELECT access_id
            FROM kat_access
            WHERE 1=1
            AND access_email = '$email'
            AND access_type = '$access_type'
            LIMIT 1";
        $row = $wpdb->get_row( $sql );

        if ( isset( $row->access_id ) )
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    // -------------------------------------------------------------------------

    /**
     * Creates Menu Pages
     *
     * @uses   add_menu_page() WP function
     */
  function admin_menu()
    {
       // $get_role = get_current_user_role();
        add_menu_page('Carousels', 'Carousels', 'administrator', 'carousels', 'carousel_manager' );
        add_submenu_page( 'carousels', 'Add New', 'Add New', 'administrator', 'carousel-add', 'carousel_manager' );

        add_menu_page('Request Access', 'Request Access', 'administrator', 'request-access', 'request_access_page' );
        
        add_menu_page('Job Applications', 'Job Applications', 'administrator', 'job-applications', 'job_applications' );
        
        add_menu_page('Contact Details', 'Contact Details', 'upload_files', 'contact-details', 'contact_details');
        add_submenu_page( 'contact-details', 'Contacts', 'Contacts', 'upload_files', 'contact-list', 'contact_list_page');

        
        
    }
    add_action('admin_menu', 'admin_menu');

    // -------------------------------------------------------------------------

    function carousel_manager()
    {
        include( 'includes/admin/carousel-manager.php' );
    }

    // -------------------------------------------------------------------------

    /**
     * Loads page
     */
    function request_access_page()
    {
        include( 'includes/admin/request-access.php' );
    }

    // -------------------------------------------------------------------------

    function contact_details()
    {
        include( 'includes/admin/contact-details.php' );
    }

    // -------------------------------------------------------------------------

    function contact_list_page()
    {
        include( 'includes/admin/contacts.php' );
    }
    
    // ------------------------------------------------------------------------

    function job_applications()
    {
        include( 'includes/admin/job-applications.php' );
    }

    // ------------------------------------------------------------------------

    /**
     * @param   string
     * @param   string
     * @return  array
     */
    function get_custom_post_labels($name, $singular_name)
    {
        $labels = array(
            'name' => _x($name, 'post type general name'),
            'singular_name' => _x($singular_name, 'post type singular name'),
            'add_new' => _x('Add New', strtolower(str_replace(' ', '-', $name))),
            'add_new_item' => __('Add New '.$singular_name),
            'edit_item' => __('Edit '.$singular_name),
            'new_item' => __('New '.$singular_name),
            'all_items' => __('All '.$name),
            'view_item' => __('View '.$singular_name),
            'search_items' => __('Search '.$name),
            'not_found' =>  __('No '.strtolower($name).' found'),
            'not_found_in_trash' => __('No '.strtolower($name).' found in Trash'), 
            'parent_item_colon' => '',
            'menu_name' => $name
        );
        return $labels;
    }

    // -------------------------------------------------------------------------

    function create_post_type() {
        register_post_type( 'press_release',
            array(
                'labels' => get_custom_post_labels( 'Latest News', 'Press Release' ),
                'public' => true,
                'has_archive' => true,
                'taxonomies' => array( 'business_area', 'locations', 'category' ),
                'rewrite' => array( 'with_front' => FALSE, 'slug' => 'press-office' ),
                'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
            )
        );

        register_post_type( 'press-area',
            array(
                'labels' => get_custom_post_labels( 'Press Area', 'Press Asset' ),
                'public' => TRUE,
                'has_archive' => TRUE,
                'hierarchical' => TRUE,
                'exclude_from_search' => TRUE,
                'publicly_queryable' => TRUE,
                'taxonomies' => array('asset_category'),
                'rewrite' => array( 'with_front' => FALSE, 'slug' => 'press-area' ),
                'supports' => array( 'title', 'editor', 'thumbnail' ),
                
            )
        );

        register_post_type( 'tender',
            array(
                'labels' => array(
                    'name' => __( 'Tenders' ),
                    'singular_name' => __( 'Tender' )
                ),
            'public' => true,
            'has_archive' => true,
            'taxonomies' => array( 'locations', 'category' ),
            'rewrite' => array('with_front' => FALSE, 'slug' => 'tenders'),
            
            )
        );
        register_post_type( 'career-opportunities',
            array(
                'labels' => array(
                    'name' => __( 'Careers' ),
                    'singular_name' => __( 'Career Opportunity', "Katara" )
                ),

                'public' => true,
                'has_archive' => true,
                'rewrite' => array('with_front' => FALSE,'slug' => 'careers'),
                'supports' => array( 'title', 'editor', 'custom-fields' ),
                'capabilities' => array(
                        'edit_post'          => 'edit_careers', 
                        'read_post'          => 'read_careers', 
                        'delete_post'        => 'delete_careers', 
                        'edit_posts'         => 'edit_careers', 
                        'edit_others_posts'  => 'edit_others_careers', 
                        'publish_posts'      => 'publish_careers',       
                        'read_private_posts' => 'read_private_careers', 
                        'create_posts'       => 'edit_careers', 
),

            )
        );

        register_post_type( 'hotels',
            array(
                'labels' => get_custom_post_labels( 'Hotels', 'Hotel' ),
                'public' => TRUE,
                'has_archive' => FALSE,
                'taxonomies' => array( 'business_area', 'locations', 'region' ),
                'rewrite' => array( 'with_front' => FALSE,'slug' => 'our-hotels' ),
                'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
            )
        );
        //flush_rewrite_rules( false );
    }
    add_action( 'init', 'create_post_type', 1 );

    // -------------------------------------------------------------------------

    /**
     * Used for development, wraps variable with pre tag
     */
    function pre( $array ) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    // -------------------------------------------------------------------------

    /**
     * Custom taxonomies
     *
     * @uses    register_taxonomy() WP function
     */
    function build_taxonomies()
    {  
        register_taxonomy( 'business_area', 'post', array( 'hierarchical' => true, 'label' => 'Business Areas', 'query_var' => true, 'rewrite' => true ) );  
        register_taxonomy( 'locations', 'post', array( 'hierarchical' => true, 'label' => 'Locations', 'query_var' => true, 'rewrite' => true, 'capabilities'=>array(
        'manage_terms' => 'manage_locations',//or some other capability your clients don't have
        'edit_terms' => 'manage_locations',
        'delete_terms' => 'manage_locations',
        'assign_terms' =>'edit_posts'), ) ); 
        register_taxonomy(
            'asset_category',
            'press-area',
            array(
                'hierarchical' => TRUE,
                'label' => 'Asset Category',
                'labels' => get_custom_taxonomy_labels( 'Asset Categories', 'Asset Category' ),
                'query_var' => TRUE,
                'rewrite' => TRUE,
                'capabilities'=>array(
        'manage_terms' => 'manage_passets',//or some other capability your clients don't have
        'edit_terms' => 'manage_passets',
        'delete_terms' => 'manage_passets',
        'assign_terms' =>'edit_posts'),
            )
        );
        //register_taxonomy( 'region', 'hotels', array( 'hierarchical' => true, 'label' => 'Region', 'query_var' => true, 'rewrite' => true ) );  
    }
    add_action( 'init', 'build_taxonomies', 0 );

    // -------------------------------------------------------------------------

    function get_custom_taxonomy_labels($name, $singular_name)
    {
        $labels = array(
            'name' => $singular_name,
            'singular_name' => $name,
            'search_items' =>  'Search '.$name,
            'all_items' => 'All '.$name,
            'parent_item' => 'Parent '.$singular_name,
            'parent_item_colon' => 'Parent '.$singular_name.':',
            'edit_item' => 'Edit '.$singular_name, 
            'update_item' => 'Update '.$singular_name,
            'add_new_item' => 'Add New '.$singular_name,
            'new_item_name' => 'New '.$singular_name.' Name',
            'separate_items_with_commas' => 'Separate '.strtolower($name).' with commas',
            'add_or_remove_items' => 'Add or remove '.strtolower($name),
            'choose_from_most_used' => 'Choose from the most used '.strtolower($name),
            'menu_name' => $name
        );
        return $labels;
    }

    // -------------------------------------------------------------------------

    /**
     * This function get the ID of the page depending on the page path
     *
     * @uses    get_page_by_path() WP function
     * @return  int|bool page ID or false
     */
    function get_page_id_from_path( $path )
    {
        $page = get_page_by_path( $path );
    
        if ( isset( $page->ID ) )
        {
            return $page->ID;
        }
        else
        {
            return FALSE;
        }
    }

    // -------------------------------------------------------------------------
    
    /**
     * This function get the ID of the page depending on the page path
     *
     * @param   int $n uri segment position
     * @return  string uri segment
     */
    function uri_segments( $n )
    {
        if ( $_SERVER['HTTP_HOST'] == 'staging.lambie-nairn.com' )
            $n = $n + 1;

        $segments = explode('/', $_SERVER['REQUEST_URI']);

        if ( isset( $segments[$n] ) )
        {
            return $segments[$n];
        }
        else
        {
            return FALSE;
        }
    }

    // -------------------------------------------------------------------------
    
    /**
     * Used in input[type=checkbox]
     *
     * @param   string $haystack
     * @param   string $needle
     * @return  string
     */
    function is_checked( $haystack, $needle )
    {
        if ( strpos( $haystack, $needle ) !== FALSE )
        {
            return 'checked="checked"';
        }
    }

    // -------------------------------------------------------------------------

    /**
     * Adds custom meta box to post type
     *
     * @uses    add_meta_box() WP function
     */
    function add_custom_boxes( $post_type, $post ) {
        // PAGE ----------------------------------------------------------------

        add_meta_box( 'sub_title_meta', 'Sub Title', 'sub_title_meta', 'page', 'advanced' );

        // PRESS RELEASE -------------------------------------------------------

        add_meta_box( 'hotel', 'Hotel', 'hotel_meta_box', 'press_release', 'side' );
        add_meta_box( 'press-asset', 'Press Asset', 'press_asset_meta_box', 'press_release', 'normal' );

        // HOTEL ---------------------------------------------------------------

        add_meta_box( 'region', 'Region', 'region_meta_box', 'hotels', 'side' );
        //add_meta_box( 'status', 'Status', 'status_meta_box', 'hotels', 'side' );
        add_meta_box( 'hotel_detail_meta', 'Hotel Details', 'hotel_detail_meta', 'hotels', 'advanced' );

        // CAREERS -------------------------------------------------------------

        add_meta_box( 'career-opportunities', 'Career Details', 'career_detail_meta', 'career-opportunities', 'advanced' );
    }
    add_action( 'add_meta_boxes', 'add_custom_boxes', 10, 2 );

    // -------------------------------------------------------------------------

    /**
     *
     * @uses    get_post_meta() WP function
     * @uses    is_checked()
     */
    function sub_title_meta($post, $metabox)
    {
        $page_sub_title = get_post_meta( $post->ID, 'page_sub_title', TRUE );

        // URL
        $output = '<p><strong>Sub Title</strong></p>';
        $output .= '<input type="text" style="width:50%;" name="page_sub_title" value="'.$page_sub_title.'" />';

        echo $output;
    }

    // -------------------------------------------------------------------------

    /**
     *
     * @uses    get_post_meta() WP function
     * @uses    is_checked()
     */
    function press_asset_meta_box($post, $metabox)
    {
        $current_meta_value = get_post_meta( $post->ID, 'press_asset', TRUE );

        global $wpdb;
        $name = ucwords($metabox['id']);
        $meta = $metabox['id'];

        $sql = "SELECT post.post_title, post.ID 
            FROM $wpdb->posts AS post
            WHERE 1=1
            AND post.post_status = 'publish' 
            AND post.post_type = 'press-area'
            ORDER BY post.post_date DESC
            LIMIT 100";
        $press_areas = $wpdb->get_results( $sql, OBJECT );

        $output = '<ul class="list:category categorychecklist form-no-clear">';
        foreach ( $press_areas as $press_area )
        {
            $output .= '<li id="hotel-'.$press_area->ID.'"><label class="selectit"><input type="checkbox" '.is_checked( $current_meta_value, $press_area->ID ).' id="hotel-'.$press_area->ID.'" name="pressAssets[]" value="'.$press_area->ID.'"> '.$press_area->post_title.'</label></li>';
        }
        $output .= '</ul>';

        echo $output;
    }

    // -------------------------------------------------------------------------

    /**
     *
     * @uses    get_post_meta() WP function
     * @uses    is_checked()
     */
    function hotel_meta_box($post, $metabox)
    {
        $current_meta_value = get_post_meta($post->ID, 'press_hotels', true);

        global $wpdb;
        $name = ucwords($metabox['id']);
        $meta = $metabox['id'];

        $querystr = "SELECT post_title,ID 
            FROM $wpdb->posts wposts
            WHERE post_status = 'publish' 
            AND post_type = 'hotels'
            ORDER BY menu_order ASC
            LIMIT 100
        ";

        $hotels = $wpdb->get_results($querystr, OBJECT);
    
        $output = '<ul class="list:category categorychecklist form-no-clear">';
        foreach ( $hotels as $hotel ) {
            $output .= '<li id="hotel-'.$hotel->ID.'"><label class="selectit"><input type="checkbox" '.is_checked($current_meta_value,$hotel->ID).' id="hotel-'.$hotel->ID.'" name="pressHotels[]" value="'.$hotel->ID.'"> '.$hotel->post_title.'</label></li>';
        }
        $output .= '</ul>';

        echo $output;
    }
    
    // -------------------------------------------------------------------------

    /**
     *
     * @uses    get_post_meta() WP function
     * @uses    is_checked()
     */
    function hotel_detail_meta($post, $metabox)
    {
        $hotel_website_url = get_post_meta( $post->ID, 'hotel_website_url', TRUE );
        $hotel_email = get_post_meta( $post->ID, 'hotel_email', TRUE );
        $hotel_fax = get_post_meta( $post->ID, 'hotel_fax', TRUE );
        $hotel_phone = get_post_meta( $post->ID, 'hotel_phone', TRUE );
        $hotel_address = get_post_meta( $post->ID, 'hotel_address', TRUE );
        $hotel_map = get_post_meta( $post->ID, 'hotel_map', TRUE );
        $hotel_reservations = get_post_meta( $post->ID, 'hotel_reservations', TRUE );
        $hotel_sales = get_post_meta( $post->ID, 'hotel_sales', TRUE );
        $hotel_sales_fax = get_post_meta( $post->ID, 'hotel_sales_fax', TRUE );
        $hotel_status = get_post_meta($post->ID, 'hotel_status', true);

        // URL
        $output = '<p><strong>Website URL</strong></p>';
        $output .= '<input type="text" style="width:50%;" name="hotel_website_url" value="'.$hotel_website_url.'" />';
        
        // Email
        $output .= '<p><strong>Email</strong></p>';
        $output .= '<input type="text" style="width:50%;" name="hotel_email" value="'.$hotel_email.'" />';
        
        // Fax
        $output .= '<p><strong>Fax</strong></p>';
        $output .= '<input type="text" style="width:50%;" name="hotel_fax" value="'.$hotel_fax.'" />';
        
        // Phone
        $output .= '<p><strong>Phone</strong></p>';
        $output .= '<input type="text" style="width:50%;" name="hotel_phone" value="'.$hotel_phone.'" />';
        
        // Reservations
        $output .= '<p><strong>Reservations</strong></p>';
        $output .= '<input type="text" style="width:50%;" name="hotel_reservations" value="'.$hotel_reservations.'" />';
        
        // Sales
        $output .= '<p><strong>Sales</strong></p>';
        $output .= '<input type="text" style="width:50%;" name="hotel_sales" value="'.$hotel_sales.'" />';
        
        // Sales
        $output .= '<p><strong>Sales Fax</strong></p>';
        $output .= '<input type="text" style="width:50%;" name="hotel_sales_fax" value="'.$hotel_sales_fax.'" />';
        
        // STATUS -------------------------------------------------------------

        $statuses = array( 'under-development', 'owned', 'operated' );

        $output .= '<p><strong>Status</strong></p>';
        $output .= '<select style="width:50%;margin-bottom:5px;display:block;" name="hotelStatus" class="adminFormSelect">';
        foreach ( $statuses as $status ) {
        
            if ($hotel_status == 'status-'.$status) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        
            $output .= '<option value="status-'.$status.'" '.$selected.'>'.ucwords($status).'</a>';
        }
        $output .= '</select>';
        
        // Address
        $output .= '<p><strong>Address</strong></p>';
        $output .= '<textarea style="width:50%;" name="hotel_address">'.$hotel_address.'</textarea>';
        
        // Google Map Embed code
        $output .= '<p><strong>Google Map Embed code</strong></p>';
        $output .= '<textarea style="width:100%;height:100px;" name="hotel_map">'.$hotel_map.'</textarea>';

        echo $output;
    }
    
    // ------------------------------------------------------------------------
    
    /**
     *
     * @uses    get_post_meta() WP function
     * @uses    is_checked()
     */
    function career_detail_meta($post, $metabox)
    {
        $job_reference = get_post_meta( $post->ID, 'job_reference', TRUE );
        $job_positions = get_post_meta( $post->ID, 'job_positions', TRUE );
        $job_experience = get_post_meta( $post->ID, 'job_experience', TRUE );
        $job_studies = get_post_meta( $post->ID, 'job_studies', TRUE );
        $job_place = get_post_meta( $post->ID, 'job_place', TRUE );
        $job_employment = get_post_meta( $post->ID, 'job_employment', TRUE );
        $job_level = get_post_meta( $post->ID, 'job_level', TRUE );
        $job_department = get_post_meta( $post->ID, 'job_department', TRUE );
        $job_location = get_post_meta( $post->ID, 'job_location', TRUE );
        $hotel_map = get_post_meta( $post->ID, 'job_experience', TRUE );
        $job_creation = get_post_meta( $post->ID, 'job_creation', TRUE );
        $job_beginning = get_post_meta( $post->ID, 'job_beginning', TRUE );
        
        // REFERENCE
        $output = '<p><strong>Reference</strong></p>';
        $output .= '<input type="text" style="width:50%;" name="job_reference" value="'.$job_reference.'" />';

        // ----- EMPLOYMENT ----- //
        
        $regions = array( 'full-time', 'part-time', 'temporary', 'permanent' );
        $region_names = array( __("Full Time", "Katara") , __("Part Time", "Katara"), __("Temporary", "Katara"), __("Permanent", "Katara") );

        $output .= '<p><strong>Contract type</strong></p>';
        $output .= '<select style="width:50%;margin-bottom:5px;display:block;" name="job_employment">';
        $output .= '<option value="" >'.__("Select Type", "Katara").'</option>';
        foreach ( $regions as $key => $region ) {
        
            if ($job_employment == $region) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        
            $output .= '<option value="'.$region.'" '.$selected.'>'.$region_names[$key].'</a>';
        }
        $output .= '</select>';
        
        // ----- LEVEL ----- //
        
        $levels = array( 'executive', 'manager', 'supervisor', 'officer', 'admin' );
        $levels_names = array( __("Executive", "Katara") , __("Manager", "Katara"), __("Supervisor", "Katara"), __("Officer", "Katara"), __("Admin", "Katara") );
        
        $output .= '<p><strong>Level</strong></p>';
        $output .= '<select style="width:50%;margin-bottom:5px;display:block;" name="job_level">';
        $output .= '<option value="" >'.__("Select Level", "Katara").'</option>';
        foreach ( $levels as $key => $level ) {
        
            if ($job_level == $level) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        
            $output .= '<option value="'.$level.'" '.$selected.'>'.$levels_names[$key].'</a>';
        }
        $output .= '</select>';
        
        // POSITIONS ----------------------------------------------------------

        $output .= '<p><strong>Job(s)</strong></p>';
        $output .= '<input type="text" style="width:50%;" name="job_positions" value="'.$job_positions.'" />';
        
        // ----- EXPERIENCE ----- //
        
        $experiences = array( 0, 1, 3, 5, 10 );
        
        $output .= '<p><strong>Experience required (Years)</strong></p>';
        $output .= '<select style="width:50%;margin-bottom:5px;display:block;" name="job_experience">';
        $output .= '<option value="" >Select Experience</option>';
        foreach ( $experiences as $experience ) {
        
            if ($job_experience == $experience ) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        
            $output .= '<option value="'.$experience.'" '.$selected.'>'.$experience.'</a>';
        }
        $output .= '</select>';
        
        
        // Working Place ----------------------------------------------------------

        $output .= '<p><strong>Working place</strong></p>';
        $output .= '<input type="text" style="width:50%;" name="job_place" value="'.$job_place.'" />';
        
        // Job beginning on ----------------------------------------------------------

        $output .= '<p><strong>Job beginning on</strong></p>';
        $output .= '<input type="text" style="width:50%;" name="job_beginning" value="'.$job_beginning.'" />';
        
        // Creation date ----------------------------------------------------------

        $output .= '<p><strong>Creation date</strong></p>';
        $output .= '<input type="text" style="width:50%;" name="job_creation" value="'.$job_creation.'" />';
        
        // LOCATION -----------------------------------------------------------
        
        $locations = array(
           'egypt' => 'Egypt',
           'sharm-el-sheikh' => 'Sharm El Sheikh',
           'doha,-qatar' => 'Doha, Qatar',
           'mesaieed' => 'Mesaieed'
        );

        $location_names = array(
           'egypt' => __("Egypt", "Katara"),
           'sharm-el-sheikh' => __("Sharm El Sheikh", "Katara"),
           'doha,-qatar' => __("Doha, Qatar", "Katara"),
           'mesaieed' => __("Mesaieed", "Katara")
        );
        
        $output .= '<p><strong>Location</strong></p>';
        $output .= '<select style="width:50%;margin-bottom:5px;display:block;" name="job_location">';
        $output .= '<option value="" >Select Location</option>';
        foreach ( $locations as $key => $location ) {
            if ($job_location == $location) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        
            $output .= '<option value="'.$location.'" '.$selected.'>'.$location_names[$key].'</a>';
        }
        $output .= '</select>';
        
        // Department -----------------------------------------------------------
        
        $locations = array(
            'administration' => 'Administration',
            'business-development' => 'Business Development',
            'ceos-office' => 'CEO\'s Office',
            'chairmans-office' => 'Chairman\'s Office',
            'finance' => 'Finance',
            'human-resources' => 'Human Resources',
            'information-technology' => 'Information Technology',
            'internal-audit' => 'Internal Audit',
            'it' => 'IT',
            'legal' => 'Legal',
            'marketing' => 'Marketing',
            'operations' => 'Operation',
            'project-&-construction' => 'Project & Construction',
            'procurement' => 'Procurement',
            'various' => 'Various'
        );

        $department_names = array(
            'human-resources' => __( 'Human Resources', 'Katara' ),
            'procurement' => __( 'Procurement', 'Katara' ),
            'information-technology' => __( 'Information Technology', 'Katara' ),
            'business-development' => __( 'Business Development', 'Katara' ),
            'internal-audit' => __( 'Internal Audit', 'Katara' ),
            'legal' => __( 'Legal', 'Katara' ),
            'chairmans-office' => __( 'Chairman\'s Office', 'Katara' ),
            'ceos-office' => __( 'CEO\'s Office', 'Katara' ),
            'administration' => __("Administration", "Katara"),
            'finance' => __("Finance", "Katara"),
            'operations' => __("Operations", "Katara"),
            'it' => __("IT", "Katara"),
            'marketing' => __("Marketing", "Katara"),
            'project-&-construction' => __("Project & Construction", "Katara"),
            'various' => __("Various", "Katara")
        );
        
        $output .= '<p><strong>Department</strong></p>';
        $output .= '<select style="width:50%;margin-bottom:5px;display:block;" name="job_department">';
        $output .= '<option value="" >- Select Department - </option>';
        foreach ( $locations as $key => $location ) {
            if ($job_department == $key) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        
            $output .= '<option value="'.$key.'" '.$selected.'>'.$department_names[$key].'</a>';
        }
        $output .= '</select>';

        echo $output;
    }

    // ------------------------------------------------------------------------

    /**
     *
     * @uses    get_post_meta() WP function
     */
    function region_meta_box($post, $metabox)
    {
        $current_meta_value = get_post_meta($post->ID, 'hotel_region', true);

        $regions = array( 'middle-east', 'africa', 'asia', 'europe' );

        // ----- REGION ----- //
        $output = '<select style="width:100%;margin-bottom:5px;display:block;" name="hotelRegion">';
        foreach ( $regions as $region ) {
        
            if ($current_meta_value == 'region-'.$region) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        
            $output .= '<option value="region-'.$region.'" '.$selected.'>'.ucwords($region).'</a>';
        }
        $output .= '</select>';

        echo $output;
    }

    // ------------------------------------------------------------------------

    /**
     *
     * @uses    get_post_meta() WP function
     */
    function status_meta_box($post, $metabox)
    {
        $current_meta_value = get_post_meta($post->ID, 'hotel_status', true);

        $statuses = array( 'under-development', 'owned', 'operated' );

        // ----- REGION ----- //
        $output = '<select style="width:100%;margin-bottom:5px;display:block;" name="hotelStatus" class="adminFormSelect">';
        foreach ( $statuses as $status ) {
        
            if ($current_meta_value == 'status-'.$status) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        
            $output .= '<option value="status-'.$status.'" '.$selected.'>'.ucwords($status).'</a>';
        }
        $output .= '</select>';

        echo $output;
    }
    
    // ------------------------------------------------------------------------

    // ------------------------------------------------------------------------

    /**
     * Saves meta data
     *
     * @uses    delete_post_meta() WP function
     * @uses    add_post_meta() WP function
     * @uses    is_checked()
     */
    function save_meta_data_action()
    {
        if ( !(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) )
        {
            $meta_array = array();
            foreach ($_POST as $key => $value) {
                $post_id = $_POST['post_ID'];
                if ($key == 'pressHotels') {
                    $meta_value = implode(",", $_POST[$key]);
                    delete_post_meta($post_id, 'press_hotels');
                    add_post_meta($post_id, 'press_hotels', $meta_value, true);
                }

                if ($key == 'pressAssets') {
                    $meta_value = implode(",", $_POST[$key]);
                    delete_post_meta($post_id, 'press_asset');
                    add_post_meta($post_id, 'press_asset', $meta_value, true);
                }
            
                if ($key == 'hotelRegion') {
                    $meta_value = $_POST[$key];
                    delete_post_meta($post_id, 'hotel_region');
                    add_post_meta($post_id, 'hotel_region', $meta_value, true);
                }

                if ( $key == 'hotel_website_url' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'hotel_website_url' );
                    add_post_meta( $post_id, 'hotel_website_url', $meta_value, TRUE );
                }
                elseif ( $key == 'hotel_email' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'hotel_email' );
                    add_post_meta( $post_id, 'hotel_email', $meta_value, TRUE );
                }
                elseif ( $key == 'hotel_fax' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'hotel_fax' );
                    add_post_meta( $post_id, 'hotel_fax', $meta_value, TRUE );
                }
                elseif ( $key == 'hotel_phone' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'hotel_phone' );
                    add_post_meta( $post_id, 'hotel_phone', $meta_value, TRUE );
                }
                elseif ( $key == 'hotel_address' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'hotel_address' );
                    add_post_meta( $post_id, 'hotel_address', $meta_value, TRUE );
                }
                elseif ( $key == 'hotel_map' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'hotel_map' );
                    add_post_meta( $post_id, 'hotel_map', $meta_value, TRUE );
                }
                elseif ( $key == 'job_department' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'job_department' );
                    add_post_meta( $post_id, 'job_department', $meta_value, TRUE );
                }
                elseif ( $key == 'job_location' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'job_location' );
                    add_post_meta( $post_id, 'job_location', $meta_value, TRUE );
                }
                elseif ( $key == 'job_level' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'job_level' );
                    add_post_meta( $post_id, 'job_level', $meta_value, TRUE );
                }
                elseif ( $key == 'job_employment' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'job_employment' );
                    add_post_meta( $post_id, 'job_employment', $meta_value, TRUE );
                }
                elseif ( $key == 'job_reference' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'job_reference' );
                    add_post_meta( $post_id, 'job_reference', $meta_value, TRUE );
                }
                elseif ( $key == 'job_positions' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'job_positions' );
                    add_post_meta( $post_id, 'job_positions', $meta_value, TRUE );
                }
                elseif ( $key == 'job_experience' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'job_experience' );
                    add_post_meta( $post_id, 'job_experience', $meta_value, TRUE );
                }
                elseif ( $key == 'job_studies' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'job_studies' );
                    add_post_meta( $post_id, 'job_studies', $meta_value, TRUE );
                }
                elseif ( $key == 'job_place' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'job_place' );
                    add_post_meta( $post_id, 'job_place', $meta_value, TRUE );
                }
                elseif ( $key == 'job_creation' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'job_creation' );
                    add_post_meta( $post_id, 'job_creation', $meta_value, TRUE );
                }
                elseif ( $key == 'job_beginning' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'job_beginning' );
                    add_post_meta( $post_id, 'job_beginning', $meta_value, TRUE );
                }
                elseif ( $key == 'page_sub_title' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'page_sub_title' );
                    add_post_meta( $post_id, 'page_sub_title', $meta_value, TRUE );
                }
                elseif ( $key == 'hotel_reservations' )
                {
                    $meta_value = $_POST[$key];
                    delete_post_meta( $post_id, 'hotel_reservations' );
                    add_post_meta( $post_id, 'hotel_reservations', $meta_value, TRUE );
                }
                elseif ($key == 'hotelStatus') {
                    $meta_value = $_POST[$key];
                    delete_post_meta($post_id, 'hotel_status');
                    add_post_meta($post_id, 'hotel_status', $meta_value, true);
                }
                elseif ($key == 'hotel_sales') {
                    $meta_value = $_POST[$key];
                    delete_post_meta($post_id, 'hotel_sales');
                    add_post_meta($post_id, 'hotel_sales', $meta_value, true);
                }
                elseif ($key == 'hotel_sales_fax') {
                    $meta_value = $_POST[$key];
                    delete_post_meta($post_id, 'hotel_sales_fax');
                    add_post_meta($post_id, 'hotel_sales_fax', $meta_value, true);
                }
                
                
                //hotel_sales

                if ( ! isset( $_POST['pressHotels'] ) )
                {
                    delete_post_meta($post_id, 'press_hotels');
                }

                if ( ! isset( $_POST['pressAssets'] ) )
                {
                    delete_post_meta($post_id, 'press_asset');
                }
            }
        }
    }
    add_action( 'save_post', 'save_meta_data_action' );

    // ------------------------------------------------------------------------

    /**
     * gets the taxonomy assigned to the post_type
     *
     * @author  morphlondon <studio@morphlondon.com>
     * @global  WPDB class $wpdb
     * @param   string $post_type
     * @param   string $taxonomy
     * @return  object
     */
    function get_taxonomy_by_post_type( $post_type, $taxonomy, $only_parents = false )
    {
        global $wpdb;

        $parents = "";

        if($only_parents)
            $parents = "AND $wpdb->term_taxonomy.parent = 0";

        $sql = "SELECT DISTINCT $wpdb->terms.name, $wpdb->terms.slug, $wpdb->term_taxonomy.term_id, $wpdb->term_taxonomy.taxonomy, $wpdb->term_taxonomy.count
            FROM $wpdb->posts
            JOIN $wpdb->term_relationships ON $wpdb->term_relationships.object_id = $wpdb->posts.ID
            JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_taxonomy_id = $wpdb->term_relationships.term_taxonomy_id
            JOIN $wpdb->terms ON $wpdb->terms.term_id = $wpdb->term_taxonomy.term_id
            WHERE 1=1
            AND $wpdb->posts.post_type = '$post_type'
            AND $wpdb->term_taxonomy.taxonomy = '$taxonomy'
            $parents
            AND $wpdb->posts.post_status = 'publish'";

        $data = $wpdb->get_results( $sql, OBJECT );

        return $data;
    }

    // ------------------------------------------------------------------------

    /**
     * gets the date archive for post_type
     *
     * @author  morphlondon <studio@morphlondon.com>
     * @global  WPDB class $wpdb
     * @param   string $post_type
     * @param   int $limit
     * @return  object
     */
    function get_dates_by_post_type( $post_type, $limit = 10 )
    {
        global $wpdb;

        $datestr = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts
            FROM $wpdb->posts 
            WHERE post_type = '$post_type'
            AND post_status = 'publish'
            GROUP BY YEAR(post_date), MONTH(post_date)
            ORDER BY post_date DESC
            LIMIT $limit";

        $dates = $wpdb->get_results($datestr, OBJECT);

        return $dates;
    }

    // -------------------------------------------------------------------------

    /**
     * modifies queries to in include custom post types
     *
     * @author  morphlondon <studio@morphlondon.com>
     * @param   WP_Query class $query
     * @uses    is_month() WP function
     * @uses    is_category() WP function
     * @uses    is_tax() WP function
     * @return  WP_Query object
     */ 
    function query_post_type($query) {
        $query_pt = ( isset($_GET['pt']) ) ? $_GET['pt']: "";
        $post_type = ( isset($query->query_vars['post_type']) ) ? $query->query_vars['post_type']: "";
    
        if ( (is_month() || is_category() || is_tax('locations') ) && $post_type == '' && ( $query_pt == 'press_release' || $query_pt == 'tender'))
        {
            $query->set('post_type', $query_pt);
        }

        if ( $query->is_search )
        {
            $access_ids = get_access_pages();
            $query->set( 'post__not_in', $access_ids );
        }

        return $query;
    }
    add_filter('pre_get_posts', 'query_post_type');

    // -------------------------------------------------------------------------

    /**
     * modifies queries to in include custom post types
     */ 
    function get_access_pages()
    {
        global $wpdb;

        $data = array();

        $sql = "SELECT p.ID
            FROM $wpdb->posts AS p
            WHERE 1=1
            AND p.post_type = 'page'
            AND p.post_status = 'publish'
            AND p.post_parent = 0
            AND p.post_name = 'access'";
        $access_id = $wpdb->get_var( $sql );

        if ( $access_id !== NULL )
        {
            $data[] = $access_id;

            $sql = "SELECT p.ID
                FROM $wpdb->posts AS p
                WHERE 1=1
                AND p.post_type = 'page'
                AND p.post_status = 'publish'
                AND p.post_parent = '$access_id'";
            $requests = $wpdb->get_results( $sql );

            foreach( $requests as $request )
            {
                $data[] = $request->ID;
            }
        }

        return $data;
    }

    // ------------------------------------------------------------------------

    /**
     * Determines of the page is associated to Press Office or Tenders
     *
     * @author  morphlondon <studio@morphlondon.com>
     * @uses    is_singular() WP function
     * @return  bool|string
     */
    function is_press_office_or_tender()
    {
        if ( isset($_GET['pt']) && $_GET['pt'] == 'tender' )
        {
            return 'tender';
        }
        elseif ( isset($_GET['pt']) && $_GET['pt'] == 'press_release' )
        {
            return 'press_release';
        }
        elseif ( is_singular('press_release') )
        {
            return 'press_release';
        }
        elseif ( is_singular('tender') )
        {
            return 'tender';
        }
        else
        {
            return FALSE;
        }
    }

    // ----------------------------------------------------------------------------

    /**
     * Retrieves hotels and places them in an array
     */
    function get_hotels()
    {
        global $wpdb;
    
        $sql = "SELECT $wpdb->posts.ID, $wpdb->posts.post_title, $wpdb->postmeta.meta_value as region, $wpdb->terms.name as location
            FROM $wpdb->posts
            LEFT JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
            LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
            LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
            LEFT JOIN $wpdb->terms ON($wpdb->terms.term_id = $wpdb->term_taxonomy.term_id)
            WHERE 1=1
            AND $wpdb->term_taxonomy.parent = '0'
            AND $wpdb->term_taxonomy.taxonomy = 'locations'
            AND $wpdb->posts.post_status = 'publish'
            AND $wpdb->posts.post_type = 'hotels'
            AND $wpdb->postmeta.meta_key = 'hotel_region'
            ORDER BY $wpdb->posts.post_title ASC";
        $hotels = $wpdb->get_results( $sql, OBJECT );
    
        $data = array(
            'region-middle-east' => array(),
            'region-europe' => array(),
            'region-africa' => array(),
            'region-asia' => array()
        );
    
        foreach($hotels as $hotel)
        {
            $region = $hotel->region;
            $location = $hotel->location;
            $data[$region][$location][] = $hotel;
        }

        return $data;
    }

    // ------------------------------------------------------------------------

    function get_access_area( $access_area )
    {
        if ( $access_area == 1 )
        {
            return 'Press Office';
        }
        elseif ( $access_area == 2 )
        {
            return 'Careers';
        }
        elseif ( $access_area == 3 )
        {
            return 'Tenders';
        }
        else
        {
            return 'Not set.';
        }
    }

    // ------------------------------------------------------------------------
    
    function fake_excerpt( $post_content, $lenth = 406, $echo = TRUE )
    {
        $post_content = strip_tags( $post_content );

        if ( strlen( $post_content ) > $lenth )
        {
            $post_content = trim( substr( $post_content, 0, ( $lenth - 3 ) ) )."...";
        }
        
        if ( $echo )
        {
            echo apply_filters( 'the_content', $post_content );
        }
        else
        {
            return apply_filters( 'the_content', $post_content );
        }
    }

    // ------------------------------------------------------------------------
    
    function custom_excerpt_length( $length )
    {
        return 15;
    }
    add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
    
    function new_excerpt_more( $more )
    {
        return '...';
    }
    add_filter('excerpt_more', 'new_excerpt_more');
    
    // ------------------------------------------------------------------------
    
    function get_iframe_src( $html )
    {
        preg_match('/(src)=("[^"]*")/i', $html, $matches);
        
        if ( isset( $matches[2] ) )
        {
            return trim( $matches[2], '"' );
        }
        else
        {
            return '';
        }
    }

    // ------------------------------------------------------------------------

    function get_business_areas_by_slug( $slugs = array() )
    {
        if ( empty( $slugs ) )
            return array();

        global $wpdb;

        $about_us_id = get_page_id_from_path( '/about-us' );
        $company_profile_id = get_page_id_from_path( '/about-us/company-profile' );
        $our_values_id = get_page_id_from_path( '/about-us/our-values' );
        
        $post_names = array();
        foreach ( $slugs as $post_name )
        {
            $post_names[] = "$wpdb->posts.post_name = '".$post_name."'";
        }
        
        $post_names_sql = implode( ' OR ', $post_names);
        

        $sql = "SELECT $wpdb->posts.ID, $wpdb->posts.post_title, $wpdb->posts.post_content
            FROM $wpdb->posts
            WHERE 1=1
            AND $wpdb->posts.post_type = 'page'
            AND $wpdb->posts.post_status = 'publish'
            AND $wpdb->posts.post_parent = '$about_us_id'
            AND ( $post_names_sql )";
        $business_areas = $wpdb->get_results( $sql );
        
        return $business_areas;
    }
    
    // -------------------------------------------------------------------------
    
    function get_archive_type()
    {
        $object = get_queried_object();
        
        if ( isset( $object->name ) )
        {
            return $object->name;
        }
        elseif ( isset( $_GET['pt'] ) )
        {
            return $_GET['pt'];
        }
        else
        {
            return '';
        }
    }

    // -------------------------------------------------------------------------

    function get_business_areas_widget()
    {
        get_template_part( 'modules/widget-business-areas' );
    }

    // -------------------------------------------------------------------------

    function get_press_assets()
    {
 