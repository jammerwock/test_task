<?php

const OPEN_BRACE = '{';
const CLOSE_BRACE = '}';
$string =
	"{Пожалуйста|Просто} сделайте так, чтобы это {удивительное|крутое|простое} тестовое предложение {изменялось {{быстро|быстрее}|мгновенно} случайным образом|менялось каждый раз}.";

for ($i = 0; $i < 100; ++$i) {
	echo processString($string) . PHP_EOL;
}
unset($i, $string);


// functions
function processString($string)
{
	$inputArray = mbStringToArray($string);

	$nextIndex = 0;
	$result = '';
	$length = count($inputArray);
	for ($index = 0; $index < $length; ++$index) {
		$char = $inputArray[$index];
		switch ($char) {
			case OPEN_BRACE:
				$result .= processOpenBrace($index + 1, $inputArray, $nextIndex);
				$index = $nextIndex;
				break;
			default:
				$result .= $char;
				break;
		}
	}
	unset($index, $char);
	return $result;
}


function processOpenBrace($index, $inputArray, &$nextIndex)
{
	$res = '';
	$length = count($inputArray);
	for ($i = $index; $i < $length; ++$i) {
		$char = $inputArray[$i];
		switch ($char) {
			case OPEN_BRACE:
				$res .= processOpenBrace($i + 1, $inputArray, $i);
				break;
			case CLOSE_BRACE:
				$nextIndex = $i;
				return format($res);

				break;
			default:
				$res .= $char;
				break;
		}
	}
	return $res;
}

function format($tmp)
{
	$tmp = explode('|', $tmp);
	$tmp = $tmp[array_rand($tmp)];

	return $tmp;
}

function mbStringToArray($string)
{
	$array = array();
	$strLen = mb_strlen($string);
	while ($strLen) {
		$array[] = mb_substr($string, 0, 1, "UTF-8");
		$string = mb_substr($string, 1, $strLen, "UTF-8");
		$strLen = mb_strlen($string);
	}
	return $array;
}

