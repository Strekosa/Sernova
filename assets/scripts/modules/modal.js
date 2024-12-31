document.addEventListener('DOMContentLoaded', function () {
	const openButtons = document.querySelectorAll('.open-modal-button');
	const modals = document.querySelectorAll('.modal');
	const closeButtons = document.querySelectorAll('.modal-close');
	const body = document.body;

	// Function to handle modal state (open/close)
	function toggleModal(modal, action) {
		if (modal) {
			if (action === 'open') {
				modal.classList.remove('hidden');
				modal.classList.add('visible');
				body.classList.add('modal-open');
			} else if (action === 'close') {
				modal.classList.remove('visible');
				modal.classList.add('hidden');
				body.classList.remove('modal-open');
			}
		}
	}

	// Event listener for opening modals
	openButtons.forEach(button => {
		button.addEventListener('click', function (event) {
			event.preventDefault();
			const modalId = button.getAttribute('href').substring(1);
			const targetModal = document.getElementById(modalId);
			toggleModal(targetModal, 'open');
		});
	});

	// Event listener for closing modals with close buttons
	closeButtons.forEach(button => {
		button.addEventListener('click', function () {
			const modal = button.closest('.modal');
			toggleModal(modal, 'close');
		});
	});

	// Event listener for closing modals by clicking outside modal content
	modals.forEach(modal => {
		modal.addEventListener('click', function (event) {
			if (event.target === modal) {
				toggleModal(modal, 'close');
			}
		});
	});

	// Event listener for closing modals with Escape key
	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape') {
			modals.forEach(modal => {
				if (modal.classList.contains('visible')) {
					toggleModal(modal, 'close');
				}
			});
		}
	});
});
