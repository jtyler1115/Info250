#!/usr/bin/php

<?php
//$StartTime= microtime(true);
function calculate_median($arr) {
    print_r($arr);
    echo "\n";

    $count = count($arr); //total numbers in array
    $middleval = floor(($count-1)/2); // find the middle value, or the lowest middle value
    if($count % 2) { // odd number, middle is the median
        $median = $arr[$middleval];
    } else { // even number, calculate avg of 2 medians
        $low = $arr[$middleval];
        $high = $arr[$middleval+1];
        $median = (($low+$high)/2);
    }
    return $median;
    return $min;
    return $max;
}


function calculate_mean($arr) {
    $count = count($arr); //total numbers in array
    $total = array_sum($arr);
    $mean = ($total/$count); // get average value
    return $mean;
}

// Function to calculate standard deviation (uses sd_square)
function std_deviation($arr, $mean) {
    $sum_of_diff_sq = 0;
    // calculate sum of square of element - mean
    $count = count($arr);
    foreach ($arr as $value) {
        $sum_of_diff_sq = $sum_of_diff_sq + pow($value - $mean,2);
    }

    // divide the sum of square differences by count
    return sqrt($sum_of_diff_sq / $count);
}

function GetKeyedIn ($Prompt) {

    echo $Prompt;

    $KeyedIn = '';
    $KeyStroke = '';
    while ($KeyStroke != "\n") {
       $KeyStroke = fgetc(STDIN);
       if ($KeyStroke != "\n"){
       $KeyedIn .= $KeyStroke;
       }
    }
    return $KeyedIn;
}

function arrHist($arr) {
    $mode = calculate_mode($arr, false);
    $dArr = $mode[0];
    $arrModes = $mode[1];
    $scale = $arrModes[0][1]/40;
    echo $scale;
}

function build_histogram($arr, $min, $max) {
    $range = $max - $min;
    $interval = $range / 10;
    $first = $min + $interval;
    $second = $first + $interval;
    $third = $second + $interval;
    $fourth = $third + $interval;
    $fifth = $fourth + $interval;
    $sixth = $fifth + $interval;
    $seventh = $sixth + $interval;
    $eighth = $seventh + $interval;
    $ninth = $eighth + $interval;

    $histogram = array
       (
         array($min,$first,0),
         array($first,$second,0),
         array($second,$third,0),
         array($third,$fourth,0),
         array($fourth,$fifth,0),
         array($fifth,$sixth,0),
         array($sixth,$seventh,0),
         array($seventh,$eighth,0),
         array($eighth,$ninth,0),
         array($ninth,$max,0),

       );


    foreach ($arr as $value) {
        switch ($value)
        {
           case ($value < $first): {
              $histogram[0][2] = $histogram[0][2] + 1;
              break;
              }
           case ($value >= $first) and ($value < $second): {
              $histogram[1][2] = $histogram[1][2] + 1;
              break;
              }
           case ($value >= $second) and ($value < $third): {
              $histogram[2][2] = $histogram[2][2] + 1;
              break;
              }
           case ($value >= $third) and ($value < $fourth): {
              $histogram[3][2] = $histogram[3][2] + 1;
              break;
              }
           case ($value >= $fourth) and ($value < $fifth): {
              $histogram[4][2] = $histogram[4][2] + 1;
     break;
              }
           case ($value >= $fifth) and ($value < $sixth): {
              $histogram[5][2] = $histogram[5][2] + 1;
              break;
              }
           case ($value >= $sixth) and ($value < $seventh): {
              $histogram[6][2] = $histogram[6][2] + 1;
              break;
              }
           case ($value >= $seventh) and ($value < $eighth): {
              $histogram[7][2] = $histogram[7][2] + 1;
              break;
              }
           case ($value >= $eighth) and ($value < $ninth): {
              $histogram[8][2] = $histogram[8][2] + 1;
              break;
              }
           case ($value >= $ninth): {
              $histogram[9][2] = $histogram[9][2] + 1;
              break;
              }
         }
     };

     print_r($histogram);
     return $histogram;
}

