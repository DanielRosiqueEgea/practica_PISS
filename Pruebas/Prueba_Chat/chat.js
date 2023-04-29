var element = $('.floating-chat');
var myStorage = localStorage;

if (!myStorage.getItem('chatID')) {
    myStorage.setItem('chatID', createUUID());
}

setTimeout(function() {
    element.addClass('enter');
}, 1000);

element.click(openElement);
var messagesContainer = $('.messages');
var oldMessages = "";
function openElement() {
    var messages = element.find('.messages');
    var textInput = element.find('.text-box');
    element.find('>i').hide();
    element.addClass('expand');
    element.find('.chat').addClass('enter');
    var strLength = textInput.val().length * 2;
    textInput.keydown(onMetaAndEnter).prop("disabled", false).focus();
    element.off('click', openElement);
    element.find('.header button').click(closeElement);
    element.find('#sendMessage').click(sendNewMessage);
    messages.scrollTop(messages.prop("scrollHeight"));
}

function closeElement() {
    element.find('.chat').removeClass('enter').hide();
    element.find('>i').show();
    element.removeClass('expand');
    element.find('.header button').off('click', closeElement);
    element.find('#sendMessage').off('click', sendNewMessage);
    element.find('.text-box').off('keydown', onMetaAndEnter).prop("disabled", true).blur();
    setTimeout(function() {
        element.find('.chat').removeClass('enter').show()
        element.click(openElement);
    }, 500);
}

function createUUID() {
    // http://www.ietf.org/rfc/rfc4122.txt
    var s = [];
    var hexDigits = "0123456789abcdef";
    for (var i = 0; i < 36; i++) {
        s[i] = hexDigits.substr(Math.floor(Math.random() * 0x10), 1);
    }
    s[14] = "4"; // bits 12-15 of the time_hi_and_version field to 0010
    s[19] = hexDigits.substr((s[19] & 0x3) | 0x8, 1); // bits 6-7 of the clock_seq_hi_and_reserved to 01
    s[8] = s[13] = s[18] = s[23] = "-";

    var uuid = s.join("");
    return uuid;
}


$('.text-box').keydown(function(e) {
    if (e.keyCode == 13) {
      sendNewMessage();
    }
  });

function sendNewMessage() {
    var userInput = $('.text-box');
    // var newMessage = userInput.html().replace(/\<div\>|\<br.*?\>/ig, '\n').replace(/\<\/div\>/g, '').trim().replace(/\n/g, '<br>');
    var newMessage = userInput[0].innerText.trim().replace(/\n/g, '<br>');
    if (!newMessage) return;

    oldMessages.push({
        type: "self",
        text: newMessage
      });
    messagesContainer.append([
        '<li class="self">',
        newMessage,
        '</li>'
    ].join(''));

    // clean out old message
    userInput.html('');
    // focus on input
    userInput.focus();

    // messagesContainer.finish().animate({
    //     scrollTop: messagesContainer.prop("scrollHeight")
    // }, 250);

    $.ajax({
        url: 'sendMessage.php',
        method: 'POST',
        data: {
            otherUser: otherUser,
            text: newMessage
        },
        success: function(response) {
            console.log('Mensaje enviado correctamente');
        },
        error: function(xhr, status, error) {
            console.log('Error al enviar el mensaje');
            console.log(xhr.responseText);
        }
    });
}

function onMetaAndEnter(event) {
    if ((event.metaKey || event.ctrlKey) && event.keyCode == 13) {
        sendNewMessage();
    }
}

function loadMessages() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'getMessages.php?otherUser='+otherUser);
    xhr.onload = function() {
      if (xhr.status === 200) {
        var messages = JSON.parse(xhr.responseText);
        updateChat(messages);
      }
    };
    xhr.send();
  }

  function updateChat(messages) {
    if(JSON.stringify(messages) === JSON.stringify(oldMessages)){
        console.log("los mensajes son los mismos que antes");
        return;
    }
    oldMessages=messages;
    messagesContainer.empty();
    messages.forEach(function(message) {
        var newMessage = message.text.trim().replace(/\n/g, '<br>');
      messagesContainer.append([
        '<li class="' + message.type + '">',
        newMessage,
        '</li>'
      ].join(''));
    });
    messagesContainer.finish().animate({
      scrollTop: messagesContainer.prop("scrollHeight")
    }, 250);
  }

  messagesContainer.empty();
  messagesContainer.append("<li>Cargando el chat, por favor espere...</li>")
  setInterval(loadMessages, 1000);