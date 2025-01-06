document.addEventListener('DOMContentLoaded', function () {
	"use strict";

	const body = document.body;

	// Function to check for large touchscreen or hybrid devices
	const isLargeTouchScreen = () => {
		return ('ontouchstart' in window || navigator.maxTouchPoints > 1) && window.innerWidth > 1024;
	};

	// Function to reset active submenus
	function resetActiveSubMenus() {
		const activeSubMenus = document.querySelectorAll('.sub-menu.active-hover');
		activeSubMenus.forEach(subMenu => {
			subMenu.style.maxHeight = '0';
			subMenu.classList.remove('active-hover');
		});
	}

	// Logic for large touchscreens and hybrid devices
	if (isLargeTouchScreen()) {
		body.classList.add('_hybrid');

		const menuItems = document.querySelectorAll('.menu-item-has-children');

		menuItems.forEach(menuItem => {
			const subMenu = menuItem.querySelector('.sub-menu');

			// Hover logic
			menuItem.addEventListener('mouseenter', function () {
				subMenu.classList.add('active-hover');
				subMenu.style.maxHeight = subMenu.scrollHeight + 'px';
			});

			menuItem.addEventListener('mouseleave', function () {
				subMenu.classList.remove('active-hover');
			});

			// Click logic
			menuItem.addEventListener('click', function (e) {
				e.stopPropagation(); // Prevent conflicts with hover
				if (subMenu.classList.contains('active-hover')) {
					subMenu.classList.remove('active-hover');
				} else {
					resetActiveSubMenus();
					subMenu.style.maxHeight = subMenu.scrollHeight + 'px';
					subMenu.classList.add('active-hover');
				}
			});
		});
	} else if (window.innerWidth <= 1024) {
		// Logic for mobile devices
		body.classList.add('_touch');

		const menuArrows = document.querySelectorAll('.nav-desc');

		menuArrows.forEach(arrow => {
			const subMenu = arrow.nextElementSibling;

			arrow.addEventListener('click', function () {
				if (subMenu.style.maxHeight === '0px' || !subMenu.style.maxHeight) {
					subMenu.style.maxHeight = subMenu.scrollHeight + 'px';
					subMenu.classList.add('active-hover');
				} else {
					subMenu.style.maxHeight = '0';
					subMenu.classList.remove('active-hover');
				}
			});
		});
	} else {
		// Logic for desktops
		body.classList.add('_pc');

		const menuItems = document.querySelectorAll('.menu-item-has-children');

		menuItems.forEach(menuItem => {
			const arrow = menuItem.querySelector('.nav-desc');
			const subMenu = menuItem.querySelector('.sub-menu');

			arrow.addEventListener('click', function (e) {
				e.preventDefault();

				if (subMenu.classList.contains('active-hover')) {
					subMenu.style.maxHeight = '0';
					subMenu.classList.remove('active-hover');
				} else {
					resetActiveSubMenus();
					subMenu.style.maxHeight = subMenu.scrollHeight + 'px';
					subMenu.classList.add('active-hover');
				}
			});
		});
	}

	// Logic for a burger menu
	const iconMenu = document.querySelector('.navbar-toggler');
	const menuBody = document.querySelector('.navbar-collapse');

	if (iconMenu) {
		iconMenu.addEventListener('click', function () {
			body.classList.toggle('lock');
			iconMenu.classList.toggle('open');
			menuBody.classList.toggle('open');

			if (!iconMenu.classList.contains('open')) {
				resetActiveSubMenus();
			}
		});

		const navLinks = menuBody.querySelectorAll('a');
		navLinks.forEach(link => {
			link.addEventListener('click', function () {
				body.classList.remove('lock');
				iconMenu.classList.remove('open');
				menuBody.classList.remove('open');
				resetActiveSubMenus();
			});
		});
	}
});
