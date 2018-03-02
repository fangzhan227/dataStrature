<?php
/*
 * 《大话数据结构》中c语言源码范例对应的php源码
 * 第五章：字符串string
 * P128 操作Index 的实现算法：  
 * 	T 为非空串。若主串 S 中第 pos 个字符之后存在与 T 相等的子串，
 * 	则返回第一个这样的子串在s 中的位置，否则返回0
 */
function Index($Str, $Tstr, $pos){
	if($pos >= 0){
		$pos_true = strpos($Str, $Tstr);
		if($pos_true !== false && $pos_true > $pos ){
			return $pos_true;
		}
		else return 0;
	}
	else return 0;
}
$Str = 'adddee';
$Tstr ='dde';

echo "<br> 字符串 '".$Tstr."' 在 '".$Str."' 中出现的位置: ".Index ($Str,$Tstr,0)."<br>";


