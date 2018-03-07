(function($){

	jQuery(document).ready(function(){

		jQuery('.b-management-detail').hide();
		jQuery('.b-management-row .loader-wrap').hide();

		function managementDetailInfo() {

			var cardClick = jQuery('.b-management-card');
			//var cardDetail = cardClick.parent('.b-management-row').find('.b-management-detail');

			cardClick.on('click', function( event ){

				jQuery(".b-management-card").removeClass('active');

				var $this = jQuery(this);

				//show loader
				var loaderImg = $this.parent('.b-management-row').find('.loader-wrap');
				loaderImg.show();

				jQuery('.b-management-detail').hide();
				
				var mName = $this.find('strong').text();
				var mDesg = $this.find('span.post').text();
				var mDesc = $this.find('.m-desc').html();
				var mImg  = $this.find('img').attr('src');
				var mID   = $this.attr('id');
				mID = parseInt( mID.replace( 'm-', '' ) );

				var prevBtnId = mID - 1;
				var nextBtnId = mID + 1;

				//console.log(mID+"=="+total_member);

				jQuery(".det-prev").show();
				if(mID=="1") {jQuery(".det-prev").hide();}

				var total_member= jQuery("#total_member").val();

				jQuery(".det-next").show();
				if(mID==total_member) {jQuery(".det-next").hide();}

				if ( jQuery('#m-'+prevBtnId).length == 0 ){ 
					var prevBtnId = parseInt(mID);
				}

				if ( jQuery('#m-'+nextBtnId).length == 0 ){ 
					var nextBtnId = parseInt(mID);
				}

				var parentDetBox = $this.parent('.b-management-row').find('.b-management-detail');
				parentDetBox.find('.name').html( mName );
				parentDetBox.find('.managenent-post').html( mDesg );
				parentDetBox.find('.text-holder-wrap').html( mDesc );

				if( mImg == 'undefined' || mImg == null ) {
					parentDetBox.find('img').hide();
				} else {
					parentDetBox.find('img').show();
					parentDetBox.find('img').attr( 'src', mImg );
				}

				parentDetBox.find('.det-prev').attr('data-p',prevBtnId);
				parentDetBox.find('.det-next').attr('data-p',nextBtnId);

				$this.removeClass('active');
				//show detail box after 2 sec delay
				setTimeout(function(){ 
					parentDetBox.fadeIn('slow');
					loaderImg.hide(); }, 
				1000);

				//hide loader
				onCLickReadMoreBtn();

				$('html, body').animate({
				    scrollTop: parentDetBox.offset().top - 350 }, 1000);
				

				$this.addClass('active');
				event.preventDefault();
			});
		}

		function managementPagination(){



			jQuery('.b-management-detail .det-prev, .b-management-detail .det-next').on('click', function( e ){
				e.preventDefault();				
				jQuery(".b-management-card").removeClass('active');
				jQuery('.b-management-detail').hide();
				jQuery('.b-management-row .loader-wrap').hide();

				var memBoxID = jQuery(this).attr('data-p');

				jQuery("#m-"+memBoxID).addClass('active');
				var $this = jQuery(this);  //a tag

				//show loader
				var loaderImg = $this.parents('.b-management-row').find('.loader-wrap');
				loaderImg.show();

				var parentDetBox = $this.parents('.b-management-detail'); //.find('.b-management-detail');
				//parentDetBox.hide();

				jQuery(".det-prev").show();
				if(memBoxID=="1") {jQuery(".det-prev").hide();}

				var total_member= jQuery("#total_member").val();

				jQuery(".det-next").show();
				if(memBoxID==total_member) {jQuery(".det-next").hide();}

				if( memBoxID ){
					var box = jQuery('#m-'+memBoxID);
					var mName = box.find('strong').text();
					var mDesg = box.find('span.post').text();
					var mDesc = box.find('.m-desc').html();
					var mImg  = box.find('img').attr('src');
					//var mID   = box.attr('id');
					//mID = parseInt( mID.replace( 'm-', '' ) );

					var prevBtnId = parseInt(memBoxID) - 1 ;
					var nextBtnId = parseInt(memBoxID) + 1;

					if ( jQuery('#m-'+prevBtnId).length == 0 ){ 
						var prevBtnId = parseInt(memBoxID);
					}

					if ( jQuery('#m-'+nextBtnId).length == 0 ){ 
						var nextBtnId = parseInt(memBoxID);
					}
					
					parentDetBox.find('.name').html( mName );
					parentDetBox.find('.managenent-post').html( mDesg );
					parentDetBox.find('.text-holder-wrap').html( mDesc );

					if( mImg == 'undefined' || mImg == null ) {
						parentDetBox.find('img').hide();
					} else {
						parentDetBox.find('img').show();
						parentDetBox.find('img').attr( 'src', mImg );
					}

					parentDetBox.find('.det-prev').attr('data-p',prevBtnId);
					parentDetBox.find('.det-next').attr('data-p',nextBtnId);
					//delay for 2 sec
					setTimeout(function(){ 
						parentDetBox.fadeIn('slow');
						loaderImg.hide(); }, 
					1000);

					onCLickReadMoreBtn();

				}
			});
		}

		function onCLickReadMoreBtn(){
			$('button.btn-mgmt-readmore').click(function(){
				$(this).hide();
				$(this).siblings('.text-holder').addClass( 'full-text' );
			})
		}

	

		managementDetailInfo();
		managementPagination();
		//onCLickReadMoreBtn();
	});

})(jQuery);
