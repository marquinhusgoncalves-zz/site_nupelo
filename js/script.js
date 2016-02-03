$(function(){   
	var nav = $('header');   
	$(window).scroll(function () { 
		if ($(this).scrollTop() > 150) { 
			nav.addClass("menu-fixo");
		} else { 
			nav.removeClass("menu-fixo"); 
		} 
	});  
});

$(function() {
	$('#navigation a').stop().animate({'marginLeft':'-85px'},1000);
	$('#navigation > li').hover(
		function () {
			$('a',$(this)).stop().animate({'marginLeft':'-2px'},200);
		},
		function () {
			$('a',$(this)).stop().animate({'marginLeft':'-85px'},200);
		}
	);
});

$(document).ready(function() {
	function filterPath(string) {
		return string
		.replace(/^\//,'')
		.replace(/(index|default).[a-zA-Z]{3,4}$/,'')
		.replace(/\/$/,'');
	}
	$('a[href*=#]').each(function() {
		if ( filterPath(location.pathname) == filterPath(this.pathname)
			&& location.hostname == this.hostname
			&& this.hash.replace(/#/,'') ) {
			var $targetId = $(this.hash), $targetAnchor = $('[name=' + this.hash.slice(1) +']');
		var $target = $targetId.length ? $targetId : $targetAnchor.length ? $targetAnchor : false;
			if ($target) {
				var targetOffset = $target.offset().top;
				$(this).click(function() {
					$('html, body').animate({scrollTop: targetOffset}, 1000);
					return false;
				});
			}
		}
	});
});
if(screen.width > 992){ 
   $('.multiple-items').slick({
  infinite: true,
  autoplay: true,
  slidesToShow: 3,
  slidesToScroll: 3,
  dots: false,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
      	autoplaySpeed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
}