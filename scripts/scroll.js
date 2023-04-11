
function scrollChatboxToBottom() {
    const chatbox = document.getElementById('chatside');
    console.log(chatbox);
    console.log(chatbox.scrollTop);
    console.log(chatbox.scrollHeight);
    chatbox.scrollTop = chatbox.scrollHeight;
}

function myFunction() {
    scrollChatboxToBottom();
    // console.log("scrolled!");
}

window.onload = myFunction;
