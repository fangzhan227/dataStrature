<?php
/*
 * 《大话数据结构》 第8章
 *P296 顺序查找:
 * 在数组a (注意元素值从下标1 开始)中查看有没有关键字k
 *  a 为数组， n 为要查找的数组个数. key为要查找的关键字*/

$arr = array('1','2','3','4','5','6') ;
$n = 4;
$k= '2';

function sequence_search($arr, $n, $k){
	for($i=1;$i<=$n;$i++){
		if($arr[$i]==$k){
			return $i;
		}
	}
	return 0;
}
echo "<br><br>顺序查找：".sequence_search($arr, $n, $k )."<br>";

/*P297 顺序查找优化:
 * 在数组a中 （从数组尾部开始）查找有没有关键字k
 *  a 为数组， n 为要查找的数组个数. key为要查找的关键字 */
function sequence_search2($arr, $n, $k){
	$arr[0] = $k;
	$i = $n;	//循环从数组尾部开始
	while($arr[$i] != $k){
		$i--;
	}
	return $i;	//返回0说明查找失败
}

echo "<br><br>顺序查找优化：".sequence_search2($arr, $n, $k )."<br>";


echo "<br><br>冒泡排序算法  降序排列：";
/**
 *  冒泡排序算法 1:
 *  对需要排序的数组从后往前（逆序）进行多遍的扫描，
 *  当发现相邻的两个数值的次序与排序要求的规则不一致时，
 *  就将这两个数值进行交换。这样比较小（大）的数值就将逐渐从后面向前面移动。
 *  http://blog.csdn.net/liumiao1128/article/details/70022928
 */
 function mysort($arr)
 {
	for($i = 0; $i < count($arr); $i++)
    {
		//$isSort = false;
		for ($j=0; $j< count($arr) - $i - 1; $j++) 
		{
			if($arr[$j] < $arr[$j+1]) //降序排列
        	{
//	          $isSort = true;
	          $temp = $arr[$j];
	          $arr[$j] = $arr[$j+1];
	          $arr[$j+1] = $temp ;
        	}
      	}
	    /*if($isSort)
	    {
	      break;
	    }*/
    }
    return $arr;
    
}

$arr = array(9,5,6,4,1,2);
var_dump(mysort($arr));

echo "<br><br>rsort()函数降序排列：";
rsort($arr);

var_dump($arr);

//输出：array(6) { [0]=> int(8) [1]=> int(6) [2]=> int(5) [3]=> int(4) [4]=> int(2) [5]=> int(1) }
  
echo "<br><br>冒泡排序算法 2 升序排列：";

/**
 *  冒泡排序算法 2:
 *  对一组数据，比较相邻数据的大小，将值小数据在前面，值大的数据放在后面。（以下升序排列，即从小到大排列）
 *  对于一个长度为N的数组，我们需要排序 N-1 轮，每 i 轮 要比较 N-i 次。
 *  对此我们可以用双重循环语句，外层循环控制循环轮次，内层循环控制每轮的比较次数。
 *  https://www.cnblogs.com/wgq123/p/6529450.html
 */

 function bubbling($arr)
 {
 	for($i = 0; $i < count($arr); $i++)
    {
//		$isSort = false;
		for ($j=0; $j< count($arr) - $i - 1; $j++) 
		{
			if($arr[$j] > $arr[$j+1]) //升序排列
        	{
//	          $isSort = true;
	          $temp = $arr[$j];
	          $arr[$j] = $arr[$j+1];
	          $arr[$j+1] = $temp ;
        	}
      	}
	    /*if($isSort)
	    {
	      break;
	    }*/
    }
    return $arr;
}

$arr = array(9,51,6,42,1,2);
var_dump(bubbling($arr));
//输出：array(6) { [0]=> int(1) [1]=> int(2) [2]=> int(4) [3]=> int(5) [4]=> int(6) [5]=> int(9) } 
  
echo "<br><br>二维数组排序：";


/**
 * php自带的函数排序速度快很多, 但二维数组排序的时候 就只能自己实现
 * 二维数组根据字段进行排序
 * @params array $array 需要排序的数组
 * @params string $field 排序的字段
 * @params string $sort 排序顺序标志 SORT_DESC 降序； SORT_ASC 升序
 */
function arraySequence($array, $field, $sort = 'SORT_ASC')
{
    $arrSort = array();
    foreach ($array as $uniqid => $row) {
        foreach ($row as $key => $value) {
            $arrSort[$key][$uniqid] = $value;
        }
    }
    array_multisort($arrSort[$field], constant($sort), $array);
    return $array;
}

$arr_2 = array(
  array('name' => 'tom', 'age' => 20), 
  array('name' => 'anny', 'age' => 18), 
  array('name' => 'jack', 'age' => 22),
  array('name' => 'jack', 'age' => 15)
  );


var_dump(arraySequence($arr_2 , 'age'));

echo "<br><br>快速排序: ";

/**
 * 快速排序:
 * 在数组中挑出一个元素（多为第一个）作为标尺，
 * 扫描一遍数组将比标尺小的元素排在标尺之前，将所有比标尺大的元素排在标尺之后，
 * 通过递归将各子序列分别划分为更小的序列直到所有的序列顺序一致。
 * （函数递归）
 */
