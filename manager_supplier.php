<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php include 'manager_home.php'; ?>
        
            <div class="formHolder">
            <h1 class="formHeaders"> Ingredients</h1> 
            <table>
            
            
                
                <tr> 
                        <th> Ingredient </th>
                        <th> Price/kg </th>
                        <th> Supply </th>
                        <th> Vegetarian </th>
                </tr>
                
                <?php
                include "db.php";
                $supplier = $_GET["ID"];
                
                //Queries for getting the extras and ingredients for a specific supplier
                $q1 = "SELECT a.ingredient_name, b.pricekg, b.supply, b.vegetarian FROM supplier_ingredient_view a, ingredient_view b WHERE a.supplier_ID = '$supplier' AND a.ingredient_name = b.name";
                $q2 = "SELECT a.extra_name, b.price, b.type, b.supply, b.price FROM extra_supplier_view a, extra_view b WHERE a.supplier_ID = '$supplier' AND a.extra_name = b.name";
                $q3 = "SELECT a.addressID, b.street_address, b.postcode, b.city FROM supplier_view a, address_view b WHERE a.supplier_ID = '$supplier' AND b.addressID = a.addressID";
                
                $resultI = mysql_query($q1, $db) or die(mysql_error($db));
            
                //Display pizzas in the order
                while ($row = mysql_fetch_row($resultI)) {
                        echo "<tr><th> " . $row[0];
                        echo "</th><th> " . $row[1];
                        echo "</th><th> " . $row[2];
                        echo "</th><th> " . $row[3]. "</tr>";
                }
                mysql_free_result($resultI);
                ?>
            </table>
            <h1 class="formHeaders"> Extras </h1> 
            <table>
                <tr> 
                        <th> Name </th>
                        <th> Type </th>
                        <th> Supply </th>
                        <th> Price/Item </th>
                </tr>
                    
                <?php
    
                $resultE = mysql_query($q2, $db) or die(mysql_error($db));
                
                //Display extras in the order
                while ($row = mysql_fetch_row($resultE)) {
                        echo "<tr><th> " . $row[0];
                        echo "</th><th> " . $row[1];
                        echo "</th><th> " . $row[2];
                        echo "</th><th> " . $row[3]. "</tr>";
                }
                mysql_free_result($resultE);
                ?>
            </table>
			<h1 class="formHeaders"> Address </h1> 
            <table>
                <tr> 
                        <th> ID </th>
                        <th> Street Address </th>
                        <th> Postcode </th>
                        <th> City </th>
                </tr>
                    
                <?php
    
                $resultA = mysql_query($q3, $db);
                if ($resultA == NULL) echo mysql_error($db);
                
                //Display extras in the order
                while ($row = mysql_fetch_row($resultA)) {
                        echo "<tr><th> " . $row[0];
                        echo "</th><th> " . $row[1];
                        echo "</th><th> " . $row[2];
                        echo "</th><th> " . $row[3]. "</tr>";
                }
                mysql_free_result($resultA);
                ?>
            </div>
    </body>
</html>
