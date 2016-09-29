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
            config: "http://videomore.ru/video/tracks/"+ window.vid +".xml",
            container: "//videomore.ru/videocontainer.swf",
            ga_account: "",
            ui_url: "//videomore.ru/module_player/UIMore.swf?v=18072016",
            url_ad: "//videomore.ru/advcontainer.swf?v=18072016",
            skin_id: 14,
            autostart: 0,
            ref: 'http://ctclove.ru',
            embed: 1,
            share_url: window.location.host+window.location.pathname
        };
        var params = {
            movie: '//videomore.ru/module_player/VideoCore.swf?v=18072016',
            data: '//videomore.ru/module_player/VideoCore.swf?v=18072016',
            wmode: 'transparent',
            allowScriptAccess: 'always',
            allowFullScreen: 'true',
            name: 'playerholder'
        };
        var attributes = {
            classid: 'd27cdb6e-ae6d-11cf-96b8-444553540000'
        };
        swfobject.embedSWF("//videomore.ru/module_player/VideoCore.swf?v=18072016", "embed_obj", "704", "528", "9.0.0", false, flashvars, params, attributes);

    }
});