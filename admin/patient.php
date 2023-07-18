<?php

//patient.php

include('../class/Appointment.php');

$object = new Appointment;

if(!$object->is_login())
{
    header("location:".$object->base_url."admin");
}

if($_SESSION['type'] != 'Admin')
{
    header("location:".$object->base_url."");
}

include('header.php');

?>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"> Ведение пациентов </h1>

                    <!-- DataTales Example -->
                    <span id="message"></span>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        	<div class="row">
                            	<div class="col">
                            		<h6 class="m-0 font-weight-bold text-danger"> Список пациентов </h6>
                            	</div>
                            	<div class="col" align="right">
                            	</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="patient_table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th> Имя: </th>
                                            <th> Фамилия: </th>
                                            <th> Электронной почты: </th>
                                            <th> Контактный номер: </th>
                                            <th> Статус проверки электронной почты: </th>
                                            <th> Действие: </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <?php
                include('footer.php');
                ?>

<div id="viewModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title"> Просмотр сведений о пациенте </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="patient_details">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> Закрывать </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

	var dataTable = $('#patient_table').DataTable({
		"processing" : true,
		"serverSide" : true,
		"order" : [],
		"ajax" : {
			url:"patient_action.php",
			type:"POST",
			data:{action:'fetch'}
		},
		"columnDefs":[
			{
				"targets":[5],
				"orderable":false,
			},
		],
	});

    $(document).on('click', '.view_button', function(){

        var patient_id = $(this).data('id');

        $.ajax({

            url:"patient_action.php",

            method:"POST",

            data:{patient_id:patient_id, action:'fetch_single'},

            dataType:'JSON',

            success:function(data)
            {
                var html = '<div class="table-responsive">';

                html += '<table class="table">';

                html += '<tr><th width="40%" class="text-right"> Электронной почты: </th><td width="60%">'+data.patient_email_address+'</td></tr>';

                html += '<tr><th width="40%" class="text-right"> Пароль: </th><td width="60%">'+data.patient_password+'</td></tr>';

                html += '<tr><th width="40%" class="text-right"> Имя пациента: </th><td width="60%">'+data.patient_first_name+' '+data.patient_last_name+'</td></tr>';

                html += '<tr><th width="40%" class="text-right"> Контактный номер: </th><td width="60%">'+data.patient_phone_no+'</td></tr>';

                html += '<tr><th width="40%" class="text-right"> Адрес: </th><td width="60%">'+data.patient_address+'</td></tr>';

                html += '<tr><th width="40%" class="text-right"> Дата рождения: </th><td width="60%">'+data.patient_date_of_birth+'</td></tr>';

                html += '<tr><th width="40%" class="text-right"> Пол: </th><td width="60%">'+data.patient_gender+'</td></tr>';

                html += '<tr><th width="40%" class="text-right"> Семейное положение: </th><td width="60%">'+data.patient_maritial_status+'</td></tr>';

                html += '<tr><th width="40%" class="text-right"> Статус проверки электронной почты: </th><td width="60%">'+data.email_verify+'</td></tr>';

                html += '</table></div>';

                $('#viewModal').modal('show');

                $('#patient_details').html(html);

            }

        })
    });

	/*$(document).on('click', '.delete_button', function(){

    	var id = $(this).data('id');

    	if(confirm("Are you sure you want to remove it?"))
    	{

      		$.ajax({

        		url:"doctor_action.php",

        		method:"POST",

        		data:{id:id, action:'delete'},

        		success:function(data)
        		{

          			$('#message').html(data);

          			dataTable.ajax.reload();

          			setTimeout(function(){

            			$('#message').html('');

          			}, 5000);

        		}

      		})

    	}

  	});*/



});
</script>