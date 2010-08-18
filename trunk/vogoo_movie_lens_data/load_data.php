<?php
include('db_connect.php');

$fh = fopen("ua.test",'r') ;
while( !feof($fh) ){

$line = fgets($fh) ;
	if ( $line !="" ) {
	$pieces = explode("\t",$line);
	$user_id = $pieces[0] ;
	$movie_id  = $pieces[1] ;
	$rating = $pieces[2] ;
	$timestamp  = $pieces[3];
	$ts = chop($timestamp) ;
        $query = " Insert into vogoo_test values('$user_id' ,' $movie_id' ,'1', '$rating','$ts' ) " ;
        if( !mysql_query($query) ) {
              
              echo ("query not executed ".mysql_error() ) ;
              exit() ;
	 }
        
	}
     
}
mysql_close($db) ;
fclose($fh) ;
?>
