<?php 
require_once("db.php");
?>
<html>
<head>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<title>Employee Details</title>
</head>
<body>
	<div class="button_link"><a href="add.php">Add New</a></div>
	<!-- Featch Employee details -->
	<?php
		$sql = "SELECT * FROM employee_details";
		$result = $conn->query($sql);	
		if ($result->num_rows > 0) {		
	?>
	<table class="tbl-qa" width="100%">	
		<thead>
			 <tr>
				<th class="table-header" width="20%">Name</th>
				<th class="table-header" width="10%"> Employee ID </th>
				<th class="table-header" width="10%"> PF Number </th>
				<th class="table-header" width="10%"> Salary </th>
				<th class="table-header" width="10%"> HRA </th>
				<th class="table-header" width="10%"> PF </th>
				<th class="table-header" width="10%"> PT </th>
				<th class="table-header" width="10%"> ESI </th>
				<th class="table-header" width="10%" colspan="2">Action</th>
			  </tr>
		</thead>
		<?php while($row = $result->fetch_assoc()) { ?>
		<tbody>		

			<tr class="table-row" id="row-<?php echo $row["id"]; ?>"> 
				<td class="table-row"><?php echo $row["emp_name"]; ?></td>
				<td class="table-row"><?php echo $row["emp_id"]; ?></td>
				<td class="table-row"><?php echo $row["pf_no"]; ?></td>
				<td class="table-row"><?php echo $row["salary"]; ?></td>
				<td class="table-row"><?php echo $row["hra"]; ?></td>
				<td class="table-row"><?php echo $row["pf"]; ?></td>
				<td class="table-row"><?php echo $row["pt"]; ?></td>
				<td class="table-row"><?php echo $row["esi"]; ?></td>
				<!-- action -->
				<td class="table-row" colspan="2">
					<a href="edit.php?id=<?php echo $row["id"]; ?>" class="link"><img title="Edit" src="icon/edit.png"/></a> 
					<a href="delete.php?id=<?php echo $row["id"]; ?>" class="link"><img name="delete" id="delete" title="Delete" onclick="return confirm('Are you sure you want to delete?')" src="icon/delete.png"/></a>
					<a href="print.php?id=<?php echo $row["id"]; ?>" class="link"><img title="Print" src="icon/print.png"/></a> 
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<!-- If no record found -->
	<?php } else {
		echo "<div class='no_records' style = 'width:100%'><h1>No records are there , please add employee details!</h1></div>";
	} ?>
</body>
</html>