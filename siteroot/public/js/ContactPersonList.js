$(document).ready(function () {
    var limit = 20;
    var start = 0;
    var action = 'inactive';
    var sort = 'first_name';
    function findSearch() {
        var result = null,
            tmp = [];
        location.search
            .substr(1)
            .split("&")
            .forEach(function (item) {
                tmp = item.split("=");
                if (tmp[0] === "search") result = decodeURIComponent(tmp[1]);
            });
        return result;
    }
    function sortF(x) {
        $('.listNames').scrollTop(0);
        start = 0;
        limit = 20;
        $.ajax({
            type: "POST",
            url: "CpData.php",
            data: { limit: limit, start: start, search: null, sort: x }
        }).done(function (data) {
            sort = x;
            $('#load_data').html('');
            $('#load_data').append(data);
        });
    }
    $('#sortVoornaam').click(function () {
        sortF('first_name');
    });
    $('#sortAchternaam').click(function () {
        sortF('last_name');
    });
    $('#workLocation').click(function () {
        sortF('work_location');
    });
    $('#businessName').click(function () {
        sortF('business_name');
    });
    function load_data(limit, start, search) {
        $.ajax({
            url: "CpData.php",
            method: "POST",
            data: { limit: limit, start: start, search: search, sort: sort },
            cache: false,
            success: function (data) {
                $('#load_data').append(data);
                if (data == '') {
                    $('#load_data_message').html("<button type='button' class='btn btn-info'>No Data Found</button>");
                    action = 'active';
                } else {
                    if (findSearch() == null || findSearch() == "") {
                        $('#load_data_message').html("<div id='loadingGif'><img src='images/loading.gif'/></div>");
                        action = "inactive";
                    } else {
                        action = "active";
                        //window.history.pushState("object or string", "Title", "/adresboek-php/siteroot/public/");
                    }
                }
                if (data == "No results") {
                    action = "inactive";
                    $('#load_data_message').html("<div id='loadingGif'><img src=''/></div>");
                }
            }
        });
    }
    if (action == 'inactive' && findSearch() == null) {
        action = 'active';
        load_data(limit, start, null, sort);
    } else {
        action = 'active';
        load_data(limit, start, findSearch(), sort);
    }
    $(".listNames").scroll(function () {
        if ($(".listNames").scrollTop() + $(".listNames").height() > $("#load_data").height() && action == 'inactive') {
            if (findSearch() == null) {
                action = 'active';
                start = start + limit;
                setTimeout(function () {
                    load_data(limit, start, null, sort);
                }, 1000);
            } else {
                action = 'active';
                start = start + limit;
                setTimeout(function () {
                    load_data(limit, start, findSearch(), sort);
                }, 650);
            }
        }
    });
});