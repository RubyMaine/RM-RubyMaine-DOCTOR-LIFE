	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  		<!-- Brand -->
  		<a class="navbar-brand" href="#"><?php echo $_SESSION['patient_name']; ?></a>

  		<!-- Links -->
	  	<ul class="navbar-nav">
	    	<li class="nav-item">
	      		<a class="nav-link" href="profile.php"> Профиль </a>
	    	</li>
	    	<li class="nav-item">
	      		<a class="nav-link" href="dashboard.php"> Записаться на прием </a>
	    	</li>
	    	<li class="nav-item">
	      		<a class="nav-link" href="appointment.php"> Моя встреча</a>
	    	</li>
	    	<li class="nav-item">
	      		<a class="nav-link" href="logout.php"> Выйти </a>
	    	</li>
	  	</ul>
	</nav>