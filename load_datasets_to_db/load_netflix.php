<?php 
  include('db_connect.php');
  $count = 0 ;
  $dir_handle = opendir("training_set");
  $movie_id = "" ;
  $user_id = "" ;
  $rating = "" ;
  $timestamp = "" ;
  $query = " Insert into vogoo_ratings('member_id','product_id','rating','ts') values($user_id,$movie_id,$rating,$timestamp) ";
    // open the movie_info handle  
    while( $filename = readdir($dir_handle) ) {
           // open and read new file in the directory
	     $num = rand(0,1) ;
	     if ( $num > 0.3) {
			continue ;
		}
	     $sys = `wc -l  $filename ` ;
	     print $sys ;
             $parts = explode(" ",$sys) ;
	     print $parts[0] ;
	 
	     if ( $parts[0] > 10 ) {
		$count++ ;
		print $count ;
 		print $filename ;
		
	     }
	     exit() ;
        if ( $filename != "." and $filename != "..") {
           $file_handle = fopen("./training_set/$filename" , "r")  or die("could not open file");
           $line = fgets($file_handle);
           //echo $line ;
           # EXTRACT THE MOVIE ID 
           $movie_id = chop($line);
           $movie_id = rtrim($movie_id,":");
           #echo $line."the second" ;
           while( !feof($file_handle) ) {
             $line = fgets($file_handle);
             $line = chop($line);
             $pieces = explode(",",$line) ;
             # Extracting the user id and ratings and timestamp
             $user_id = $pieces[0] ;
             $rating =  $pieces[1];
             $timestamp =  $pieces[2];
             # inserting this information into the database
  	     $result = $mysql_query($query) ;
             if ( !$result ) {
                    die(" could not execute query ".mysql_error());
             }  				
          }
          // close ratings file   
          fclose($file_handle) ;  
	}
        
   }
  mysql_close($db)
?>
