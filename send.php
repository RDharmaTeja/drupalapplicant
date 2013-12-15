<?php

    //db connect
    $host="localhost"; 
    $dbuser="root";
    $dbpass="darmateja";
    $dbname="STUDENT";
    $tblname="details";

    //form post
    $name=$_POST['name'];
    $institute=$_POST['institute'];
    $year=$_POST['year'];
    $branch=$_POST['branch'];
    $interests=$_POST['interest'];
    
    $con = mysqli_connect("$host","$dbuser","$dbpass","$dbname");
if (mysqli_connect_errno())
  {
  die ("Failed to connect to MySQL: " . mysqli_connect_error());
  }


    
if(empty($_POST['name'])||empty($_POST['institute'])||empty($_POST['year'])||empty($_POST['branch'])){
echo '<p style="color:red;">You have not entered the proper response </p>';
echo '<a href="studentform.html" ><button style="color:red;">submit proper response</button></a><br><br>';
}
else{
$send = mysqli_query($con,"INSERT INTO details (name,institute,year,department,interests) VALUES ('$name', '$institute','$year','$branch','$interests')");
    echo '<p style="color:blue;">you have submitted your response </p>';
    echo '<a href="studentform.html" ><button style="color:blue;">submit other response</button></a><br><br>';}
    echo '<h2>statistics</h2>';
 $result = mysqli_query($con,"SELECT * FROM details");
 $values=array(array(0,0,0,0,0,0),
              array(0,0,0,0,0,0),
              array(0,0,0,0,0,0),
              array(0,0,0,0,0,0),
              array(0,0,0,0,0,0),
              array(0,0,0,0,0,0),
              array(0,0,0,0,0,0),
              array(0,0,0,0,0,0),
              array(0,0,0,0,0,0),);
  $count=0;
$branchname=array('AEROSPACE','BIO-TECH','CIVIL','COMPUTER SCIENCE','CHEMICAL','ELECTRICAL','MECHANICAL','OTHERS','TOTAL');
while($row = mysqli_fetch_array($result))
  {
  $yer= $row['year'];
  $dep=$row['department'];
for ($j=1;$j<=8;$j++){
for ($i=0;$i<=4;$i++){
if ($yer==($i+1) && $dep==$j){
$values[$j-1][$i]=$values[$j-1][$i]+1;
}}}
$count++;
}
//counting
for($j=0;$j<=8;$j++){
$values[$j][5]=$values[$j][0]+$values[$j][1]+$values[$j][2]+$values[$j][3]+$values[$j][4];
}
for($i=0;$i<=4;$i++){
$values[8][$i]=$values[0][$i]+$values[1][$i]+$values[2][$i]+$values[3][$i]+$values[4][$i]+$values[5][$i]+$values[6][$i]+$values[7][$i];
}
$values[8][5]=$count;

echo "Total number of students ".$count."<br><br>";
echo '<table border="1">';
echo '<tr><td>BRANCH/YEAR</td><td>year1</td><td>year2</td><td>year3</td><td>year4</td><td>year5</td><td>TOTAL</td></tr>';
for ($j=1;$j<=9;$j++){
echo '<tr>';
echo '<td>'.$branchname[$j-1].'</td>';
for ($i=0;$i<=5;$i++){
echo '<td>'.$values[$j-1][$i].'</td>';
}
echo "</tr>";
}


?>
