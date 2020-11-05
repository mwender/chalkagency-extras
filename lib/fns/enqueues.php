<?php

namespace chalkagency\enqueues;

function enqueue_scripts(){
  // Our custom styles
  wp_enqueue_style( 'nccagent-styles', plugin_dir_url( __FILE__ ) . '../' . CHALK_CSS_DIR . '/main.css', ['hello-elementor','elementor-frontend'], filemtime( plugin_dir_path( __FILE__ ) . '../' . CHALK_CSS_DIR . '/main.css' ) );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts', 99 );