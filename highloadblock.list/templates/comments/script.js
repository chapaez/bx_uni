$(function(){
	
	smoothScroll.init();

	var eid=$('.comments-wrap').data('eid');
	var md = new MobileDetect(window.navigator.userAgent);
	
	$("body").on("click",".js-answer",function(event){
		$that=$(this);
		event.preventDefault();
		$.ajax({
			url:'/ajax/auth.php',
			dataType:'json',
			method:'post',
			data:{
				check: 'authorize'
			},
			success:function(data){
				if ( data.auth ) {
					$('#commentText').focus();
					$('#commentText').val($that.parent().find($('.comments-username')).html() + ', ');
				} else {
					$('#authModal').modal();
				} 
			}
		});
		
	});
	
	$("body").on("click",".js-comments-likes a",function(event){
		$that=$(this);
		event.preventDefault();
		$.ajax({
			url:'/ajax/like.php',
			dataType:'json',
			method:'post',
			data:{
					sessid:$('#sessid').val(),
					cid:$that.data('cid'),
					eid:eid
					
				},
			success:function(data){
				if(data.status=='ok'){
					$that.next('.comments-likes__count')
						.html(data.likes_count);
					if ( $that.hasClass('comments-likes__href--active') ) {
						$that.removeClass('comments-likes__href--active');
						$that
							.next('.comments-likes__count')
							.removeClass('comments-likes__count--active')
					} else {
						$that.addClass('comments-likes__href--active');
						$that
							.next('.comments-likes__count')
							.addClass('comments-likes__count--active')
					} 
					
				}else{
					$('#authModal').modal();
				}
			}
			
		});
	});
	$("body").on("click",".revert-change",revert=function(event){
		event.preventDefault();
		var cid=$(this).data('id');
		var eid=$('.comments-wrap').data('eid');
		$that=$(this);
		$.ajax({
			url:'/ajax/remove_comment.php',
			dataType:'json',
			method:'post',
			data:{
				sessid:$('#sessid').val(),
				cid:cid,
				eid:eid,
				save:true
			},
			success:function(data){
				$that.parents('.comments-list__item').css({'background-color':'inherit'});
				jQuery('<a/>', {
				    text: 'еще удалить :(',
				    class: 'js-comments-remove',
				    href: '',
				    'data-id':cid
				}).insertAfter($that);
				$that.remove();
			}
		})

	});
	$("body").on("click",".js-comments-remove",remove=function(event){
		event.preventDefault();
		var cid=$(this).data('id');
		
		$that=$(this);
		$.ajax({
			url:'/ajax/remove_comment.php',
			dataType:'json',
			method:'post',
			data:{
				sessid:$('#sessid').val(),
				cid:cid,
				eid:eid
			},
			success:function(data){
				if(data.status=='ok'){
					$that.parents('.comments-list__item').css({'background-color':'gray'});
					jQuery('<a/>', {
					    text: 'ну и злой же я :(',
					    class: 'revert-change',
					    href: '',
					    'data-id':cid
					}).insertAfter($that);
					$that.remove();

				}else{
					alert('error');
				}
			}
			
		});
	});
	$("body").on("click",".comments-show-all-items",function(event){
		event.preventDefault();
		$that=$(this);
		$.ajax({
			url:'/ajax/comments.php',
			dataType:'html',
			method:'get',
			data:{
				all_comments:true,
				eid:   $that.data('eid')
			},
			success:function(data){
				$('.comments-list').html(data);
				$that.remove();
			}
			
		});
	}); 
});
