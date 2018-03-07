
function closeModal(){
    $('#iframe-modal').fadeOut(100,function(){
        $('#iframe-modal').css('top','50%')
        .children('#modal-iframe').css('height','auto');
    });
    //$('#iframe-modal').removeClass('open');
    //$('#modal-iframe').attr('src','');  

    $('#modal').fadeOut(100);
    $('#modal-cont').delay(100).fadeOut(100);
    
    return false;
}

function reloadStyleSheets(){//stops fon-face rendering bug in ie8
    var sheets = document.styleSheets;
    for(var s = 0, slen = sheets.length; s < slen; s++) {
        sheets[s].disabled = true;
        sheets[s].disabled = false;
    }
}

function adjustColHeights(){
    var lH = ( $('.aside-left').length > 0 ) ? $('.aside-left').outerHeight() : null;
    var mH = ( $('.content').length > 0 ) ? $('.content').outerHeight() : null;
    
    if( lH == null || mH == null ){
        return false;
    }else if(mH > lH){
        $('.aside-left').css('min-height',mH);
    } 
}

function toggleAccordian(accord){
    if(accord.attr('data-state') == '0'){
        var h = 0;
        accord.children('li').each(function(){
           h = h + $(this).outerHeight();
        });
        accord.animate({'height':h},500).attr('data-state','1')
        .siblings('a.accordian-btn').addClass('active');
    }else{
        accord.animate({'height':0},500).attr('data-state','0')
        .siblings('a.accordian-btn').removeClass('active');
    }
}

function setCaroOff(on){
   if( on != undefined){
       var caro = $('div.caro.full-width');
       
       caroInterval = setInterval(function(){
           var copyReel = caro.children('div.caro-item-copy').children('ul.copy-reel'),
           imgReel = caro.children('ul.img-reel'),
           pos = parseInt(caro.attr('data-position')),
           max = copyReel.children('li').length - 1,
           newPos = ( (pos + 1) > max )? 0 : pos + 1;
           
            $('a.caro-nav-btn.active').removeClass('active');
            copyReel.children('li.active').removeClass('active').fadeOut(200,function(){
              copyReel.children('li').eq(newPos).fadeIn(300,function(){
                  copyReel.children('li').eq(newPos).addClass('active');
              });
            });
            
            imgReel.children('li.active').removeClass('active').fadeOut(200,function(){
              imgReel.children('li').eq(newPos).fadeIn(300,function(){
                  imgReel.children('li').eq(newPos).addClass('active');
              })
              .parent('ul.img-reel').siblings('nav.caro-nav').children('ul')
              .children('li').eq(newPos).children('a').addClass('active');
            })
            .parent('ul.img-reel').parent('div.caro.full-width').attr('data-position', newPos );

       },15000);
   }else{
       clearInterval(caroInterval);
   }
}

function setCaroOffNew(on){
   if( on != undefined){
       var caro = $('.caro'),
       length = (caro.hasClass('hotel-caro'))? 710 : 960 ;
       
       caroIntervalNew = setInterval(function(){
           var reel = caro.children('ul'),
           pos = parseInt(caro.attr('data-position')),
           max = reel.children('li').length - 1,
           newPos = ( (pos + 1) > max )? 0 : pos + 1;
               
           $('a.caro-nav-btn.active').removeClass('active');
           reel.children('li.active').removeClass('active').fadeOut(200,function(){
               reel.children('li').eq(newPos).fadeIn(300,function(){
                   reel.children('li').eq(newPos).addClass('active');
               })
               .parent('ul.reel').siblings('nav.caro-nav').children('ul')
               .children('li').eq(newPos).children('a').addClass('active');
           })
           .parent('ul.reel').parent('div.caro').attr('data-position', newPos );

       },15000);
   }else{
       clearInterval(caroIntervalNew);
   }
}
   
