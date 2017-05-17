<!DOCTYPE html>

<?php    
if(isset($_POST['SubmitButton'])){ //check if form was submitted
    $location = htmlspecialchars($_POST['location']); //get input text
    $obj = htmlspecialchars($_POST['obj']); //get input text
    $floor = htmlspecialchars($_POST['floor']); //get input text
    $monitor = htmlspecialchars($_POST['monitor']); //get input text
    $device = htmlspecialchars($_POST['device']); //get input text

    if((!empty($location)) or (!empty($$obj)) or (!empty($floor)) or (!empty($monitor)) or (!empty($device)) ){
              // Verbing zu Shared Desk Area 5.0 desk registration DB with Port 16331
            //$link = mysqli_connect('sl-eu-lon-2-portal.3.dblayer.com:16331', 'admin', 'DRJDYHMKHZLHLDVU','compose');
            $link = mysqli_connect('mysqlsvr71.world4you.com', 'sql7095747', 'x@jy9m3','8632695db2');
            if (!$link) {
                die('Verbindung schlug fehl: ' . mysqli_error());
            }
                    //Query get info of fields from input
             
            if (!empty($location)){
                $w_str = "location like '%$location%' ";
            }
        
            if (!empty($obj)){
                
               if(!empty($w_str)){ 
                   $w_str = $w_str ."and obj like '%$obj%' ";
               } else{
                   $w_str ="obj like '%$obj%' ";
               }
                
            }
        
            if (!empty($floor)){
                
               if(!empty($w_str)){ 
                   $w_str = $w_str ."and room like '%$floor%' ";
               } else{
                   $w_str ="room like '%$floor%' ";
               }
                
            }
        
            if (!empty($monitor)){
                
               if(!empty($w_str)){ 
                   $w_str = $w_str ."and monitor like '%$monitor%' ";
               } else{
                   $w_str ="monitor like '%$monitor%' ";
               }        
            }
        
            if (!empty($device)){
                
               if(!empty($w_str)){ 
                   $w_str = $w_str ."and equippment like '%$device%' ";
               } else{
                   $w_str ="equippment like '%$device%' ";
               }
                
            }
                
            //$sql = "SELECT * FROM compose.Table_conf WHERE $w_str";
            $sql = "SELECT * FROM 8632695db2.Table_conf WHERE $w_str";
            $result =$link->query($sql);
            mysqli_close($link);
    }
}    
?>
<?php 
    if(isset($_POST['SubmitB'])){ //check if form was submitted
         $ll_plan = htmlspecialchars($_POST['s_plan']);
    }

?>
<html>
<head>
	<title>Shared Desk Area 5.0</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

	<table style="border-spacing: 0;width:100%;">
		<tr>
            <td style="width:200;border-bottom: 1px solid black;background-color:#b2c3c5;">
                <img src="images/s_logo.jpg" alt="Siemens Logo" height="100" width="200" align="left">
            </td>
            <td style="border-bottom: 1px solid black;background-color:#b2c3c5;">
                <H1 style="color:white;align:middle">Shared Desk Area 5.0</H1><br>
            </td>
		</tr>
        
    </table> 
        
    
    <table>
        <tr style="border:1px solid black;border-collapse:collapse">
            
            
            <td style="width:450px">
                <!--
                 Info Section
                -->
                <b><u>Legend:</u></b><br><br>
                    <img src='images/used.jpg' alt='desk in use' height='20' width='20' align='left'>..........Shared Desk is used<br>
                    <br><img src='images/free.jpg' alt='desk is free' height='20' width='20' align='left'>..........Shared Desk is free<br>
            </td>
            <td style="width:500">
                    <form action="" method="post">
                        <fieldset>
                            <legend><H3> Search Shared Desk:</H3></legend>                       
                      
                                Location:<input type="text" name="location" />
                                Object:<input type="text" name="obj" />
                                Floor:<input type="text" name="floor" /><br><br>
                                Monitor:&nbsp;<input type="text" name="monitor" />
                                Device:<input type="text" name="device" /><br><br>        
                                <input type="submit" name="SubmitButton" value="Submit" />
                                <button type="reset" value="Reset">Reset</button>
                                   
                        </fieldset>
                    </form>
            </td>             
        </tr>
                                                 
    </table>
  

    <table>
                <tr>           
                    <td style="width:450px">
                        <!--
                            not used space left side
                        -->
                    </td>
                    <td>
                     <?php 

                        if(!empty($sql)){
                            echo "<H3>Result:</H3>";
                          
                            if($result->num_rows > 0) {

                                while($row = $result->fetch_assoc()) {

                                    echo "<p>";
                                    if ($row["registerd"] == 1){

                                        echo "<img src='images/used.jpg' alt='desk in use' height='20' width='20' align='left'>";

                                    } else {

                                        echo "<img src='images/free.jpg' alt='desk free' height='20' width='20' align='left'>";
                                    }
                                    echo "Desk ID: ", $row["idTable_conf"],",  ";
                                    echo "Location: ",$row["location"],",  ";
                                    echo "Object: ", $row["obj"],",  ";
                                    echo "Floor: ", $row["room"],",  ";
                                    echo "Monitor: ", $row["monitor"],",  ";
                                    echo "Device: ", $row["equippment"],",  ";
                                    if (!empty($row["desk_plan"])){
                                        $t_plan =(string)$row["desk_plan"];
                                        echo "<form action='' method='post'>";
                                        echo "<input type='hidden' name='s_plan' value='$t_plan'>";
                                        echo "<button type='submit' name='SubmitB'>Show Plan</button>";
                                        echo"</form>";
                                        echo"<hr />";

                                    }else{ 
                                        echo "<br>no plan available";
                                        echo"<hr />";
                                    }
                                    echo "</p>";
                                }
                            } else {

                                       echo "No shared desk found";
                                    }
                        }
                    ?>
                    </td>
                </tr>
            </table>
    
  
 <table>
                <tr>           
                    <td style="width:450px">
                        <!--
                            not used space left side
                        -->
                    </td>
                    <td>
                    <?php
                        if(!empty($ll_plan)){
                            echo "<H3> Location Plan</H3>";
                             echo "<img src='images/$ll_plan' alt='location plan' height='400' width='400' align='left'>";
                        }
                        
                     ?>
                    </td>
     </tr>
    </table>
    
</body>
</html>
		