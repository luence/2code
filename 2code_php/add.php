<?php

header("Access-Control-Allow-Origin: *"); 
$u = isset($_GET["u"]) ? $_GET["u"] : '';
$c = isset($_GET["c"]) ? $_GET["c"]: '';
$a = isset($_GET["a"]) ? $_GET["a"] : '';
$n = isset($_GET["n"]) ? $_GET["n"]: '';
$i = isset($_GET["i"]) ? $_GET["i"]: '';
session_start();
if ($_SESSION['code']!=$u) {
	exit('{"code":0,"msg":"非法操作!"}');
}
 
// 连主库
//$conn = mysqli_connect('路径'.':'.'端口','账号','密码','库名');
include 'conn_sql.php';

// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
 

$sql="INSERT INTO `2code_code` (`id`, `user`, `num`, `content`, `address`, `address_id`, `name`, `info`) VALUES (NULL, '".$u."', '0', '".$c."', '".$a."', '', '".$n."','".$i."')";


// echo ($sql);
$result = $conn->query($sql);

class Verify {
    public $code  = '00';
}
$verify = new Verify();

// var_dump($result);
if ($result){
    $verify->code = 1;
}else{
$verify->code = 0;
}
echo json_encode($verify);
mysqli_close($conn);

?>
