<?php
/**
 * This file belongs to Question 1
 * @author Anil Konsal <anil.konsal@gmail.com>
 */

namespace SoftwareEngineerTest;

// Question 1a
$DB_HOST = 'localhost';
$DB_NAME = 'test';
$DB_USER = 'test';
$DB_PASS = 'test';

// Connect to database
$conn = mysql_connect($DB_HOST, $DB_USER, $DB_PASS) or die('Cannot connect to Server');
$db = mysql_select_db($DB_NAME) or die('Cannot select the database');

// Get occupation parameter
$occupation = $_GET['occupation'];

// if occupation is provided as get argument, then make the condition
$condition = empty($occupation) ? '' : ' where co.occupation_name ="' . mysql_real_escape_string($occupation) . '"';


$sql = "Select 
            c.username, c.first_name, c.last_name, ifnull(co.occupation_name, 'Unemployed') as occupation_name
        From
            customer c
            left join `customer_occupation` co on c.`customer_occupation_id` = co.`customer_occupation_id`
        " . $condition;

$result = mysql_query($sql);
?>

<h2>Customer List</h2>
<table>
    <tr>
        <th>Customer ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Occupation</th>
    </tr>

    <!-- Write your code here -->
    <?php while ($row = mysql_fetch_object($result)) { ?>
        <tr>
            <td><?= $row->customer_id ?></td>
            <td><?= $row->first_name ?></td>
            <td><?= $row->last_name ?></td>
            <td><?= $row->occupation_name ?></td>
        </tr>
    <?php } ?>

</table>







