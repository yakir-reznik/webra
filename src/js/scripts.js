$(document).ready(function(){

	setup_burger_button();
	setup_scroller_links();

});

function setup_burger_button(){
	$('#burger-button').clickAndEnter(function(){
		$('#burger-button').toggleClass('active');
	});
}

function setup_scroller_links(){
	$('*[data-scroll-target]').clickAndEnter(function(){
		console.log($(this).attr('data-scroll-target'));
		$(window).scrollTo( $(this).attr('data-scroll-target') , 300, { offset: { top: -86 } });
	});
}