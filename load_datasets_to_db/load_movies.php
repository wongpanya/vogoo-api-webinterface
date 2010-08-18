<?php
 include('db_connect.php') ;
 
 $insert_query = " Insert into movie values($movie_id,$movie_rls,$movie_name) " ;
 $file_handle = fopen("movie_titles","r") or die("could not open the file movie_titles");
 while( !feof($file_handle)){
    
    $line = fgets($file_handle) ;
    chop($line) ;
    $pieces = explode(",",$line) ; 
    $movie_id = $pieces[0] ;
    $movie_rls = $pieces[1] ;
    $movie_name = $pieces[2] ;
    $result = mysql_query($insert_query) ;
    if ( !$result ){
       die("could not execute query".mysql_error() ) ;
   }  
     
  
 }
 fclose($file_handle) ;
 mysql_close($db) ;
?>