function setCaroTo(i,caro){
    clearInterval(caroInterval);
    
    var copyReel = caro.children('div.caro-item-copy').children('ul.copy-reel'),
    imgReel = caro.children('ul.img-reel'),
    max = copyReel.children('li').length - 1;
    
    $('a.caro-nav-btn.active').removeClass('active');
    copyReel.children('li.active').removeClass('active').fadeOut(200,function(){
      copyReel.children('li').eq(i).fadeIn(300,function(){
          copyReel.children('li').eq(i).addClass('active');
      });
    });

    imgReel.children('li.active').removeClass('active').fadeOut(200,function(){
      imgReel.children('li').eq(i).fadeIn(300,function(){
          imgReel.children('li').eq(i).addClass('active');
      })
      .parent('ul.img-reel').siblings('nav.caro-nav').children('ul')
      .children('li').eq(i).children('a').addClass('active');
    })
    .parent('ul.img-reel').parent('div.caro.full-width').attr('data-position', i );
    setCaroOff(true);
}
function setCaroToNew(i,caro){
    clearInterval(caroIntervalNew);
    var reel = caro.children('ul'),
    max = reel.children('li').length - 1;
    
    $('a.caro-nav-btn.active').removeClass('active');
    reel.children('li.active').removeClass('active').fadeOut(200,function(){
       reel.children('li').eq(i).fadeIn(300,function(){
           reel.children('li').eq(i).addClass('active');
       })
       .parent('ul.reel').siblings('nav.caro-nav').children('ul')
       .children('li').eq(i).children('a').addClass('active');
    })
    .parent('ul.reel').parent('div.caro').attr('data-position', i );
    setCaroOffNew(true);
}

function toggleExpand(cont){
    var h, newState,text;
    if(cont.attr('data-state') == '0'){
        
        h = cont.children('div').outerHeight();
        newState = '1';
        text=window.lessText;
        cont.siblings('a.more.expand').addClass('active');
    }else{
        h = cont.attr('data-closed-h');
        newState = '0';
        text=window.moreText;
        cont.siblings('a.more.expand').removeClass('active');
    }
    cont.animate({'height':h},400).attr('data-state',newState)
    .siblings('a.more.expand').text(text);
}

function autoResize(id){
    var newheight;
    if(document.getElementById){
        newheight=document.getElementById(id).contentWindow.document.body.scrollHeight;
    }
    if(navigator.userAgent.indexOf('Firefox') > -1 ) newheight = newheight+35;
    if(navigator.userAgent.indexOf('MSIE') > -1 ) newheight = newheight+50; 
    $('#iframe-modal').animate({'top': ($(window).scrollTop() + ( ($(window).height() - newheight ) /2 )) + 'px' });
    $('#'+id).animate({'height':newheight,opacity:'1'});
}

function thanksResize(){
    //$('#iframe-modal').animate({'margin-top': -107});
    $('#modal-iframe').animate({'height':180,opacity:'1'});
}

function standardValidation(form){
    var pass = true;
    form.find('input.required').css('border-color','transparent').siblings('.error').text('');
    form.find('textarea.required').css('border-color','transparent').siblings('.error').text('');
    form.find('.dummy-select.required').css('border-color','transparent').siblings('.error').text('');
    form.find('.dummy-file.required').css('border-color','transparent').siblings('.error').text('');
    form.find('input.required[type="email"]').css('border-color','transparent').siblings('.error').text('');
    form.find('input.number').css('border-color','transparent').siblings('.error').text('');
    
    form.find('input.required').each(function(){  
        if( $(this).val() == '' && $(this).attr('type') != 'file'){
            pass = false;
            $(this).css('border-color','#d20000').siblings('.error').text(window.requiredError);
        }
    });
    form.find('input.validate-number').each(function(){  
        var that = $(this);
        var isNum = /^[0-9\u0660-\u0669]+$/.test(that.val());

        if (isNum == false) {
            pass = false;
            that.css('border-color','#d20000').siblings('.error').text(window.phoneError);
        }
    });
    form.find('textarea.required').each(function(){
        if( $(this).val() == '' ){
            pass = false;
            $(this).css('border-color','#d20000').siblings('.error').text(window.requiredError);
        }
    });
    form.find('.dummy-select.required').each(function(){
        if( $(this).children('select').val() == '' ){
            pass = false;
            $(this).css('border-color','#d20000').siblings('.error').text(window.requiredError);
        }
    });
    form.find('.dummy-file.required').each(function(){
        if( $(this).children('input').val() == '' ){
            pass = false;
            $(this).css('border-color','#d20000').siblings('.error').text(window.requiredError);
        }
    });
    form.find('input.required[type="email"]').each(function(){
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if( re.test($(this).val()) == false ){
            pass = false;
            $(this).css('border-color','#d20000').siblings('.error').text(window.emailError);
        }
    });	
    form.find('input.number').each(function(){  
        if( isNaN($(this).val()*1) ){
            pass = false;
            $(this).css('border-color','#d20000').siblings('.error').text(window.dobError);
        }
        
        if( $(this).hasClass('small') && $(this).val().length != 2 ){
            pass = false;
            $(this).css('border-color','#d20000').siblings('.error').text(window.dobError);
        }
        if( $(this).hasClass('med') && $(this).val().length != 4 ){
            pass = false;
            $(this).css('border-color','#d20000').siblings('.error').text(window.dobError);
        }
    });
    return pass;
}

