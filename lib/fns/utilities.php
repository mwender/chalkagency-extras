<?php

namespace chalkagency\utilities;

/**
 * Returns an HTML alert message
 *
 * @param      array  $atts {
 *   @type  string  $type         The alert type can info, warning, success, or danger (defaults to `warning`).
 *   @type  string  $title        The title of the alert.
 *   @type  string  $description  The content of the alert.
 *   @type  string  $css_classes  Additional CSS classes to add to the alert parent <div>.
 * }
 *
 * @return     html  The alert.
 */
function get_alert( $atts ){
  $args = shortcode_atts([
   'type'        => 'warning',
   'title'       => null,
   'description' => 'Alert description goes here.',
   'css_classes' => null,
  ], $atts );

  $data = [
    'type'        => strtolower($args['type']),
    'title'       => $args['title'],
    'description' => $args['description'],
    'css_classes' => $args['css_classes'],
  ];

  if( ! in_array( $data['type'], [ 'info','warning','success','danger' ] ) )
    $data['description'].= '<br/><br/>NOTE: You passed an invalid alert <code>type</code>. Please use either <code>info</code>, <code>warning</code>, <code>success</code>, or <code>danger</code>.';

  $html = chalkagency_hbs_render_template( 'alert', $data );
  return $html;
}