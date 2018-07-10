<?php
	require_once("db.php");
	/* Insert data code */
	if (isset($_POST['submit'])) {
		$sql = $conn->prepare("INSERT INTO employee_details ( `emp_name`, `emp_id`, `pf_no`, `salary`, `hra`, `pf`, `pt`, `esi`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");  

		$emp_name=$_POST['emp_name'];
		$emp_id = $_POST['emp_id'];
		$pf_no= $_POST['pf_no'];
		$salary= $_POST['salary'];
		$hra = $_POST['hra'];
		$pf = $_POST['pf'];
		$pt = $_POST['pt'];
		$esi = $_POST['esi'];

		$sql->bind_param("ssssssss", $emp_name, $emp_id, $pf_no, $salary, $hra, $pf, $pt, $esi); 
		if($sql->execute()) {
			$success_message = "Employee Data Added Successfully";
		} else {
			$error_message = "Problem in Adding New Record";
		}
		$sql->close();   
		$conn->close();
	} 
?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
	
<style>
.tbl-qa{border-spacing:0px;border-radius:4px;border:#6ab5b9 1px solid;}
</style>
  <title>Add New Employee</title> 	
</head>
<body>
<!-- For error and success message -->
<?php if(!empty($success_message)) { ?>
<div class="success message"><?php echo $success_message; ?></div>
<?php } if(!empty($error_message)) { ?>
<div class="error message"><?php echo $error_message; ?></div>
<?php } ?>
<!-- Function for autofill hra,pf,pt,esi based on salary field //START -->
<script type="text/javascript" charset="utf-8">     
		function getHRA(){         
			salary = document.getElementById("salary").value; 
			document.getElementById("hra").value = 0.20*salary;
			document.getElementById("pf").value = 0.1*salary;
			document.getElementById("pt").value = 0.2*salary;
			document.getElementById("esi").value = 0.1*salary;     
		}
</script>
<!-- Function for autofill hra,pf,pt,esi based on salary field //END -->
<form name="frmUser" method="post" action="">
<div class="button_link"><a href="index.php"> Back to List </a></div>
<!-- Add data table -->
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tbl-qa">
	<thead>
		<tr>
			<th colspan="2" class="table-header">Add New Employee</th>
		</tr>
	</thead>
	<tbody>
		<tr class="table-row">
			<td><label>Employee Name*</label></td>
			<td><input type="text" name="emp_name" class="txtField" required pattern="[a-zA-Z\s]+" title="Enter Characters only!"></td>
		</tr>
		<tr class="table-row">
			<td><label>Employee ID*</label></td>
			<td><input type="text" name="emp_id" class="txtField" required pattern="[0-9]+" title="Enter numbers only!"></td>
		</tr>
		<tr class="table-row">
			<td><label>PF Number*</label></td>
			<td><input type="text" name="pf_no" class="txtField" required pattern="[0-9]+" title="Enter numbers only!"></td>
		</tr>
		
		<tr class="table-row">
			<td><label>Salary*</label></td>
			<td><input type="text" id="salary" name="salary" class="txtField" onkeyup="getHRA();" required pattern="[0-9]+" title="Enter numbers only!"></td>
		</tr>
		<tr class="table-row">
			<td><label>HRA</label></td>
			<td><input type="text" id="hra" name="hra" class="txtField" readonly></td>
		</tr>
		<tr class="table-row">
			<td><label>PF</label></td>
			<td><input type="text" id="pf" name="pf" class="txtField" readonly></td>
		</tr>
		<tr class="table-row">
			<td><label>PT</label></td>
			<td><input type="text" id="pt" name="pt" class="txtField" readonly></td>
		</tr>
		<tr class="table-row">
			<td><label>ESI</label></td>
			<td><input type="text" id="esi" name="esi" class="txtField" readonly></td>
		</tr>
		<tr class="table-row">
			<td colspan="2"><input type="submit" name="submit" value="Submit" class="demo-form-submit"></td>
		</tr>
	</tbody>
</table>
</form>
</body>
</html>