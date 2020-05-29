<?php

namespace Test_Widgets\Widgets;

use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Test extends Widget_Base
{
  public function get_name()
  {
    return 'Test';
  }

  public function get_title()
  {
    return esc_html__('Test', 'sba-widgets');
  }

  public function get_icon()
  {
    return 'eicon-button';
  }

  public function get_categories()
  {
    return ['test_widgets'];
  }

  public function get_script_depends()
  {
    return ['sba_widgets_script'];
  }

  public function get_style_depends()
  {
    return ['font-awesome', 'sba_widgets_style'];
  }

  protected function _register_controls() {}

  protected function render($instance = []) {}
}