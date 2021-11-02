<?php

Class CsvUtility{

	protected $input;
	public function __construct($input){
		$this->input = $input;	
	}

	public function makeEachInputWordUpper(){
		return strtoupper($this->input)."\n";
	}

	public function makeAlternateInputWordUpper(){
		$temp_string = str_split($this->input);
		$capslock_flag = true;
		foreach($temp_string as $key=>$value){
		    if($capslock_flag){
		        $output = strtoupper($value);
		        if($output <> " ")  
		            $capslock_flag = false;
		    }
		    else{
		        $output = strtolower($value);
		        $capslock_flag = true;
		    }
		    $temp_string[$key] = $output;
		}
		$str = implode('',$temp_string);
		echo $str;
	}

	public function generateCsv(){
		$filename = "K-".strtotime('now');
		$this->input = [str_split($this->input)];	
		$file = fopen($filename.".csv","w");
		foreach ($this->input as $line) {
			fputcsv($file, $line);
		}
		fclose($file);
		echo "CSV Created!";
	}
} // Class ends here.

// Main or entry point.
if (isset($argc) && isset($argv[1]) && !empty( isset($argv[1]) ) ) {

	$utility_obj = new CsvUtility($argv[1]);
	echo $utility_obj->makeEachInputWordUpper();
	echo $utility_obj->makeAlternateInputWordUpper();
	$utility_obj->generateCsv();

}
else {
	echo "\033[0;31m [Error: php main.php 'inputstring']";
}
?>

 