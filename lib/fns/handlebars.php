<?php

/**
 * Renders a handlebars template from lib/templates.
 *
 * Checks to see if the .hbs template inside lib/templates has a timestamp
 * newer than the corresponding template inside lib/tempaltes/compiled. If
 * the .hbs file is newer, the function regenerates the compiled version
 * of the template from the .hbs.
 *
 * @since 3.0.6
 *
 * @param      string           $filename  The template filename
 * @param      array            $data      The data which will populate the template
 *
 * @return     string|boolean   The rendered HTML.
 */
function chalkagency_hbs_render_template( $filename = '', $data = [] ){
  if( empty( $filename ) )
    return false;

  // Remove file extension
  $extensions = ['.hbs', '.htm', '.html'];
  $filename = str_replace( $extensions, '', $filename );

  $compile = false;

  $plugin_template = plugin_dir_path( __FILE__ ) . '../templates/' . $filename . '.hbs';
  $plugin_template_compiled = plugin_dir_path( __FILE__ ) . '../templates/compiled/' . $filename . '.php';

  if( file_exists( $plugin_template ) ){
    if( ! file_exists( $plugin_template_compiled ) ){
      $compile = true;
    } else if( filemtime( $plugin_template ) > filemtime( $plugin_template_compiled ) ){
      $compile = true;
    }

    $template = $plugin_template;
    $template_compiled = $plugin_template_compiled;
  } else if( ! file_exists( $plugin_template ) ){
    return false;
  }

  $template = [
    'filename' => $template,
    'filename_compiled' => $template_compiled,
    'compile' => $compile,
  ];

  if( ! file_exists( dirname( $template['filename_compiled'] ) ) )
    \wp_mkdir_p( dirname( $template['filename_compiled'] ) );

  if( 'true' == $template['compile'] ){
    $hbs_template = file_get_contents( $template['filename'] );
    $phpStr = \LightnCandy\LightnCandy::compile( $hbs_template, [
      'flags' => \LightnCandy\LightnCandy::FLAG_SPVARS | \LightnCandy\LightnCandy::FLAG_PARENT | \LightnCandy\LightnCandy::FLAG_NAMEDARG | \LightnCandy\LightnCandy::FLAG_ELSE,
      'helpers' => [
        'if_even' => function( $number, $options ){
          return ($number % 2 == 0)? $options['fn']() : $options['inverse']() ;
        },
      ],
    ] );
    if ( ! is_writable( dirname( $template['filename_compiled'] ) ) )
      \wp_die( 'I can not write to the directory.' );
    file_put_contents( $template['filename_compiled'], '<?php' . "\n" . $phpStr . "\n" . '?>' );
  }

  if( ! file_exists( $template['filename_compiled'] ) )
    return false;

  $renderer = include( $template['filename_compiled'] );

  return $renderer( $data );
}

/**
 * Checks if template file exists.
 *
 * @since 3.0.6
 *
 * @param  string $filename Filename of the template to check for.
 * @return bool             Returns TRUE if template file exists.
 */
function chalkagency_hbs_template_exists( $filename = '' ){
  if( empty( $filename ) )
    return false;

  // Remove file extension
  $extensions = ['.hbs', '.htm', '.html'];
  $filename = str_replace( $extensions, '', $filename );

  $plugin_template = trailingslashit( DONMAN_DIR ) . 'lib/templates/' . $filename . '.hbs';

  if( file_exists( $plugin_template ) ){
    return true;
  } else if( ! file_exists( $plugin_template ) ){
    return false;
  }
}
