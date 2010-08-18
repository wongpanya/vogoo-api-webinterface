<html>
<head>
<?php
//include('vogoo-2.2/vogoo/vogoo.php');
include('vogoo-2.2/vogoo/items.php');
if(!$vogoo->connected)
{
        echo "<h1 align=\"center\">OOPS !! Connection couldnot be established !!</h1>";
}
else
{
?>
<!--<div id="go_home" align="left"><a href="item_based.php?member_id=$_GET['member_id']">back</a></div><br/> -->
<h1 align="center"> Item Based Recommendation </h1>
<br />
<?php

}
?>
</head>

<body>
        <form name="table_content" method="get">
                <div id="items_table" align="center">
                <table border="1">

<?php
                        $member_id = $_GET['member_id'];
                        echo "<h3> Items Rated by user ID $member_id</h3>" ;
                        $user = "vogoo";
                        $user_password = "";
                        $db_name = "vogoo_web";
                        $db = new mysqli ("localhost", $user, $user_password, $db_name) or die(" could not connect to db");
                        $query = " select * from vogoo_test where member_id=$member_id " ; 
                        $result = $db->query($query) ;
                        echo "<tr>";
                        echo "<td align=\"center\">";
                        echo "<b>Rated Items Id</b>";
                        echo "</td>";
                        echo "<td align=\"center\">";
                        echo "<b>Item name</b>";
                        echo "</td>";
                        echo "<td align=\"center\">";
                        echo "<b>Rating</b>";
                        echo "</td>";
                        echo "</tr>";
                        while($ret = $result->fetch_array(MYSQLI_BOTH))
                        {
                                echo "<tr>";
                                echo "<td align=\"center\">";
                                $movie_id = $ret['product_id'];
                                $rating = $ret['rating'];
                                echo $movie_id ;
                                echo "</td>";
                              #  echo "<td align=\"center\">";
                              #  printf("%.2f",$pieces[1]);
                                //echo $pieces[1];
                              #  echo "</td>";
                                echo "<td align=\"center\">";
                                $query ='select name from movies where id = '.$movie_id;
                                if($rating_data = $db->query($query))
                                {
                                        $record = $rating_data->fetch_array(MYSQLI_BOTH);
                                        echo $record['name'];
                                }
                                echo "</td>";
                                echo "<td align=\"center\">";
                                echo "$rating";
                                echo "</td>";
                                echo "</tr>";
                        }
                        #else {
                        #     echo "error" ;
                        # }
                        $db->close();
  ?>
                </table>
                </div>
        </form>
</body>
</html>

