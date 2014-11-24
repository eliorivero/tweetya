/* QueryLoop Script for TweetYa */
(function($){
	$('.tweetya-btn').each(function(){
		$(this).append( $('<span class="tweetya-tip">' + qlTweetYaVars.toolTip + '</span>') );
	});
})(jQuery);