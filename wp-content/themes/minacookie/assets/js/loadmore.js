jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error
	$('.cm_loadmore').click(function(){
 
		var button = $(this),
		    data = {
			'action': 'loadmore',
			'query': cm_loadmore_params.posts,
			'page' : cm_loadmore_params.current_page,
			'is_home': cm_loadmore_params.is_home
		};
 
		$.ajax({
			url : cm_loadmore_params.ajaxurl,
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...');
			},
			success : function( data ){
				if( data ) { 
					button.text( 'Xem thêm' )
					$('.list-posts').append(data);
					cm_loadmore_params.current_page++;
 
					if ( cm_loadmore_params.current_page == cm_loadmore_params.max_page ) 
						button.remove();
 
				} else {
					button.remove();
				}
			}
		});
	});
});