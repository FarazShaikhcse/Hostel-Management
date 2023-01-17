<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for registration
if(isset($_POST['submit']))
{
	$roomno=$_POST['room'];
	$seater=$_POST['seater'];
	$feespm=$_POST['fpm'];
	$foodstatus=$_POST['foodstatus'];
	$stayfrom=$_POST['stayf'];
	$duration=$_POST['duration'];
	$regno=$_POST['regno'];
	$fname=$_POST['fname'];
	$mname=$_POST['mname'];
	$lname=$_POST['lname'];
	$gender=$_POST['gender'];
	$contactno=$_POST['contact'];
	$emailid=$_POST['email'];
	$emcntno=$_POST['econtact'];
	$gurname=$_POST['gname'];
	$gurrelation=$_POST['grelation'];
	$gurcntno=$_POST['gcontact'];
	$paddress=$_POST['paddress'];
	$pcity=$_POST['pcity'];
	$pstate=$_POST['pstate'];
	$ppincode=$_POST['ppincode'];
	$result ="SELECT count(*) FROM userRegistration WHERE email=? || regNo=?";
	$stmt = $mysqli->prepare($result);
	$stmt->bind_param('ss',$email,$regno);
	$stmt->execute();
	$stmt->bind_result($count);
	$stmt->fetch();
	$stmt->close();
	if($count>0)
	{
		echo"<script>alert('Registration number or email id already registered.');</script>";
	}else{

		$query1="insert into  userregistration(regNo,firstName,middleName,lastName,gender,contactNo,email,password) values(?,?,?,?,?,?,?,?)";
		$stmt1= $mysqli->prepare($query1);
		$defaultPassword = "12345";
		$stmt1->bind_param('sssssiss',$regno,$fname,$mname,$lname,$gender,$contactno,$emailid,$defaultPassword);
		$stmt1->execute();

		$query="insert into  registration(roomno,seater,feespm,foodstatus,stayfrom,duration,regno,egycontactno,guardianName,guardianRelation,guardianContactno,pmntAddress,pmntCity,pmnatetState,pmntPincode) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $mysqli->prepare($query);
		$rc=$stmt->bind_param('iiiisisississsi',$roomno,$seater,$feespm,$foodstatus,$stayfrom,$duration,$regno,$emcntno,$gurname,$gurrelation,$gurcntno,$paddress,$pcity,$pstate,$ppincode);
		$stmt->execute();
		$stmt->close();

		$query2 = "update room_occupancy SET occupiedseats = occupiedseats + 1 where roomno = ?";
		$stmt2 = $mysqli->prepare($query2);
		$stmt2->bind_param('i',$roomno);
		$stmt2->execute();
		echo"<script>alert('Student Succssfully registered');</script>";
	}
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
	<title>Student Hostel Registration</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">>
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
	<script type="text/javascript" src="js/validation.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script>
		function getSeater(val) {
			$.ajax({
				type: "POST",
				url: "get_seater.php",
				data:'roomid='+val,
				success: function(data){
//alert(data);
$('#seater').val(data);
}
});

			$.ajax({
				type: "POST",
				url: "get_seater.php",
				data:'rid='+val,
				success: function(data){
//alert(data);
$('#fpm').val(data);
}
});
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
						
						<h2 class="page-title">Registration </h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading">Registration Info</div>
									<div class="panel-body">
										<form method="post" action="" class="form-horizontal">
											
											
											<div class="form-group">
												<label class="col-sm-4 control-label col-sm-offset-1 text-primary"><h3 align="left">Room Related info </h3> </label>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Room no. </label>
												<div class="col-sm-8">
													<select name="room" id="room"class="form-control"  onChange="getSeater(this.value);" onBlur="checkAvailability()" required> 
														<option value="">Select Room</option>
														<?php $query ="SELECT * FROM rooms
														INNER JOIN room_occupancy ON rooms.room_no = room_occupancy.roomno and
														room_occupancy.occupiedseats < rooms.seater;";
														$stmt2 = $mysqli->prepare($query);
														$stmt2->execute();
														$res=$stmt2->get_result();
														while($row=$res->fetch_object())
														{
															?>
															<option value="<?php echo $row->room_no;?>"> <?php echo $row->room_no;?></option>
														<?php } ?>
													</select> 
													<span id="room-availability-status" style="font-size:12px;"></span>

												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-2 control-label">Seater</label>
												<div class="col-sm-8">
													<input type="text" name="seater" id="seater"  class="form-control" readonly="true"  >
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Fees Per Month</label>
												<div class="col-sm-8">
													<input type="text" name="fpm" id="fpm"  class="form-control" readonly="true">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Food Status</label>
												<div class="col-sm-8">
													<input type="radio" value="0" name="foodstatus" checked="checked"> Without Food
													<input type="radio" value="1" name="foodstatus"> With Food
												</div>
											</div>	

											<div class="form-group">
												<label class="col-sm-2 control-label">Stay From</label>
												<div class="col-sm-8">
													<input type="date" name="stayf" id="stayf"  class="form-control" >
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Duration</label>
												<div class="col-sm-8">
													<select name="duration" id="duration" class="form-control">
														<option value="">Select Duration in Month</option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
														<option value="10">10</option>
														<option value="11">11</option>
														<option value="12">12</option>
													</select>
												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-2 col-sm-offset-1 control-label text-primary"><h3 align="left">Personal Info </h3> </label>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Registration No : </label>
												<div class="col-sm-8">
													<input type="text" name="regno" id="regno"  class="form-control" required="required"  onBlur="checkRegnoAvailability()">
													<span id="user-reg-availability" style="font-size:12px;"></span>
												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-2 control-label">First Name : </label>
												<div class="col-sm-8">
													<input type="text" name="fname" id="fname"  class="form-control" required="required" >
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Middle Name : </label>
												<div class="col-sm-8">
													<input type="text" name="mname" id="mname"  class="form-control">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Last Name : </label>
												<div class="col-sm-8">
													<input type="text" name="lname" id="lname"  class="form-control" required="required">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Gender : </label>
												<div class="col-sm-8">
													<select name="gender" class="form-control" required="required">
														<option value="">Select Gender</option>
														<option value="male">Male</option>
														<option value="female">Female</option>
														<option value="others">Others</option>
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Contact No : </label>
												<div class="col-sm-8">
													<input type="text" name="contact" id="contact"  class="form-control" required="required" maxlength="10">
												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-2 control-label">Email id : </label>
												<div class="col-sm-8">
													<input type="email" name="email" id="email"  class="form-control" onBlur="checkAvailability()" required="required">
													<span id="user-availability-status" style="font-size:12px;"></span>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Emergency Contact: </label>
												<div class="col-sm-8">
													<input type="text" name="econtact" id="econtact"  class="form-control" required="required" maxlength="10">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Guardian  Name : </label>
												<div class="col-sm-8">
													<input type="text" name="gname" id="gname"  class="form-control" required="required">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Guardian  Relation : </label>
												<div class="col-sm-8">
													<input type="text" name="grelation" id="grelation"  class="form-control" required="required">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Guardian Contact no : </label>
												<div class="col-sm-8">
													<input type="text" name="gcontact" id="gcontact"  class="form-control" required="required" maxlength="10">
												</div>
											</div>							

											<div class="form-group">
												<label class="col-sm-3 control-label col-sm-offset-1 text-primary"><h3 align="left">Permanent Address </h3> </label>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Address : </label>
												<div class="col-sm-8">
													<textarea  rows="5" name="paddress"  id="paddress" class="form-control" required="required"></textarea>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">City : </label>
												<div class="col-sm-8">
													<input type="text" name="pcity" id="pcity"  class="form-control" required="required">
												</div>
											</div>	

											<div class="form-group">
												<label class="col-sm-2 control-label">State </label>
												<div class="col-sm-8">
													<select name="pstate" id="pstate"class="form-control" required> 
														<option value="">Select State</option>
														<?php $query ="SELECT * FROM states";
														$stmt2 = $mysqli->prepare($query);
														$stmt2->execute();
														$res=$stmt2->get_result();
														while($row=$res->fetch_object())
														{
															?>
															<option value="<?php echo $row->State;?>"><?php echo $row->State;?></option>
														<?php } ?>
													</select> </div>
												</div>							

												<div class="form-group">
													<label class="col-sm-2 control-label">Pincode : </label>
													<div class="col-sm-8">
														<input type="text" name="ppincode" id="ppincode"  class="form-control" required="required" maxlength="6">
													</div>
												</div>	

												<div class="form-group">
													<button class="btn btn-default col-sm-1 col-sm-offset-4 text-lg" type="submit">Cancel</button>
													<div class="col-sm-1"></div>
													<input type="submit" name="submit" Value="Register" class="btn btn-success col-sm-1 text-lg">
												</div>
											</div>
										</form>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> 	
</div>
</div>
</div>
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
<script>
	function checkAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "check_availability.php",
			data:'roomno='+$("#room").val(),
			type: "POST",
			success:function(data){
				$("#room-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error:function (){}
		});
	}
</script>

<script>
	function checkAvailability() {

		$("#loaderIcon").show();
		jQuery.ajax({
			url: "check_availability.php",
			data:'emailid='+$("#email").val(),
			type: "POST",
			success:function(data){
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error:function ()
			{
				event.preventDefault();
				alert('error');
			}
		});
	}
</script>
<script>
	function checkRegnoAvailability() {

		$("#loaderIcon").show();
		jQuery.ajax({
			url: "check_availability.php",
			data:'regno='+$("#regno").val(),
			type: "POST",
			success:function(data){
				$("#user-reg-availability").html(data);
				$("#loaderIcon").hide();
			},
			error:function ()
			{
				event.preventDefault();
				alert('error');
			}
		});
	}
</script>

</html>