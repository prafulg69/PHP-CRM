<?php
 include('session.php');
 ?>
<html>
<head><title>Create New Task</title>
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<?php  include 'header.php'; ?>
<script>
function hideShow(str){
if(str.checked == true ){		
document.getElementById("deadline_date").style.display='block';		
}	
else{		
document.getElementById("deadline_date").style.display='none';	
}}
</script>
<body style="background: #f5f5f5;"><div class="container">
<div class="col-form white-bg" style="float: none; margin: auto; box-shadow: 0 2px 1px #777;">
<h1 class="title-text">Create New Task</h1>		
<form  name="myForm" class="enquiry-form lead-form"  onsubmit="return validateForm()" action="createtask.php" method="POST">
<input type="text" value="<?php echo $login_session; ?>" name="given_by" hidden="true" readonly>
<label class="required-label">Task Title : </label>
<input type="text" value="" name="task_title">
<label class="required-label">Task Description : </label>
<textarea name="task_description" rows="4"></textarea>
<label class="required-label">Assign to : </label>
<select name="given_to">
<option value="">Select an option...</option>
<?php
  include 'db_config.php';
  $result= $db->query("SELECT email, name FROM `Users` WHERE status = 'active' ORDER BY name ASC");
  while($rows = $result->fetch_assoc()) { ?>
 <option value="<?php echo trim($rows["email"])?>"><?php echo trim($rows["name"])?></option>
<?php	} ?>
</select>
<label><input type="checkbox" onclick="hideShow(this)" name="deadline" value="true" style="margin-right: 5px;">Set Deadline</label>
<input type="datetime-local" name="deadline_date" value="<?php echo date('Y-m-d\TH:i'); ?>" id="deadline_date" style="display:none;">		

		<input class="red-button" type="submit" name="submit" value="Assign Task">
		</form>
		</div>
		</div>
		<script type="text/javascript">
		function validateForm() {		
	var task_title = document.forms["myForm"]["task_title"].value;
	var task_description = document.forms["myForm"]["task_description"].value;
	var given_to = document.forms["myForm"]["given_to"].value;
	
if ((task_title == null || task_title == "") || (task_description == null || task_description == "") || (given_to == null || given_to == "")) {
        //alert("Please fill all the required fields");
		swal("Error", "Please fill all the required fields", "error");
        return false;
    } 
}
</script>
</body>
</html>

<?php
if(isset($_POST['submit'])) {
date_default_timezone_set('Asia/Kolkata');
$fulldate= date("Y-m-d H:i:s");
$given_by = trim(addslashes($_POST['given_by']));
$task_title = trim(addslashes($_POST['task_title']));
$task_description=trim(addslashes($_POST['task_description']));
$given_to= trim(addslashes($_POST['given_to']));
$deadline=trim(addslashes($_POST['deadline']));
$deadline_date=trim(addslashes($_POST['deadline_date']));
$task_status="pending";
$url = "customerinfo.php?url=&custid=".$customer_id;

$results1 = $db->query("INSERT INTO `task` (`Task_title`, `Task_description`, `Given_by`, `Given_to`, `Date_created`, `Deadline`, `Deadline_Date`, `Task_status`) VALUES ('$task_title', '$task_description', '$given_by', '$given_to', '$fulldate', '$deadline', '$deadline_date', '$task_status');");
	
	if($results1){      
              echo "<script type='text/javascript'>swal('Success', 'New Task Created Successfully', 'success');</script>";
              echo "<script>window.open('$url','_self')</script>";
    }
    else {
          echo "<script type='text/javascript'>swal('Error', 'Failed Creating a New Task', 'error');</script>";
    }
}
?>