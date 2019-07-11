<?php
session_start();
$file = 'items.txt';
$cart = 'index.php';
if (isset($_GET['add'])) {
    if ($handle = fopen($file, 'r')) {
        while (!feof($handle)) {
            $content = fgets($handle);
            $itemInfo = explode(':', $content);
            if ($itemInfo[0] == $_GET['add']) {
                if ($itemInfo[4] != $_SESSION['item_'.$_GET['add']]) {                
                    $_SESSION['item_'.$_GET['add']] += '1';                    
                }
                header('Location: '.$cart);
            }
        }
    }
}

if (isset($_GET['remove'])) {
    $_SESSION['item_'.$_GET['remove']] -= '1';
    header('Location: '.$cart);
}

if (isset($_GET['delete'])) {
    $_SESSION['item_'.$_GET['delete']] = '0';
    header('Location: '.$cart);
}
?>