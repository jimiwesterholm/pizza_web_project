<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
            <?php include 'staff_home.php'; ?>
        
            <div class="formHolder">
            <h1 class="formHeaders"> Pizzas </h1> 
            <table>
            
                
                    <tr> 
                            <th> Pizza </th>
                            <th> Size </th>
                            <th> Quantity </th>
                            <th> Price/Item </th>
                    </tr>
                
                    <?php
                    include "db.php";
                    $order = $_GET["ID"];
                    
                    //Queries for getting the extras and pizzas in a specific order
                    $pizzaQ = "SELECT b.pizza_name, b.pizza_size, b.Quantity, a.price FROM staffpizza_view a, pizza_order b WHERE b.orderID = '$order' AND a.name = b.pizza_name AND a.size = b.pizza_size";
                    $extraQ = "SELECT a.Extra_name, b.type, a.Quantity, b.price FROM customerorder_extra a, extra b WHERE a.order_ID = '$order' AND a.Extra_name = b.name";
                    
                    $resultP = mysql_query($pizzaQ, $db) or die(mysql_error($db));
                
                    //Display pizzas in the order
                    while ($row = mysql_fetch_row($resultP)) {
                            echo "<tr><th> " . $row[0];
                            echo "</th><th> " . $row[1];
                            echo "</th><th> " . $row[2];
                            echo "</th><th> " . $row[3]. "</tr>";
                    }
                    mysql_free_result($resultP);
                    
                    ?>
            </table>
            <h1 class="formHeaders"> Extras </h1> 
            <table>
                    <tr> 
                            <th> Name </th>
                            <th> Type </th>
                            <th> Quantity </th>
                            <th> Price/Item </th>
                    </tr>
                    
                    <?php
        
                    $resultE = mysql_query($extraQ, $db) or die(mysql_error($db));
                    
                    //Display extras in the order
                    while ($row = mysql_fetch_row($resultE)) {
                            echo "<tr><th> " . $row[0];
                            echo "</th><th> " . $row[1];
                            echo "</th><th> " . $row[2];
                            echo "</th><th> " . $row[3]. "</tr>";
                    }
                    mysql_free_result($resultE);
                    ?>
					
					
			
			
	</div> 
					
            </table>
            </div>
    </body>
</html>
