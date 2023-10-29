for(const button of document.querySelectorAll(".desplegable")) {
	button.addEventListener("click", event => {
		/**
		 * @type {HTMLUListElement}
		 */
		const list = event.target.parentElement.parentElement.parentElement.querySelector("ul");
		console.log(list.display, list)

		if (list.style.display === "none") {
			list.style.display = '';
			button.style="transform: rotate(0deg)";
		} else {
			list.style.display = 'none'
			button.style="transform: rotate(-90deg)";
		}
	});
	button.dispatchEvent(new Event('click'))
}