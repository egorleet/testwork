<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.redux.io/
 *
 * @package Redux Framework
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
  return;
}

// This is your option name where all the Redux data is stored.
$opt_name = 'test_opt';  // YOU MUST CHANGE THIS.  DO NOT USE 'test_opt' IN YOUR PROJECT!!!

// Uncomment to disable demo mode.
Redux::disable_demo();

$dir = dirname( __FILE__ ) . '/';

/*
 * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
 */

$sample_html = '';
if ( file_exists( $dir . '/info-html.html' ) ) {
  $fs = Redux_Filesystem::get_instance();
  if ( method_exists( $fs, 'get_contents' ) ) {
    $sample_html = $fs->execute( 'get_contents', $dir . '/info-html.html' );
  }
}

// Background Patterns Reader.
$sample_patterns_path = Redux_Core::$dir . '../sample/patterns/';
$sample_patterns_url  = Redux_Core::$url . '../sample/patterns/';
$sample_patterns      = array();

if ( is_dir( $sample_patterns_path ) ) {
  $sample_patterns_dir = opendir( $sample_patterns_path );

  if ( $sample_patterns_dir ) {
    $sample_patterns = array();

    // phpcs:ignore WordPress.CodeAnalysis.AssignmentInCondition
    while ( false !== ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) ) {
      if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
        $name              = explode( '.', $sample_patterns_file );
        $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
        $sample_patterns[] = array(
          'alt' => $name,
          'img' => $sample_patterns_url . $sample_patterns_file,
        );
      }
    }
  }
}

// Used to execept HTML tags in description arguments where esc_html would remove.
$kses_exceptions = array(
  'a'      => array(
    'href' => array(),
  ),
  'strong' => array(),
  'br'     => array(),
  'code'   => array(),
);

/*
 * ---> BEGIN ARGUMENTS
 */

/**
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://docs.redux.io/core/arguments/
 */
$theme = wp_get_theme(); // For use with some settings. Not necessary.

// TYPICAL -> Change these values as you need/desire.
$args = array(
  // This is where your data is stored in the database and also becomes your global variable name.
  'opt_name'                  => $opt_name,

  // Name that appears at the top of your panel.
  'display_name'              => $theme->get( 'Name' ),

  // Version that appears at the top of your panel.
  'display_version'           => $theme->get( 'Version' ),

  // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only).
  'menu_type'                 => 'menu',

  // Show the sections below the admin menu item or not.
  'allow_sub_menu'            => true,

  // The text to appear in the admin menu.
  'menu_title'                => esc_html__( 'Sample Options', 'testloc' ),

  // The text to appear on the page title.
  'page_title'                => esc_html__( 'Sample Options', 'testloc' ),

  // Enabled the Webfonts typography module to use asynchronous fonts.
  'async_typography'          => true,

  // Disable to create your own google fonts loader.
  'disable_google_fonts_link' => false,

  // Show the panel pages on the admin bar.
  'admin_bar'                 => true,

  // Icon for the admin bar menu.
  'admin_bar_icon'            => 'dashicons-portfolio',

  // Priority for the admin bar menu.
  'admin_bar_priority'        => 50,

  // Sets a different name for your global variable other than the opt_name.
  'global_variable'           => '',

  // Show the time the page took to load, etc (forced on while on localhost or when WP_DEBUG is enabled).
  'dev_mode'                  => true,

  // Enable basic customizer support.
  'customizer'                => true,

  // Allow the panel to opened expanded.
  'open_expanded'             => false,

  // Disable the save warning when a user changes a field.
  'disable_save_warn'         => false,

  // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
  'page_priority'             => null,

  // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters.
  'page_parent'               => 'themes.php',

  // Permissions needed to access the options panel.
  'page_permissions'          => 'manage_options',

  // Specify a custom URL to an icon.
  'menu_icon'                 => '',

  // Force your panel to always open to a specific tab (by id).
  'last_tab'                  => '',

  // Icon displayed in the admin panel next to your menu_title.
  'page_icon'                 => 'icon-themes',

  // Page slug used to denote the panel, will be based off page title, then menu title, then opt_name if not provided.
  'page_slug'                 => $opt_name,

  // On load save the defaults to DB before user clicks save.
  'save_defaults'             => true,

  // Display the default value next to each field when not set to the default value.
  'default_show'              => false,

  // What to print by the field's title if the value shown is default.
  'default_mark'              => '*',

  // Shows the Import/Export panel when not used as a field.
  'show_import_export'        => true,

  // The time transinets will expire when the 'database' arg is set.
  'transient_time'            => 60 * MINUTE_IN_SECONDS,

  // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output.
  'output'                    => true,

  // Allows dynamic CSS to be generated for customizer and google fonts,
  // but stops the dynamic CSS from going to the page head.
  'output_tag'                => true,

  // Disable the footer credit of Redux. Please leave if you can help it.
  'footer_credit'             => '',

  // If you prefer not to use the CDN for ACE Editor.
  // You may download the Redux Vendor Support plugin to run locally or embed it in your code.
  'use_cdn'                   => true,

  // Set the theme of the option panel.  Use 'wp' to use a more modern style, default is classic.
  'admin_theme'               => 'wp',

  // HINTS.
  'hints'                     => array(
    'icon'          => 'el el-question-sign',
    'icon_position' => 'right',
    'icon_color'    => 'lightgray',
    'icon_size'     => 'normal',
    'tip_style'     => array(
      'color'   => 'red',
      'shadow'  => true,
      'rounded' => false,
      'style'   => '',
    ),
    'tip_position'  => array(
      'my' => 'top left',
      'at' => 'bottom right',
    ),
    'tip_effect'    => array(
      'show' => array(
        'effect'   => 'slide',
        'duration' => '500',
        'event'    => 'mouseover',
      ),
      'hide' => array(
        'effect'   => 'slide',
        'duration' => '500',
        'event'    => 'click mouseleave',
      ),
    ),
  ),

  // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
  // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
  'database'                  => '',
  'network_admin'             => true,
);

Redux::set_args( $opt_name, $args );

Redux::set_section(
  $opt_name,
  array(
    'title' => esc_html__( 'Цвета', 'testloc' ),
    'id'    => 'color',
    'icon'  => 'el el-brush',
  )
);

Redux::set_section(
  $opt_name,
  array(
    'title'      => esc_html__( 'Фон сайта и цвет текста', 'testloc' ),
    'id'         => 'opt-color',
    'subsection' => true,
    'fields'     => array(
      array(
        'id'          => 'opt-color',
        'type'        => 'color',
        'output'      => array(
          'color'            => 'body, .entry-title a, :root .has-primary-color, .site-title , h1.entry-title, h2.entry-title, h2.widget-title',
        ),
        'title'       => esc_html__( 'Цвет текста', 'testloc' ),
        'subtitle'    => esc_html__( 'По-умолчанию, #000', 'testloc' ),
        'default'     => '#000000',
        'color_alpha' => true,
      ),
      array(
        'id'       => 'opt-color-footer',
        'type'     => 'color',
        'title'    => esc_html__( 'Фон сайта', 'testloc' ),
        'subtitle' => esc_html__( 'По-умолчанию, #f5efe0', 'testloc' ),
        'default'  => '#f5efe0',
        'validate' => 'color',
        'output'      => array(
          'background'            => 'body',
        ),
      ),
    ),
  )
);
