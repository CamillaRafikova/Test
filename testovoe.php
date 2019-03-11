<?php
define('ROOT',dirname(_FILE_));
function search($file,$znach){
	$f=fopen($file,"r");
	while (!feof($f)) {
		$string=fgets($f,4000);
		$explodedstring=explode('\x0A', $string);
		array_pop($explodedstring);
		foreach ($explodedstring as $key => $value) {
			$arr[]=explode('/t', $value);
		}
		$start=0;
		$end=count($arr)-1;
		while ($start<=$end){
			$middle=floor(($start + $end)/2);
			$strnatcmp=strnatcmp($arr[$middle][0],$znach);
			if($strnatcmp>0) {
				$end=$middle-1;
			}
			elseif ($strnatcmp<0){
				$start=$middle+1;
			}
			else {
				return $arr[$middle][1];
			}
		}
	}
	return 'undef';
}
$znach = file_get_contents('./znach.txt');
$file=ROOT.'/test.txt';
echo search($file,$znach)."</br>";
?>