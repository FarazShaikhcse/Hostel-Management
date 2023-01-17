	<?php
	session_start();
	include('includes/config.php');
	include('includes/checklogin.php');
	check_login();

	if(isset($_GET['del']))
	{
	$id=$_GET['del'];
	$result = mysql_query("SELECT roomno FROM text WHERE regno ='$id'");
	while ($row = mysql_fetch_array($result)) 
	{
		$roomno= $row['roomno'];  
	}
	$adn1 = "update room_occupancy SET occupiedseats = occupiedseats - 1 where roomno = ?";
	$stmt1= $mysqli->prepare($adn1);
	$stmt1->bind_param('i',$roomno);
	$stmt1->execute();
	$stmt1->close();
	$adn="delete from registration where regNo=?";
	$stmt= $mysqli->prepare($adn);
	$stmt->bind_param('s',$id);
	$stmt->execute();
	$stmt->close();	   


	}
	?>
	<!doctype html>
	<html lang="en" class="no-js">

	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<title>Manage Rooms</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
	<script language="javascript" type="text/javascript">
		var popUpWin=0;
		function popUpWindow(URLStr, left, top, width, height)
		{
			if(popUpWin)
			{
				if(!popUpWin.closed) popUpWin.close();
			}
			popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+510+',height='+430+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
		}
	</script>

	</head>

	<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title" style="margin-top:4%">Manage Registred Students</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All Room Details</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Sno.</th>
											<th>Student Name</th>
											<th>Reg no</th>
											<th>Contact no </th>
											<th>room no  </th>
											<th>Seater </th>
											<th>Staying From </th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php	
										$aid=$_SESSION['id'];
										$ret="select * from registration";
										$stmt= $mysqli->prepare($ret) ;
	//$stmt->bind_param('i',$aid);
	$stmt->execute() ;//ok
	$res=$stmt->get_result();
	$cnt=1;
	while($row=$res->fetch_object())
	{
	$ret1="select firstName,middleName,lastName,contactNo from userregistration where regno = ?";
	$stmt1= $mysqli->prepare($ret1) ;
	$stmt1->bind_param('s',$row->regno);
	$stmt1->execute() ;//ok
	$stmt1->bind_result($fname,$mname,$lname,$cno);
	$rs=$stmt1->fetch();
	$stmt1->close();

	?>
	<tr><td><?php echo $cnt;;?></td>
		<td><?php 
		echo "$fname $mname $lname";
	?></td>
		<td><?php echo $row->regno;?></td>
		<td><?php echo $cno;?></td>
		<td><?php echo $row->roomno;?></td>
		<td><?php echo $row->seater;?></td>
		<td><?php echo $row->stayfrom;?></td>
		<td>
			<a href="student-details.php?regno=<?php echo $row->regno;?>" title="View Full Details"><i class="fa fa-desktop"></i></a>&nbsp;&nbsp;
			<a href="manage-students.php?del=<?php echo $row->regno;?>" title="Delete Record" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
		</tr>
		<?php
		$cnt=$cnt+1;
	} ?>


	</tbody>
	</table>


	</div>
	</div>


	</div>
	</div>



	</div>
	</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

	</body>

	</html>
