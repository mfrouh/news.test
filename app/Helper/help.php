<?php
   function sorteimage($despath,$req_file_img)
   {
    $destinationPath =$despath;
    $files = $req_file_img;
    $file_name =$despath.'/'.time() . $files->getClientOriginalName();
    $files->move($destinationPath, $file_name);
    return $file_name;
  }
  function slug($text)
  {
   return str_replace(" ","-",$text);
  }
?>
