 <?php
                    require "dbconnect.php";
                    #show all class
                    $query1 = "SELECT * FROM class";
                    if ($result1 = $mysqli->query($query1)) {
                        while ($row1 = $result1->fetch_assoc()) {
                            echo "<button class='dropdown-btn'>" . $row1['class'] . "</button>";
                            ?>
                            <div class="dropdown-container">
                            <?php
                            $query2 = "SELECT * FROM records WHERE class='". $row1['class'] ."'";         
                            if ($result2 = $mysqli->query($query2)) {
                                while ($row2 = $result2->fetch_assoc()) {
                                    echo '<a class="comdetail" comname="' .$row2['name'] . '">' . $row2['name']. '</a>';
                                }
                            }
                            ?>
                            </div>
                            <?php
                        }
                    }
                ?>