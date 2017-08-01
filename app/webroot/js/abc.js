function likeAction(photo_id,video_id){
	$.ajax({
		url: '/PhotoStock/Likes/like',
		type: "POST",
		dataType: 'json',
		data: { photo_id_to_send: photo_id,
				video_id_to_send: video_id },
		success: function(data){
			// console.log(data);
			if(data.isLike == 1){
				if (video_id == null) {
					$('#'+photo_id).removeClass('glyphicon-heart-empty');
					$('#'+photo_id).addClass('glyphicon-heart');
					$('#'+photo_id).css('color','red');
					$('#item-'+photo_id).text(data.likecount);
				} else {
					$('#'+video_id).removeClass('glyphicon-heart-empty');
					$('#'+video_id).addClass('glyphicon-heart');
					$('#'+video_id).css('color','red');
					$('#itemv-'+video_id).text(data.likecount);
				}
			} else {
				if (video_id == null) {
					$('#'+photo_id).removeClass('glyphicon-heart');
					$('#'+photo_id).addClass('glyphicon-heart-empty');
					$('#'+photo_id).css('color','black');
					$('#item-'+photo_id).text(data.likecount);
				} else {
					$('#'+video_id).removeClass('glyphicon-heart');
					$('#'+video_id).addClass('glyphicon-heart-empty');
					$('#'+video_id).css('color','black');
					$('#itemv-'+video_id).text(data.likecount);
				}
			}
		},
		error: function(xhr, err){
			// console.log("readyState: " + xhr.readyState + "  status: " + xhr.status + "\n\nresponseText: " + xhr.responseText);
		}
	})
}

function checkLike(photo_id){
	var x = document.getElementById(photo_id);
	if(x != null){
		x.classList.add('glyphicon-heart');
		x.classList.remove('glyphicon-heart-empty');
		x.style.color = "red";
	}
}
//Comment
function commentAction(){
    var url    = window.location.href;
    var result = url.split('/');

    var type = result[result.length - 3];
    var id   = result[result.length - 1];
    var message = document.getElementById('msg').value;
    $.ajax({
    	url: '/PhotoStock/Comments/add',
    	type: 'POST',
    	dataType: 'json',
    	data: { message_to_send: message,
    			id_to_send: 	 id,
    			type_to_send:    type		},
    	success: function(data){
    		//console.log(data.create);
    		$('#msg').val('');
			var x ='<li id='+'cmt-'+data.commentid+'>'+
					'<input type="button" class="close" aria-hidden="true" onClick="if(confirm(\'Are you sure?\')) deleteComment('+data.commentid+')" value="&times;">'+

                    '<div class="commentName"><b>'+data.user_name+'</b>'+
                    	'<span class="commentText">'+message+'</span></div>'+
					'<div><p class="date sub-text">on '+data.create+'</p></div></li>';
			$('.commentList').prepend(x);
			$('#number').text(data.commentcount);
			
    	},
    	error: function(xhr,err){
    		// console.log("readyState: " + xhr.readyState + "  status: " + xhr.status + "\n\nresponseText: " + xhr.responseText);
    	}
    })
	return false;
}

function deleteComment(comment_id){
	var url    = window.location.href;
    var result = url.split('/');

    var type = result[result.length - 3];
    var id   = result[result.length - 1];

	$.ajax({
		url: '/PhotoStock/Comments/delete/',
		type: "POST",
		dataType: 'json',
		data: { comment_id : comment_id,
				type_to_send: type,
				id_to_send: id},
		success: function(data){
			// console.log(data);
			// console.log(comment_id);
			$('#cmt-'+ comment_id).hide(600);
			$('#number').text(data.commentcount);
		},
		error: function(xhr, err){
			// console.log("readyState: " + xhr.readyState + "  status: " + xhr.status + "\n\nresponseText: " + xhr.responseText);
		}
	});
}
