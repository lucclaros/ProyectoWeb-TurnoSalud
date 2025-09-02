<?php
session_start();
	class martin{
		
		//esta funcion recibiria la id del turno para imprimir el coste del mismo aplicando el descuento de la obra social
		public function coste($doc){
			$tarifa = "SELECT precio from doctores dc where dc.id == $doc" //consulta a la tarifa del medico
			$descuento = "SELECT descuento from obras_sociales ob where paciente.obra_social == ob.id_obra_social" //consulta a el descuento de la obra social 
			$resultado = ($tarifa - $tarifa * $descuento);
			echo "el valor de la consulta seria: $resultado"

		}



	}

?>