<?php
// $Id: inline_ajax_search-theme-form.tpl.php,v 1.4.2.3 2010/03/23 11:37:24 fabianderijk Exp $
/**
 * 
 * @file inline_ajax_search-theme-form.tpl.php
 * @see template_preprocess_inline_ajax_search_theme_form()
 */
?>
<div id="inline_ajax_search_container">
	<form id="inline-ajax-search-form" method="post" accept-charset="UTF-8" action="<?php print $inline_ajax_search->formurl; ?>">
    <input type="text" name="inline_ajax_search" id="inline_ajax_search" title="<?php print t('type a keyword'); ?>">
    <div style="display:none" class="searchthrobber IAS_block_throbber"></div>
    <div id="inline_ajax_search_results"></div>
  </form>
</div>
