$(document).ready(() => {

    setInterval(function () {
        $("#chat-area").load(location.href + " #chat-area>*", "");
    }, 500);

    $("#chat-area").scrollTo($('#chat-area>div:last-child'), 0);

    let currentjson = undefined;
    $.ajax("chat/chat.json", { // This gets the file the first time the user opens the page
        success: function (data) {
            // const messages = JSON.parse(data); 
            currentjson = data;
            // addNodes(currentjson);
        },
        error: function () {
            alert("There was some error performing the AJAX call!");
        }
    });

    $("#type_message").keypress(function (event) {
        let keycode = event.keyCode ? event.keyCode : event.which;
        if (keycode == "13") {

            let msg = $("#type_message").val();
            if (msg.length == 0) {
                alert("Enter a message first!");
                return;
            }

            let name = $("#uname").html().replace(/ +/g, "");

            let data = {
                "uname": name,
                "text": msg
            };
            currentjson.push(data); // Also added one global variable which allows you to push the new data into the old json array.
            $.ajax({
                type: "POST",
                url: "chat/chat_post.php",
                data: {
                    data: JSON.stringify(currentjson)
                },
                dataType: "json",
                success: function (response) {
                    // console.log('Response: ' + JSON.stringify(response, null, 4));
                    // $(".chat").html("");    // Reset the html of the chat
                    // addNodes(response); // Add the new Data to the chat by calling addNodesfunction
                },
                error: function (err) {
                    console.log(err);
                }
            });
            $("#type_message").val(""); // clear text input
            $("#chat-area").scrollTo($('#chat-area>div:last-child'), 1000);
        }
    });
});
// function addNodes(values) {
//     for (let message of values) {
//         const chatDiv = $(".chat");
//         const user = document.createElement("h3");
//         const content = document.createElement("p");
//         user.textContent = message.uname;
//         content.textContent = message.text;
//         chatDiv.append(user);
//         chatDiv.append(content);
//     }
// }