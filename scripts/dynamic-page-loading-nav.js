

$(document).ready(function() {
	// Define event listener on navigation links
	$('.').on('click', function(e) {
		// Prevent default link behavior
		e.preventDefault();

		// Get the URL of the new page
		var url = $(this).attr('href');

		// Send an AJAX request to the server
		$.ajax({
			url: url,
			method: 'GET'
		}).done(function(data) {
			// Update the content of the main element with the new page content
			$('#content').html(data);

            console.log('alas');


			// Update the browser history with the new URL
			history.pushState(null, null, url);
		}).fail(function(xhr, textStatus, errorThrown) {
            // Log any errors to the console
            console.error(xhr, textStatus, errorThrown);
        });
	});

	// Define event listener for popstate event (when user clicks back or forward button)
	window.addEventListener('popstate', function(e) {
		// Get the URL of the current page
		var url = window.location.href;

        console.log('popstate event triggered with URL:', url);

		// Send an AJAX request to the server to fetch the page content
		$.ajax({
			url: url,
			method: 'GET'
		}).done(function(data) {
			// Update the content of the main element with the new page content
			$('#content').html(data);
		});
	});
});
