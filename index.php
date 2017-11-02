<!DOCTYPE html>
<html>
<body>

Welcome <?php echo $_POST["name"]; ?> <br>
Your ID number is: <?php echo $_POST["IDnum"]; ?><br>


<?php 
$digits = array("11011001100","11001101100","11001100110","10010011000","10010001100","10001001100","10011001000","10011000100","10001100100","11001001000","11001000100","11000100100","10110011100","10011011100","10011001110","10111001100","10011101100","10011100110","11001110010","11001011100","11001001110","11011100100","11001110100","11101101110","11101001100","11100101100","11100100110","11101100100","11100110100","11100110010","11011011000","11011000110","11000110110","10100011000","10001011000","10001000110","10110001000","10001101000","10001100010","11010001000","11000101000","11000100010","10110111000","10110001110","10001101110","10111011000","10111000110","10001110110","11101110110","11010001110","11000101110","11011101000","11011100010","11011101110","11101011000","11101000110","11100010110","11101101000","11101100010","11100011010","11101111010","11001000010","11110001010","10100110000","10100001100","10010110000","10010000110","10000101100","10000100110","10110010000","10110000100","10011010000","10011000010","10000110100","10000110010","11000010010","11001010000","11110111010","11000010100","10001111010","10100111100","10010111100","10010011110","10111100100","10011110100","10011110010","11110100100","11110010100","11110010010","11011011110","11011110110","11110110110","10101111000","10100011110","10001011110","10111101000","10111100010","11110101000","11110100010","10111011110","10111101110","11101011110","11110101110");
$zero = "10011101100";
$one = "10011100110";
$two = "11001110010";
$three = "11001011100";
$four = "11001001110";
$five = "11011100100";
$six = "11001110100";
$seven = "11101101110";
$eight = "11101001100";
$nine = "11100101100";
$zerovalue = 16;
$onevalue = 17;
$twovalue = 18;
$threevalue = 19;
$fourvalue = 20;
$fivevalue = 21;
$sixvalue = 22;
$sevenvalue = 23;
$eightvalue = 24;
$ninevalue = 25;
$phase2 = "";
$phase3 = "<svg width='4000' height='100'>";
$rectx = "<rect x='";
$brect2 = "'y='0' width='4' height='50' style='fill:rgb(0,0,0);' />";
$wrect2 = "'y='0' width='4' height='50' style='fill:rgb(255,255,255);' />";
$quietzone = "<rect x='0'y='0' width='40' height='50' style='fill:rgb(255,255,255);' />";
$startcode = "11010000100";
$stopcode = "11000111010";
$checksum = 0;
$finalbarcode = ""
?>

<?php

function Phase2_finder($originalID){
    global $zero, $one, $two, $three, $four, $five, $six, $seven, $eight, $nine, $phase2; 
    for ($i = 0; $i <= strlen($originalID); $i++) {
        if ($originalID[$i] == "0"){
         $phase2 .= $zero;}
        if ($originalID[$i] == "1"){
            $phase2 .= $one;}
        if ($originalID[$i] == "2"){
            $phase2 .= $two;}
        if ($originalID[$i] == "3"){
            $phase2 .= $three;}
        if ($originalID[$i] == "4"){
            $phase2 .= $four;}
        if ($originalID[$i] == "5"){
            $phase2 .= $five;}
        if ($originalID[$i] == "6"){
            $phase2 .= $six;}
        if ($originalID[$i] == "7"){
            $phase2 .= $seven;}
        if ($originalID[$i] == "8"){
            $phase2 .= $eight;}
        if ($originalID[$i] == "9"){
            $phase2 .= $nine;}
        }
        return $phase2;
       }

$answer = Phase2_finder($_POST["IDnum"]) ;

?>

<br>

Phase2 code is <?php echo $answer;?>

<?php
function Phase3_finder($binarystring){
    global $phase3, $rectx, $wrect2, $brect2; 
    for ($i = 0; $i <= strlen($binarystring); $i++) {
        if ($binarystring[$i] == "0"){
            $phase3 .= $rectx;
            $phase3 .= strval(4*$i);
            $phase3 .= $wrect2;
        }
        else if ($binarystring[$i] == "1"){
            $phase3 .= $rectx;
            $phase3 .= strval(4*$i);
            $phase3 .= $brect2;
        
    }}
    
    $phase3.= "</svg>";
    return $phase3;
    
}

$rawbarcode = Phase3_finder($answer);
?>

<br>

Raw barcode is <?php echo $rawbarcode;?>

<?php

function checksum_finder($originalID){
    global $zerovalue, $onevalue, $twovalue, $threevalue, $fourvalue, $fivevalue, $sixvalue, $sevenvalue, $eightvalue, $ninevalue, $checksum; 
    for ($i = 0; $i <= strlen($originalID); $i++)  { 
        if ($originalID[$i] == "0"){
         $checksum = $checksum + ($zerovalue * ($i+1));}
        if ($originalID[$i] == "1"){
         $checksum = $checksum + ($onevalue * ($i+1));}
        if ($originalID[$i] == "2"){
         $checksum = $checksum + ($twovalue * ($i+1));}
        if ($originalID[$i] == "3"){
         $checksum = $checksum + ($threevalue * ($i+1));}
        if ($originalID[$i] == "4"){
         $checksum = $checksum + ($fourvalue * ($i+1));}
        if ($originalID[$i] == "5"){
         $checksum = $checksum + ($fivevalue * ($i+1));}
        if ($originalID[$i] == "6"){
         $checksum = $checksum + ($sixvalue * ($i+1));}
        if ($originalID[$i] == "7"){
         $checksum = $checksum + ($sevenvalue * ($i+1));}
        if ($originalID[$i] == "8"){
         $checksum = $checksum + ($eightvalue * ($i+1));}
        if ($originalID[$i] == "9"){
         $checksum = $checksum + ($ninevalue * ($i+1));}
        }
        return ($checksum % 103);
       }
       
?>

Checksum is <?php echo checksum_finder($_POST["IDnum"]);?>

<?php

?>

</body>
</html>
