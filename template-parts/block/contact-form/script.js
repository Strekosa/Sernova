
jQuery(document).ready(function () {
	const submit = document.querySelectorAll('.wpcf7-submit');
	submit.forEach(element => {
		const parentElement = element.parentElement;
		parentElement.classList.add('form-submit');
	});
});

// Contact form
document.addEventListener('DOMContentLoaded', function () {
	//Finding all form fields Contact Form 7
	const formFields = document.querySelectorAll('.wpcf7-form input, .wpcf7-form textarea, .wpcf7-form select');

	formFields.forEach(function (field) {
		field.addEventListener('input', function () {
			if (field.value.trim() !== '') {
				field.classList.add('filled');
			} else {
				field.classList.remove('filled');
			}
		});

		// Checking pre-filled data when loading the page
		if (field.value.trim() !== '') {
			field.classList.add('filled');
		}
	});

	//Select2
	const selectFields = document.querySelectorAll('.wpcf7-form select');
	selectFields.forEach(function (select) {
		//Dynamically getting the first value (placeholder)
		const defaultPlaceholder = select.querySelector('option').value;

		// Add the 'filled' class when selecting a value via Select2
		$(select).on('select2:select', function () {
			const selectedValue = $(this).val();
			if (selectedValue !== defaultPlaceholder) {
				$(this).next('.select2-container').find('.select2-selection--single').addClass('filled').removeClass('not-valid');

				//Remove the error message if there is one
				const errorTip = $(this).closest('.form-row').find('.wpcf7-not-valid-tip');
				if (errorTip.length) {
					errorTip.remove();
				}
			}
		});

		//Remove the 'filled' class if the value is cleared or placeholder is selected
		$(select).on('select2:unselect', function () {
			if ($(this).val() === null || $(this).val().trim() === '' || $(this).val() === defaultPlaceholder) {
				$(this).next('.select2-container').find('.select2-selection--single').removeClass('filled');
			}
		});

		//Dynamic validation on page load
		const currentValue = $(select).val();
		if (currentValue !== null && currentValue.trim() !== '' && currentValue !== defaultPlaceholder) {
			$(select).next('.select2-container').find('.select2-selection--single').addClass('filled');
		}
	});

	// Listening to the Contact Form 7 form being sent
	document.querySelectorAll('.wpcf7-form').forEach(function (form) {
		form.addEventListener('submit', function (event) {
			//Find all required Select2 fields
			const requiredSelects = form.querySelectorAll('select.wpcf7-validates-as-required');

			requiredSelects.forEach(function (select) {
				const selectedValue = $(select).val();
				const defaultPlaceholder = select.querySelector('option').value;

				// If the value is not selected or it is a placeholder, add the 'not-valid' class
				if (selectedValue === null || selectedValue === '' || selectedValue === defaultPlaceholder) {
					const selectContainer = $(select).next('.select2-container').find('.select2-selection--single');
					selectContainer.addClass('not-valid');

					// Add an error message if there is none already
					if (!$(select).closest('.form-row').find('.wpcf7-not-valid-tip').length) {
						const errorTip = $('<span class="wpcf7-not-valid-tip">This field is required.</span>');
						$(select).closest('.form-row').append(errorTip);
					}
				} else {
					// If the field is full, remove the 'not-valid' class and the error message
					$(select).next('.select2-container').find('.select2-selection--single').removeClass('not-valid');
					const errorTip = $(select).closest('.form-row').find('.wpcf7-not-valid-tip');
					if (errorTip.length) {
						errorTip.remove();
					}
				}
			});
		});
	});

	document.addEventListener('wpcf7mailsent', function (event) {
		const form = event.target;

		setTimeout(function() {
			form.reset();

			form.querySelectorAll('.filled').forEach(function (field) {
				field.classList.remove('filled');
			});

			form.querySelectorAll('input[name="your-tel"], input[name="your-fax"]').forEach(function (inputField) {
				const originalPlaceholder = inputField.getAttribute('placeholder');
				inputField.value = '';
				inputField.placeholder = originalPlaceholder;
				inputField.classList.remove('filled');
			});

			form.querySelectorAll('select').forEach(function (select) {
				const defaultPlaceholder = select.querySelector('option').value;
				$(select).val(defaultPlaceholder).trigger('change');
				$(select).next('.select2-container').find('.select2-selection--single').removeClass('filled not-valid');
			});
		}, 15000);
	});

});

// Logic for telephone and fax fields
document.addEventListener('DOMContentLoaded', function () {
	const telInputs = document.querySelectorAll('input[name="your-tel"], input[name="your-fax"]');

	const minDigits = 7;  // For city numbers
	const maxDigits = 15; // For mobile numbers and international

	telInputs.forEach(function (inputField) {
		const originalPlaceholder = inputField.placeholder;

		// Automatically add + on focus
		inputField.addEventListener('focus', function () {
			if (!this.value.startsWith('+ ')) {
				this.value = '+ ';
			}
			// this.placeholder = '';
		});

		// Restoring placeholder when focus is lost, if the field is empty or less than the minimum number of digits is entered
		inputField.addEventListener('blur', function () {
			const numericValue = this.value.replace(/\D/g, ''); // leave only numbers
			if (numericValue.length < minDigits) {
				this.placeholder = originalPlaceholder;
				this.value = '';
				this.classList.remove('filled'); // Remove the filled class if the field is empty again
			}
		});

		// Allows you to enter and delete any characters
		inputField.addEventListener('input', function () {
			let inputValue = this.value;

			// allow you to completely remove everything, including +
			if (inputValue === '' || inputValue === '+ ') {
				this.value = '';
				this.classList.remove('filled');
				return; // interrupt further processing
			}

			// Remove all characters except numbers and spaces
			inputValue = inputValue.replace(/[^+\d\s]/g, '');

			// Check if + was removed, add it again
			if (!inputValue.startsWith('+')) {
				inputValue = '+ ' + inputValue;
			}

			this.value = inputValue;

			// Add or remove the filled class depending on the number of entered digits
			const numericValue = this.value.replace(/\D/g, '');
			if (numericValue.length >= minDigits) {
				this.classList.add('filled');
			} else {
				this.classList.remove('filled');
			}
		});
	});
});
