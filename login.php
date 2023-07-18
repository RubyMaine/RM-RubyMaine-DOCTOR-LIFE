<?php

//login.php

include('header.php');

include('class/Appointment.php');

$object = new Appointment;

?>

<div class="container">
	<div class="row justify-content-md-center">
		<div class="col col-md-4">
			<?php
			if(isset($_SESSION["success_message"]))
			{
				echo $_SESSION["success_message"];
				unset($_SESSION["success_message"]);
			}
			?>
			<span id="message"></span>
			<div class="card">
				<div class="card-header" style="text-align: center;"><img src="img/logo.png" style="height: 130px;text-align:center;" alt=""></div>
				<div class="card-body">
					<form method="post" id="patient_login_form">
						<div class="form-group">
							<label> Электронной почты (пациента): </label>
							<input type="text" name="patient_email_address" id="patient_email_address" class="form-control" required autofocus data-parsley-type="email" data-parsley-trigger="keyup" placeholder="Электронной почты (пациента)..." />
						</div>
						<div class="form-group">
							<label> Введите ваш пароль: </label>
							<input type="password" name="patient_password" id="patient_password" class="form-control" required  data-parsley-trigger="keyup" placeholder="Введите ваш пароль:" />
						</div>
						<div class="form-group text-center">
							<input type="hidden" name="action" value="patient_login" />
							<input type="submit" name="patient_login_button" id="patient_login_button" class="btn btn-primary" value=" Войти " />
						</div>

						<div class="form-group text-center">
							<p><a href="register.php"> Регистрация (пациента)</a></p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

include('footer.php');

?>


<script>

$(document).ready(function(){

	$('#patient_login_form').parsley();

	$('#patient_login_form').on('submit', function(event){

		event.preventDefault();

		if($('#patient_login_form').parsley().isValid())
		{
			$.ajax({

				url:"action.php",
				method:"POST",
				data:$(this).serialize(),
				dataType:"json",
				beforeSend:function()
				{
					$('#patient_login_button').attr('disabled', 'disabled');
				},
				success:function(data)
				{
					$('#patient_login_button').attr('disabled', false);

					if(data.error != '')
					{
						$('#message').html(data.error);
					}
					else
					{
						window.location.href="dashboard.php";
					}
				}
			});
		}

	});

});



</script>