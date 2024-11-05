document.addEventListener('DOMContentLoaded', function () {
	const serviceButtons = document.querySelectorAll('.square-btn--services');
	const hiringButton = document.querySelector('.menu-item-hiring a'); //select the "Hiring" menu item
	const presidentMessageButton = document.getElementById('menu-item-96'); //select the president message button in the header nav
	const openPopupButton = document.getElementById('openPopup');
	const popup = document.getElementById('popup');
	const popupClose = document.querySelector('.popup__close');
	const popupThumbnail = document.querySelector('.popup__thumbnail');
	const popupFlex = document.querySelector('.popup__flex-container');
	const popupTitle = document.querySelector('.popup__title');
	const popupText = document.querySelector('.popup__text');
	const popupLink = document.querySelector('.popup__link');

	function openPopupWithData(postId) {
		//fetch post data via AJAX
		fetch(custom_data.ajaxurl, {
			method: 'POST',
			headers: {
				'Content-Type':
					'application/x-www-form-urlencoded; charset=UTF-8',
			},
			body: new URLSearchParams({
				action: 'fetch_service_post',
				post_id: postId,
				nonce: custom_data.nonce, //include nonce
			}),
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					//ensure elements are found before trying to set properties
					if (
						popupThumbnail &&
						popupTitle &&
						popupText &&
						popupLink
					) {
						//reset any custom styles before applying specific ones
						popupThumbnail.style.width = '';
						popupThumbnail.style.position = '';
						popupThumbnail.style.top = '';
						popupThumbnail.style.left = '';

						//populate the popup with fetched data
						popupThumbnail.src = data.data.featured_image_url;
						popupTitle.innerText = data.data.title;
						popupText.innerHTML = data.data.popup_text;
						popupLink.href = data.data.link;
						popupLink.innerHTML = data.data.button_text;

						//show or hide the link button based on the postId
						if (postId === '114' || postId === '186') {
							popupLink.style.display = 'none';
						} else {
							popupLink.style.display = 'block';
						}

						//apply custom class for postId === '138'
						if (postId === '138') {
							popupThumbnail.classList.add(
								'cash-register-thumbnail'
							);
						} else {
							popupThumbnail.classList.remove(
								'cash-register-thumbnail'
							);
						}

						//apply custom class for postId 52
						if (postId === '52') {
							popupThumbnail.classList.add('car-sales-thumbnail');
						} else {
							popupThumbnail.classList.remove(
								'car-sales-thumbnail'
							);
						}

						//apply custom styles for the 'president message' popup
						if (postId === '186') {
							popupThumbnail.style.width = '40%';
							popupThumbnail.style.float = 'none';
							popupText.style.backgroundColor = '#E5DCD2';
							popupText.style.width = '60%';
							popupText.style.padding = '2.5rem 5rem';
							popupText.style.borderRadius = '100px';
							popupFlex.style.display = 'flex';
							popupFlex.style.flexDirection = 'row-reverse';
							popupFlex.style.justifyContent = 'center';
							popupFlex.style.alignItems = 'center';
							popupText.style.fontSize = '1.85rem';
							popupText.style.fontWeight = '700';
						} else {
							popupThumbnail.style.width = '';
							popupThumbnail.style.float = '';
							popupText.style.backgroundColor = '';
							popupText.style.width = '';
							popupText.style.borderRadius = '';
							popupFlex.style.display = '';
							popupFlex.style.flexDirection = '';
							popupFlex.style.justifyContent = '';
							popupFlex.style.alignItems = '';
							popupText.style.fontSize = '';
							popupText.style.fontWeight = '';
						}

						//show the popup
						popup.classList.add('visible');
						document.body.classList.add('no-scroll'); //prevent background scrolling
					} else {
						console.error('Popup elements not found');
					}
				} else {
					console.error('Post not found');
				}
			})
			.catch((error) => console.error('Error fetching data:', error));
	}

	serviceButtons.forEach((button) => {
		button.addEventListener('click', function (event) {
			event.preventDefault();
			const postId = this.getAttribute('data-id');
			openPopupWithData(postId);
		});
	});

	//add event listener for the "社長メッセージ" button
	if (openPopupButton) {
		openPopupButton.addEventListener('click', function (event) {
			event.preventDefault();
			const specificPostId = '186';
			openPopupWithData(specificPostId);
		});
	} else {
		console.error('"社長メッセージ" button not found');
	}

	//add event listener for the "社長メッセージ" button in header nav
	if (presidentMessageButton) {
		presidentMessageButton.addEventListener('click', function (event) {
			event.preventDefault();
			const specificPostId = '186';
			openPopupWithData(specificPostId);
		});
	} else {
		console.error('"社長メッセージ" button not found');
	}

	//add event listener for the "Hiring" menu item
	if (hiringButton) {
		hiringButton.addEventListener('click', function (event) {
			event.preventDefault();
			const hiringPostId = '122'; // Replace with the actual post ID for the hiring info
			openPopupWithData(hiringPostId);
		});
	} else {
		console.error('Hiring menu item not found');
	}

	//close the popup
	if (popupClose) {
		popupClose.addEventListener('click', function (event) {
			event.preventDefault();
			popup.classList.remove('visible');
			document.body.classList.remove('no-scroll');
		});
	} else {
		console.error('Popup close button not found');
	}

	//close popup when clicking outside of it
	popup.addEventListener('click', function (event) {
		if (event.target === popup) {
			popup.classList.remove('visible');
			document.body.classList.remove('no-scroll');
		}
	});
});
