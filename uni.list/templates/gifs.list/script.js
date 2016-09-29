//(function(){
//    document.addEventListener("DOMContentLoaded", ready);
//    function ready() {
//        var btnGenre = document.getElementsByClassName('cinema-filter-genre')[0];
//        btnGenre.addEventListener('click', function() {
//            document.getElementsByClassName('b-cinema-filter')[0].classList.toggle('show-all')
//        });
//        // инициализируем кнопки на слайдере
//        carouselBtn();
//
//    }
//})();

$(function() {
    $(document).on('click', '.gifs-filter-genre', function() {
        $(this).toggleClass('active');
        $('.b-gifs-filter').toggleClass('show-all');
    });
    $('.bct-list i').click(function() {
        location.href = "/entertainment/gifs/";
    })
});


