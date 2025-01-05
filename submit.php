<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_REQUEST['val1'];

    if(empty($data)) {
        echo "Data is empty.";
    } else {
        echo $data;
    }
}

$conn->close();

?>