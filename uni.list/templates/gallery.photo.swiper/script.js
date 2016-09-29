/**
 * Created by vnilov on 03.07.15.
 */
var slideID = 0;
var slide = 0;
var galleryTop;
var galleryThumbs;
var galleryMobile;
var urlFlag = false;
function fullScreen(element) {
		if(element.requestFullscreen) {
			element.requestFullscreen();
		} else if(element.webkitRequestFullscreen) {
			element.webkitRequestFullscreen();
		} else if(element.mozRequestFullScreen) {
			element.mozRequestFullScreen();
		}
}
function fullScreenCancel() {
		if (document.cancelFullScreen) {
				document.cancelFullScreen();
			} else if (document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if (document.webkitCancelFullScreen) {
				document.webkitCancelFullScreen();
			}
	}

$(function(){
	$(document).ready(function () {
		var url = window.location.href,
			urlIdPos = url.indexOf('?id=');
		if(urlIdPos != -1) {
			var slideID = url.slice(urlIdPos + 4);
			var targetIndex = $('.swiper-slide[data-id="' + slideID + '"]').attr('data-swiper-slide-index');
			$('#galleryModal').modal();
			setTimeout(function () {
				galleryTop.slideTo(targetIndex, 0);
			}, 500)
			urlFlag = true;
		}
	});

	$('.modal-close-btn').click(function() {
		$('#galleryModal').modal('hide');
	});

	$('.right-block').click( function() {
		//console.log('right block click');
		var canvas = document.getElementById('mtop');
		var button = $(this).find('.mdi');
		if (button.hasClass('mdi-fullscreen')) {
			button
				.removeClass('mdi-fullscreen')
				.addClass('mdi-fullscreen-exit');
			$(this).find('div').html('свернуть');

			fullScreen(canvas);

		} else {
			fullScreenCancel();
			button
			.removeClass('mdi-fullscreen-exit')
			.addClass('mdi-fullscreen');
			$(this).find('div').html('на весь экран');
		}
	});
	var pushFlag = false;
	var gallery = $('#gallery_wrap');

	$('.gallery-top').hover(
		function() {
				$( this ).find( ".swiper-button-next, .swiper-button-prev" ).css('display','block');
			}, function() {
				$( this ).find( ".swiper-button-next, .swiper-button-prev" ).css('display','none');
			}
	);
	galleryTop = new Swiper('.gallery-top', {
				nextButton: '.gallery-top .swiper-button-next',
				prevButton: '.gallery-top .swiper-button-prev',
				spaceBetween: 10,
				observer: true,
				observeParents: true,
				loop: true,
				loopedSlides: 1,
				loopAdditionalSlides : 10,
				onInit: function(swiper){},
				onTransitionStart: function(res){ },
				onTransitionEnd:function(swiper){ },
				onSlideChangeStart: function(){ },
				onSlideChangeEnd: function(res){
					$('.photo-name').html(gallery.find('.gallery-top .swiper-slide').eq(res.activeIndex).data('name'));
					var currentIndex = $(res.slides[res.activeIndex]).data('num');
					$('#pNum').html(currentIndex);
					if(pushFlag) {
						history.pushState({slide: res.activeIndex}, '', '?id=' + $(res.slides[res.activeIndex]).data('id'));
					}
					pushFlag = true;
					page_url = window.location.href;
					setLikesCount(page_url);

				}
	});
	galleryThumbs = new Swiper('.gallery-thumbs', {
				nextButton: '.gallery-thumbs .swiper-button-next',
				prevButton: '.gallery-thumbs .swiper-button-prev',
				spaceBetween: 18,
				centeredSlides: true,
				slidesPerView: 4,
				touchRatio: 0.2,
				slideToClickedSlide: true,
				observer: true,
				observeParents: true,
				slidesOffsetBefore: 20,
				loop: true,
				loopedSlides: 1,
				loopAdditionalSlides : 10
		});
	
		galleryTop.params.control = galleryThumbs;
		galleryThumbs.params.control = galleryTop;
		galleryThumbs.slides.length = galleryThumbs.slides.length - 1;
	
		$('.project_series__item a[data-type="photo_gallery"]').click(function(){
			slideID = parseInt($(this).parent().attr('data-link-id'));
				$('#galleryModal').modal();   
				return false;
		});
		$('#galleryModal').on('show.bs.modal', function (event) {
			//console.log('show.bs.modal')
			galleryTop.activeIndex = slide;
			galleryThumbs.activeIndex = slide;
			galleryTop.updateClasses();
		});
		$('#galleryModal').on('shown.bs.modal', function (event) {
			if(!urlFlag) {
				console.log('slide', slide)
				galleryTop.slideTo(slide,0);
				history.pushState({slide: slide}, '', '?id=' + slideID);
			}
			page_url = window.location.href;
			//history.pushState({slide: slide}, '', '?id=' + $(galleryTop.slides[slide]).data('id'));
			$('#gallery_wrap').css({'visibility':'visible'});
			setLikesCount(page_url);
		});
		$('#galleryModal').on('hidden.bs.modal', function (event) {
			$('#gallery_wrap').css({'visibility':'hidden'});
			history.pushState({slide: ''}, '', '.');
			setLikesCount(page_url);
			//console.log('hidden.bs.modal')
		});
		window.addEventListener("popstate", function(e) {
				//console.log('popstate');
				if (e.state) {
						galleryTop.slideTo(e.state.slide, 0);
				}
		}, false);
	galleryMobile = new Swiper('.gallery-mobile', {
		slidesPerView: 1,
		nextButton: '.right',
		prevButton: '.left',
		initialSlide: slide,
		// Disable preloading of all images
		preloadImages: false,
		// Enable lazy loading
		lazyLoading: true,
		onSlideChangeEnd: function(res) {
			//console.log('onSlideChangeEnd Mobile');
			$('.gallery-mobile .name').html($('.gallery-mobile').find('.swiper-slide').eq(res.activeIndex).data('name'));
			$('.gallery-mobile .count span').html(res.activeIndex + 1);
			history.pushState({slide: res.activeIndex}, '', ''+$(res.slides[res.activeIndex]).data('id'));
			//page_url = $(res.slides[res.activeIndex]).data('id'));
			page_url = window.location.href;
			setLikesCount(page_url);
			//console.log(page_url+$(res.slides[res.activeIndex]).data('id'));
		}
	});
});