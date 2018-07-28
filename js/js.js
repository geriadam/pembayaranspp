$(document).ready(function(){

	// script owl carousel slideshow
	var itemSlide = $(".item-slide");
	var newsPanel = $("#news-panel");
	var headerSlider = $('.item-slide');
	var headerBackground = $(".header-middle-background");

		itemSlide.owlCarousel({
		    loop:true,
		    items: 5,
		    dots: false,
		})
		newsPanel.owlCarousel({
		    center: true,
		    items:4,
		    loop:true,
		    margin:15,
		});
		headerBackground.owlCarousel({
	      	loop:true,
	      	dots:true,
		  	items: 1,
			center: true,
		  	autoplay:true,
	    	autoplayTimeout:2000,
    		autoplayHoverPause:true,
    		onChanged: callback,
		});

		function callback(event) {
		    var index = event.item.index;
		    var headerClass = $('#header-panel').attr('class');
		    if(index == 3){
		    	$("#header-panel").removeClass(headerClass);
		    	$("#header-panel").addClass("brown");
		    }
		    if(index == 4){
		    	$("#header-panel").removeClass(headerClass);
		    	$("#header-panel").addClass("orange");
		    }
		    if(index == 5){
		    	$("#header-panel").removeClass(headerClass);
		    	$("#header-panel").addClass("grey");
		    }
		    if(index == 6){
		    	$("#header-panel").removeClass(headerClass);
		    	$("#header-panel").addClass("red");
		    }
		    if(index == 7){
		    	$("#header-panel").removeClass(headerClass);
		    	$("#header-panel").addClass("black");
		    }
		}

		/*headerBackground.on('changed.owl.carousel', function(e) {
		    var color = ['brown','orange'];
		    var headerClass = $('#header-panel').attr('class');
		    $.each(color, function(index,value){
		    	if(headerClass == value){
		    		$("#header-panel").removeClass(headerClass);
		    		$("#header-panel").addClass(color[ Math.floor( Math.random()*color.length ) ] );
		    	}
		    });
		});

		/* untuk custome naviagasi slideshow */

		headerSlider.owlCarousel();
		newsPanel.owlCarousel();

		$('#news-nav-left').click(function() {
		    newsPanel.trigger('prev.owl.carousel', [300]);
		});
		$('#header-nav-left').click(function() {
		    headerSlider.trigger('prev.owl.carousel', [300]);
		});
		$("#news-nav-right").click(function() {
			newsPanel.trigger('next.owl.carousel');
		});
		$("#header-nav-right").click(function() {
			headerSlider.trigger('next.owl.carousel');
		});

	});

	/* untuk menu top muncul */
	$(window).on('scroll', function(){
		if($(window).scrollTop() > 150){
			$("#header-onscroll").css('display','block');
		} else { 
			$("#header-onscroll").css('display','none');
		}
	});	

	/* ketika menu about di mouseover dan mouseout */
	$(".nav-about").mouseover(function(){
		$(".mega-menu-about").addClass("dropdown");
	});
	$(".nav-about").mouseout(function(){
		$(".mega-menu-about").removeClass("dropdown");
	});

	/* ketika menu product di mouseover dan mouseout */
	$(".nav-product").mouseover(function(){
		$(".mega-menu-product").addClass("dropdown");
	});
	$(".nav-product").mouseout(function(){
		$(".mega-menu-product").removeClass("dropdown");
	});

/* untuk hover hover mouse */

/* on mouseover menu */
var isActiveMenu = 0;
function currentMenu(n) {
	activeMenu(isActiveMenu = n);
}

function activeMenu(n) {
	var i;
	var item = document.getElementsByClassName("nav"); 
	if(item != 'undefinied'){
		for (i = 0; i < item.length; i++) {
		    item[i].className = item[i].className.replace(" active", "");
		}
		item[isActiveMenu].className += " active";
	}
}
$(".nav").mouseout(function(){
	$(".nav").removeClass('active');
});

/* on mouseover brand item page index */
var isActiveBrandItem = 0;
function currentBrandIndex(n) {
	activeBrandIndex(isActiveBrandItem = n);
}

function activeBrandIndex(n) {
	var i;
	var item = document.getElementsByClassName("brand-item"); 
	if(item != 'undefinied'){
		for (i = 0; i < item.length; i++) {
		    item[i].className = item[i].className.replace(" active", "");
		}
		item[isActiveBrandItem].className += " active";
	}
}
$(".brand-item").mouseout(function(){
	$(".brand-item").removeClass('active');
});

/* on mouseover brand item page product oil */
var activeBrand = 0;
function currentBrandProduct(n) {
	activeBrandProduct(activeBrand = n);
}

function activeBrandProduct(n) {
	var i;
	var item = document.getElementsByClassName("product-oil-category-item");
	var productItem = document.getElementsByClassName("page-product-content-item");
	if(item != 'undefinied'){
		for (i = 0; i < item.length; i++) {
			if(productItem != "undefinied" && productItem.length != 0){
				productItem[i].className = productItem[i].className.replace(" active", "");
			}
		    item[i].className = item[i].className.replace(" active", "");
		}
		item[activeBrand].className += " active";
		if(productItem != "undefinied" && productItem.length != 0){
			productItem[activeBrand].className += " active";
		}
	}
}
$(".product-oil-category-item").mouseout(function(){
	$(".product-oil-category-item").removeClass('active');
	var productItem = $(".page-product-content-item");
	if(productItem != "undefinied" && productItem.length != 0){
		productItem.removeClass('active');
	}
});