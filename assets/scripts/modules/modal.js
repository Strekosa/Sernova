document.addEventListener('DOMContentLoaded', function () {
	const openButtons = document.querySelectorAll('.open-modal-button');
	const modals = document.querySelectorAll('.modal');
	const closeButtons = document.querySelectorAll('.modal-close');
	const body = document.body; // The body element

	// Function to close the modal
	function closeModal(modal) {
		if (modal) {
			modal.classList.remove('visible');
			modal.classList.add('hidden');
			body.classList.remove('modal-open'); // Remove the 'modal-open' class
		}
	}

	// Open the modal
	openButtons.forEach(button => {
		button.addEventListener('click', function (event) {
			event.preventDefault();
			const modalId = button.getAttribute('href').substring(1);
			const targetModal = document.getElementById(modalId);

			if (targetModal) {
				targetModal.classList.remove('hidden');
				targetModal.classList.add('visible');
				body.classList.add('modal-open'); // Add the 'modal-open' class
			}
		});
	});

	// Close the modal (when clicking the close button)
	closeButtons.forEach(button => {
		button.addEventListener('click', function () {
			const modal = button.closest('.modal');
			closeModal(modal);
		});
	});

	// Close the modal (when clicking outside the modal content)
	modals.forEach(modal => {
		modal.addEventListener('click', function (event) {
			if (event.target === modal) {
				closeModal(modal);
			}
		});
	});

	// Close the modal (when pressing the Escape key)
	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape') {
			modals.forEach(modal => {
				if (modal.classList.contains('visible')) {
					closeModal(modal);
				}
			});
		}
	});
});
