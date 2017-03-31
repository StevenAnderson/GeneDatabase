<html><head><title>Execute SQL</title></head>
<body>

<?php
    $species = $_REQUEST["species"];

    //Open a connection

    $connopts = array('Database'=>'Swag', 'TrustServerCertificate'=>1);
    $conn = sqlsrv_connect("cs1", $connopts) or die("cannot connect :".sqlsrv_errors());

$result = sqlsrv_query($conn, "select SName from SpeciesInfo");

echo "<select id='speciesmenu' name = 'speciesmenu'>";

				echo '<option value="NULL">Select a Species if applicable</option>';
				
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                  echo '<option value="'.$row['SName'].'">'.$row['SName'].'</option>';                 
}
    echo "</select>";
   sqlsrv_close($conn)
?>
</body></html>