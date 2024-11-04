document.addEventListener('DOMContentLoaded', function () {
	const fadeUpElements = document.querySelectorAll('.fade-up');
	const fadeDownElements = document.querySelectorAll('.fade-down');
	const opacityElements = document.querySelectorAll('.appear');

	function checkVisibility(elements) {
		elements.forEach((element) => {
			const rect = element.getBoundingClientRect();
			const elementTop = rect.top;
			const elementBottom = rect.bottom;
			const triggerPoint = window.innerHeight * 0.9;
			const isVisible = elementTop < triggerPoint && elementBottom >= 0;

			if (isVisible) {
				element.classList.add('in-view');
			} else {
				element.classList.remove('in-view');
			}
		});
	}

	function checkAllVisibilities() {
		checkVisibility(fadeUpElements);
		checkVisibility(fadeDownElements);
		checkVisibility(opacityElements);
	}

	// Check on scroll and resize
	window.addEventListener('scroll', checkAllVisibilities);
	window.addEventListener('resize', checkAllVisibilities);

	// Ensure the initial visibility is checked after everything is set up
	checkAllVisibilities();
});
