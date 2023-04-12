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
            $('#titlename').html($(data).find('#titlename').html());

            // Update the browser history with the new URL
            history.pushState(null, null, url);
            
            // Update the sidebar
            updateSidebar();
            botPage();
            enterListener();
            // checkInput();
            
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


    function enterListener() {
        
        var textarea = document.getElementById("messageid");

        if(textarea) {
        textarea.addEventListener("keydown", function(event) {
            if (event.key === "Enter" && !event.shiftKey && textarea.value.length > 0) {
            console.log("log from chat.js: enter-no-ctrl success");
                event.preventDefault();
                this.form.submit();
            }
            if (event.key === "Enter" && event.shiftKey) {
            console.log("log from chat.js: enter+ctrl success");
            var scrollTop = this.scrollTop;

            // // Insert a new line
            // var start = this.selectionStart;
            // var end = this.selectionEnd;
            // var value = this.value;
            // this.value = value.substring(0, start) + "\n" + value.substring(end);
            // this.selectionStart = this.selectionEnd = start + 1;

            // Scroll back to the previous position
            this.scrollTop = scrollTop;
            }
        });
        } 
    }

    function botPage() {
        const chatbox = document.getElementById('chatside');
        // console.log(chatbox);
        console.log(chatbox.scrollTop);
        var he = chatbox.scrollHeight;
        console.log(he);
        chatbox.scrollTop = he;
        console.log("scrolled:" + chatbox.scrollTop);
    }
});


