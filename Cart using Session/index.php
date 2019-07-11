<?php
session_start();
$file = file('items.txt', FILE_IGNORE_NEW_LINES);
$total = 0;
foreach ($_SESSION as $name=>$value) {
    if ($value > 0) {
        if (substr($name,0,5) == 'item_') {
            $id = substr($name,5,strlen($name)-5);
            foreach ($file as $line) {
                $itemInfo = explode(':', $line);
                if ($itemInfo[0] == $id) {
                    $sub = $itemInfo[3] * $value;
                    echo $itemInfo[1].' x '.$value.' @ '.number_format($itemInfo[3],2).' = '.$sub.'<a href="shop.php?remove='.$id.'">[-]<a/>','<a href="shop.php?add='.$id.'">[+]</a>','<a href="shop.php?delete='.$id.'">Delete</a><br/>';
                }
            }
            $total += $sub;
        }
    }
}

if ($total == 0) {
    echo '<p>Cart Empty</p>';
} else {
    echo 'TOTAL: '.$total;
}

foreach ($file as $line) {
    $itemInfo = explode(':', $line);
    $newCont = "";
    echo '<p>'.$itemInfo[1].'<br/>'.$itemInfo[3].'<br/>'.$itemInfo[2].'&nbsp;<a href="shop.php?add='.$itemInfo[0].'">Add</a>';
}
?>