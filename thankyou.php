<html>
<head>
<title>Thank you</title>
<link rel="stylesheet" type="text/css" href="css/crm-stylesheet.css" />	
<link href="https://fonts.googleapis.com/css?family=Dosis:500" rel="stylesheet">
</head>
<body style="background: url(images/gif-background.gif) center/cover no-repeat;">
<?php include('header.php'); ?>
<div class="container" >
<div class="confirm-box">
<h2>THANK YOU</h2>
<?php $orderid = $_GET['id']; $type = trim($_GET['type']); $cust_id = ($_GET['custid']);?>
<h3>Your Order No <?php echo $orderid; ?> has been Submitted</h3>
<?php if($type == "sample") { ?>
<a href="editsampleorder.php?id=<?php echo $orderid; ?>&custid=<?php echo $cust_id; ?>">Show Sample Order</a>
<?php } else { ?>
<a href="ordertable.php?searchtype=idsearch&id=<?php echo $orderid; ?>">Show Order</a>
<?php } ?>
</div>
</div>
</body>
</html>