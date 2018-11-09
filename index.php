<html>
	<head>
		<title>Webslesson Demo - PHP PDO Ajax CRUD with Data Tables and Bootstrap Modals</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<style>
			body
			{
				margin:0;
				padding:0;
				background-color:#f1f1f1;
			}
			.box
			{
				width:1270px;
				padding:20px;
				background-color:#fff;
				border:1px solid #ccc;
				border-radius:5px;
				margin-top:25px;
			}
		</style>
	</head>
	<body>
		<div class="container box">
			<h1 align="center">PHP PDO Ajax CRUD with Data Tables and Bootstrap Modals</h1>
			<br />
			<div class="table-responsive">
				<br />
				<div align="right">
					<button type="button" id="add_button" onclick="window.location.assign('insertview.php')" class="btn btn-info btn-lg">Add</button>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							
							<th width="10%">First Name</th>
							<th width="10%">DOB</th>
							<th width="10%">Age</th>
							<th width="10%">Address</th>
							<th width="10%">Email</th>
							<th width="10%">Gender</th>
							<th width="10%">Subjects</th>
							<th width="10%">Vehicle</th>
							<th width="10%">Total Marks</th>
							<th width="10%">Edit</th>
							<th width="10%">Delete</th>
							<th width="10%">View</th>
						</tr>
					</thead>
				</table>
				
			</div>
		</div>
	</body>
</html>





<script type="text/javascript" language="javascript" >
// AJAX code to check input field values when onblur event triggerd.

$(document).ready(function(){
	
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 8, 9],
				"orderable":false,
			},
		],
		"lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],

	});

	
	
	
	
	
	
	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{user_id:user_id},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
	
});
</script>
