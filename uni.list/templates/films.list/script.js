$(function() {
    (function(){
       var arrUrl = location.href.split('/');
        if(arrUrl.length >= 6) {
            var genre = arrUrl[4];
            var state = {'genre': genre};
            var wrapID = $('.projects.left_column').parent().attr('id');
            var onclickAttr = 'BX.ajax.insertToNode(\'/films/?bxajaxid=' + wrapID.slice(5) + '\', \'' + wrapID + '\'); return false;';
            $('.cinema-filter-all a').attr('onclick', onclickAttr);
            history.replaceState(state, null, '/films/' + genre);
        }
    })();

    // отображаем скрытый список фильтров
    $(document).on('click', '.cinema-filter-genre', function() {
        $('.b-cinema-filter').toggleClass('show-all');
        $('body').bind('DOMSubtreeModified', function() {
            // инициализируем кнопки на слайдере
            carouselBtn();
        });
    });

    // выбираем фильтр
    $(document).on('click', '.bcf-list a', function(event) {
        event.preventDefault();

        $('.cinema-filter-all a').removeClass('active');
        $(this).addClass('active-tag');
        $('.cinema-filter-genre, .bcf-list').addClass('hidden');

        // genres history
        var genre = $(this).attr('data-code');
        var state = {'genre': genre};
        history.pushState(state, null,  genre);
    });

    // закрываем тег с фильтром
    $(document).on('click', '.bct-list i', function(event) {
        $('.cinema-filter-genre, .bcf-list').removeClass('hidden');
        $('.bct-list').addClass('hidden');
        $('.cinema-filter-all a').trigger('click');
    });

    // сбрасываем фильтр
    $(document).on('click', '.cinema-filter-all a', function(event) {
        $('.bct-list').empty();
        $(this).addClass('active');
        var state = {'genre': 'all'};
        history.replaceState(state, null,  '/films/');
    });

    window.addEventListener('popstate', function(e) {
        //    body....
    })
});


