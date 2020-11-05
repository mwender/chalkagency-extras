<?php

namespace chalkagency\shortcodes;
use function chalkagency\utilities\{get_alert};

function display_postblocks( $atts ){
  $args = shortcode_atts( [
    'numberposts' => 5,
    'post_type'   => 'post',
  ], $atts );

  $query_args = [
    'post_type'   => $args['post_type'],
    'numberposts' => $args['numberposts'],
    'orderby'     => 'date',
    'order'       => 'DESC',
  ];

  if( ! post_type_exists( $args['post_type'] ) )
    return get_alert([
      'title' => '`<code>' . $args['post_type'] . '</code>` CPT Not Found!',
      'description' => 'I could not find a custom post_type called <code>' . $args['post_type'] . '</code>. Check the WP Admin and adjust the <code>post_type</code> attribute appropriately.',
      'type' => 'danger'
    ]);

  $posts = get_posts( $query_args );

  if( ! $posts )
    return get_alert([
      'title' => 'No `<code>' . $args['post_type'] . '</code>` Found!',
      'description' => 'Please add some <code>' . $args['post_type'] . '</code> posts to display here.',
      'type' => 'danger'
    ]);

  $x = 0;
  foreach( $posts as $post ){
    setup_postdata( $post );

    $data['posts'][$x] = [
      'post_content'  => apply_filters( 'the_content', get_the_content() ),
      'post_title'    => get_the_title( $post->ID ),
      'thumbnail_url' => get_the_post_thumbnail_url( $post->ID, 'large' ),
    ];

    $background_color = get_post_meta( $post->ID, 'background_color', true );
    $background_color = ( $background_color )? $background_color : '#eee' ;
    $data['posts'][$x]['background_color'] = $background_color;

    $font_color = get_post_meta( $post->ID, 'font_color', true );
    $font_color = ( $font_color )? $font_color : '#000' ;
    $data['posts'][$x]['font_color'] = $font_color;

    if( is_user_logged_in() ){
      $edit_link = get_edit_post_link( $post->ID, 'edit' );
      $data['posts'][$x]['edit_link'] = $edit_link;
    }

    $x++;
  }

  $html = chalkagency_hbs_render_template( 'postblocks', $data );
  return $html;
}
add_shortcode( 'postblocks', __NAMESPACE__ . '\\display_postblocks' );