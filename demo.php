<?php
//Demo
require("src/regit.php");

$regit = new Regit();

//Has Number
$input = 'abc234';
$exp = $regit->hasnumber()->bake();
$f = $regit->valid($exp,$input);

echo 'INPUT: '.$input;
echo '<br/>';
echo "EXP: ".$exp;
echo '<br/>';
if($f){
	echo "VALID";
}else{
	echo "NOT VALID";
}

echo '<hr/>';
//URL reg example
$input = 'http://';
$regit = new Regit();
$exp = $regit->begins()
			 ->then('http')
			 ->mighthave('s')
			 ->then('://')
			 ->build();
$f = $regit->valid($exp,$input);
echo 'INPUT: '.$input;
echo '<br/>';
echo "EXP: ".$exp;
echo '<br/>';
if($f){
	echo "VALID";
}else{
	echo "NOT VALID";
}