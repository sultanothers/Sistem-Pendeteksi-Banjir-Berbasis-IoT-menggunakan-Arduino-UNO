<?php

include "conn.php";

$query = $conn->query("SELECT * FROM SensorData");

$ultra = array();
$flow = array();
$id = array();
$respon = array();

while ($data = $query->fetch_object()){
    array_push($ultra, (int)$data->value1);
    array_push($flow, (int)$data->value2);
    array_push($id, (int)$data->id);
}
$respon = ["ultra" => $ultra, "flow" => $flow, "id" => $id];
echo json_encode($respon);
?>