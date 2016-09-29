/**
 * Created by vnilov on 24.12.15.
 */
$(document).ready(function(){
    $('.slick__items').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        dots: true,
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    centerMode: true,
                    centerPadding: '30px'
                }
            }]
    });
});