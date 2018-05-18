<?php include('includes/Contactpersoon.php'); ?>
<?php include 'layouts/index_header.php'; ?>
<?php require_once('includes/ContactPersoon.php'); ?>


    <section id="content">
        <div class="search">
            <form class="searchForm" method="get" id="searchForm">
                <input type="text" name="voornaam" placeholder="Zoeken" />
                <a href="#" onclick="document.getElementById('searchForm').submit()" rel="search">
                    <i class="fa fa-search"></i>
                </a>
            </form>
        </div>
        <div class="sortNames">
            <ul type="none">
                <li class="voornaam-sorteren">
                    <a href="#">
                        voornaam
                        <i class="fa fa-caret-down"></i>
                    </a>
                </li>
                <li class="achternaam-sorteren">
                    <a href="#">
                        achternaam
                        <i class="fa fa-caret-down"></i>
                    </a>
                </li>
                <li class="plaats-sorteren">
                    <a href="#">
                        plaats
                        <i class="fa fa-caret-down"></i>
                    </a>
                </li>
                <li class="bedrijfsnaam-sorteren">
                    <a href="#">
                        bedrijfsnaam
                        <i class="fa fa-caret-down"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="listNames">

            <div class="wrapper">
                <ul id="results"><!-- results appear here as list --></ul>
            </div>

            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script type="text/javascript">
                (function ($) {
                    $.fn.loaddata = function (options) {// Settings
                        var settings = $.extend({
                            loading_gif_url: "ajax-loader.gif", //url to loading gif
                            end_record_text: 'No more records found!', //no more records to load
                            data_url: 'fetch_pages.php', //url to PHP page
                            start_page: 1 //initial page
                        }, options);

                        var el = this;
                        loading = false;
                        end_record = false;
                        contents(el, settings); //initial data load

                        $(window).scroll(function () { //detact scroll
                            if ($(window).scrollTop() + $(window).height() >= $(document).height()) { //scrolled to bottom of the page
                                contents(el, settings); //load content chunk
                            }
                        });
                    };
                    //Ajax load function
                    function contents(el, settings) {
                        var load_img = $('<img/>').attr('src', settings.loading_gif_url).addClass('loading-image'); //create load image
                        var record_end_txt = $('<div/>').text(settings.end_record_text).addClass('end-record-info'); //end record text

                        if (loading == false && end_record == false) {
                            loading = true; //set loading flag on
                            el.append(load_img); //append loading image
                            $.post(settings.data_url, { 'page': settings.start_page }, function (data) { //jQuery Ajax post
                                if (data.trim().length == 0) { //no more records
                                    el.append(record_end_txt); //show end record text
                                    load_img.remove(); //remove loading img
                                    end_record = true; //set end record flag on
                                    return; //exit
                                }
                                loading = false;  //set loading flag off
                                load_img.remove(); //remove loading img
                                el.append(data);  //append content
                                settings.start_page++; //page increment
                            })
                        }
                    }

                })(jQuery);

                $("#results").loaddata();
            </script>
        </div>

    </section>

    <section id="detail">
        <img src="images/profile_pictures/kim.jpg">
        <h2>Kim, Jung Un</h2>
        <div class="paraSide">
            <p><i class="fas fa-address-book" style="color: black"></i> Kim Jung Un</p>
            <p><i class="fas fa-building" style="color: black"></i> Microsoft</p>
            <p><i class="fas fa-envelope" style="color: black"></i> kimjungun@gmail.com</p>
            <p><i class="fas fa-phone" style="color: black"></i> +31 1238624</p>
            <p><i class="fas fa-phone" style="color: black"></i> 0315-18793712</p>
            <p><i class="fas fa-building" style="color: black"></i> Ulft</p>
        </div>
        <div class="deleteChange">
            <i class="fas fa-pencil-alt"></i>
            <i class="fas fa-trash"></i>
        </div>
    </section><?php include 'layouts/index_footer.php';?>
