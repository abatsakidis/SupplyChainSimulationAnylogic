<?php 

class ShortcodeHelpers 
{
  function __construct () {
    global $_LV_SHORTCODE ;
    $_LV_SHORTCODE = array();
  }

  
  static function run($content) {
    global $_LV_SHORTCODE;
    
    $pattern = self::getTags();
    
    if ((!preg_match_all( "/$pattern/Usi", $content ))){
      return $content;
    }
    
    return preg_replace_callback( "/$pattern/s", array( 'ShortcodeHelpers' ,'runTag'), $content );
    
  }
  
  static function runTag($m) {
    global $_LV_SHORTCODE;
    
    // allow [[foo]] syntax for escaping a tag
    if ( $m[1] == '[' && $m[6] == ']' ) {
      return substr($m[0], 1, -1);
    }

    $tag = $m[2];
    $attr = self::parseAtts( $m[3] );
    
    if( preg_match( '/^@/',$tag )){
      $tag = substr($tag,1);
      return $m[1] . call_user_func( $tag , $attr , $m[5] );
    }

    if ( isset( $m[5] ) ) {
      // enclosing tag - extra parameter
      return $m[1] . call_user_func( $_LV_SHORTCODE[$tag], $attr, $m[5], $tag ) . $m[6];
    } else {
      // self-closing tag
      return $m[1] . call_user_func( $_LV_SHORTCODE[$tag], $attr, null,  $tag ) . $m[6];
    }
    
    
  }
  
  private static function parseAtts($text) {
    $atts = array();
    $pattern = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
    $text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text);
    if ( preg_match_all($pattern, $text, $match, PREG_SET_ORDER) ) {
      foreach ($match as $m) {
        if (!empty($m[1]))
          $atts[strtolower($m[1])] = stripcslashes($m[2]);
        elseif (!empty($m[3]))
          $atts[strtolower($m[3])] = stripcslashes($m[4]);
        elseif (!empty($m[5]))
          $atts[strtolower($m[5])] = stripcslashes($m[6]);
        elseif (isset($m[7]) and strlen($m[7]))
          $atts[] = stripcslashes($m[7]);
        elseif (isset($m[8]))
          $atts[] = stripcslashes($m[8]);
      }
    } else {
      $atts = ltrim($text);
    }
    return $atts;
  
  }
  
  static function mergeAtts($pairs, $atts) {
    $atts = (array)$atts;
    $res = array();
    foreach($pairs as $name => $default) {
      if ( array_key_exists($name, $atts) )
        $res[$name] = $atts[$name];
      else
        $res[$name] = $default;
    }
    return $res;
    
  }
  
  private static function getTags() {
    global $_LV_SHORTCODE;
    
    if( count( $_LV_SHORTCODE  )){
      $tagnames = array_keys($_LV_SHORTCODE);
      $tagregexp = join( '|', array_map('preg_quote', $tagnames) ).'|';
    } else {
      $tagregexp = '';
    }
    $tagregexp .= '\@[\w\_\:]+';
    
    return "\[(\[?)({$tagregexp})(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)";
    
  }
  
}



