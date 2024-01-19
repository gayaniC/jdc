<html>
<head>  
    <style>
    body{padding: 10px;}
    #hdr{background-color: silver;}
    tr{height: 10px;}
    </style>
</head>

<body>
<?php
    mysql_connect('localhost','root','') or die('unable to connect');
    mysql_select_db('jdc_db') or die('unable to select');
    
   
    $sql ='SELECT * FROM m01_company';
    $result = mysql_query($sql) or die('unable to select');
    ?>
    <table width="100%" cellspacing="0" cellpadding="0" border="1">
    <tr id="hdr" >
        <th>comp_id</th>  
        <th>com_name</th>  
        <th>com_postal_code</th>
        <th>com_contact_Address_line1</th>
        <th>com_contact_Address_line2</th>
        <th>com_contact_no</th>
    </tr>
    
    <?php
    while($row = mysql_fetch_array($result)){
        echo '<tr>';
            echo '<td>'.$row['comp_id'].'<br/></td>';
            echo '<td>'.$row['com_name'].'<br/></td>';
            echo '<td>'.$row['com_postal_code'].'<br/></td>';
            echo '<td>'.$row['com_contact_Address_line1'].'<br/></td>';
            echo '<td>'.$row['com_contact_Address_line2'].'<br/></td>';
            echo '<td>'.$row['com_contact_no'].'<br/></td>';
        echo '</tr>';
        
        
    }
?>
</table>
</body>
</html>
<?php
