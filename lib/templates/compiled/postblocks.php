<?php
use \LightnCandy\SafeString as SafeString;use \LightnCandy\Runtime as LR;return function ($in = null, $options = null) {
    $helpers = array(            'if_even' => function( $number, $options ){
          return ($number % 2 == 0)? $options['fn']() : $options['inverse']() ;
        },
);
    $partials = array();
    $cx = array(
        'flags' => array(
            'jstrue' => false,
            'jsobj' => false,
            'jslen' => false,
            'spvar' => true,
            'prop' => false,
            'method' => false,
            'lambda' => false,
            'mustlok' => false,
            'mustlam' => false,
            'mustsec' => false,
            'echo' => false,
            'partnc' => false,
            'knohlp' => false,
            'debug' => isset($options['debug']) ? $options['debug'] : 1,
        ),
        'constants' => array(),
        'helpers' => isset($options['helpers']) ? array_merge($helpers, $options['helpers']) : $helpers,
        'partials' => isset($options['partials']) ? array_merge($partials, $options['partials']) : $partials,
        'scopes' => array(),
        'sp_vars' => isset($options['data']) ? array_merge(array('root' => $in), $options['data']) : array('root' => $in),
        'blparam' => array(),
        'partialid' => 0,
        'runtime' => '\LightnCandy\Runtime',
    );
    
    $inary=is_array($in);
    return '<div class="postblocks">
'.LR::sec($cx, (($inary && isset($in['posts'])) ? $in['posts'] : null), null, $in, true, function($cx, $in) {$inary=is_array($in);return ''.((LR::ifvar($cx, (($inary && isset($in['font_color'])) ? $in['font_color'] : null), false)) ? '    <style type="text/css">
    #row-'.htmlspecialchars((string)(isset($cx['sp_vars']['index']) ? $cx['sp_vars']['index'] : null), ENT_QUOTES, 'UTF-8').' h2.post-title,
    #row-'.htmlspecialchars((string)(isset($cx['sp_vars']['index']) ? $cx['sp_vars']['index'] : null), ENT_QUOTES, 'UTF-8').' .post-content{
      color: '.htmlspecialchars((string)(($inary && isset($in['font_color'])) ? $in['font_color'] : null), ENT_QUOTES, 'UTF-8').';
    }
    </style>
' : '').''.LR::hbbch($cx, 'if_even', array(array((isset($cx['sp_vars']['index']) ? $cx['sp_vars']['index'] : null)),array()), $in, false, function($cx, $in) {$inary=is_array($in);return '    <div class="row" id="row-'.htmlspecialchars((string)(isset($cx['sp_vars']['index']) ? $cx['sp_vars']['index'] : null), ENT_QUOTES, 'UTF-8').'">
      <div class="col-sm" style="'.((LR::ifvar($cx, (($inary && isset($in['background_color'])) ? $in['background_color'] : null), false)) ? 'background-color: '.htmlspecialchars((string)(($inary && isset($in['background_color'])) ? $in['background_color'] : null), ENT_QUOTES, 'UTF-8').';' : '').'">
        <div class="box">
          <h2 class="post-title">'.(($inary && isset($in['post_title'])) ? $in['post_title'] : null).'</h2>
          <div class="post-content">
            '.(($inary && isset($in['post_content'])) ? $in['post_content'] : null).'
          </div>
        </div>
      </div>
      <div class="col-sm featured-image right" style="background-image: url('.htmlspecialchars((string)(($inary && isset($in['thumbnail_url'])) ? $in['thumbnail_url'] : null), ENT_QUOTES, 'UTF-8').');">
        <div class="box">
          '.((LR::ifvar($cx, (($inary && isset($in['edit_link'])) ? $in['edit_link'] : null), false)) ? '<a class="edit" href="'.htmlspecialchars((string)(($inary && isset($in['edit_link'])) ? $in['edit_link'] : null), ENT_QUOTES, 'UTF-8').'">Edit</a>' : '').'
        </div>
      </div>
    </div>
';}, function($cx, $in) {$inary=is_array($in);return '    <div class="row" id="row-'.htmlspecialchars((string)(isset($cx['sp_vars']['index']) ? $cx['sp_vars']['index'] : null), ENT_QUOTES, 'UTF-8').'">
      <div class="col-sm featured-image left" style="background-image: url('.htmlspecialchars((string)(($inary && isset($in['thumbnail_url'])) ? $in['thumbnail_url'] : null), ENT_QUOTES, 'UTF-8').');">
        <div class="box">
          '.((LR::ifvar($cx, (($inary && isset($in['edit_link'])) ? $in['edit_link'] : null), false)) ? '<a class="edit" href="'.htmlspecialchars((string)(($inary && isset($in['edit_link'])) ? $in['edit_link'] : null), ENT_QUOTES, 'UTF-8').'">Edit</a>' : '').'
        </div>
      </div>
      <div class="col-sm" style="'.((LR::ifvar($cx, (($inary && isset($in['background_color'])) ? $in['background_color'] : null), false)) ? 'background-color: '.htmlspecialchars((string)(($inary && isset($in['background_color'])) ? $in['background_color'] : null), ENT_QUOTES, 'UTF-8').';' : '').'">
        <div class="box">
          <h2 class="post-title">'.(($inary && isset($in['post_title'])) ? $in['post_title'] : null).'</h2>
          <div class="post-content">
            '.(($inary && isset($in['post_content'])) ? $in['post_content'] : null).'
          </div>
        </div>
      </div>
    </div>
';}).'';}).'</div>';
};
?>