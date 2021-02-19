<?php
	/**
	 * 
	 */
	class database
	{
		function connect(){
			$con1 = mysqli_connect("localhost","root","");
			mysqli_select_db($con1,"prueba_evelyn");
			return($con1);
		}
	}