<?php
		$id_agenda = 1; //$_POST['id_agenda'];
		$sql = "UPDATE turnos t inner join agendas a on t.id_agenda = $id_agenda set t.estado_turno = 'cancelado' where a.id_doctor == $_SESSION['id']";
		$result = mysqli_query($conn, $sql);

?>