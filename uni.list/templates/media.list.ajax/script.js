/**
 * Created by vnilov on 01.09.15.
 */

$(function(){

    var elem = $('.media-list');
    
    var mediaList;
    var img = new imagesLoaded(elem, function(){
        mediaList = elem.masonry({
            itemSelector: '.media-list__item',
            columnWidth: '.media-list__item',
            gutter: '.media-list__gutter'
        });
    });
    
    
    
    
    
    
});