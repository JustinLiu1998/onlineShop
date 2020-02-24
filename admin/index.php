<?php

include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';

$template['title'] = '系统信息';
$template['css'] = array('css/index.css');

$conn = connect();
include_once './inc/is_manage_login.inc.php';

$query = "select * from admin where id={$_SESSION['manage']['id']}";
$result_manage = execute($conn, $query);
$data_manage = mysqli_fetch_assoc($result_manage);

if($data_manage['level'] == '0') {
    $data_manage['level'] = '超级管理员';
}
else {
    $data_manage['level'] = '普通管理员';
}

$query = "select count(*) from dirInfo";
$count_dir = get_num($conn, $query);
$query = "select count(*) from subDirInfo";
$count_subDir = get_num($conn, $query);
$query = "select count(*) from product";
$count_product = get_num($conn, $query);
$query = "select count(*) from member";
$count_member = get_num($conn, $query);

?>

<?php include 'inc/header.inc.php'?>
<div id="main">
    <div class="title">系统信息</div>
    <div class="explain">
        <ul>
            <li style="font-size: medium; margin: 10px 0 25px 0">您好，<?php echo $data_manage['name']?></li>
            <li>|- 等级：<?php echo $data_manage['level']?> </li>
            <li>|- 创建时间：<?php echo $data_manage['create_time']?></li>
        </ul>
    </div>
    <div class="explain">
        <ul>
            <li>|- 目录数(<?php echo $count_dir?>)
                子目录数(<?php echo $count_subDir?>)
                商品数(<?php echo $count_product?>)
                会员数(<?php echo $count_member?>)
            </li>
        </ul>
    </div>
    <div class="explain">
        <ul>
            <li>|- 服务器操作系统：<?php echo PHP_OS?> </li>
            <li>|- 服务器软件：<?php echo $_SERVER['SERVER_SOFTWARE']?> </li>
            <li>|- MySQL 版本：<?php echo  mysqli_get_server_info($conn)?></li>
            <li>|- 最大上传文件：<?php echo ini_get('upload_max_filesize')?></li>
            <li>|- 项目安装位置(绝对路径)：<?php echo SA_PATH?></li>
<!--            <li>|- 内存限制：--><?php //echo ini_get('memory_limit')?><!--</li>-->
<!--            <li>|- <a target="_blank" href="phpinfo.php">PHP 配置信息</a></li>-->
        </ul>
    </div>

<!--    <div class="explain">-->
<!--        <ul>-->
<!--            <li>|- 项目安装位置(绝对路径)：--><?php //echo SA_PATH?><!--</li>-->
<!--            <li>|- 版本：onlineShop V1.0-->
<!--            <li>|- 作者：LiuJingdi </li><a target="_blank" href="https://github.com/JiangNanMax/IBBS">[查看项目源代码]</a></li>-->
<!--        </ul>-->
<!--    </div>-->
</div>
<?php include 'inc/footer.inc.php'?>
