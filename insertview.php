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

<div id="userModal" class="container">
	<div class="">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="content">
				<div class="header">
					
					<h4 class="title">Add User</h4>
				</div>
				<div class="body">
					<label>Enter Name</label>
					<input type="text" name="Name" id="Name1" class="form-control" onblur="validate('Name',this.value)" />
					<span class="help-block" id="Name"></span>
					<br />
					<label>Enter DOB</label>
					<input type="date" name="DOB" id="DOB" class="form-control" />
					<br />	
					<label>Age</label>
					<input type="text" name="Age" id="Age" class="form-control" readonly />
					<br />
					<label>Enter Address</label>
					<textarea name="Address" rows="5" id="Address" class="form-control" ></textarea>
					<br />
					<label>Enter Email</label>
					<input type="email" name="Email" id="Email" class="form-control" />
					<br />
					<label>Enter Gender</label>
					<br />
<label class="radio-inline"><input type="radio" value="male" name="Gender" class="Gender">male</label>
<label class="radio-inline"><input type="radio"  value="female" name="Gender" class="Gender">female</label>
					<br />
					<label>Enter Subjects</label>
					<select class="form-control" name="Subjects[]" id="Subjects" size="4" multiple>
  <option value="tamil">tamil</option>
  <option value="english">english</option>
  <option value="maths">maths</option>
  <option value="science">science</option>
</select>

					<br />
					<label>enter ur vehicle</label>
					<br />
<label class="checkbox-inline"><input class="vehicle" type="checkbox" id="vehicle" name="vehicle[]" value="cycle">bi-cycle</label>
<label class="checkbox-inline"><input class="vehicle" type="checkbox" id="vehicle" name="vehicle[]" value="bike">bike</label>
<label class="checkbox-inline"><input class="vehicle" type="checkbox" id="vehicle" name="vehicle[]" value="car">car</label>
					<br />
					<label>Enter Total Marks</label>
					<input type="text" name="Marks" id="Marks" class="form-control" />
					<br />
					
				</div>
				<div class="footer">
					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" onclick="window.location.assign('index.php')" data-dismiss="modal">Back</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
function validate(field, query) {
var xmlhttp;
if (window.XMLHttpRequest) { // for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp = new XMLHttpRequest();
} else { // for IE6, IE5
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
document.getElementById(field).innerHTML = "Validating..";
} else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
document.getElementById(field).innerHTML = xmlhttp.responseText;
} else {
document.getElementById(field).innerHTML = "Error Occurred. <a href='index.php'>Reload Or Try Again</a> the page.";
}
}
xmlhttp.open("GET", "validation.php?field=" + field + "&query=" + query, false);
xmlhttp.send();
}
$(document).ready(function(){
		$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var Name1 = $('#Name1').val();
		var DOB = $('#DOB').val();
		var Age = $('#Age').val();
		var Address = $('#Address').text();
		var Email = $('#Email').val();
		var Gender = $('.Gender').val();
		var Subjects = $('#Subjects').val();
		alert(Subjects);
		var myCheckboxes = new Array();
        $(".vehicle:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
		alert(myCheckboxes);
		var Marks = $('#Marks').val();
		
		if(Name1 == '' || DOB == '')
		{
			alert("Both Fields are Required");
			
		}
		else
		{
			var Name1 = $('#Name').text();
			if(Name1=="Must be 3+ letters"){
				alert("Fill Valid Information");
			}
			else{
				$.ajax({
				url:"insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					window.location.assign('index.php');
				}
			});
			}
		}
	});
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
				
				$('#Name1').val(data.Name);
				$('#DOB').val(data.DOB);
				$('#Age').val(data.Age);
				$('#Address').text(data.Address);
				$('#Email').val(data.Email);
				if(data.Gender !=''){
					$('.Gender[value="'+data.Gender+'"]').prop("checked",true);
				}
				
				
				var values=data.Subjects;
				$.each(values.split(","), function(i,e){
				$('#Subjects option[value="'+e+'"]').prop("selected",true);
				});
				alert(data.Subjects);
				var vehicle=data.vehicle;
				$.each(vehicle.split(","), function(i,e){
				$('.vehicle[value="'+e+'"]').prop("checked",true);
				});
				$('#Marks').val(data.Marks);
				$('#user_id').val(user_id);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
		}
	});
</script>
<script>
$(document).ready(function(){
		$('#user_form')[0].reset();
		$('.title').text("Add User");
		$('#action').val("Add");
		$('#operation').val("Add");
$("#DOB").change(function(){
	var birth=$("#DOB").val();
	if(birth != ''){
	var birthdate=new Date(birth);	
    var today = new Date();
    var dayDiff = Math.ceil(today - birthdate) / (1000 * 60 * 60 * 24 * 365);
    var age = parseInt(dayDiff);
    $('#Age').val(age);
}
});
});

</script>
</body>
</html>
