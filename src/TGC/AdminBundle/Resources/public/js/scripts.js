$(document).ready(function() {
	

	$('#logos .slider').bxSlider({
		pager:false,
		controls:false,
		speed: 4000,
		auto:true,
		pause:3000	
	});
	
	$('.toggle-nav').click(function() {
		$('#main-nav').toggleClass('opened');
		$('#main-nav ul').css({
			width: $('body').width() + 'px'
		});
	});
	
	//Accordion
	var allPanels = $('.accordion .accordion-content').hide();
	$('.accordion .accordion-content.active').show();
	$('.accordion .accordion-title a').click(function() {
	    allPanels.slideUp();
	    $(this).parent().next().slideDown();
	    return false;
	});
	
	//tabs
	var allTabPanels = $('.tabs .tab-content').hide();
	$('.tabs .tab-content.active').show();
	$('.tabs .tabs-nav a').click(function() {
		var target = $(this).attr('href');
	    allTabPanels.hide();
	    $(target).fadeIn();
	    $(this).parent().addClass('active').siblings().removeClass('active');
	    return false;
	});
	
	$('select').select2();
	
});

document.createElement("article");
document.createElement("footer");
document.createElement("header");
document.createElement("hgroup");
document.createElement("nav");
document.createElement("aside");
document.createElement("section");
document.createElement("figure");
document.createElement("figcaption");

