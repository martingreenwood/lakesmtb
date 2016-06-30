var $j = jQuery;

//Slick SLider

$j(document).ready(function(){
  
	$j('.slides').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 7000,
		nextArrow: '<i class="fa fa-chevron-right"></i>',
  		prevArrow: '<i class="fa fa-chevron-left"></i>',
	});
});



