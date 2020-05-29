<?php
/*
Plugin Name: Test for Elementor
Description: Test for Elementor allows to WP Cute
Author: KhongCanSua
Author URI: ---
Version: 1.0
Text Domain: sba-widgets
Domain Path: /languages
License: GNU General Public License v3.0
*/

if (!defined('ABSPATH'))
  exit;

final class SlideMenu_Widgets
{

  const VERSION = '1.0.0';
  const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
  const MINIMUM_PHP_VERSION = '5.2';


  public function __construct()
  {
    add_action('init', array(
      $this,
      'i18n'
    ));
    add_action('plugins_loaded', array(
      $this,
      'init'
    ));
    define('URL_PLUGIN_TEST_ELEMENTOR', plugins_url('/', __FILE__));
  }

  public function i18n()
  {
    load_plugin_textdomain('sba-widgets', false, basename(dirname(__FILE__)) . '/languages');
  }

  public function init()
  {
    if (!did_action('elementor/loaded')) {
      add_action('admin_notices', array(
        $this,
        'admin_notice_missing_main_plugin'
      ));
      return;
    }

    if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
      add_action('admin_notices', array(
        $this,
        'admin_notice_minimum_elementor_version'
      ));
      return;
    }

    if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
      add_action('admin_notices', array(
        $this,
        'admin_notice_minimum_php_version'
      ));
      return;
    }
    require_once('plugin.php');

    add_action( 'elementor/elements/categories_registered', function () {

      $elementsManager = \Elementor\Plugin::instance()->elements_manager;

      $elementsManager->add_category(
        'SlideMenu_Widgets',
        array(
          'title' => 'TEST',
          'icon'  => 'fonts',
        )
      );
    } );
  }

  public function admin_notice_missing_main_plugin()
  {
    if (isset($_GET['activate'])) {
      unset($_GET['activate']);
    }

    $message = sprintf(('"%1$s" requires "%2$s" to be installed and activated.'), '<strong>' . esc_attr('Test for Elementor', 'sba-widgets') . '</strong>', '<strong>' . esc_attr('Elementor', 'sba-widgets') . '</strong>');

    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
  }

  public function admin_notice_minimum_elementor_version()
  {
    if (isset($_GET['activate'])) {
      unset($_GET['activate']);
    }

    $message = sprintf(('"%1$s" requires "%2$s" version %3$s or greater.'), '<strong>' . esc_attr('Test for Elementor', 'sba-widgets') . '</strong>', '<strong>' . esc_attr('Elementor', 'sba-widgets') . '</strong>', self::MINIMUM_ELEMENTOR_VERSION);

    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
  }

  public function admin_notice_minimum_php_version()
  {
    if (isset($_GET['activate'])) {
      unset($_GET['activate']);
    }

    $message = sprintf(('"%1$s" requires "%2$s" version %3$s or greater.'), '<strong>' . esc_attr('Test for Elementor', 'sba-widgets') . '</strong>', '<strong>' . esc_attr('PHP', 'sba-widgets') . '</strong>', self::MINIMUM_PHP_VERSION);
    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
  }
}

new SlideMenu_Widgets();