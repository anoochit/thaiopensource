/**
 * Plugin: jquery.zRSSFeed
 * 
 * Version: 1.0.1
 * (c) Copyright 2010, Zazar Ltd
 * 
 * Description: jQuery plugin for display of RSS feeds via Google Feed API
 *              (Based on original plugin jGFeed by jQuery HowTo)
 * 
 * History:
 * 1.0.1 - Corrected issue with multiple instances
 *
 **/

(function($){

	var current = null; 
	
	$.fn.rssfeed = function(url, options) {	
	
		// Set pluign defaults
		var defaults = {
			limit: 10,
			header: true,
			titletag: 'h3',
			date: false,
			content: false,
			snippet: false,
			showerror: true,
			errormsg: '',
			key: null
		};  
		var options = $.extend(defaults, options); 
		
		// Functions
		return this.each(function(i, e) {
			var $e = $(e);
			
			
			// Check for valid url
			if(url == null) return false;

			// Create Google Feed API address
			var api = "http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&callback=?&q=" + url;
			if (options.limit != null) api += "&num=" + options.limit;
			if (options.key != null) api += "&key=" + options.key;

			// Send request
			$.getJSON(api, function(data){
				
				// Check for error
				if (data.responseStatus == 200) {
	
					// Process the feeds
					_callback(e, data.responseData.feed, options);
				} else {

					// Handle error if required
					if (options.showerror)
						if (options.errormsg != '') {
							var msg = options.errormsg;
						} else {
							var msg = data.responseDetails;
						};
						$(e).html('<div class="rssError"><p>'+ msg +'</p></div>');
				};
			});				
		});
	};
	
	// Callback function to create HTML result
	var _callback = function(e, feeds, options) {
		if (!feeds) {
			return false;
		}

		
		html = '';
		// Add feeds
		for (var i=0; i<feeds.entries.length; i++) {
			
			// Get individual feed
			var entry = feeds.entries[i];
			
			// Format published date
			var entryDate = new Date(entry.publishedDate);
			var pubDate = entryDate.toLocaleDateString() + ' ' + entryDate.toLocaleTimeString();
			
         var link = entry.link.toString();
         var linktmp = link.split("v=");
         var thump = linktmp[1].toString();
         var thump = thump.split("&feature=");
         
/*
         var content = entry.content;
         var matches = content.match(/<img[^>]+>/);
*/
         var title = entry.title.toString();
         
         if (title.match(/Writer+/)=="Writer") {
               titlex=title.substring(6);
         } else if (title.match(/Calc+/)=="Calc") {
               titlex=title.substring(4);
         } else if (title.match(/Base+/)=="Base") {
               titlex=title.substring(4);
         } else if (title.match(/Math+/)=="Math") {
               titlex=title.substring(4);
         } else if (title.match(/Macro+/)=="Macro") {
               titlex=title.substring(5);
         } else if (title.match(/Impress+/)=="Impress") {
               titlex=title.substring(7);
         } else if (title.match(/Draw+/)=="Draw") {
               titlex=title.substring(4);
         } else {
               titlex=title;
         }

   		// Add feed row
			html += '<li>' + 
				'<a href="vnd.youtube://'+ thump[0] + '" title="View this feed at '+ 
				feeds.title +'">'+ titlex + '</a>' 
			if (options.date) html += '<div>'+ pubDate +'</div>'
			if (options.content) {
			
				// Use feed snippet if available and optioned
				if (options.snippet && entry.contentSnippet != '') {
					var content = entry.contentSnippet;
				} else {
					var content = entry.content;
				}
				
				html +=  content + '</h4>';
			}
			
			html += '</li>';
		
		}
		
		$(e).html(html);
		$("#item_list").listview("refresh");
	};
})(jQuery);
