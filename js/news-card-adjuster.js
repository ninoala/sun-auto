//this function adjusts the styling of the news post card
//depending on whether there is a featured image attached to the post

document.addEventListener("DOMContentLoaded", function() {
  var newsPosts = document.querySelectorAll('.news__post');

  if (window.innerWidth > 800) {
    newsPosts.forEach(function(post) {
      var thumbnail = post.querySelector('.attachment-news-portrait');
      var headingContainer = post.querySelector('.news__date-heading-container');
      var heading = headingContainer.querySelector('.heading-tertiary--news');

    if (!thumbnail) {
      heading.style.position = 'absolute';
      heading.style.left = '50%';
      heading.style.top = '50%';
      heading.style.transform = 'translate(-50%, -50%)';
      heading.style.width = '80%';
      heading.style.textAlign = 'center';
    }
    });
  }
});
