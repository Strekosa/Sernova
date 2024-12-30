jQuery(document).ready(function ($) {
	const postsContainer = $('.resources__list-wrapp');
	const paginationContainer = $('.pagination-container');
	const filterButtons = $('.resources__taxonomy.filter-posts-button');
	const searchField = $('#resources-search-form .search-field');
	const scrollOffset = 100;
	let currentPage = 1;
	let currentFilter = 'all';
	let currentSearch = '';

	// Debounce function to limit the frequency of function execution
	function debounce(func, delay) {
		let timer;
		return function (...args) {
			clearTimeout(timer);
			timer = setTimeout(() => func.apply(this, args), delay);
		};
	}

	// Fetch posts via AJAX
	function fetchPosts(filter, search = '', page = 1) {
		$.ajax({
			url: themeVars.ajaxurl,
			type: 'POST',
			data: {
				action: 'filter_resources',
				filter: filter,
				search: search,
				page: page,
			},
			beforeSend: function () {
				postsContainer.html('<p>Loading...</p>');
			},
			success: function (response) {
				if (response.success) {
					postsContainer.html(response.data.posts);
					paginationContainer.html(response.data.pagination);

					// Scroll to the top of the posts container
					$('html, body').animate({
						scrollTop: postsContainer.offset().top - scrollOffset,
					}, 500);
				} else {
					postsContainer.html('<p>No posts found.</p>');
					paginationContainer.html('');
				}
			},
			error: function () {
				postsContainer.html('<p>Error loading posts.</p>');
			},
		});
	}

	// Handle pagination click events
	paginationContainer.on('click', '.pagination-link', function (e) {
		e.preventDefault();
		if ($(this).hasClass('current')) return;

		// Update the current page based on the clicked button
		const pageText = $(this).text().trim();
		currentPage = pageText === '»' ? currentPage + 1 : pageText === '«' ? currentPage - 1 : parseInt(pageText, 10);

		fetchPosts(currentFilter, currentSearch, currentPage);
	});

	// Handle filter button clicks
	filterButtons.on('click', function () {
		currentFilter = $(this).data('filter');
		currentSearch = searchField.val();
		currentPage = 1;

		// Update active state of filter buttons
		filterButtons.removeClass('active');
		$(this).addClass('active');

		fetchPosts(currentFilter, currentSearch, currentPage);
	});

	// Handle search field input with debounce
	searchField.on('input', debounce(function () {
		currentSearch = $(this).val();
		currentPage = 1;

		fetchPosts(currentFilter, currentSearch, currentPage);
	}, 300)); // 300ms delay for debouncing

	// Get query parameter from URL
	function getQueryParam(name) {
		const urlParams = new URLSearchParams(window.location.search);
		return urlParams.get(name);
	}

	// Check for initial category on page load
	const initialCategory = getQueryParam('category');
	if (initialCategory) {
		currentFilter = initialCategory;

		// Set active class for the filter button
		filterButtons.removeClass('active');
		filterButtons.each(function () {
			if ($(this).data('filter') === currentFilter) {
				$(this).addClass('active');
			}
		});

		fetchPosts(currentFilter, currentSearch, currentPage);
	}
});

// Shadow updates for taxonomy scrolling
document.addEventListener('DOMContentLoaded', function () {
	const heading = document.querySelector('.resources__heading-main');
	const taxonomies = document.querySelector('.resources__taxonomies');

	// Update shadows based on scroll position
	function updateShadows() {
		if (!taxonomies) return;

		const scrollLeft = taxonomies.scrollLeft;
		const scrollWidth = taxonomies.scrollWidth;
		const clientWidth = taxonomies.clientWidth;

		heading.classList.toggle('show-shadow-left', scrollLeft > 0);
		heading.classList.toggle('show-shadow-right', scrollLeft + clientWidth < scrollWidth);
	}

	if (taxonomies) {
		taxonomies.addEventListener('scroll', updateShadows);
		window.addEventListener('resize', updateShadows);
		updateShadows();
	}
});
