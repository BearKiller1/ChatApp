var SetSearch; // Search toggler

$(document).ready(function () {
    SetSearch = false;
})

// Runs Searcher every 100ms if search is ON
setInterval( () => {
    if(SetSearch == true){
        SearchPartner();
    }
}, 100);

$(document).on("click","#start",function () {
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
    SetSearch = true;
});

$(document).on("click","#stop_search, #cancel",function () {
    ChangeStatus(1);
    SetSearch = false;
})

SearchPartner = () => {
    $.ajax({
        url: "components/chat/chat.php",
        data: {
            method: "GetPartner",
        },
        success: function (response) {
            response = JSON.parse(response);
            console.log(response.result);
            
            if(response.result != 0){
                SetSearch = false;
                alert("Found");
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
