<?php

class Log {
	
	//globals
	var $logDir="";
	var $logFile="";
	var $countFile="";
	var $headerTitle="";
	var $logMode="";
	var $logNumber="";
		
		
		
		
	/**
	* @return void
	* @desc 
		Class constructor.
		Prepares files for first run.
		Global variables setting.
		
		//spanish
		Prepara los archivos a utilizar para inicializar
		el log por primera vez y setea las variables
		globales.
	*/
	function Log($logDir='log', $logFile='log_', $headerTitle='LOG', $logMode='oneFile', $countFile="counter"){
		//-----------------------------------------------------
		//set global variables //es: seteo variables globales
		$this->logDir=$logDir;
		$this->logFile=$logFile;
		if($countFile) $this->countFile=$this->logDir . "/$countFile";
		$this->headerTitle=$headerTitle;
		$this->logMode=$logMode;
		
		
	
		//generate log number //es: genero el NRO DE LOG
		//set counter file and log folder //es: seteo el archivo contador y la carpeta de logs
		$countFile=$this->countFile;
		$logDir=$this->logDir;
		
		//verify log folder existence //es: verifico que exista la carpeta de logs
		//if it doesn't I create it //es: si no existe la creo
		if(!is_dir($logDir)){
			if(mkdir($logDir)===FALSE){
				echo "Could not create log dir"; //es: 'No es posible crear el directorio de logs';
			}
		}
		
		
		//Counter INICILIZATION //es: INICIALIZACIÓN del Counter
		if(file_exists($countFile)===FALSE){
			//if log counter file does not exist, I create it //es: si el archivo de conteo de logs no existe lo genero
			touch($countFile);
			
			//inicializing file in 0 //es: inicializo el archivo en 0
			$initNumber=0;
			$fp=fopen($countFile,"a");
			if(fwrite($fp,$initNumber)===FALSE){
				echo "Could not write Counter file"; //es: "No es posible escribir el archivo Contador";
			}
			fclose($fp);
		}
		//------------------------------------------------------------
		

		//INCREMENT Counter //es: AUMENTO del Counter
		//read counter //es: leo el contador
		$logNumber=trim(file_get_contents($countFile));
		$logNumber++; //increment counter //es: incremento el contador
		
		//set log number in class var //es: seteo la variable de Clase con el nro de log
		$this->logNumber=$logNumber;
		
		//write incremented counter value //es: escribo el contador aumentado en 1
		$fp=fopen($countFile,"w+");
		if(fwrite($fp,$logNumber)===FALSE){
			echo "Could not write Counter file"; //es: "No es posible escribir el archivo Contador";
		}
		fclose($fp);
		//-----------------------------------------------------	
	}//end function
	
	//-----------------------------------------------------------------
		
	/**
	* @return void
	* @param String $logString
	* @desc
		Recieves the string you want lo log.
		This function is used by "logThis" function,
		which offers simplified logging with
		some practical functions.
		
		//spanish
		Recibe la cadena a loggear en el archivo de logs.
		Esta función es utilizada por "logThis",
		función que ofrece un uso simplificado de logging
		con varias funciones prácticas.		
	*/
		function writeLog($logString){
			global $logNumber;
			
			
			//depending on selected log mode... //es: según el modo de log definido...
			//use only one log file, or one file per log instance //es: uso un único archivo o un archivo por log
			if($this->logMode=='oneFilePerLog'){
				$logFile=$this->logDir . "/" . $this->logFile . $logNumber . '.log';
			} else {
				//"oneFile" mode
				$logFile=$this->logDir . "/" . $this->logFile . '.log';	
			}
			
			//in case file does not exist //es: considero que el archivo no exista
			if(file_exists($logFile)===FALSE){
				//if log file does not exist, I create it //es: si el archivo de log no existe lo genero
				touch($logFile);
				
				//generate file header //es: genero el encabezado del archivo
				$logHeader =$this->headerTitle . "\n"; //. " " . $logNumber . "\n";
				$logHeader.='--------------------------------------------------------------------' . "\n";
				$logHeader.='--------------------------------------------------------------------' . "\n\n\n";
				
				$fp=fopen($logFile,"w+");
				if(fwrite($fp,$logHeader)===FALSE){
					echo "Could not write LOG Header"; //es: "No es posible escribir el Header del archivo de LOG";
				}
				fclose($fp);
			}//end if fileExists
			//-----------------------------------
			
			
			
			//write to log file //es: escribo el archivo de LOG
			$fp=fopen($logFile,"a");
			if(fwrite($fp,$logString)===FALSE){
				echo "Could not write to LOG file"; //es: "No es posible escribir el archivo de LOG";
			}
			fclose($fp);
		}//end function
	
		//-----------------------------------------------------------------
	
