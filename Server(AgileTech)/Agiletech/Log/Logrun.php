<?php /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//for($i = 1; $i <=  date('t'); $i++)
//{
//   // add the date to the dates array
//   $dates[] = date('Y') . "-" . date('m') . "-" . str_pad($i, 2, '0', STR_PAD_LEFT);
//}

// show the dates array
//var_dump($dates);
$list=array();
$Day=array();
$month = date('m');
$year = date('y');
$S_date=date('d');
for($d=$S_date; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time) == $month) {
        $list[] = date('Y-m-d', $time);
         $Day[]= date('D', $time);
    }
}
echo "<pre>";
print_r($list);
print_r($Day);
echo "</pre>";
//$timer = date_default_timezone_set("Asia/Kolkata");
//$date = new DateTime();
//$Date = $date->format('Y-m-d');
//
//function isWeekend($date) {
//    return (date('N', strtotime($date)) >= 6);
//}
//if( date('D') == 'Sun') { 
//  echo "Today is Saturday or Sunday.";
//} else {
//  echo "Today is not Saturday or Sunday.";
//}
