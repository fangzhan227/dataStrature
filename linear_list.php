<?php
/*
 * 《大话数据结构》中c语言源码范例对应的php源码
 */
echo "<br><br>1+2+3+....+100 = ：";
function plus($max)
{
	$sum = 0;
	if($max >= 1){
		for($i=1; $i<=$max; $i++){
			$sum += $i;
		}
		return $sum;
	}
}
var_dump(plus(100));


echo "<br><br> union 并集A=A U B：";
/*
 * P46示例： 集合A=A U B,把存在集合B 中但并不存在A 中的数据元素插入到A 中
 * strpos: 查找字符串首次出现的位置。
 * strpos($a, $b) !== false：如果$a 中存在 $b，则为 true ，否则为 false。
 * 用 !== false （或者 === false） 的原因是如果 $b 正好位于$a的开始部分，那么该函数会返回int(0)，
 * 那么0是false，但$b确实位于$a中，所以要用 !== 判断一下类型，要确保是严格的 false。
 */
function union($str_a,$str_b)
{
	$arr_b = explode(',',$str_b);
	foreach($arr_b as $key =>$val){
		// 注意这里使用的是 ===。简单的 == 不能像我们期待的那样工作，
		// 因为 '1' 是第 0 位置上的（第一个）字符。
		if(strpos($str_a, $val )=== false)
		{
			$str_new_a = $str_a.",".$val;
		}
	}
	return $str_new_a;
	
}

$str_a = '1,2,3,5,6,7,8,9';
$str_b = '1,0,2,4,10';

var_dump(union($str_a,$str_b));


/*
 * P52示例： 
 * http://blog.51cto.com/noican/1598290
 * 线性表：即零个或多个数据元素的有限序列。
 * 线性表的数据结构:即数据元素依此存储在一段地址连续的存储单元内。在高级语言中就表现为数组。
 *
 * 1. DestroyList: 销毁顺序线性表
 * 2. ClearList: 将线性表重置为空
 * 3. ListEmpty: 判断线性表是否为空
 * 4. ListLength: 返回线性表的长度
 * 5. GetElem: 返回线性表中第$index个数据元素
 * 6. LocateElem: 返回给定的数据元素在线性表中的位置
 * 7. PriorElem: 返回指定元素的前一个元素
 * 8. NextElem: 返回指定元素的后一个元素
 * 9. ListInsert: 在第index的位置插入元素elem
 * 10. ListDelete: 删除第index位置的元素elem
 *
 */
 
class SeqStoreList {
    public $SqArr; 
    public static  $length;
    public function __construct($SqArr){
        $this->SqArr = $SqArr;
        self::$length=count($SqArr);
    }
     
    //销毁顺序线性表
    public  function DestroyList(){
        $this->SqArr=null;
        self::$length=0;
    }
 
    //将线性表重置为空
    public  function ClearList(){
        $this->SqArr=array();
        self::$length=0;
    }
     
    //判断线性表是否为空
    public  function ListEmpty(){
        if(self::$length==0){
            return 'Is null';
        }else{
            return 'Not null';
        }
    }
 
    //返回线性表的长度
    public function ListLength(){
        return self::$length;
    }
 
    //返回线性表中第$index个数据元素
    public function GetElem($index){
        if(self::$length==0 || $index<1 || $index>self::$length){
            return 'ERROR';
        }
        return $this->SqArr[$index-1];
    }
 
    //返回给定的数据元素在线性表中的位置
    public function LocateElem($elem){
        for($i=0;$i<self::$length;$i++){
            if($this->SqArr[$i] == $elem){
                break;
            }
        }
        if($i>=self::$length){
            return 'ERROR';
        }
//        echo $i+1;
        return $i+1;
    }
 
    //返回指定元素的前一个元素
    public function PriorElem($cur_elem){
        for($i=0;$i<self::$length;$i++){
            if($this->SqArr[$i] == $cur_elem){
                break;
            }
        }
        if($i==0 || $i>=self::$length){
            return 'ERROR';
        }
        return $this->SqArr[$i-1];
    }
 
    //返回指定元素的后一个元素
    public function NextElem($cur_elem){
        for($i=0;$i<self::$length;$i++){
            if($this->SqArr[$i] == $cur_elem){
                break;
            }
        }
        if($i>=self::$length-1){
            return 'ERROR';
        }
        return $this->SqArr[$i+1];
    }
 
    //在第index的位置插入元素elem
    public function ListInsert($index, $elem){
        if($index<1 || $index>self::$length+1){
        return 'ERROR';
        }
        if($index<=self::$length){
            for($i=self::$length-1;$i>=$index-1;$i--){
                $this->SqArr[$i+1]=$this->SqArr[$i];
            }
        }
        $this->SqArr[$index-1]=$elem; //将新元素插入
        self::$length++;
//         var_dump($this->SqArr);
        return 'ok';
    }
 
    //ListDelete: 删除第index位置的元素elem
    public function ListDelete($index){
        if($index<1 || $index>self::$length+1){
            return 'ERROR';
        }
        if($index < self::$length){
            for($i=$index; $i<self::$length; $i++){	 //将删除位置后继元素前移
                $this->SqArr[$i-1] = $this->SqArr[$i];
            }
        }
        self::$length--;
//        var_dump($this->SqArr[$index-1]);
        return $this->SqArr[$index-1];
    }
}

$SArr = array("a","b","c","d"); //array('a','a','a','a') ;
$linearList = new SeqStoreList($SArr);


echo "<br><br> php实现数据结构线性表:";

 //返回给定的数据元素在线性表中的位置
echo "<br> - 返回给定的数据元素在线性表中的位置: ".$linearList->LocateElem('d');

echo "<br> - 在第index的位置插入元素elem: ".$linearList->ListInsert(2,'A');

echo "<br> - 删除第index位置的元素elem: ".$linearList->ListDelete(2);



?>

