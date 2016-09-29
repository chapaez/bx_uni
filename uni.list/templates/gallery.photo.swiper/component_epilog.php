<? if(intval($_REQUEST["id"])>0): ?>
<!--    <script>
        $(function(){
            var id = <?/*=intval($_REQUEST["photo_code"])*/?>;
            var md = new MobileDetect(window.navigator.userAgent);
            if ( md.tablet() != null || md.mobile() == null ) {
                
                var idx = $('.swiper-slide[data-id="' + id + '"]').data('num');
                slide = idx - 1;
                $('.photo-name').html($('.gallery-top .swiper-slide').eq(slide).data('name'));
                $('#pNum').html(idx);
                $('#galleryModal').modal();
            }else{
                var idx = $('.gallery-mobile .swiper-slide[data-id="' + id + '"]').data('num');
                slide = idx - 1;
                galleryMobile.slideTo(slide,0);
                $('.gallery-mobile .name').html($('.gallery-mobile').find('.swiper-slide').eq(slide).data('name'));
                $('.gallery-mobile .count span').html(idx);
            }
        });
    </script>-->
    <? $APPLICATION->SetPageProperty("seo_element", Array($arResult['DETAIL_ELEMENT'],'element')); ?>
<? endif; ?>
