var ata_page=1;
$(function(){

    /*
     * 
     * MASONRY 
     * 
     */

    var elem = $('.js-grid')
    var elems = $('.media-list__item').length;

    var mediaList;

    if ( elems > 0 ) {
        var img = new imagesLoaded(elem, function(){
            mediaList = elem.masonry({
                itemSelector: '.media-list__item',
                columnWidth: '.media-list__item',
                gutter: '.media-list__gutter',
                stamp: '.js-stamp'
            });
        });
    }
    
    
    
    
    
    $("body").on("click",'.js-media-list__show_answer',function(event){
        event.preventDefault();
        var $answer_wrap=$(this).siblings('.media-list__text_answer');
        if($answer_wrap.css('display')=='none') {
            $(this).html('свернуть ответ');
            $answer_wrap.slideDown(100, function(){
                mediaList.masonry('layout');
            });
        }else{
            $(this).html('смотреть ответ');
            $answer_wrap.slideUp(100, function(){
                mediaList.masonry('layout');
            });
        }
    });
    /*$("body").on("click",'.js-media-list__show_video_answer',function(event){
        event.preventDefault();
        var $answer_wrap=$(this).siblings('.media-list__text_answer');
        $answer_wrap.modal();
    });*/
    var get_filters = function(){
        var have_answer;
        if($('.js-media-filter__item').hasClass('media-filter__item--active')){
            have_answer="y";
        }else{
            have_answer="n";
        }
        return {
            sessid:$('#sessid').val(),
            sort:$('.js-media-sort').val(),
            have_answer:have_answer,
            star:$('.js-media-filter__star').val(),
            clear_cache:'Y'
        }
    }
    var update_list = function(){
        var data=get_filters();
        ata_page=1;
        $.ajax({
            url:'/ajax/sp/ata_questions.php',
            dataType:'html',
            method:'get',
            data:data,
            success:function(data){
                $('.js-items').html('');
               
                
                var $elems = $( data );
                var img = new imagesLoaded($elems, function() {
                    ($('.js-items').append($elems));//.masonry('appended', $elems);
                    mediaList.masonry('appended', $elems);
                    mediaList.masonry('layout');
                });

                
                refresh_players();
            }

        });
    };
    var add_page = function(){
        var data=get_filters();
        ata_page++;
        data.page=ata_page;
        $.ajax({
            url:'/ajax/sp/ata_questions.php',
            dataType:'html',
            method:'get',
            data:data,
            success:function(data){
                
                refresh_players();
                if ( data != '' ) {
                    var $elems = $( data );
                    var img = new imagesLoaded($elems, function() {
                        ($('.js-items').append($elems));//.masonry('appended', $elems);
                        mediaList.masonry('appended', $elems);
                    });
                } else {
                    $('.js-media-list__btn').hide();
                }
            }

        });
    };
    $('body').on('click','.js-media-list__more',function(event){
        event.preventDefault();
        add_page();
    });
    $('.js-media-sort, .js-media-filter__star').change(function(){
        update_list();
    });
    $('.js-media-filter__item').click(function(event){
        event.preventDefault();
        if($(this).hasClass('media-filter__item--active')){
            $(this).removeClass('media-filter__item--active');
        }else{
            $(this).addClass('media-filter__item--active');
        }
        update_list();
    });
    $('body').on("click",".js-media-list__likes",function(event){
        var $that=$(this);
        event.preventDefault();
        $.ajax({
            url:'/ajax/like_ib.php',
            dataType:'json',
            method:'post',
            data:{
                sessid:$('#sessid').val(),
                eid:$that.data('cid'),
                ibid:$that.parents('.js-media-list').data('ibid')
            },
            success:function(data){
                if(data.status=='ok'){
                    $that.children('.js-media-list__likes_count')
                        .html(data.likes_count);
                    if ( $that.hasClass('like--active') ) {
                        $that.removeClass('like--active');
                        $that
                            .children()
                            .removeClass('like--active');
                    } else {
                        $that.addClass('like--active');
                        $that
                            .children()
                            .addClass('like--active');
                    }

                }else if(data.status=='error' && data.message=='no_authorized'){
                    $('#authModal').modal();
                }
            }

        });
    });
    var refresh_players = function() {
        var md = new MobileDetect(window.navigator.userAgent);
        if (md.mobile() == null) {

            $('.js-media-list__video_answer').each(function (index) {
                $(this).find("iframe").remove();
                var $vm_block = $(this);
                var vm_str = $vm_block.data('vmid');
                var flashvars = {
                    config: "http://videomore.ru/video/tracks/" + vm_str + ".xml", 
                    skin_id: 14,
                    autostart: 0,
                    ref: 'http://ctclove.ru',
                    embed: 1,
                    share_url: window.location.host + window.location.pathname
                };
                var params = {
                    movie: 'http://videomore.ru/player.swf?config=http://videomore.ru/video/tracks/' + vm_str + '.xml?skin_id=14',
                    data: 'http://videomore.ru/player.swf?skin_id=14',
                    allowScriptAccess: 'always',
                    allowFullScreen: 'true',
                    wmode: 'transparent'
                };
                var attributes = {};
                swfobject.embedSWF("http://videomore.ru/player.swf?skin_id=14", $(this).find('.js-embed_obj').attr('id'), "704", "528", "9.0.0", false, flashvars, params, attributes);
            });
        }
    };
    refresh_players();
    

});