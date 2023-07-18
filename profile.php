<?php

//profile.php



include('class/Appointment.php');

$object = new Appointment;

$object->query = "
SELECT * FROM patient_table 
WHERE patient_id = '".$_SESSION["patient_id"]."'
";

$result = $object->get_result();

include('header.php');

?>

<div class="container-fluid">
	<?php include('navbar.php'); ?>

	<div class="row justify-content-md-center">
		<div class="col col-md-6">
			<br />
			<?php
			if(isset($_GET['action']) && $_GET['action'] == 'edit')
			{
			?>
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6">	Изменить данные профиля	</div>
						<div class="col-md-6 text-right">
							<a href="profile.php" class="btn btn-secondary btn-sm"> Посмотреть </a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="post" id="edit_profile_form">
						<div class="form-group">
							<label> Электронной почты пациента <span class="text-danger">*</span></label>
							<input type="text" name="patient_email_address" id="patient_email_address" class="form-control" required autofocus data-parsley-type="email" data-parsley-trigger="keyup" readonly />
						</div>
						<div class="form-group">
							<label> Пароль пациента: <span class="text-danger">*</span></label>
							<input type="password" name="patient_password" id="patient_password" class="form-control" required  data-parsley-trigger="keyup" />
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label> Имя пациента <span class="text-danger">*</span></label>
									<input type="text" name="patient_first_name" id="patient_first_name" class="form-control" required  data-parsley-trigger="keyup" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label> Фамилия пациента <span class="text-danger">*</span></label>
									<input type="text" name="patient_last_name" id="patient_last_name" class="form-control" required  data-parsley-trigger="keyup" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label> Дата рождения пациента <span class="text-danger">*</span></label>
									<input type="text" name="patient_date_of_birth" id="patient_date_of_birth" class="form-control" required  data-parsley-trigger="keyup" readonly />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label> Пол пациента <span class="text-danger">*</span></label>
									<select name="patient_gender" id="patient_gender" class="form-control">
										<option value="Мужской"> Мужской </option>
										<option value="Женский"> Женский </option>
										<option value="Женский"> Прочее </option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label> Контактный номер пациента <span class="text-danger">*</span></label>
									<input type="text" name="patient_phone_no" id="patient_phone_no" class="form-control" required  data-parsley-trigger="keyup" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label> Семейное положение пациента <span class="text-danger">*</span></label>
									<select name="patient_maritial_status" id="patient_maritial_status" class="form-control">
										<option value="Single"> Одинокий </option>
										<option value="Married"> Женатый </option>
										<option value="Seperated"> Разделенный </option>
										<option value="Divorced"> В разводе </option>
										<option value="Widowed"> Овдовела </option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label> Полный адрес пациента <span class="text-danger">*</span></label>
							<textarea name="patient_address" id="patient_address" class="form-control" required data-parsley-trigger="keyup"></textarea>
						</div>
						<div class="form-group text-center">
							<input type="hidden" name="action" value="edit_profile" />
							<input type="submit" name="edit_profile_button" id="edit_profile_button" class="btn btn-primary" value=" Редактировать " />
						</div>
					</form>
				</div>
			</div>

			<br />
			<br />
			

			<?php
			}
			else
			{

				if(isset($_SESSION['success_message']))
				{
					echo $_SESSION['success_message'];
					unset($_SESSION['success_message']);
				}
			?>

			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6">	Детали профиля	</div>
						<div class="col-md-6 text-right">
							<a href="profile.php?action=edit" class="btn btn-secondary btn-sm"> Редактировать </a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-striped">
						<?php
						foreach($result as $row)
						{
						?>
						<tr>
							<th class="text-right" width="40%"> Имя пациента: </th>
							<td><?php echo $row["patient_first_name"] . ' ' . $row["patient_last_name"]; ?></td>
						</tr>
						<tr>
							<th class="text-right" width="40%"> Электронной почты: </th>
							<td><?php echo $row["patient_email_address"]; ?></td>
						</tr>
						<tr>
							<th class="text-right" width="40%"> Пароль пациента: </th>
							<td><?php echo $row["patient_password"]; ?></td>
						</tr>
						<tr>
							<th class="text-right" width="40%"> Адрес: </th>
							<td><?php echo $row["patient_address"]; ?></td>
						</tr>
						<tr>
							<th class="text-right" width="40%"> Контактный номер: </th>
							<td><?php echo $row["patient_phone_no"]; ?></td>
						</tr>
						<tr>
							<th class="text-right" width="40%"> Дата рождения: </th>
							<td><?php echo $row["patient_date_of_birth"]; ?></td>
						</tr>
						<tr>
							<th class="text-right" width="40%"> Пол: </th>
							<td><?php echo $row["patient_gender"]; ?></td>
						</tr>
						
						<tr>
							<th class="text-right" width="40%"> Семейное положение: </th>
							<td><?php echo $row["patient_maritial_status"]; ?></td>
						</tr>
						<?php
						}
						?>	
					</table>					
				</div>
			</div>
			<br />
			<br />
			<?php
			}
			?>
		</div>
	</div>
</div>

<?php

include('footer.php');


?>

<script>

$(document).ready(function(){

	$('#patient_date_of_birth').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });

<?php
	foreach($result as $row)
	{

?>
$('#patient_email_address').val("<?php echo $row['patient_email_address']; ?>");
$('#patient_password').val("<?php echo $row['patient_password']; ?>");
$('#patient_first_name').val("<?php echo $row['patient_first_name']; ?>");
$('#patient_last_name').val("<?php echo $row['patient_last_name']; ?>");
$('#patient_date_of_birth').val("<?php echo $row['patient_date_of_birth']; ?>");
$('#patient_gender').val("<?php echo $row['patient_gender']; ?>");
$('#patient_phone_no').val("<?php echo $row['patient_phone_no']; ?>");
$('#patient_maritial_status').val("<?php echo $row['patient_maritial_status']; ?>");
$('#patient_address').val("<?php echo $row['patient_address']; ?>");

<?php

	}

?>

	$('#edit_profile_form').parsley();

	$('#edit_profile_form').on('submit', function(event){

		event.preventDefault();

		if($('#edit_profile_form').parsley().isValid())
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:$(this).serialize(),
				beforeSend:function()
				{
					$('#edit_profile_button').attr('disabled', 'disabled');
					$('#edit_profile_button').val('wait...');
				},
				success:function(data)
				{
					window.location.href = "profile.php";
				}
			})
		}

	});

});

</script>