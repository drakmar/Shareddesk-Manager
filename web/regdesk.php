<!DOCTYPE html>
<html>
<head>
	<title>Shared Desk Area 5.0 registrer QR/NFC Tags</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>

<body>
<table style="width:100%">
    <tr style="height:150"> 
        <td style="width:150"></td>
        <td style="align:middle;width:150">
            <img src="images/s_logo.jpg" alt="Siemens Logo" height="150" width="300" align="middle"> 
        </td>

    </tr>
    <tr>
        <td style="height:150;width:150">
             <img src="images/HandyQR.jpg" alt="Smartphone QR/NFC" height="150" width="150"align="left"> 
        </td >
        <td style="width:100%;height:101;align:left">
            <?php

                $desk = $_GET["sdesk"];

                if (!empty($desk)) {

                        // Verbing zu Shared Desk Area 5.0 desk registration DB with Port 16331
                    //$link = mysqli_connect('sl-eu-lon-2-portal.3.dblayer.com:16331', 'admin', 'DRJDYHMKHZLHLDVU','compose');
                    $link = mysqli_connect('mysqlsvr71.world4you.com', 'sql7095747', 'x@jy9m3','8632695db2');
                    if (!$link) {

                        die('Verbindung schlug fehl: ' . mysqli_error());
                    }



                    //Query get info of fields ffrom selected desk via nfc or QR
                    $sql = "SELECT * FROM 8632695db2.Table_conf WHERE idTable_conf=$desk";

                    $result =$link->query($sql);

                    if($result->num_rows > 0) {

                         while($row = $result->fetch_assoc()) {
                            $testx = $row["registerd"];
                            $test1 = $row["location"];
                            $test2 = $row["obj"];
                            $test3 = $row["room"];
                        }
                                            if($testx==1 ) {

                        $sql = "UPDATE Table_conf SET registerd=0 WHERE idTable_conf=$desk";

                    } else{

                        $sql = "UPDATE Table_conf SET registerd=1 WHERE idTable_conf=$desk";

                    }


                    // Write registration data for desk into DB and write status to browser
                    if ($link->query($sql) === TRUE) {

                        if($testx==1 ){


                            echo "<p> <H1 align='left' style='color:black;'>Shared Desk Area 5.0 </H1></p>";
                            echo "<p> <H1 align='left' style='color:blue;'>You have unregistered desk with ID:<br>", $desk,".",$test1,".",$test2,".",$test3,"(Desk ID.Location.Obj.Floor)</H1></p>";
                        } else {

                           echo "<p> <H1 align='left' style='color:black;'>Shared Desk Area 5.0 </H1></p>";
                           echo "<p> <H1 align='left' style='color:green;'>You have registered desk with ID:<br>", $desk,".",$test1,".",$test2,".",$test3,"(Desk ID.Location.Obj.Floor) </H1></p>"; 
                        }

                    } else {
                        echo "<p><H1 align='left' style='color:red;'> Error: " . $sql . "</p></H1>" . $link->error;
                    }

                    } else {

                       echo "<p> <H1 align='left' style='color:red;'>No shared desk found with ID:", $desk,"</H1></p>";
                    }


                    mysqli_close($link);
                    
                } else {

                        echo "<p><H1 align='left' style='color:red;'>No shared desk ID </p></H1>";
                }
                
            ?>
            </td>
        </tr>
    </table>

</body>
</html>