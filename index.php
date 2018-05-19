<?php include 'action.php'; ?>
<html>
	<head>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="jumbotron">
				<h1>Medicine Stock<small>MAS</small></h1>
			</div>
		</div>
		<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="panel panel-primary">
				<div class="panel-heading">Enter Medicine Details</div>
				<div class="panel-body">
				<?php
						if(isset($_GET['update'])) {
							$id = $_GET['mid'] ?? null;
							$where = array('mid'=>$id);
							$rec = $obj->select_record('medicines',$where);
				?>
					<form method="post" action="action.php">
						<table class="table table-hover">
							<tr>
								<td><input type="hidden" value="<?php echo $rec['mid'] ?>" name="id" ></td>
							</tr>
							<tr>
								<td>Medicine Name</td>
								<td><input type="text" value="<?php echo $rec['m_name'] ?>" class="form-control" name="mname" placeholder="Enter Medicine Name"></td>
							</tr>
							<tr>
								<td>Quantity</td>
								<td><input type="text" value="<?php echo $rec['qty'] ?>" class="form-control" name="qty" placeholder="Enter Quantity"></td>
							</tr>
							<tr>
								<td colspan="2" align="center">
									<input type="submit" class="btn btn-primary" name="edit" value="Update">
								</td>
							</tr>
						</table>
					</form>
				<?php } else { ?>
				<form method="post" action="action.php">
						<table class="table table-hover">
							<tr>
								<td>Medicine Name</td>
								<td><input type="text" class="form-control" name="mname" placeholder="Enter Medicine Name"></td>
							</tr>
							<tr>
								<td>Quantity</td>
								<td><input type="text" class="form-control" name="qty" placeholder="Enter Quantity"></td>
							</tr>
							<tr>
								<td colspan="2" align="center">
									<input type="submit" class="btn btn-primary" name="submit" value="Store">
								</td>
							</tr>
						</table>
					</form>
				<?php } ?>
				</div>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<table class="table table-bordered">
						<tr>
							<td>#</td>
							<td>Medicine Name</td>
							<td>Available Stock</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<?php
							$record = $obj->fetch_record('medicines	');
							foreach($record as $rec) {
						?>
						<tr>
							<td><?php echo $rec['mid'] ?></td>
							<td><?php echo $rec['m_name'] ?></td>
							<td><b><?php echo $rec['qty'] ?></b></td>
							<td><a href="?update=1&mid=<?php echo $rec['mid'] ?>" class="btn btn-info">Edit</a></td>
							<td><a href="?update=1&mid=<?php echo $rec['mid'] ?>" class="btn btn-danger">Delete</a></td>
						</tr>
						<?php 
							}
						?>
					</table>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>

	</body>
</html>