		/**
		* @return void
		* @param String $string
		* @param String $modifier
		* @desc 
			Writes to LOG File each recieved value.
			To write the log we use the function "writeLog".
					
			Esta función va escribiendo en el archivo de LOG 
			a medida que recibe	valores. 
			Para escribir el log se recurre a la función "writeLog".
			
			Output: $this->writeLog()
					Will directly write to log file
		*/
		function logThis($string,$modifier="empty"){
			//provides a global counter //es: la función provee un contador global
			global $logThisCounter;
	
	
	
	
			//for logThisCounter to start in 1 //es: para que el logThisCounter comience en 1
			if(!isset($logThisCounter)){
				$logThisCounter=0;
			} 
	
			
			//set "line" separator //es: seteo el separador "line"
			$line="\n" . '--------------------------------------------------------------------' . "\n";
			
			
			
			
			//it uses modifiers only if a log function has not
			//been passed
			
			//spanish
			//uso los modificadores sólo si no se ha seteado el uso 
			//de una función de log en forma directa.
			//se considera la posibilidad de pasar sólo una línea, por ej,
			//como: logThis('f:line'), en tal caso no se usan modificadores
			if(substr($string,0,2)!='f:'){
				//manejo distintos tipos de modificadores
				switch($modifier){
					case 'empty':
						$this->writeLog($string . "\n");
						break;
						
					case 'n':
						$this->writeLog($string . "\n");
						break;
						
					case '2n':
						$this->writeLog($string . "\n\n");
						break;
						
					case '3n':
						$this->writeLog($string . "\n\n\n");
						break;
						
					case 'line':
						$this->writeLog($string . $line);
						break;
						
					case '2line':
						$this->writeLog($string . $line . $line);
						break;
						
					case 'nLine':
						$this->writeLog($string . "\n" . $line);
						break;
						
					case '2nLine':
						$this->writeLog($string . "\n\n" . $line);
						break;
						
					case 'n2Line':
						$this->writeLog($string . "\n" . $line . $line);
						break;
				}//end switch $modifier
			} else {
				//----------------
				//FUNCTIONS - "F:"
				//--------------------------------------------------
				//using a log function passed in $string //es: aquí estoy utilizando una función de log pasada en $string
				//example: logThis('f:line')
				switch($string){
					case 'f:line':
						$this->writeLog($line);
						break;
					
					case 'f:2line':
						$this->writeLog($line . $line);
						break;
						
					case 'f:nl':
						$this->writeLog("\n");
						break;
						
					case 'f:2nl':
						$this->writeLog("\n\n");
						break;	
						
					case 'f:logNumber':
						$this->writeLog('+ LOG Number: ' . $this->logNumber . "\n");	
						break;
						
					case 'f:counter':
						switch($modifier){
							case 'empty':
								$logThisCounter++;
								$this->writeLog($logThisCounter);
								break;	
								
							default:
								$logThisCounter++;
								$this->writeLog($modifier . $logThisCounter);
								break;	
						}//end switch f:counter
						break;
						
					case 'f:counter.nl':
						switch($modifier){
							case 'empty':
								$logThisCounter++;
								$this->writeLog($logThisCounter . "\n");
								break;	
								
							default:
								$logThisCounter++;
								$this->writeLog($modifier . $logThisCounter . "\n");
								break;	
						}//end switch f:counter
						break;
						
					case 'f:nl.counter':
						switch($modifier){
							case 'empty':
								$logThisCounter++;
								$this->writeLog("\n" . $logThisCounter);
								break;	
								
							default:
								$logThisCounter++;
								$this->writeLog("\n" . $modifier . $logThisCounter);
								break;	
						}//end switch f:counter
						break;
						
					case 'f:nl.counter.nl':
						switch($modifier){
							case 'empty':
								$logThisCounter++;
								$this->writeLog("\n" . $logThisCounter . "\n");
								break;	
								
							default:
								$logThisCounter++;
								$this->writeLog("\n" . $modifier . $logThisCounter . "\n");
								break;	
						}//end switch f:counter
						break;
				}//end switch $string
			
			}//end if "f:"
			
			
		}
	
		//----------------------------------------------

		/**
		* @return String $fecha
		* @desc 
			Return formatted actual date.
			Example: 28.08.2005 - 01:14
			
			
			//spanish
			Devuelve la fecha actual formateada.
		*/
		function get_formatted_date(){
			$fecha=date("d.m.Y - ") . (date("H")) . date(":i");
			
			return $fecha;
		}
		
		//-----------------------------------------------------------------
		/**
		 * Delete a file, or a folder and its contents
		 *
		 * @author      Aidan Lister <aidan@php.net>
		 * @version     1.0.2
		 * @param       string   $dirname    Directory to delete
		 * @return      bool     Returns TRUE on success, FALSE on failure
		 */
		function rmdirr($dirname)
		{
			// Sanity check
			if (!file_exists($dirname)) {
				//echo 'dir not exist: ' . $dirname . "<br>\n";
				return false;
			}
		 
			// Simple delete for a file
			if (is_file($dirname)) {
				return unlink($dirname); //delete files inside dir //acá elimina los archivos dentro del dir
				//echo 'DELETED FILE: ' . $dirname . "<br>\n";
			}
		 
			
			if(is_dir($dirname)){
				// Loop through the folder
				$dir = dir($dirname);
				while (false !== $entry = $dir->read()) {
					// Skip pointers
					if ($entry == '.' || $entry == '..') {
						continue;
					}
			 
					// Recurse
					$this->rmdirr("$dirname/$entry");
				}
			 
				// Clean up 
				$dir->close();
				return rmdir($dirname); //delete empty dir //acá elimina el directorio que ya quedó vacío
				//echo 'DELETED DIR : ' . $dirname . "<br>\n";
			}//fin if is dir
			
			
			
		}
		//-----------------------------------------------------------------
		
		/**
		* @return void
		* @desc
			Deletes log dir and its contents.
			
			//spanish
			Elimina el directorio de Logs y su contenido
			para comenzar un nuevo proceso de log desde cero.
		*/
		function clean(){
			$this->rmdirr($this->logDir);
		}
		
		
		
} //end class Log




	

?>