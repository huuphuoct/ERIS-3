<meta http-equiv="refresh" content="1">
<?php

$dir_path = "image/";
$extensions_array = array('jpg');

if(is_dir($dir_path))
{
    $files = scandir($dir_path);
    
    for($i = 0; $i < count($files); $i++)
    {
        if($files[$i] !='.' && $files[$i] !='..')
        {
            // get file name

            echo "<br><br> Name: $files[$i]</br>";
            
            // get file extension
            $file = pathinfo($files[$i]);
            $extension = $file['extension'];
            //echo "&#272;uôi-> $extension</br>";
            
           // check file extension
		   if(in_array($extension, $extensions_array))
            {
            // show image
            echo "</br><img src='$dir_path$files[$i]' style='width:640px;height:480px;'><br>";
            }
            
        }
    }
}