function quick_sort($arr) 
{
	//先判断是否需要继续进行
	$length = count($arr);
	if($length <= 1) 
	{
		return $arr;
	}
	else{
		$base_num = $arr[0];//选择一个标尺 选择第一个元素
	
		//初始化两个数组
		$left_array = array();	//小于标尺的
		$right_array = array();	//大于标尺的
		for($i=1; $i<$length; $i++) 
		{      
	      	//遍历 除了标尺外的所有元素，按照大小关系放入两个数组内
	        if($base_num > $arr[$i]) 	//升序排列
//	        if($base_num > $arr[$i])  //降序
	        {
	          //放入左边数组
	          $left_array[] = $arr[$i];
	        } 
	        else
	        {
	          //放入右边
	          $right_array[] = $arr[$i];
	        }
		}
		//再分别对 左边 和 右边的数组进行相同的排序处理方式
		//递归调用这个函数,并记录结果
		$left_array = quick_sort($left_array);
		$right_array = quick_sort($right_array);
		//合并左边 标尺 右边
		return array_merge($left_array, array($base_num), $right_array);
	}
}
    
$arr = array(3,5,6,4,7,1,2);
var_dump(quick_sort($arr)); 

//输出：array(7) { [0]=> int(1) [1]=> int(2) [2]=> int(3) [3]=> int(4) [4]=> int(5) [5]=> int(6) [6]=> int(7) } 


echo "<br><br>选择排序：";

/**
 * 选择排序：
 * 在要排序的一组数中，选出最小的一个数与第一个位置的数交换。
 * 然后在剩下的数当中再找最小的与第二个位置的数交换，
 * 如此循环到倒数第二个数和最后一个数比较为止。
 * https://www.cnblogs.com/rainblack/p/5808694.html
 */
function selectSort($arr) {
	//双重循环完成，外层控制轮数，内层控制比较次数
	$len=count($arr);
    for($i=0; $i<$len-1; $i++) {
        //先假设最小的值的位置
        $p = $i;
        
        for($j=$i+1; $j<$len; $j++) {
            //$arr[$p] 是当前已知的最小值
            if($arr[$p] > $arr[$j]) {
            //比较，发现更小的,记录下最小值的位置；并且在下次比较时采用已知的最小值进行比较。
                $p = $j;
            }
        }
        //已经确定了当前的最小值的位置，保存到$p中。
        //如果发现最小值的位置与当前假设的位置$i不同，则位置互换即可。
        if($p != $i) {
            $tmp = $arr[$p];
            $arr[$p] = $arr[$i];
            $arr[$i] = $tmp;
        }
    }
    //返回最终结果
    return $arr;
}
$arr = array(3,5,6,4,7,1,2);
var_dump(selectSort($arr));
//输出：array(7) { [0]=> int(1) [1]=> int(2) [2]=> int(3) [3]=> int(4) [4]=> int(5) [5]=> int(6) [6]=> int(7) }


echo "<br><br>插入排序：";

/**
 * 插入排序：
 * 在要排序的一组数中，假设前面的数已经是排好顺序的，默认第0个元素是有序的（因为只有一个元素a[0]，自然是有序的）
 * 现在要把第n个数插到前面的有序数中，使得这n个数也是排好顺序的。
 * 如此反复循环，直到全部排好顺序。
 */
function insertSort($arr) {
    $len = count($arr); 
    for($i=1; $i<$len; $i++) {
        $tmp = $arr[$i];
        //内层循环控制，比较并插入
        for($j=$i-1;$j>=0;$j--) {
            if($tmp < $arr[$j]) {
                //发现插入的元素要小，交换位置，将后边的元素与前面的元素互换
                $arr[$j+1] = $arr[$j];
                $arr[$j] = $tmp; //$arr[$i]
            } 
            else {//如果碰到不需要移动的元素，由于是已经排序好是数组，则前面的就不需要再次比较了
                break;
            }
        }
    }
    return $arr;
}
$arr = array(3,5,6,4,7,1,2);
var_dump(insertSort($arr));


echo "<br><br>二分查找：";
/**
 *P298 
 * 二分查找（折半查找算法）：适用于静态查找，一次排序后不再变化的表。
 *  假设数据是按升序排序的，对于给定值x，从序列的中间位置开始比较，
 *  如果当前位置值等于x，则查找成功；
 *  若x小于当前位置值，则在数列的前半段中查找；
 *  若x大于当前位置值则在数列的后半段中继续查找，直到找到为止。（数据量大的时候使用）
 */
function bin_search($arr,$low,$high,$k)
{
    if($low <= $high)
    {
	      $mid = intval(($low + $high)/2);
	      if($arr[$mid] == $k)
	      {
	        	return $mid;
	      }
	      else if($k < $arr[$mid])
	      {
	        	return bin_search($arr,$low,$mid-1,$k);
	      }
	      else
	      {
	        	return bin_search($arr,$mid+1,$high,$k);
	      }
    }
    return -1;
}
$arr = array(1,2,3,4,5,6,7,8,9,10);

print(bin_search($arr, 0, 9, 6));

?>