<?php
define('ROOT',dirname(_FILE_));
function search($file,$znach){
	$handle=fopen($file,"r");
	while (!feof($handle)) {
		$string=fgets($handle,4000);
		mb_convert_encoding($string, 'cp1251');
		$explodedstring=explode('\x0A', $string);
		array_pop($explodedstring);
		foreach ($explodedstring as $key => $value) {
			$arr[]=explode('/t', $value);
		}
		$nachalo=0;
		$konec=count($arr)-1;
		while ($nachalo<=$konec){
			$seredina=floor(($nachalo + $konec)/2);
			$strnatcmp=strnatcmp($arr[$seredina][0],$znach);
			if($strnatcmp>0) {
				$konec=$seredina-1;
			}
			elseif ($strnatcmp<0){
				$nachalo=$seredina+1;
				$konec=$seredina-1;
			}
			else {
				return $arr[$seredina][1];
				$konec=$seredina-1;
			}
		}
	}
	return 'undef';
}
$znach = file_get_contents('./znach.txt');
$file=ROOT.'/test.txt';
echo search($file,$znach)."</br>";
?>