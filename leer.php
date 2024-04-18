<?php 

$archivo = $_GET['file'];
require('php-excel-reader/excel_reader2.php');
    require('SpreadsheetReader.php');
    $Reader = new SpreadsheetReader($archivo);
    $Sheets = $Reader -> Sheets();   
?>

<table class="table table-striped table-hover">
		<tr>
			<th class="success">#</th>
			<th class="success">Fecha</th>
			<th class="success">Hora</th>
			<th class="success">Temperatura</th>
		</tr>
<?php


	foreach ($Sheets as $Index => $Name)
		{
		$Reader -> ChangeSheet($Index);
						       
		$i=0;

		foreach ($Reader as $Row)
		{	
			if($i==0) {
				$i++;
			}
			else {
					echo "<tr>";
						echo "<td>".$i++."</td>";
						print_r("<td>".$Row[0]."</td>");  
						print_r("<td>".$Row[1]."</td>"); 
						print_r("<td>".$Row[2]."º</td>"); 
					echo "</tr>";
				}
			}
			echo "</table>";
		}
?>		
