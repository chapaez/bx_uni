$(function(){
	$('.btn-readmore.short-item').click(function() {
		$('.short-item').addClass('hidden');
		$('.full-item').removeClass('hidden');
	});
	$('.btn-readmore.full-item').click(function() {
		$('.full-item').addClass('hidden');
		$('.short-item').removeClass('hidden');
	});
	
    var md = new MobileDetect(window.navigator.userAgent);
    if ( md.mobile() == null ) {
        $(".project_video__player iframe").remove()
        var flashvars = { 
            config: "https://videomore.ru/video/tracks/"+ window.vid +".xml",
            skin_id: 14,
            autostart: 0,
            ref: 'http://ctclove.ru',
            embed: 1,
            share_url: window.location.host+window.location.pathname
        };
        var params = {
            movie: 'https://videomore.ru/player.swf?config=http://videomore.ru/video/tracks/'+ window.vid +'.xml?skin_id=14',
            data: 'https://videomore.ru/player.swf?skin_id=14',
            allowScriptAccess: 'always',
            allowFullScreen: 'true'
        };
        var attributes = {};
        swfobject.embedSWF("https://videomore.ru/player.swf?skin_id=14", "embed_obj", "704", "528", "9.0.0", false, flashvars, params, attributes);

    }
});