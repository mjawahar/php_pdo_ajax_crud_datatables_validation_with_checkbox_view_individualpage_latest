<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<div id="userviewModal" class="">
	<div class="">
		<form method="post"  class="form-horizontal" enctype="multipart/form-data">
			<div class="content">
				<div class="header">
					
					<h4 class="title">View User</h4>
				</div>
				<div class="body">
				<div class="form-group">
    <label class="control-label col-sm-3">Name:</label>
    <div class="col-sm-9">
      <p class="form-control-static" id="Namev"></p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3">DOB:</label>
    <div class="col-sm-9">
      <p class="form-control-static" id="DOBv"></p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3">Age:</label>
    <div class="col-sm-9">
      <p class="form-control-static" id="Agev"></p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3">Address:</label>
    <div class="col-sm-9">
      <p class="form-control-static" id="Addressv"></p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3">Email:</label>
    <div class="col-sm-9">
      <p class="form-control-static" id="Emailv"></p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3">Gender:</label>
    <div class="col-sm-9">
      <p class="form-control-static" id="Genderv"></p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3">Subjects:</label>
    <div class="col-sm-9">
      <p class="form-control-static" id="Subjectsv"></p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3">vehicle:</label>
    <div class="col-sm-9">
      <p class="form-control-static" id="vehiclev"></p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3">Total Marks:</label>
    <div class="col-sm-9">
      <p class="form-control-static" id="Marksv"></p>
    </div>
  </div>
					
					
					
					
					
					
					
					
					
				</div>
				<div class="footer">
					<input type="hidden" name="user_id" id="user_idv" />
					<button type="button" class="btn btn-default" onclick="window.location.assign('index.php')" data-dismiss="modal">Back</button>
					
				</div>
			</div>
		</form>
	</div>
</div>
</div>
<script>
$(document).ready(function(){
	 if(window.location.hash)
    {
    	var user_id = window.location.hash.substring(4);
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				
				$('#Namev').text(data.Name);
				$('#DOBv').text(data.DOB);
				$('#Agev').text(data.Age);
				$('#Addressv').text(data.Address);
				$('#Emailv').text(data.Email);
				$('#Genderv').text(data.Gender);
				
				$('#Subjectsv').text(data.Subjects);
				$('#vehiclev').text(data.vehicle);
				
				$('#Marksv').text(data.Marks);
				$('#user_idv').val(user_id);
			}
		})
		}
	});
</script>
</body>
</html>