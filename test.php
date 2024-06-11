<?php 
require "inc/Prozigzig.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function fetchDataAndEncode($variableName, $type, $year,$h, $dateColumn, $tblname)
{
    $vname = $variableName;
    $query = "SELECT MONTH($dateColumn) as month, COUNT(*) as user_count FROM `$tblname` WHERE YEAR($dateColumn) = ?";
$params = [$year];

if ($type !== '') {
    $query .= " AND user_type = ?";
    $params[] = $type;
}

$query .= " GROUP BY MONTH($dateColumn)";

// Create an instance of Prozigzig class


// Call the select function with the query and parameters
$result = $h->select_query($query, $params);

    

    $monthNames = [
        1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
        5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug',
        9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
    ];

    $variableName = array_fill_keys(array_values($monthNames), 0);

    while ($data = $result->fetch_assoc()) {
        $numericMonth = $data['month'];
        $monthName = $monthNames[$numericMonth];
        $variableName[$monthName] = $data['user_count'];
    }

    return 'var ' . $vname . ' = ' . json_encode($variableName) . ';';
}
$year = date('Y');
$h = new Prozigzig($probus);
echo fetchDataAndEncode('yearlyData', 'USER', $year,$h, 'rdate', 'tbl_user');