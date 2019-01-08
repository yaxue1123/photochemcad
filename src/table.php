<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="Shortcut Icon" href="./image/PhotochemCADLogo.jpg">
    <title>Photochemcad</title>
    <link rel="stylesheet" href="./stylesheet/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen|Roboto|Spectral">
    <script>
         $(document).ready(function () {
            $(".heading").click(function () {
                // use variable to access the new sortby parameter
                // and store existing page and number variable to post to new php page
                var page =  $("#pagestore").text();
                var sortby = $(this).attr("sortby");
                var number = $("#select :selected").text();

                if ($("#orderstore").text()=='ASC'){
                    var order = 'DESC';
                }
                else{
                    var order = 'ASC';
                }

                $.post("table.php",
                    {
                     page: page,
                     sort: sortby,
                     num: number,
                     order: order
                    },
                    function (data, status) {
                        // reload the table.php
                        $("#comtable").html(data);
                    });
            });

            $(".comtr").click(function () {
                // when clicking the table item
                // send compound name to compound-detail.php
                var name = $(this).attr("comname");
                window.location.href = "compound-detail.php?name=" + encodeURIComponent(name);
            });

            $(".pagenum").click(function () {
                // use variable to access the new page parameter
                // and store existing sortby and number variable to post to new php page
                var page = $(this).attr("apage");
                var number = $("#select :selected").text();
                var sortby = $("#sortbystore").text();
                var order = $("#orderstore").text();

                $.post("table.php",
                    {
                     page: page,
                     sort: sortby,
                     num: number,
                     order: order
                    },
                    function (data, status) {
                        // reload the table.php
                        $("#comtable").html(data);
                    });
            });
        });
    </script>
</head>
<body id="tablebody">
    <table class="comtable">
      <tr>
        <td class="heading" sortby="id">ID &nbsp<i class="fa fa-sort"></i></td>
        <td class="heading" sortby="name">Compound &nbsp<i class="fa fa-sort"></i></td>
        <td class="heading" sortby="class">Class &nbsp<i class="fa fa-sort"></i></td>
        <td class="heading" sortby="wavelength_abs">Absorption &nbsp<i class="fa fa-sort"></i></td>
        <td class="heading" sortby="ems">Emission &nbsp<i class="fa fa-sort"></i></td>
      </tr>
<?php
    require "dbconnect.php";
    $sql = "SELECT count(*) from records";
    $count = $mysqli->query($sql)->fetch_assoc()['count(*)']; // number of all records
    $start = 0; // start number of records for current page

    // number of records displayed per page, chosen by user, passed from homepage.php
    if (isset($_POST['num']))
        $num = $_POST['num']; 
    else
        $num = $count;

    // sort-by value, posted by homepage.php
    if (isset($_POST['sort']))
        $sortby = $_POST['sort']; 
    else
        $sortby = 'id';
       
    if (isset($_POST['order']))
        $order = $_POST['order']; 
    else
        $order = 'ASC';   

    // page value, posted by homepage.php
    if (isset($_POST['page'])){
        $page = $_POST['page']; 
        // calculate start page for db query
        $start = ($page-1) * $num;
    }
    else
        $page = 1;

    // search-by value, posted by homepage.php
    if (isset($_POST['search']))
    $searchby = $_POST['search']; 
    else
    $searchby = "";

    echo "<div id='sortbystore' style='display: none'>" . $sortby .  "</div>";
    echo "<div id='pagestore' style='display: none'>" . $page .  "</div>";
    echo "<div id='orderstore' style='display: none'>" . $order .  "</div>";

    // Use switch in case that a user input illegal url mannually.

    switch ($sortby) {
        case "id":
            $sortby = "id";
            break;
        case "name":
            $sortby = "name";
            break;
        case "class":
            $sortby = "class";
            break;
        case "wavelength_abs":
            $sortby = "wavelength_abs";
            break;
        case "ems":
            $sortby = "ems";
            break;
        default:
            $sortby = "id";
    }
    
    // calculated by count and pagelimit
    $totalpage; 
    $totalpage = ceil($count / $num);

    $query = "select * from records WHERE (name LIKE '%".$searchby."%') OR (id LIKE '%".$searchby."%') OR (class LIKE '%".$searchby."%') ORDER BY $sortby $order LIMIT $start, $num";

    //Show the display results in the interface
    if ($result = $mysqli->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $ems = 'NA';
            if($row['ems']!=0)
                $ems = $row['ems'];
            echo '<tr class="comtr" comname="' . $row['name'] . '"><td>' . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['class']
                . "</td><td>" . $row['wavelength_abs'] . "</td><td>" . $ems . "</td></tr>";
            echo "<p>";
        }
    }

?>
</table>

<table id="foottable">
    <tr>
        <?php
        // display all page number for users to click 
        for ($i = 1; $i <= $totalpage; $i++) {
            ?>
            <td class="pagenum" apage="<?php echo $i; ?>">
                    <?php if ($i == $page) echo "[" . $i . "]"; else echo $i; ?></td>
            <?php
        } ?></tr>
</table>
    </body>
</html>