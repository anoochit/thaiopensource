// $Id: inline_ajax_search_page.js,v 1.1.2.3 2010/03/26 22:58:56 fabianderijk Exp $
Drupal.behaviors.inline_ajax_search_page = function() {
  Drupal.settings.IAS_settings.pIAS_charChount = 0;
  Drupal.settings.IAS_settings.pIAS_el = $('#inline_ajax_search_container_page #inline_ajax_search_page');
  Drupal.settings.IAS_settings.pIAS_el_res = $('#inline_ajax_search_container_page #inline_ajax_search_page_results');
  pIAS_throbber = $('.IAS_page_throbber');
  Drupal.settings.IAS_settings.pIAS_el.val(Drupal.settings.IAS_settings.pIAS_el.attr('title'));
  Drupal.settings.IAS_settings.pIAS_el_res.hide();
  $('body').addClass('inline-ajax-search-page');
  Drupal.settings.IAS_settings.pIAS_el.keyup(function(event) {
    Drupal.settings.IAS_settings.pIAS_charChount = $(this).val().length; 
    if($(this).val().length >= Drupal.settings.IAS_settings.word_size) {
      Drupal.settings.IAS_settings.countCharsShown = false;
      Drupal.settings.IAS_settings.pIAS_el_res.empty();
      pIAS_throbber.show();
      var path = Drupal.settings.basePath + 'search/inline_ajax_search/get/';
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: path + $(this).val() + '/page',
        success: inline_ajax_search_page_succes
      });
      return false;
    } else if($(this).val().length > 0) {
      setTimeout(function() {
        if(!Drupal.settings.IAS_settings.countCharsShown && Drupal.settings.IAS_settings.pIAS_charChount < Drupal.settings.IAS_settings.word_size) {
          Drupal.settings.IAS_settings.resultsShownPage = true;
          Drupal.settings.IAS_settings.countCharsShown = true;
          pIAS_throbber.hide();
          var result = '<div class="searchresult lowcharcount">' + Drupal.t('You have to search with more than ') + Drupal.settings.IAS_settings.word_size + Drupal.t(' characters.') + '</div>';
          Drupal.settings.IAS_settings.pIAS_el_res.empty();
          Drupal.settings.IAS_settings.pIAS_el_res.append(result);
          Drupal.settings.IAS_settings.pIAS_el_res.fadeIn('fast');
          Drupal.settings.IAS_settings.pIAS_el_res.addClass('shown');
        }
      }, 500);
    } else {
      Drupal.settings.IAS_settings.resultsShownPage = false;
      Drupal.settings.IAS_settings.countCharsShown = false;
      Drupal.settings.IAS_settings.pIAS_el_res.fadeOut('fast', function() {
        Drupal.settings.IAS_settings.pIAS_el_res.removeClass('shown');
        Drupal.settings.IAS_settings.pIAS_el_res.empty();
      });
    }
  });
  
  Drupal.settings.IAS_settings.pIAS_el.focus(function() {
    if($(this).val() == $(this).attr('title')) {
      $(this).val('');
    }
  });
  
  Drupal.settings.IAS_settings.pIAS_el.blur(function(e) {
    if(!Drupal.settings.IAS_settings.resultsShownPage) {
      $(this).val($(this).attr('title'));
    }
  });
  
  $('body').click(function(e) {
    if(Drupal.settings.IAS_settings.resultsShownPage) {
      var left = Drupal.settings.IAS_settings.pIAS_el_res.offset().left;
      var top = Drupal.settings.IAS_settings.pIAS_el_res.offset().top;
      var bottom = top + Drupal.settings.IAS_settings.pIAS_el_res.height();
      var right = left + Drupal.settings.IAS_settings.pIAS_el_res.width();
      if(e.pageX > left && e.pageX < right && e.pageY > top && e.pageY < bottom) {
        // do something inside the results
      } else {
        Drupal.settings.IAS_settings.resultsShownPage = false;
        Drupal.settings.IAS_settings.pIAS_el_res.fadeOut('fast', function() {
          Drupal.settings.IAS_settings.pIAS_el_res.empty();
          Drupal.settings.IAS_settings.pIAS_el_res.removeClass('shown');
          Drupal.settings.IAS_settings.pIAS_el.val(Drupal.settings.IAS_settings.pIAS_el.attr('title'));
        });
      }
    }
  });
}

function inline_ajax_search_page_succes(data) {
  if(data.answer != null) {
    pIAS_throbber.hide();
    Drupal.settings.IAS_settings.resultsShownPage = true;
    Drupal.settings.IAS_settings.pIAS_el_res.html(data.answer);
    Drupal.settings.IAS_settings.pIAS_el_res.fadeIn('fast');
    Drupal.settings.IAS_settings.pIAS_el_res.addClass('shown');
  }
}