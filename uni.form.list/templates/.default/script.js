/**
 * Created by vnilov on 24.12.15.
 */
function getPage(page) {
    
    var pages = $('.items').data('pages');
    
    if ( page <= pages ) {
        $.ajax({
            url: '/projects/sp/MBand/casting_ajax.php?p=' + page,
            dataType: 'html',
            method: 'get',
            success: function (data) {
                console.log(data);
                $('.bride__listing .items .item').last().after(data);
                $('.items').data('page', page);
                if (page == pages) {
                    $('.items .btn').hide();
                }
            }
        });
        

    }
}

$(function() {
   
});