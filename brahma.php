<?php


//header("Content-type: text/plain");

// tell php to automatically flush after every output
// including lines of output produced by shell commands
//disable_ob();

$lang = $_POST["lang"];
$return_type = $_POST["return_type"];
$f_name = $_POST["f_name"];
$f_param = $_POST["f_param"];
$call = "python /home/quicksilver/brahma/work.py ";

$cmd = $call;
//$lang = "Roger Federer";
$descriptorspec = array(
   0 => array("pipe", "r"),   // stdin is a pipe that the child will read from
   1 => array("pipe", "w"),   // stdout is a pipe that the child will write to
   2 => array("pipe", "w")    // stderr is a pipe that the child will write to
);
flush();
$process = proc_open($cmd, $descriptorspec, $pipes, realpath('./'), array());

echo "<html><head><link title='Template Style Sheet' rel='stylesheet' href='my_template.css' type='text/css'>
</head><body>";
echo "<h1> Code Window ";
echo $url." "."</h1><hr><p>";
echo "<div   id = 'code_window' contenteditable='true'><p><br><br>";
//echo $output;
if (is_resource($process)) {

    fgets($pipes[1]);
    fwrite($pipes[0], $lang . "\n");
    
    fgets($pipes[1]);
    fwrite($pipes[0], $f_name . "\n");

    fgets($pipes[1]);
    fwrite($pipes[0], $f_param . "\n");
    
    fgets($pipes[1]);
    fwrite($pipes[0], $return_type . "\n");
    
    fgets($pipes[1]);
   
    
    while(!feof($pipes[1])){
    $val = fgets($pipes[1]);
    //print($val);

    $val = htmlspecialchars($val);
    echo "<pre>".$val."</pre>";
    }
    fclose($pipes[1]);
    fclose($pipes[0]);
    fclose($pipes[2]);
    //$return_value =
     
    proc_close($process);

 //   echo "command returned $return_value\n";  
}
echo "<br><br></div>";



echo "<center><a href='get_code.php'>CODE</a></center>";
echo "<center><a href='get_brahma_input.html'>BACK </a></center>";

echo "</body></html>";
?>
