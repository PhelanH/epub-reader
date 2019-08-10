<?php
/**
 * Register all actions and filters for the plugin
 *
 * @link       https://github.com/PhelanH/epub-reader/
 * @since      0.9.0
 *
 * @package    Epub_Reader
 * @subpackage Epub_Reader/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      0.9.0
 * @package    Epub_Reader
 * @subpackage Epub_Reader/includes
 * @author     phelanh <phelanh@users.noreply.github.com>
 */
class Epub_Reader_PostType {
	
	public function init($loader) { //$loader is EPub_Reader_Loader
		//$loader->add_action( 'init', $this, 'register_post_type' );
		//$loader->add_filter( 'default_content', $this, 'set_default_content', 10, 2 );
		//$loader->add_filter( 'single_template', $this, 'filter_page_template');
		//$loader->add_filter( 'page_template', $this, 'filter_page_template' );
		$loader->add_filter( 'upload_mimes', $this, 'phelanh_custom_myme_types' );
		$loader->add_filter( 'upload_mimes', $this, 'phelanh_upload_mimes' );
		$loader->add_filter( 'upload_mimes', $this, 'phelanh_custom_mime_types' );
	}
	/**
	 * Allow Upload of Epub and Mobi files
	 *
	 * @since    1.0.0
	 */	
	function phelanh_custom_myme_types($mime_types){
		$mime_types['epub'] = 'application/octet-stream'; 
		return $mime_types;
	}
	
	function phelanh_upload_mimes($mimes) {
		$mimes = array_merge($mimes, array(
			'epub|mobi' => 'application/octet-stream'
		));
		return $mimes;
	}	
	
	function phelanh_custom_mime_types($mimes){
		$new_file_types = array (
			'zip' => 'application/zip',
			'mobi' => 'application/x-mobipocket-ebook',
			'epub' => 'application/epub+zip'
		);
		return array_merge($mimes,$new_file_types);
	}

	public function register_post_type() {

		$args = array (
			'label' => esc_html__( 'ePub Reader Pages', 'text-domain' ),
			'labels' => array(
				'menu_name' => esc_html__( 'ePub Reader Pages', 'text-domain' ),
				'name_admin_bar' => esc_html__( 'ePub Reader Page', 'text-domain' ),
				'add_new' => esc_html__( 'Add new', 'text-domain' ),
				'add_new_item' => esc_html__( 'Add new ePub Reader Page', 'text-domain' ),
				'new_item' => esc_html__( 'New ePub Reader Page', 'text-domain' ),
				'edit_item' => esc_html__( 'Edit ePub Reader Page', 'text-domain' ),
				'view_item' => esc_html__( 'View ePub Reader Page', 'text-domain' ),
				'update_item' => esc_html__( 'Update ePub Reader Page', 'text-domain' ),
				'all_items' => esc_html__( 'All ePub Reader Pages', 'text-domain' ),
				'search_items' => esc_html__( 'Search ePub Reader Pages', 'text-domain' ),
				'parent_item_colon' => esc_html__( 'Parent ePub Reader Page', 'text-domain' ),
				'not_found' => esc_html__( 'No ePub Reader Pages found', 'text-domain' ),
				'not_found_in_trash' => esc_html__( 'No ePub Reader Pages found in Trash', 'text-domain' ),
				'name' => esc_html__( 'ePub Reader Pages', 'text-domain' ),
				'singular_name' => esc_html__( 'ePub Reader Page', 'text-domain' ),
			),
			'public' => true,
			'description' => 'Pages for an epub reader',
			'exclude_from_search' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'show_in_menu' => true,
			'show_in_admin_bar' => false,
			'show_in_rest' => false,
			'menu_position' => 11,
			'menu_icon' => 'dashicons-book-alt',
			'capability_type' => 'post',
			'hierarchical' => false,
			'has_archive' => false,
			'query_var' => true,
			'can_export' => true,
			'rewrite_slug' => 'ebook',
			'rewrite_no_front' => true,
			'supports' => array(
				'title',
				'editor',
				//'custom-fields',
				'page-attributes',
			),
			'rewrite' => array(
				'slug' => 'ebook',
				'with_front' => false,
				'feeds' => true
			),
		);

		register_post_type( EPUB_READER_POSTTYPE, $args );
	}

	public function set_default_content($content, $post) { // from https://wordpress.stackexchange.com/a/26028
		if ($post->post_type == EPUB_READER_POSTTYPE)
			$content = '['.EPUB_READER_SHORTCODE.' src="/path/to/ebook/" width="100%" height="100%"]';

	    return $content;
	}


	/**
	 * Watch for our post_type & choose our page template (or use a global custom one if defined).
	 *
	 * @since    0.9.0
	 */
	public function filter_page_template( $page_template )
	{
		global $post;

     	if ($post->post_type == EPUB_READER_POSTTYPE ) {
	   	
			$single_postType_template = locate_template("single-epub-reader-page.php");
			if( file_exists( $single_postType_template ) )
			{
				return $single_postType_template;
			} 
			else 
			{
		        $page_template = dirname( __FILE__ ) . '/../public/views/epub-reader-template.php';
			}

	    }
	    return $page_template;
	}

}

