<?php
// $Id: inline_ajax_search.inc,v 1.1.2.6 2010/03/29 19:56:03 fabianderijk Exp $
/**
 * @file
 * The file that holds the function that does the search
 */
function _inline_ajax_search($str, $type) {
  switch ($type) {
    case 'page':
      $ext = '_page';
      break;
    case 'default':
      $ext = '';
      break;
  }
  $uselucene = module_exists('luceneapi') && module_exists('luceneapi_node') && variable_get('inline_ajax_use_lucene' . $ext, 0) == 1 ? TRUE : FALSE;
  $str = inline_ajax_search_string_format($str);
  $snippet = variable_get('inline_ajax_search_snippet' . $ext, 0);
  $types = array();
  $nr = variable_get('inline_ajax_search_count' . $ext, 10);
  if (count($types) > 0) {
    $str .= ' type:';
    foreach ($types as $type) {
      if (!empty($type)) {
        $str .= $type . ',';
      }
    }
  }
  if ($uselucene) {
    $results = luceneapi_node_search('search', $str);
  }
    else {
      $results = inline_ajax_search_search('search', $str);
    }
  $count = count($results);
  if ($count > 0) {
    $n = 0;
    foreach ($results as $result) {
      if ($n < $nr) {
        switch ($snippet) {
          case 0: // show only title
            $ret .= '<div class="searchresult"><h3>' . l($result['title'], $result['link'], array('attributes' => array('target' => variable_get('inline_ajax_search_target' . $ext, '_self')))) . '</h3>';
            break;
          case 1: // show title and snippet
            $ret .= '<div class="searchresult"><h3>' . l($result['title'], $result['link'], array('attributes' => array('target' => variable_get('inline_ajax_search_target' . $ext, '_self')))) . '</h3>';
            $ret .= '<span>' . $result['snippet'] . '</span>';
            break;
          case 2: // show teaser
            $nid = $result['node']->nid;
            $node = node_view(node_load(array('nid' => $nid)), TRUE, FALSE);
            $pattern = "/<(a)([^>]+)>/i";
            $replacement = "<\\1 target=\"_blank\"\\2>";
            $str = preg_replace($pattern, $replacement, str_replace('target="' . variable_get('inline_ajax_search_target' . $ext, '_self') . '"', '', $node)); 
            $ret .= '<div class="searchresult">' . $str;
            break;
      }
        $ret .= '</div>';
        $n++;
      }
    }
    if ($count > $nr && variable_get('inline_ajax_show_more' . $ext, 0) == 1) {
      if ($uselucene) {
        $p = 'search/luceneapi_node/' . $str;
      }
        else {
          $p = 'search/node/' . $str;
        }
      $ret .= '<div class="moreresults">' . l(t('Found @count results. Show more', array('@count' => $count)), $p, array('attributes' => array('target' => variable_get('inline_ajax_search_target' . $ext, '_self')))) . '</div>';
    }
  }
    else {
      $ret = '<div class="searchresult noresults">' . t('No results were found. Try with a different term.') . '</div>';
    }
  return drupal_json(array('answer' => $ret));
}