function initialize() {
    var mapOptions = {
      center: new google.maps.LatLng(25.386255, 51.524291),
      zoom: 14,
      scrollwheel: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var mapEle = new google.maps.Map(document.getElementById("map"),
        mapOptions);

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(25.386255, 51.524291),
        map: mapEle,
        title: "Click for details"
    });

    // var contentString = 
    //   '<h1 style="font-weight:700;padding-top:20px;margin-bottom:5px;">Katara Hospitality</h1>'+
    //   '<p>Katara Hospitality Building <br>' +
    //   'Marina District, Lusail City, PO <br>'+
    //   'Box 2977 Doha, Qatar <br>'+
    //   'T +974 4423 7777 <br>'+
    //   'F +974 4427 0707</p>';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(mapEle,marker);
    });

}

$(document).ready(function() {
    adjustColHeights();

    if( document.getElementById("map") != null ){
        initialize();
    }
    
   //------------------------------------caro stuff
   //set up reels for carousels
   $('ul.reel').each(function(){
       var itmWidth = $(this).children().eq(0).outerWidth();
       $(this).width( itmWidth * $(this).children().length + 10 ); // plus 10 for good luck 
   });
   
   $('nav.caro-nav').each(function(){
       var itmWidth = 20;
       $(this).children('ul').width( itmWidth * $(this).children('ul').children().length ); // plus 10 for good luck 
   });

   //CAROUSEL
   var caroInterval;
   if( $('.caro.full-width').length > 0 ){ 
       setCaroOff('on');   
   } 
   var caroIntervalNew;   
   if( $('.caro.hotel-caro').length > 0 ){ 
          setCaroOffNew('on');   
    }
      
    $('.caro.full-width').find("a.caro-nav-btn").click(function(){
        var i = $(this).parent('li').attr('data-number');
        var caro = $(this).parents('div.caro');
        setCaroTo(i,caro);
        return false;
    });
    
    $('.caro.hotel-caro').find("a.caro-nav-btn").click(function(){
        var i = $(this).parent('li').attr('data-number');
        var caro = $(this).parents('div.caro');
        setCaroToNew(i,caro);
        return false;
    });

	$(".board-read-more").click(function(){
		var text = $(this).text(),
		current_pannel = "#"+$(this).siblings('.board-info').attr("id");
		
		if ( text == "Close")
		{
			$('.board-info').animate({'height': '195px' });
			$(".board-read-more").text("Read More");
		}
		else
		{
			$('.board-info:not('+current_pannel+')').animate({'height': '195px' });
			$(".board-read-more").text("Read More");
			$(current_pannel).animate({'height': $('.board-content').height() });
			$(this).text("Close");
		}	
		return false;
	});
	
	$('input.search-tb').focus(function(){
	    if( $(this).val() == $(this).attr('data-placeholder') )
	        $(this).val('').css('color','#000');
	})
	.blur(function(){
	    if( $(this).val() == '' )
	        $(this).val( $(this).attr('data-placeholder') ).css('color','#ACACAC');
	});
	
	
	$('input.pwd').focus(function(){
	    $(this).css('color','#000').siblings('span').hide();
	})
	.blur(function(){
	    if( $(this).val() == '' ){
	        $(this).siblings('span').show();
	    }      
	});
	$('div.dummy-pwd span').click(function(){
	    $(this).siblings('input.pwd').focus();
	});
	
    $('input.username').focus(function(){
        if( $(this).val() == $(this).attr('data-placeholder') )
	        $(this).val('').css('color','#000');
    })
    .blur(function(){
        if( $(this).val() == '' )
	        $(this).val( $(this).attr('data-placeholder') ).css('color','#ACACAC');
    });
	
    $('a.open-modal').click(function(){
        $('#modal-cont').height( $(document).height() ).fadeIn(function(){
            $('#modal').show();
            var h = $('#modal').outerHeight();
            $('#modal').animate({'margin-top': -(h/2) });
        });
        return false;
    });
    
    $('a.open-iframe-modal').click(function(){
        var file = $(this).attr('href');
        $('#modal-cont').height( $(document).height() ).fadeIn(function(){
            $('#modal-iframe').css({opacity:'0'}).attr('src',file);
            $('#iframe-modal').show();
            //$('#iframe-modal').addClass('open');
        });
        return false;
    });
    
    //accordian
    $('a.accordian-btn').click(function(){
        if( !$(this).hasClass('active') && $('a.accordian-btn.active').length > 0 ){
            toggleAccordian($('a.accordian-btn.active').siblings('ul.accordian-menu'));
        }
        var accord = $(this).siblings('ul.accordian-menu');
        toggleAccordian(accord);
        return false;
    });
    
    $('a.expand').click(function(){
        if( !$(this).hasClass('active') && $('a.more.expand.active').length > 0 ){
            toggleExpand($('a.more.expand.active').siblings('div.expanding-cont'));
        }
        var cont = $(this).siblings('div.expanding-cont');
        toggleExpand(cont);
        return false;
    }); 
    
    $('input[type="checkbox"]').change(function(){
        if( $(this).is(':checked') ){
            $(this).parent('.dummy-cb').css('background-position','0 -16px');
        }else{
            $(this).parent('.dummy-cb').css('background-position','0 0');
        }
    });
    
    $('input[type="file"]').live('change',function(){
        var that = $(this),
        fullPath = that.val();
        if (fullPath) {
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
            }
            that.siblings('span.file-name').css('color','#000').text(filename);
        }
    });    
    
    $('select').change(function(){
        var that = $(this),
        val = that.children('option[selected="selected"]').text();
        that.siblings('span').css('color','#000').text(val);
    });
    
    $('input.submit-btn.validate"').click(function(){
        var f = $(this).parents('form');
        var pass = standardValidation(f);
        if(pass == true){        
            f.submit();
        }
        return false;
    });
    
    $('input.dob').blur(function(){
        var dob = $('#tb-day').val()+'-'+$('#tb-month').val()+'-'+$('#tb-year').val();
        $('#application_dob').val(dob);
    });
    
    $('input.login-submit').click(function(){
        $(this).siblings('p.error').text('');
        if( $(this).siblings('input.username').val() == '' || $(this).siblings('input.username').val() == 'Username' || $(this).siblings('input.pwd').val() == '' || $(this).siblings('input.pwd').val() == 'Password'){
            $(this).siblings('p.error').text(window.loginError);
            return false;
        }     
    });
    
    $('.play-btn').click( function(e){
      e.preventDefault();

      var ytplayer = document.getElementById("myytplayer");

      //ytplayer = $("#myytplayer");

      ytplayer.playVideo();

      $(this).fadeOut(function(){
        $(".hide-video").css('visibility', 'visible');
      });
    });
    
});