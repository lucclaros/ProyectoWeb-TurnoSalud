<?php

	class email{
		public function respuesta($estado)
		{
			$destino="$_SESSION['email']";
			$asunto="no respond turno salud";
			if($estado == "aprobado"){
				$mensaje="el tunro fue aprobado correctamente";
			}
			else{
				$mensaje="el tunro no esta aprobado"
			}
			$header="From: ".$_SESSION['nombre']."<".$_SESSION['email'].">";

			$enviado = mail($destino,$asunto,$mensaje,$header);

			if($enviado == true){
				echo "Su correo ha sido enviado.";
			}else{
				echo "Hubo un error en el envio del mail.";
			}
		}

	}
?>