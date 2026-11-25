<?php
require_once __DIR__.'/../../src/auth.php'; require_login(); header('Content-Type: application/json; charset=utf-8');
$q=trim((string)($_GET['q']??''));
$sql="SELECT t.trip_id,b.plate_no,r.name AS route_name,r.origin,r.destination,t.status,b.last_latitude AS latitude,b.last_longitude AS longitude,b.location_updated_at AS recorded_at FROM trips t JOIN buses b ON b.bus_id=t.bus_id JOIN routes r ON r.route_id=t.route_id WHERE t.status IN ('active','scheduled')";
$params=[];if($q!==''){$sql.=' AND (b.plate_no LIKE ? OR r.name LIKE ? OR r.origin LIKE ? OR r.destination LIKE ?)';$like='%'.$q.'%';$params=[$like,$like,$like,$like];}
$sql.=' ORDER BY t.trip_id DESC LIMIT 100';$stmt=$pdo->prepare($sql);$stmt->execute($params);echo json_encode($stmt->fetchAll(),JSON_THROW_ON_ERROR);
