<?php
/*
 * 《大话数据结构》中c语言源码范例对应的php源码
 * 第四章 栈与队列
 */

/*
 * php数组出栈入栈
 */
echo "<br/><br/>数组入栈：";
$stack = array("Simon", "Elaine"); //定义数组
array_push($stack, "Helen", "Peter"); //入栈
print_r($stack);
echo "<br/>";

$stack = array("Simon", "Elaine"); //定义数组
array_unshift ($stack, "Helen", "Peter"); //入栈
print_r($stack);

echo "<br/><br/>数组出栈：";
$stack = array("Simon", "Elaine", "Helen", "Peter");
echo "<br/>".array_pop($stack)."<br/>"; //最后一个出栈
print_r($stack);

$stack = array("Simon", "Elaine", "Helen", "Peter");
echo "<br/>".array_shift($stack)."<br/>"; //第一个出栈
print_r($stack);


echo "<br/><br/> 链表 栈的算法操作（顺序存储）: <br/>";
/*
 * P95 php栈的操作  顺序存储
 * 参考http://blog.csdn.net/martinhacker/article/details/60781815
 * */

/*节点*/
class node{
    private $value;
    private $pre;
    public function __construct($value){
        $this->value = $value;
        $this->pre = null;
    }
    public function addPre($node){
        $this->pre = $node;
    }
    public function getPre(){
        return $this->pre;  
    }
    public function getValue(){
    	//echo " this->value: ".$this->value;
        return $this->value;
    }
}
/*栈*/
class stack{
    private $top;
    static public $size;
    public function __construct($value){
        $this->top = new node($value);
//        var_dump($this->top) ;
    }
	//入栈
    public function push($value){
        $current = $this->top;
        $newNode = new node($value);  
        $newNode->addPre($current); 
        $this->top = $newNode;    //栈顶=新节点
    }

    public function getAllStack(){
        $stack = null;
        $current = $this->top;    //new node($value)
        while ($current->getPre() != null){
            $stack .= $current->getValue()."\n";
            $current = $current->getPre();
        }
        return $stack;
    }

    public function getSize(){
        $current = $this->top;
        while (null != $current->getValue()){
            self::$size++;
            $current = $current->getPre();
        }
        return self::$size;
    }
	//出栈
    public function pop(){
        $current = $this->top;
        $this->top = $current->getPre();
        unset($current);
    }

    public function getTop(){
        return $this->top->getValue();
    }
}

$stack = new stack(0);
$stack->push(1);
$stack->push(2);
$stack->push(3);
$stack->push(4);
$stack->push(5);
$stack->push(6);
$stack->push('a');
$stack->push('b');
echo "此时的栈顶元素: ".$stack->getTop()."<br>";
$stack->push('c');
$stack->push('d');
echo "无出栈顺序: ".$stack->getAllStack()."<br>";
$stack->pop();
$stack->pop();
$stack->pop();
echo "三次出栈后: ".$stack->getAllStack()."<br>";
//最后进去的元素：
echo "此时的栈顶元素: ".$stack->getTop()."<br>";

echo "栈的长度为: ".$stack->getSize()."<br>";

/*
 * https://www.cnblogs.com/yafang/p/5872187.html
 * PHP SPL标准库（Standard PHP Library）是用于解决典型问题的一组接口与类的集合 （oop）
 * 双链表是一种重要的线性存储结构，对于双链表中的每个节点，不仅仅存储自己的信息，
 * 还要保存前驱和后继节点的地址。SPL中的SplDoublyLinkedList类提供了对双链表的操作。
 * 
 */


/*
 * P102 迭代和递归   打印出前20位的斐波那契数列数:1 1 2 3 5 8 13 21 34 55 …
 * 概念： 前两个值都为1，该数列从第三位开始，每一位都是当前位前两位的和 
 * 规律公式为： Fn = F(n-1) + F(n+1) 
 * F：指当前这个数列 ， n：指数列的下标
 * 参考http://blog.csdn.net/echo_xiaomo/article/details/52837699
 */
