// import external dependencies
localStorage.clear();
sessionStorage.clear();

import "jquery"

// Import everything from autoload
import "./autoload/**/*"
import 'slick-carousel';

// Import everything from modules
import "./modules/modal"
import "./modules/menu"


document.addEventListener("DOMContentLoaded", function () {
	localStorage.clear();
	sessionStorage.clear();
	console.log("localStorage and sessionStorage cleared on page load");

	(function () {
		const originalSetItem = localStorage.setItem;
		localStorage.setItem = function (key, value) {
			if (key === 'LogLevel') {
				console.warn(`Blocked storage of LogLevel: ${value}`);
				return;
			}
			try {
				originalSetItem.apply(this, arguments);
			} catch (e) {
				if (e.name === 'QuotaExceededError') {
					console.error(`Quota exceeded for key "${key}"`);
				}
			}
		};
	})();

	function isAppleDevice() {
		return /iPhone|iPad|iPod|Macintosh/.test(navigator.userAgent);
	}

	var phoneLinks = document.querySelectorAll('.dynamic-phone-link');

	phoneLinks.forEach(function (link) {
		var phoneNumber = link.getAttribute('data-phone');
		if (isAppleDevice()) {
			link.setAttribute('href', 'facetime:' + phoneNumber);
		} else {
			link.setAttribute('href', 'tel:' + phoneNumber);
		}
	});
});


document.addEventListener('scroll', function () {
	const backtop = document.getElementById('backtop');

	if (window.scrollY > 100) {
		backtop.classList.add('visible');
	} else {
		backtop.classList.remove('visible');
	}
});


document.addEventListener('DOMContentLoaded', function() {
	const backtopLink = document.querySelector('#backtop a');

	if (backtopLink) {
		backtopLink.addEventListener('click', function(e) {
			e.preventDefault();
			window.scrollTo({
				top: 0,
				behavior: 'smooth',
			});
		});
	}
});

/////////////Search////////////////////////////////////////////////////////////////////
document.addEventListener('DOMContentLoaded', function () {
	const searchForm = document.querySelector('.header__search-form');
	const searchField = searchForm.querySelector('.search-field');
	const searchIcon = searchForm.querySelector('svg');

	searchIcon.addEventListener('click', function (event) {
		event.preventDefault();
		searchForm.classList.toggle('active');
		searchField.focus();
	});

	document.addEventListener('click', function (event) {
		if (!searchForm.contains(event.target)) {
			searchForm.classList.remove('active');
		}
	});
});


/////////////////////////////////////////
function findAndHighlightText(node, highlightWord) {
	if (node.nodeType === Node.TEXT_NODE) {
		const regex = new RegExp(`(${highlightWord})`, 'gi');
		if (node.textContent.match(regex)) {
			const span = document.createElement('span');
			span.innerHTML = node.textContent.replace(regex, '<mark style="background-color: yellow;">$1</mark>');
			node.replaceWith(span);
		}
	} else if (node.nodeType === Node.ELEMENT_NODE && node.childNodes) {
		node.childNodes.forEach((child) => findAndHighlightText(child, highlightWord));
	}
}

document.addEventListener('DOMContentLoaded', function () {
	const urlParams = new URLSearchParams(window.location.search);
	const highlightWord = urlParams.get('highlight');

	if (highlightWord) {
		findAndHighlightText(document.body, highlightWord);

		const firstMatch = document.querySelector('mark');
		if (firstMatch) {
			firstMatch.scrollIntoView({ behavior: 'smooth', block: 'center' });
		}
	}
});