function calculate_mode ($histogram) {
     $mode_count = -1;

     foreach ($histogram as $histo_value) {
        if ($histo_value[2] > $mode_count) {
           $mode_quartile = array ( $histo_value ) ;
           $mode_count = $histo_value[2];
        }
        else if ($histo_value[2] == $mode_count) {
           $mode_quartile[] = $histo_value;
        }
     }

     return $mode_quartile;
}

function printHistogram($histogram, $mode)
{
    $scale_factor = 50 / $mode;
    foreach ($histogram as $histo_value) {
        echo sprintf('%5u',$histo_value[0]) . " to " . sprintf('%5u',$histo_value[1]) ." | ";
        for ($i=0; $i<($histo_value[2]*$scale_factor); $i++) {
            echo "X";
        }
        echo "\n";
     }
}
function bubbleSort($arr) {
    $sorted = false;
    while (false === $sorted) {
        $sorted = true;
        for ($i = 0; $i < count($arr)-1; ++$i) {
            $current = $arr[$i];
            $next = $arr[$i+1];
            if ($next < $current) {
                $arr[$i] = $next;
                $arr[$i+1] = $current;
                $sorted = false;
            }
        }
    }
    return $arr;
}

$TheDirectory = opendir("/home/gschool");
$FileNumber = 0;
while (false !== ($fname = readdir ($TheDirectory))) {
    $Parts = explode (".", $fname);
    if (isset ($Parts[1]) && $Parts[1] == "nbrs") {
       $FileNumber ++;
       echo "$FileNumber) $fname\n";
    }
}
closedir ($TheDirectory);

do {
    $WhichFile = GetKeyedIn ("\nWhichFile to read --->");
    if ($WhichFile == "")exit;
    $StartTime= microtime(true);
    $file = fopen("/home/gschool/$WhichFile",'r');

    if (! $file) {
        echo "\nNo such file exists in this directory. Please run program again.\n";
        $WhichFile == "";
    }
} while ($WhichFile == "");

    if ($file)
    {
        echo "have file\n\n\n";

       // $numbers = array();
        $NonNumericCounter = 0;
        $count= 0;
        while (($buffer = fgets($file)) !== false) {
            $buffer = trim($buffer);
            $buffer = trim($buffer,"'");

            if (is_numeric($buffer)) {
              $numbers[$count] = $buffer;
                $count++;
            }
            else {
               echo $buffer;
         echo " is not numeric \n";
               $NonNumericCounter += 1;
            }
        }

        $count = count($numbers);
        $numbers= bubbleSort($numbers);
        $median = calculate_median($numbers);
        $mean = calculate_mean($numbers);
        //$mode_quartile = calculate_mode($numbers, $min, $max);
        $stddev = std_deviation ($numbers, $mean);
        $min = $numbers[0];
        $max = $numbers[$count-1];
        $histogram = build_histogram($numbers, $min, $max);
        $mode_quartile = calculate_mode($histogram);

        //$histogram = arrHist($numbers);
        if ($count != 0){
                echo "number of non-numeric terms omitted is " . $NonNumericCounter . "\n";
                echo "count is " . $count . "\n";
                echo "median is " . $median . "\n";
                echo "mean is " . $mean . "\n";
                foreach ($mode_quartile as $mode) {
                echo "mode is decile " .
                        $mode[0] .
                        " to " .
                        $mode[1] .
                        " with frequency " .
                        $mode[2] . "\n";
                        $mode_value = ($mode[0]+$mode[1])/2;
                        echo "mode is " . $mode_value . "\n";
                }
                echo "std deviation is " . $stddev . "\n";
                echo "min is " . $min . "\n";
                echo "max is " . $max . "\n";
                printHistogram($histogram, $mode_quartile[0][2]);
                $EndTime= microtime(true);
                $Duration = $EndTime-$StartTime;
                echo "Time to complete is " . $Duration . "\n";
                echo "done\n";
        }
        else {
                echo "no numeric terms in this file. no calculations are possible. \n";
                echo "number of non numeric terms is " . $NonNumericCounter . "\n";
        }
        if (!feof($file)) {
            echo "Error: unexpected fgets() fail \n";
        }
        fclose($file);
    }
    else
    {
        echo "no file";
    }
?>
