document.addEventListener('DOMContentLoaded', function () {
	"use strict";

	const body = document.body;
	const iconMenu = document.querySelector('.navbar-toggler');
	const menuBody = document.querySelector('.navbar-collapse');

	// Function for checking mobile devices
	const isMobile = {
		Android: () => navigator.userAgent.match(/Android/i),
		Opera: () => navigator.userAgent.match(/Opera Mini/i),
		Windows: () => navigator.userAgent.match(/IEMobile/i),
		BlackBerry: () => navigator.userAgent.match(/BlackBerry/i),
		iOS: () => navigator.userAgent.match(/iPhone|iPad|iPod/i),
		any: function () {
			return (
				this.Android() ||
				this.Opera() ||
				this.BlackBerry() ||
				this.iOS() ||
				this.Windows()
			);
		},
	};

	// Function to reset active submenus
	function resetActiveSubMenus() {
		const activeSubMenus = document.querySelectorAll('.sub-menu.active');
		const activeMenuArrows = document.querySelectorAll('.nav-desc.active');
		const activeMenuItems = document.querySelectorAll('.menu-item.active');

		activeSubMenus.forEach(subMenu => {
			subMenu.style.maxHeight = '0';
			subMenu.classList.remove('active');
		});

		activeMenuArrows.forEach(arrow => {
			arrow.classList.remove('active');
		});

		activeMenuItems.forEach(item => {
			item.classList.remove('active');
		});
	}

	// Logic for mobile devices
	if (isMobile.any()) {
		body.classList.add('_touch');
		const menuArrows = document.querySelectorAll('.nav-desc');

		menuArrows.forEach(arrow => {
			const subMenu = arrow.nextElementSibling;
			const parentMenuItem = arrow.parentElement;

			arrow.addEventListener('click', function () {
				const windowHeight = window.innerHeight;
				const maxMenuHeight = windowHeight - arrow.getBoundingClientRect().bottom;

				if (subMenu.style.maxHeight === '0px' || !subMenu.style.maxHeight) {
					const subMenuHeight = subMenu.scrollHeight;

					if (subMenuHeight > maxMenuHeight) {
						subMenu.style.maxHeight = maxMenuHeight + 'px';
						subMenu.style.overflowY = 'auto';
					} else {
						subMenu.style.maxHeight = subMenuHeight + 'px';
						subMenu.style.overflowY = 'hidden';
					}

					subMenu.classList.add('active');
					arrow.classList.add('active');
					parentMenuItem.classList.add('active');
				} else {
					subMenu.style.maxHeight = '0';
					subMenu.classList.remove('active');
					arrow.classList.remove('active');
					parentMenuItem.classList.remove('active');
				}
			});
		});
	} else {
		body.classList.add('_pc');
		const menuItems = document.querySelectorAll('.menu-item-has-children');

		menuItems.forEach(menuItem => {
			const arrow = menuItem.querySelector('.nav-desc');
			const subMenu = menuItem.querySelector('.sub-menu');

			arrow.addEventListener('click', function (e) {
				e.preventDefault();

				menuItems.forEach(item => {
					const otherArrow = item.querySelector('.nav-desc');
					const otherSubMenu = item.querySelector('.sub-menu');

					if (item !== menuItem) {
						otherArrow.classList.remove('active-hover');
						otherSubMenu.classList.remove('active-hover');
					}
				});

				if (arrow.classList.contains('active-hover')) {
					arrow.classList.remove('active-hover');
					subMenu.classList.remove('active-hover');
				} else {
					arrow.classList.add('active-hover');
					subMenu.classList.add('active-hover');
				}
			});
		});
	}

	// Logic for a burger menu
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
