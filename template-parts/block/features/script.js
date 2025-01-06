document.addEventListener("DOMContentLoaded", function () {
	function reorderItemsForLargeScreens() {
		if (window.innerWidth >= 577) {
			const lists = document.querySelectorAll(".features__list");

			lists.forEach((list) => {
				const items = Array.from(list.children);
				const columnCount = 2;
				const rows = Math.ceil(items.length / columnCount);

				const reorderedItems = [];
				for (let i = 0; i < rows; i++) {
					for (let j = 0; j < columnCount; j++) {
						const index = i + j * rows;
						if (items[index]) {
							reorderedItems.push(items[index]);
						}
					}
				}

				list.innerHTML = "";
				reorderedItems.forEach((item) => list.appendChild(item));
			});
		}
	}


	reorderItemsForLargeScreens();
	window.addEventListener("resize", reorderItemsForLargeScreens);
});
