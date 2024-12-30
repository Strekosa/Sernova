jQuery(document).ready(() => {

	// Menu
	"use strict"
	const isMobile = {
		Android: function () {
			return navigator.userAgent.match(/Android/i);
		},
		Opera: function () {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function () {
			return navigator.userAgent.match(/IEMobile/i);
		},
		BlackBerry: function () {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function () {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		any: function () {
			return (
				isMobile.Android() ||
				isMobile.Opera() ||
				isMobile.BlackBerry() ||
				isMobile.iOS() ||
				isMobile.Windows()
			);
		},
	}

	if (isMobile.any()) {
		document.body.classList.add('_touch');

		let menuArrows = document.querySelectorAll('.nav-desc');
		if (menuArrows.length > 0) {
			for (let i = 0; i < menuArrows.length; i++) {
				let thisArrow = menuArrows[i];
				let subMenu = menuArrows[i].nextElementSibling;
				let parentMenuItem = menuArrows[i].parentElement;

				// Add smooth transition in CSS
				// subMenu.style.transition = 'max-height 0.3s ease';
				// subMenu.style.overflow = 'hidden';
				// subMenu.style.maxHeight = '0';

				thisArrow.addEventListener("click", function () {
					const windowHeight = window.innerHeight; // Высота окна

					const maxMenuHeight = windowHeight - thisArrow.getBoundingClientRect().bottom;

					if (subMenu.style.maxHeight === '0px' || !subMenu.style.maxHeight) {
						let subMenuHeight = subMenu.scrollHeight;

						if (subMenuHeight > maxMenuHeight) {
							subMenu.style.maxHeight = maxMenuHeight + 'px';
							subMenu.style.overflowY = 'auto';
						} else {
							subMenu.style.maxHeight = subMenuHeight + 'px';
							subMenu.style.overflowY = 'hidden';
						}

						subMenu.classList.add('active');
						thisArrow.classList.add('active');
						parentMenuItem.classList.add('active');
					} else {
						subMenu.style.maxHeight = '0';
						subMenu.classList.remove('active');
						thisArrow.classList.remove('active');
						parentMenuItem.classList.remove('active');
					}
				});
			}
		}
	} else {
		document.body.classList.add('_pc');

		let menuItems = document.querySelectorAll('.menu-item-has-children');
		menuItems.forEach(function (menuItem) {
			let thisArrow = menuItem.querySelector('.nav-desc');
			let subMenu = menuItem.querySelector('.sub-menu');
			// let link = menuItem.querySelector('a');

			thisArrow.addEventListener("click", function (e) {
				e.preventDefault();

				menuItems.forEach(function (item) {
					let otherArrow = item.querySelector('.nav-desc');
					let otherSubMenu = item.querySelector('.sub-menu');
					if (item !== menuItem) {
						otherArrow.classList.remove('active-hover');
						otherSubMenu.classList.remove('active-hover');
					}
				});

				if (thisArrow.classList.contains('active-hover')) {
					thisArrow.classList.remove('active-hover');
					subMenu.classList.remove('active-hover');
				} else {
					thisArrow.classList.add('active-hover');
					subMenu.classList.add('active-hover');
				}
			});

		});
	}

	// Menu Burger
	const iconMenu = document.querySelector('.navbar-toggler');
	if (iconMenu) {
		const menuBody = document.querySelector('.navbar-collapse');
		iconMenu.addEventListener("click", function () {
			document.body.classList.toggle('lock');
			iconMenu.classList.toggle('open');
			menuBody.classList.toggle('open');

			if (!iconMenu.classList.contains('open')) {
				let activeSubMenus = document.querySelectorAll('.sub-menu.active');
				let activeMenuArrows = document.querySelectorAll('.nav-desc.active');
				let activeMenuItems = document.querySelectorAll('.menu-item.active');

				activeSubMenus.forEach(function (subMenu) {
					subMenu.style.maxHeight = '0';
					subMenu.classList.remove('active');
				});

				activeMenuArrows.forEach(function (arrow) {
					arrow.classList.remove('active');
				});

				activeMenuItems.forEach(function (item) {
					item.classList.remove('active');
				});
			}
		});

		const navLinks = menuBody.querySelectorAll('a');
		for (let i = 0; i < navLinks.length; i++) {
			navLinks[i].addEventListener('click', function () {
				document.body.classList.remove('lock');
				iconMenu.classList.remove('open');
				menuBody.classList.remove('open');

				let activeSubMenus = document.querySelectorAll('.sub-menu.active');
				let activeMenuArrows = document.querySelectorAll('.nav-desc.active');
				let activeMenuItems = document.querySelectorAll('.menu-item.active');

				activeSubMenus.forEach(function (subMenu) {
					subMenu.style.maxHeight = '0';
					subMenu.classList.remove('active');
				});

				activeMenuArrows.forEach(function (arrow) {
					arrow.classList.remove('active');
				});

				activeMenuItems.forEach(function (item) {
					item.classList.remove('active');
				});
			});
		}
	}
});
