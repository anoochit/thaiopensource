<?php
// $Id: inline_ajax_search-theme-page.tpl.php,v 1.1.2.1 2010/03/24 11:26:36 fabianderijk Exp $
/**
 * 
 * @file inline_ajax_search-theme-page.tpl.php
 * @see template_preprocess_inline_ajax_search_theme_page()
 */
?>

<div id="inline_ajax_search_container_page">
	<form id="inline-ajax-search-page" method="post" accept-charset="UTF-8" action="<?php print $inline_ajax_search->formurl; ?>">
    <input type="text" name="inline_ajax_search_page" id="inline_ajax_search_page" title="<?php print t('type a keyword'); ?>">
    <div style="display:none" class="searchthrobber IAS_page_throbber"></div>
    <div id="inline_ajax_search_page_results"></div>
  </form>
</div>
