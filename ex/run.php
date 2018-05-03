<?php
include 'hinhtrutron.php';

$htt = new hinhtrutron();
$htt->Gan(20, 30);
echo "Hình trụ tròn r = ".$htt->getR().", h = ".$htt->getH();
echo "<br/>";
echo "Thể tích: ".$htt->TheTich();
echo "<br/>";
echo "Diện tích xung quanh: ".$htt->DTXQ();
echo "<br/>";
echo "Diện tích toàn phần: ".$htt->DTTP();
 ?>
