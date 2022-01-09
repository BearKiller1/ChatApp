var SetSearch = false; // Search toggler
var partner_id;
$(document).ready(function () {
    SetSearch = false;
})

// Runs Searcher every 100ms if search is ON
setInterval( () => {
    if(SetSearch != false){
        SearchPartner();
    }
}, 100);

$(document).on("click","#start",function () {

    SearchPartner();
    $.ajax({
        url: "components/chat/chat.php",
        data: {
            method: "ChangePartner",
            partner_id : 1
        },
        success: function (response) {
            console.log(response);
        }
    });
});

$(document).on("click","#start_search",function () {
    ChangeStatus(4);
    //SetSearch = true;
    SearchPartner();
});

$(document).on("click","#stop_search, #cancel",function () {
    ChangeStatus(1);
    SetSearch = false;
})

$(document).on("click","#send",function() {
    var msg = $("#user_msg").val();
    SendMessage(msg);
})

SearchPartner = () => {
    $.ajax({
        url: "components/chat/chat.php",
        data: {
            method: "GetPartner",
        },
        success: function (response) {
            response = JSON.parse(response);
            if(response.result == 1){
                SetSearch = false;

                partner_id = response.partner['id'];

                $(".chat_container_test").show();
                $("#partner_name").html(response.partner['name']);
                
                $.ajax({
                    url: "components/chat/chat.php",
                    data :{
                        method:"SetChat",
                        partner_id: partner_id
                    },
                    success: function (response) {
                        alert(response);
                    }
                })
            }
            else if(response.result == 0){
                SearchPartner();
                console.log(response.result);
            }
        }
    });
}

ChangeStatus = (status_id) => {
    $.ajax({
        url: "components/chat/chat.php",
        data: {
            method: "ChangeStatus",
            status: status_id,
        },
        success: function (response) {

        }
    });
}

SendMessage = (msg) => {

    $.ajax({
        url: "components/chat/chat.php",
        data: {
            method: "SetMessage",
            partner: partner_id,
            user_msg: msg,
        },
        success: function (response) {
        }
    });
}