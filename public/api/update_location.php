<?php
require_once __DIR__.'/../../src/auth.php'; require_role('driver'); header('Content-Type: application/json; charset=utf-8');
if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);echo json_encode(['message'=>'POST required']);exit;}
$data=json_decode(file_get_contents('php://input'),true)??[];
$token=$_SERVER['HTTP_X_CSRF_TOKEN']??'';if(!hash_equals($_SESSION['csrf_token']??'',(string)$token)){http_response_code(419);echo json_encode(['message'=>'Security token expired. Refresh the page.']);exit;}
$trip=filter_var($data['trip_id']??null,FILTER_VALIDATE_INT);$lat=filter_var($data['latitude']??null,FILTER_VALIDATE_FLOAT);$lng=filter_var($data['longitude']??null,FILTER_VALIDATE_FLOAT);
if(!$trip||$lat===false||$lng===false||$lat < -90||$lat>90||$lng < -180||$lng>180){http_response_code(422);echo json_encode(['message'=>'Invalid trip or GPS coordinates.']);exit;}
$check=$pdo->prepare("SELECT bus_id FROM trips WHERE trip_id=? AND status='active'");$check->execute([$trip]);$row=$check->fetch();if(!$row){http_response_code(403);echo json_encode(['message'=>'This trip is not active.']);exit;}
$save=$pdo->prepare('UPDATE buses SET last_latitude=?,last_longitude=?,location_updated_at=NOW() WHERE bus_id=?');$save->execute([$lat,$lng,$row['bus_id']]);echo json_encode(['message'=>'Location updated successfully.']);
