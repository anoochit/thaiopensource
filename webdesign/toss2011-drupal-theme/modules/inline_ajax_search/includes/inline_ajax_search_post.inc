<?php
// $Id: inline_ajax_search_post.inc,v 1.1.2.5 2010/03/23 11:37:24 fabianderijk Exp $
/**
 * @file
 * The file that redirects to the correct search page
 */
function _inline_ajax_search_post() {
  if (module_exists('luceneapi') && module_exists('luceneapi_node') && variable_get('inline_ajax_use_lucene', 0) == 1 && variable_get('inline_ajax_use_lucene_on_enter', 0) == 0) {
    $p = 'search/luceneapi_node/' . inline_ajax_search_string_format($_POST['inline_ajax_search']);
  }
    else {
      $p = 'search/node/' . $_POST['inline_ajax_search'];
    }
  drupal_goto($p);
}