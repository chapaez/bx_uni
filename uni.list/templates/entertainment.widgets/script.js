$(function(){
	var $grid = $('.grid').masonry({
		itemSelector: '.grid > .grid-item',
		columnWidth: '.grid-item',
		stamp: '.js-stamp-rcolumn',
		gutter: '.gutter-sizer',
		isFitWidth: true
	});
	$grid.imagesLoaded().progress( function() {
		$grid.masonry('layout');
	});
});