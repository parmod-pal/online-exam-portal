<?php
session_start();
$progid=1;
$progid=$_SESSION['pid'];
$frm=$_SESSION['frm'];
$to=$_SESSION['to'];
//create query to select as data from your table
/* $link = mysql_connect('localhost', 'root', '');
mysql_select_db('studentinfo', $link);  */
$link = mysql_connect('localhost', 'elefaw8a_rimsr', 'qwer_!@#4');
mysql_select_db('elefaw8a_rimsrstudinfo', $link);
if($progid != "" && $frm !='' && $to !='')
{
	$export=mysql_query("select s.admissionno,s.firstname,s.middlename,s.lastname,s.community,s.emailid,p1.programname, p.dateofadmission,p.dateofcompletion from student_info s inner join admission_details p, programdet p1 where s.id=p.studentid and p.admittedfor='".$progid."' and p1.id='".$progid."' and (p.dateofadmission between '".$frm."' and '".$to."') order by  s.firstname asc",$link);
}
else if($progid != "" && ( $frm =='' || $to ==''))
{
	$export=mysql_query("select s.admissionno,s.firstname,s.middlename,s.lastname,s.community,s.emailid,p1.programname, p.dateofadmission,p.dateofcompletion from student_info s inner join admission_details p, programdet p1 where s.id=p.studentid and p.admittedfor='".$progid."'and p1.id='".$progid."' order by p.dateofadmission, s.firstname asc",$link);
}
else
{
	$export=mysql_query("select s.admissionno,s.firstname,s.middlename,s.lastname,s.community,s.emailid,p1.programname, p.dateofadmission,p.dateofcompletion from student_info s inner join admission_details p, programdet p1 where s.id=p.studentid and p1.id=p.admittedfor order by p.dateofadmission, s.firstname asc",$link);
}
//run mysql query and then count number of fields
/* $export = mysql_query ( $select ) 
       or die ( "Sql error : " . mysql_error( ) ); */
$fields = mysql_num_fields ( $export );

//create csv header row, to contain table headers 
//with database field names
for ( $i = 0; $i < $fields; $i++ ) {
	$header .= mysql_field_name( $export , $i ) . ",";
}

//this is where most of the work is done. 
//Loop through the query results, and create 
//a row for each
while( $row = mysql_fetch_row( $export ) ) {
	$line = '';
	//for each field in the row
	foreach( $row as $value ) {
		//if null, create blank field
		if ( ( !isset( $value ) ) || ( $value == "" ) ){
			$value = ",";
		}
		//else, assign field value to our data
		else {
			$value = str_replace( '"' , '""' , $value );
			$value = '"' . $value . '"' . ",";
		}
		//add this field value to our row
		$line .= $value;
	}
	//trim whitespace from each row
	$data .= trim( $line ) . "\n";
}
//remove all carriage returns from the data
$data = str_replace( "\r" , "" , $data );
$file_name="Programwise_Studentlist";

//create a file and send to browser for user to download
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$file_name.".csv");
print "$header\n$data";
exit;
?>