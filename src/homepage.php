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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

            $("#select").change(function(){
              // when change the select opion
              // send current counts of displaying records to table.php
              $("#searchbox").val('');
              var number = $("#select :selected").text();
              $.post("table.php", 
              {num: number},
              function (data, status) {
                // display the table content to #comtable element on the homepage
                $("#comtable").html(data);
              });
            });        

              $("#searchbox").keyup(function(){
              // When user inputs search term, use ajax to refresh the records table
              var searchbox = $("#searchbox").val();
              $.post("table.php", 
              {search: searchbox},
              function (data, status) {
                // display the table content to #comtable element on the homepage
                $("#comtable").html(data);
              });
            }); 

               $("#searchbtn").click(function(){
              // When user inputs search term, use ajax to refresh the records table
              var searchbtn = $("#searchbox").val();
              $.post("table.php", 
              {search: searchbtn},
              function (data, status) {
                // display the table content to #comtable element on the homepage
                $("#comtable").html(data);
              });
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
        <aside>
            <h2>Compound Categories</h2>
            <div class = "sidenav">
              <?php 
                require "sidebar.php";
              ?>
            </div>
        </aside>
        <section id = "detail">
        <h2>Compounds and spectra in PhotochemCAD 3.0 database</h2>
        
        <div class="filter">
        <h3>
          Show
        <select name="select" id="select">
          <option value="339">339</option>
          <option value="100">100</option>
          <option value="50">50</option>
          <option value="25">25</option>
        </select>
          entries 
        </h3>
        
        <div class="search-container">
            <input type="text" placeholder="Search" name="search" id="searchbox">
            <button type="submit" id="searchbtn"><i class="fa fa-search"></i></button>
        </div>
      </div>

        <div id = "comtable">
          <?php 
            require "table.php";
          ?>
                  </div>
        </section>
    </div> 
    <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
    <footer>
      Copyright © 2004-2018 Jonathan S. Lindsey.
    </footer>

    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;
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
        
        for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
            } else {
            dropdownContent.style.display = "block";
            }
        });
        }

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