/*非递归写法 迭代*/
function fb_list($n){ //$n:传入数列中数字的个数
	if($n<=0){
		return 0;
	}
	$array[1] = $array[2] =1;
	for($i=3; $i<=$n; $i++){
		$array[$i] = $array[$i-1] +$array[$i-2] ;
	}
	return $array;
}
echo "<br/>打印出前20位的斐波那契数列数: <br/>非递归写法（迭代） <br/>";
print_r(fb_list(20));

/*递归写法*/
function recursion($n){
	if($n<=0){
		return 0;
	}
	if($n == 1 || $n == 2){
		return 1;
	}
	if($n > 2){
		return recursion($n - 1)+recursion($n - 2);
	}
}

//循环显示         
for($i=1; $i<=20; $i++) {
  $str .= ','.recursion($i);
}    
$str = substr($str,1);
echo "<br/>递归写法<br/>". $str;



/**
*队列的链式存储和队列的基本操作
*1.初始化队列
*2.链队列的入队操作
*3.链队列的出队操作
*4.仅返回队列中的全部元素
*5.返回队列元素个数
*6.判断队列是否为空
*7.将所有元素出队列
*
*@author xudianyang<>
*@version $Id:QueueLinked.class.php,v 1.0 2011/02/12 13:05:00 uw Exp
*@copyright &copy;2011,xudianyang
**/
class QLNode{
 public $mElem=null;
 public $mNext=null;
}
class QueueLinked{
 //队列“队首指针”
 public $mFront=null;
 //队列“队尾指针”
 public $mRear=null;
 //队列长度
 public static $mLength=0;
 public $mNext=null;
/**
*初始化队列
*
*@return void
*/
 public function __construct(){
  $this->mFront=$this;
  $this->mRear=$this;
  self::$mLength=0;
  $this->mNext=null;
 }
/**
*链队列的入队操作
*
*@param mixed $e 入队新元素值
*@return void
*/
 public function getInsertElem($e){
  $newLn=new QLNode();
  $newLn->mElem=$e;
  $newLn->mNext=null;
  $this->mRear->mNext=$newLn;
  $this->mRear=$newLn;
  self::$mLength++;
 }
/**
*链队列的出队操作
*
*@param mixed $e 出队的元素的值保存在此变量中
*@return boolean 成功返回true,否则返回false
*/
 public function getDeleteElem(&$e){
  if($this->mFront == $this->mRear){
   return false;
  }
  $p=$this->mFront->mNext;
  $e=$p->mElem;
  $this->mFront->mNext=$p->mNext;
  if($p==$this->mRear){
   $this->mRear=$this->mFront;
  }
  self::$mLength--;
  return true;
 }
/**
*仅返回队列中的全部元素
*
*@return array 队列全部元素所组成的一个数组
*/
 public function getAllElem(){
  $qldata=array();
  if($this->mFront==$this->mRear){
   return $qldata;
  }
  $p=$this->mFront->mNext;
  while($p!=null){
   $qldata[]=$p->mElem;
   $p=$p->mNext;
  }
  return $qldata;
 }
/**
*返回队列元素个数
*
*@return int 
*/
 public function getLength(){
  return self::$mLength;
 }
/**
*判断队列是否为空
*
*@return boolean 为空返回true,否则返回false
*/
 public function getIsEmpty(){
  if($this->mFront == $this->mRear){
   return true;
  }else{
   return false;
  }
 }
/**
*将所有元素出队列
*
*@return array 所有出队列的元素所组成的一个数组
*/
 public function getDeleteAllElem(){
  $qldata=array();
  if($this->mFront == $this->mRear){
   return $qldata; 
  }
  while($this->mFront->mNext!=null){
   $qldata[]=$this->mFront->mNext->mElem;
   $this->mFront->mNext=$this->mFront->mNext->mNext;
   self::$mLength--;
  }
  $this->mFront->mNext=null;
  $this->mRear=$this->mFront;
  return $qldata;
 }
}




?>

