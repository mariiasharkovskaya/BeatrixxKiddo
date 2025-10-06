<?php
    $conn = mysqli_connect('localhost', 'mariia', 'mariiagfhjkm', 'beatrix_kiddo');

    if(!$conn) {
        echo 'Connection error: ' .mysqli_connect_error();
    }
?>