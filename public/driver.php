<?php
require_once __DIR__.'/../src/auth.php'; require_role('driver');
$trips=$pdo->query("SELECT t.trip_id,b.plate_no,r.name AS route_name FROM trips t JOIN buses b ON b.bus_id=t.bus_id JOIN routes r ON r.route_id=t.route_id WHERE t.status='active' ORDER BY t.trip_id DESC")->fetchAll(); page_header('Driver GPS');
?>
<section class="panel narrow"><h1>Share bus location</h1><p>Choose an active trip and allow your browser to access GPS. This feature works on HTTPS or localhost.</p><label>Active trip</label><select id="trip"><option value="">Choose trip</option><?php foreach($trips as $t):?><option value="<?=$t['trip_id']?>">#<?=$t['trip_id']?> · <?=e($t['plate_no'])?> · <?=e($t['route_name'])?></option><?php endforeach;?></select><button id="start">Start sharing location</button> <button id="stop" class="secondary" disabled>Stop</button><p id="status" class="muted" aria-live="polite">Not sharing.</p></section>
<script>const csrfToken=<?=json_encode(csrf_token())?>;</script><script src="assets/driver.js" defer></script><?php page_footer();?>
