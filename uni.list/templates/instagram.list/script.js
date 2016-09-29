/**
 * Created by vnilov on 01.09.15.
 */



$(function(){
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




    /**********************\
     *   #GET ELEMENTS     *
     \**********************/
        
    var list    = '.js-media-list';
    var curPage = 1;
    $('.js-media-list__btn').click( function() {
        
        $.ajax({
            type: 'GET',
            url: '/bitrix/components/custom/uni.list/templates/instagram.list/ajax.php?page=' + (curPage + 1),
            dataType: "html",
            success: function (data) {
                if ( data != '' ) {
                    var $elems = $( data );
                    var img = new imagesLoaded($elems, function() {
                        mediaList.append($elems).masonry('appended', $elems);
                        instgrm.Embeds.process();
                    });
                    curPage++;
                } else {
                    $('.js-media-list__btn').hide();
                }
            }
        });
        return false;
    });
    
});