
function scrollChatboxToBottom() {
    const chatbox = document.getElementById('chatside');
    // console.log(chatbox);
    console.log(chatbox.scrollTop);
    console.log(chatbox.scrollHeight);
    chatbox.scrollTop = chatbox.scrollHeight;
}

function myFunction() {
    scrollChatboxToBottom();
    console.log("scrolled!");
}

window.onload = myFunction;


function checkInput() {
    var textarea = document.getElementById('messageid');
    var button = document.getElementById('msgbtn');
    var iconbtn = document.getElementById('iconbtn');

    if (textarea.value.length > 0) {
        button.disabled = false;
        iconbtn.style.color = '#ffffff';
    } else {
        button.disabled = true;
        iconbtn.style.color = '#737373';
    }
}