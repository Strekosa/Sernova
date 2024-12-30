document.addEventListener('DOMContentLoaded', function () {
	const fileInput = document.getElementById('custom-file');

	if (fileInput) {
		const fileWrap = fileInput.closest('.wpcf7-form-control-wrap[data-name="your-file"]');

		if (fileWrap) {
			fileInput.addEventListener('click', function (event) {
				event.stopPropagation();
			});

			fileWrap.addEventListener('click', function () {
				fileInput.click();
			});

			fileInput.addEventListener('change', function () {
				if (fileInput.files.length > 0) {
					fileWrap.classList.add('chosen');
				} else {
					fileWrap.classList.remove('chosen');
				}
			});
		}
	}
});
