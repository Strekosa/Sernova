jQuery(document).ready(function ($) {
	const filterButtons = $('.careers__taxonomy.filter-button');
	const postList = $('.careers__list-wrapp');

	filterButtons.on('click', function () {
		const filterValue = $(this).data('filter');
		filterButtons.removeClass('active');
		$(this).addClass('active');

		$.ajax({
			url: themeVars.ajaxurl,
			type: 'POST',
			data: {
				action: 'filter_careers',
				filter: filterValue,
			},
			beforeSend: function () {
				postList.html('<p>Loading...</p>');
			},
			success: function (response) {
				postList.html(response);
			},
			error: function () {
				postList.html('<p>Error loading posts</p>');
			},
		});
	});
});

document.addEventListener('DOMContentLoaded', function () {
	const heading = document.querySelector('.careers__heading');
	const taxonomies = document.querySelector('.careers__taxonomies');

	function updateShadows() {
		const scrollLeft = taxonomies.scrollLeft;
		const scrollWidth = taxonomies.scrollWidth;
		const clientWidth = taxonomies.clientWidth;

		if (scrollLeft > 0) {
			heading.classList.add('show-shadow-left');
		} else {
			heading.classList.remove('show-shadow-left');
		}

		if (scrollLeft + clientWidth < scrollWidth) {
			heading.classList.add('show-shadow-right');
		} else {
			heading.classList.remove('show-shadow-right');
		}
	}

	taxonomies.addEventListener('scroll', updateShadows);
	window.addEventListener('resize', updateShadows);

	updateShadows();
});
