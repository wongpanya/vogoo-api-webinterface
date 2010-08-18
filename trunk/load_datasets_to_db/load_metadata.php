<?php


//connect to database

 $db_handle =  mysql_connect('localhost','vogoo');

 if( !$db_handle ) {
   die("could not connect to database". mysql_error()."\n") ;
 }
 mysql_select_db("vogoo_web",$db_handle) or die("couldnt find db \n");
 
 // create a table 
$sql_create_table_u = " create table users (
id      int,
gender  char(1),
age     int,
occupation int, 
zipcode    int 

)";
$sql_create_table_m = " create table movies (
id     int,
name   varchar(255),
genre  varchar(255)
)";

if (!table_exists("movies")){
 if( !mysql_query($sql_create_table_u,$db_handle)) {

    echo " unable to create users table , " . mysql_error()."\n" ;

 }
 else {

 echo "table created" ;

 }
}
if (!table_exists("users")){
if( !mysql_query($sql_create_table_m,$db_handle)) {

    echo " unable to create movies table  " . mysql_error()."\n" ;

 }
else{

   echo "table created " ;
 }
}
// read files in php 
$file_handle_m = fopen("movies.dat",'r') or exit("unable to open movies file");

while( ! feof($file_handle_m)) {

  $string = fgets($file_handle_m) . " \n" ;
  $pieces = explode("::",$string ) ;
  if ( count($pieces) < 3 ) {
          continue ;
  }
  $name = mysql_real_escape_string( $pieces[1] ) ;
  $pieces[2] = chop($pieces[2]) ;
  $genre =  mysql_real_escape_string( $pieces[2] ) ;
  $sql_query = " Insert into movies(id,name,genre) values('$pieces[0]','$name','$genre')"  ;
  if(!mysql_query($sql_query,$db_handle)) {
  
     die (" could not execute movie data insertion query " . mysql_error() );
    
  
  }
}

fclose( $file_handle_m ) ;
$file_handle_u = fopen("users.dat",'r') or exit("unable to open users file");

while( !feof($file_handle_u)) {

  $string = fgets($file_handle_u) . " \n" ;
  //echo $string ;
  $pieces = explode("::",$string ) ;
  if (count($pieces) < 5 ){
 
     continue ;
  }
  $zip_code = chop($pieces[4]);
  $sql_query = " Insert into users values('$pieces[0]','$pieces[1]','$pieces[2]','$pieces[3]','$zip_code') " ;
  
  if(!mysql_query($sql_query,$db_handle)) {
  
     die (" could not execute user data insertion query " . mysql_error() );
  
  }
  
}

fclose($file_handle_u) ;

mysql_close($db_handle) ;
function table_exists($table){

   $query = " show tables ";
   if ( !$db_tables = mysql_query($query) ){
        die ( "show table query did not work " . mysql_error())  ;
  }
   #echo $db_tables."hi\n" ;
   while( $table_array = mysql_fetch_array($db_tables)) {
      if ($table == $table_array[0] ) {
         return true ;
     } 
     
  } 

   return false ;
}

?>
