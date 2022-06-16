$(document).ready(function(){
    "use strict";
	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
    fullHeight();

    //dealing with sidebar hide and show
	$('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('.custom-menu').toggleClass('active');

    });

    //dealing with submenu
    $('.submenu').on('click', function () {
        var target=$(this).attr("data-target");
        $('#'+target).slideToggle();
    });
});
