document.addEventListener("DOMContentLoaded", function () {
	const lists = document.querySelectorAll(".features__list");

	lists.forEach((list) => {
		const items = Array.from(list.children);

		const columnCount = 2;
		const rows = Math.ceil(items.length / columnCount);

		// Создаём новую структуру
		const reorderedItems = [];
		for (let i = 0; i < rows; i++) {
			for (let j = 0; j < columnCount; j++) {
				const index = i + j * rows;
				if (items[index]) {
					reorderedItems.push(items[index]);
				}
			}
		}

		// Очищаем и вставляем элементы в новом порядке
		list.innerHTML = "";
		reorderedItems.forEach((item) => list.appendChild(item));
	});
});
