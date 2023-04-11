$(document).ready(function() {
    // Define event listener on navigation links

    // $('.sid').off('click');

    $(document).on('click', '.sid', function(e) {
        // Prevent default link behavior
        e.preventDefault();

        // Get the URL of the new page from the sidebar
        var url = $(this).attr('href');

        // Send an AJAX request to the server
        $.ajax({
            url: url,
            method: 'GET'
        }).done(function(data) {
            // Update the content of the main element with the new page content
            // $('#content').html(data);
            $('#chatbox').html($(data).find('#chatbox').html());
            $('#subform').html($(data).find('#subform').html());

            // Update the browser history with the new URL
            history.pushState(null, null, url);
            
            // Update the sidebar
            updateSidebar();
            scrollChatboxToBottom();
            
        }).fail(function(xhr, textStatus, errorThrown) {
            // Log any errors to the console
            console.error(xhr, textStatus, errorThrown);
        });
    });
    
    // Load the chat room links on page load from the sidebar
    updateSidebar();

    function updateSidebar() {
        // Check if the sidebar content is cached
        var cachedSidebar = localStorage.getItem('sidebarContent');
        if (cachedSidebar) {
            
            // If the sidebar content is cached, update the sidebar with the cached content
            $('#sidebar').html(cachedSidebar);
    
            // Get the current URL
            var currentUrl = window.location.href;
    
            // Loop through each link in the sidebar
            var links = document.querySelectorAll('.sid');
            links.forEach(function(link) {
                // Check if the href attribute of the link matches the current URL
                if (link.href === currentUrl) {
                    // Add the active class to the link
                    link.classList.add('active-side');
                } else {
                    link.classList.remove('active-side');
                }
            });
        } else {
            // If the sidebar content is not cached, make an AJAX request to the server
            $.ajax({
                url: $('#sidebar').attr('data-url'),
                method: 'GET'
            }).done(function(data) {
                // Update the content of the sidebar element with the new sidebar content
                var sidebarContent = $(data).find('#sidebar').html();
                $('#sidebar').html(sidebarContent);

                // Cache the sidebar content
                localStorage.setItem('sidebarContent', sidebarContent);

                // Get the current URL
                var currentUrl = window.location.href;

                // Remove the active class from all the links
                $('.sid').removeClass('active-side');
        
                // Loop through each link in the sidebar
                var links = document.querySelectorAll('.sid');
                links.forEach(function(link) {
                  // Check if the href attribute of the link matches the current URL
                  if (link.href === currentUrl) {
                    // Add the active class to the link
                    link.classList.add('active-side');
                  }
                });
                
            }).fail(function(xhr, textStatus, errorThrown) {
                // Log any errors to the console
                console.error(xhr, textStatus, errorThrown);
            });
        }
    }
});


