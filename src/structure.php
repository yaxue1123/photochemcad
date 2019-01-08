<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="Shortcut Icon" href="./image/PhotochemCADLogo.jpg">
    <title>Photochemcad</title>
    <link rel="stylesheet" href="./stylesheet/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen|Roboto|Spectral|Arial%20OS">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <script>

        // when the DOM is ready, execute the JQuery code
        $(document).ready(function () {
    
            if ($('#back-to-top').length) {
                var scrollTrigger = 100, // px
                    backToTop = function () {
                        var scrollTop = $(window).scrollTop();
                        if (scrollTop > scrollTrigger) {
                            $('#back-to-top').addClass('show');
                        } else {
                            $('#back-to-top').removeClass('show');
                        }
                    };
                backToTop();
                $(window).on('scroll', function () {
                    backToTop();
                });
                $('#back-to-top').on('click', function (e) {
                    e.preventDefault();
                    $('html,body').animate({
                        scrollTop: 0
                    }, 700);
                });
            }

            $(".comdetail").click(function () {
                // when clicking the sidebar meanu item
                // send compound name to compound-detail.php
                var name = $(this).attr('comname');
                window.location.href = "compound-detail.php?name=" + name;
            });

            $(".dropdown-btn-structure").click(function(){
                // when clickding the plus/ minus icon, hide or show the items
                var dropdown = document.getElementsByClassName("dropdown-btn-structure");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "none") {
                    dropdownContent.style.display = "block";
                    $(this).children().attr('class','fas fa-minus');
                } else {
                    dropdownContent.style.display = "none";
                    $(this).children().attr('class','fas fa-plus');
                }  
            });

        });

    </script>
</head>

<body>
    <header>
        <div class="logo">
            <h1>PhotochemCAD</h1>
            <h3>calculational modules and a database of absorption and emission spectra for diverse compounds</h3>
        </div>
        <div class="navitems" id="navbar">
        <ul>
                <li>
                    <a href="PhotochemCAD.html">PhotochemCAD™</a>
                </li>
                <li>
                    <a href="homepage.php">Spectra by Name</a>
                </li>
                <li>
                    <a href="structure.php">Spectra by Structure</a>
                </li>
                <li>
                    <a href="download.html">Download</a>
                </li>
                <li>
                    <a href="https://sites.google.com/a/ncsu.edu/lindsey-lab/">Lindsey Lab</a>
                </li>
                <li>
                    <a href="about.html">About</a>
                </li>
            </ul>
        </div>
    </header>

    <div class="main" id="main">
        <div class="structure">
        <?php 
            require "dbconnect.php";
            $query1 = "SELECT * FROM class";
            if ($result1 = $mysqli->query($query1)) {
                while ($row1 = $result1->fetch_assoc()) {
                    echo "<p class='dropdown-btn-structure'><i id='icon-". $row1['id'] ."' class='fas fa-minus'></i>" . $row1['class'] . "</p>";
                    ?>
                    <div class="dropdown-structure">
                    <?php
                    $query2 = "SELECT * FROM records WHERE class='". $row1['class'] ."'";         
                    if ($result2 = $mysqli->query($query2)) {
                        while ($row2 = $result2->fetch_assoc()) {
                            echo '<a href="compound-detail.php?name='. $row2['name'] .'"><img src="./image/structure/' . $row2['id'] . '_result.png" alt="compound structure" height="180"></a>';
                        }
                    }
                    ?>
                    </div>
                    <?php
                }
            }
        ?>
        </div>
    </div> 
    <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
    <footer>
      Copyright © 2004-2018 Jonathan S. Lindsey.
    </footer>

    <script>

       // when the user scrolls the page, execute stick function
       // when the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
          stick();
        };
        // get the navbar and right aside
        var navbar = document.getElementById("navbar");
        var main = document.getElementById("main");
       // get the offset position of the navbar
        var sticky = navbar.offsetTop;

        function stick() {
        // change sticky style for navbar and right aside based on the navbar's position
        if (window.pageYOffset >= sticky) {
            // when the navbar is on the right top, keep navbar and right aside fixed
            navbar.classList.add("sticky");
            main.classList.add("main-margin");
        } else {
            // when the navbar is below the top, un-stick the navbar and right aside
            navbar.classList.remove("sticky");
            main.classList.remove("main-margin");
        }
    }

</script>
</body>
</html>