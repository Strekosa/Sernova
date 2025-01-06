jQuery(document).ready(() => {
	jQuery('.brands-slider').slick({
		dots: false,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 0,
		speed: 5000,
		infinite: true,
		centerMode: false,
		cssEase: 'linear',
		easing: 'ease',
		variableWidth: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		pauseOnHover: false,
		pauseOnFocus: false,
		swipe: false,
	});
});
