
// Enter key to submit form
// ;
var textarea = document.getElementById("messageid");

if(textarea) {
textarea.addEventListener("keydown", function(event) {
    if (event.key === "Enter" && !event.shiftKey && textarea.value.length > 0) {
        event.preventDefault();
        this.form.submit();
    }
    if (event.key === "Enter" && event.shiftKey) {
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
    

// Get the current URL
var currentUrl = window.location.href;

// Loop through each link in the sidebar
var links = document.querySelectorAll('.sid');
links.forEach(function(link) {
  // Check if the href attribute of the link matches the current URL
  if (link.href === currentUrl) {
    // Add the active class to the link
    link.classList.add('active-side');
  }
});

