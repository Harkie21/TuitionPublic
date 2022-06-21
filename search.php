<?php

include_once "header.php";
include_once "db_login.php";
?>
    <style>

        body {
            background: #343a40;
        }

        #searchbox {
            padding: 10px;
            box-shadow: 1px 5px 5px #242424;
        }

        .search-box {
            position: absolute;
            top: 15%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #919191;
            height: 65px;
            border-radius: 40px;
            padding: 10px;
        }

        .search-box:hover > .search-txt {
            width: 700px;
            padding: 0 6px;

        }

        .search-box:hover > .search-btn {
            background: #919191;
        }

        .search-btn, .search-btn:hover {
            color: #FFFFFF;
            float: right;
            width: 40px;
            height: 40px;
            border-radius: 80%;
            background: #919191;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            transition: 0.4s;
        }

        .search-txt {
            border: none;
            background: none;
            outline: none;
            float: left;
            padding: 0px;
            color: white;
            font-size: 18px;
            transition: 0.4s;
            line-height: 45px;
            width: 0px;
        }

        ::placeholder {
            color: #FFFFFF;
            opacity: 1; /* Firefox */
        }

        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: #FFFFFF;
        }

        ::-ms-input-placeholder { /* Microsoft Edge */
            color: #FFFFFF;
        }

        .contact {
            float: left;
            margin: 20px;
            background: #919191;
            text-align: center;
            padding: 10px;
            width: 250px;
            box-shadow: 1px 5px 5px #242424;
            border: 2px solid white;
            border-radius: 25px;
        }

    </style>
    <script>

        $(function () {
            $('input').blur();
        });

        // Checks if the page has been fully loaded
        $(document).ready(function () {
            // Checks everytime a letter is typed
            $("#search").keyup(function () {

                $.ajax({

                    url: 'search_backend.php',
                    type: 'post',
                    data: {search: $(this).val()},
                    success: function (result) {

                        $("#result").html(result);

                    }

                })

            });

        });

    </script>
    <div id="searchbox" class="search-box" style="margin-top: 2rem;">
        <input class="search-txt" type='TEXT' id='search'
               placeholder="Type to begin search" autofocus="false">
        <a class="search-btn" href="#">
            <i class="fas fa-search"></i>
        </a>
    </div><br><br><br><br><br>
    <span id='result' style="color: white;"></span>
<?php
include_once "footer.php";
?>