<?php
	//include database file
	require_once("db.php");

	//Get the employee data and update
	if (isset($_POST['submit'])) {		
		$sql = $conn->prepare("UPDATE employee_details SET emp_name=? , emp_id=? , pf_no=? , salary=? , hra=? , pf=? , pt=? , esi=?  WHERE id=?");
		$emp_name=$_POST['emp_name'];
		$emp_id = $_POST['emp_id'];
		$pf_no= $_POST['pf_no'];
		$salary= $_POST['salary'];
		$hra= $_POST['hra'];
		$pf= $_POST['pf'];
		$pt= $_POST['pt'];
		$esi= $_POST['esi'];

		$sql->bind_param("ssssssssi",$emp_name, $emp_id, $pf_no, $salary, $hra, $pf, $pt, $esi,$_GET["id"]);	
		if($sql->execute()) {
			$success_message = "Employee Data Edited Successfully";
		} else {
			$error_message = "Problem in Editing Record";
		}

	}
	//Display updated data
	$sql = $conn->prepare("SELECT * FROM employee_details WHERE id=?");
	$sql->bind_param("i",$_GET["id"]);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {		
		$row = $result->fetch_assoc();
	}
	$conn->close();
?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<style>
.tbl-qa{border-spacing:0px;border-radius:4px;border:#6ab5b9 1px solid;}
</style>
<title>Employee Edit</title>
</head>
<body>
<!-- For Error and success msg -->
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
<div class="button_link"><a href="index.php" >Back to List </a></div>

<!-- Update data table-->
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tbl-qa">
	<thead>
		<tr>
			<th colspan="2" class="table-header">Employee Edit</th>
		</tr>
	</thead>
	<tbody>
		<tr class="table-row">
			<td><label>Employee Name</label></td>
			<td><input type="text" name="emp_name" class="txtField" value="<?php echo $row["emp_name"]?>"></td>
		</tr>
		<tr class="table-row">
			<td><label>Employee_id</label></td>
			<td><input type="text" name="emp_id" class="txtField" value="<?php echo $row["emp_id"]?>"></td>
		</tr>
		<tr class="table-row">
			<td><label>PF Number</label></td>
			<td><input type="text" name="pf_no" class="txtField" value="<?php echo $row["pf_no"]?>"></td>
		</tr>
		<tr class="table-row">
			<td><label>Salary</label></td>
			<td><input type="text" id="salary" name="salary" class="txtField" onkeyup="getHRA();" value="<?php echo $row["salary"]?>"></td>
		</tr>
		<tr class="table-row">
			<td><label>HRA</label></td>
			<td><input type="text" id="hra" name="hra" class="txtField" value="<?php echo $row["hra"]?>"></td>
		</tr>
		<tr class="table-row">
			<td><label>PF</label></td>
			<td><input type="text" id="pf" name="pf" class="txtField" value="<?php echo $row["pf"]?>"></td>
		</tr>
		<tr class="table-row">
			<td><label>PT</label></td>
			<td><input type="text" id="pt" name="pt" class="txtField" value="<?php echo $row["pt"]?>"></td>
		</tr>
		<tr class="table-row">
			<td><label>ESI</label></td>
			<td><input type="text" id="esi" name="esi" class="txtField" value="<?php echo $row["esi"]?>"></td>
		</tr>
		<tr class="table-row">
			<td colspan="2"><input type="submit"  name="submit" value="Submit" class="demo-form-submit"></td>
		</tr>
	</tbody>	
</table>
</form>
</body>
</html>