<?php 
include("team/db_config.php");

function filterData(&$str){
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

//excel file name for download
$filename = "contacts-data_" . date('Ymd') . ".xls";

//column names
$fields = array('#', 'Full Name', 'Phone Number', 'Email', 'Age', 'Hear about us', 'Departmental Preference 1', 'Departmental Preference 2', 'Departmental Preference 3', 'In case none of the aforementioned departments interest you', 'What motivates you to be a part of YWP', 'What are your views on mental health awareness and accessibility in India', 'Any other information that you d like to provide', 'if you have been part of the Discover Bootcamp', 'if you are a person with disability or a dalit', 'Posting Date', 'Document download link' );

// //display column name as first row
$excelData = implode("\t", array_values($fields)) . "\n" ;

//fetch records from database
$sql = "SELECT * FROM `tblcontactdata` ORDER BY id ASC";
$result = mysqli_query($con, $sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $status = ($row['status'] == 1)?'Active':'Inactive';
        $lineData = array($row['id'], $row['FullName'], $row['PhoneNumber'], $row['EmailId'], $row['Age'], $row['Hearing'], $row['Dept_pref1'], $row['Dept_pref2'], $row['Dept_pref3'], $row['Aforementioned_ans'], $row['Motivates_ans'], $row['Mental_health_ans'], $row['Other_info_ans'], $row['Part_of'], $row['Person_with'], $row['PostingDate'], 'https://yourewonderfulproject.org/uploads/'.$row['name']);
        array_walk($lineData, 'filterData');
        $excelData .= implode("\t", array_values($lineData)) . "\n";
    }
}else{
    $excelData .= 'No records found...'. "\n";
}

//header for download
header("Content-Type: aplication/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
echo $excelData;
exit;

?>