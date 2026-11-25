<?php
require_once __DIR__.'/../src/auth.php'; require_login(); page_header('Track bus');
?>
<h1>Track school buses</h1><p class="muted">The map updates every 10 seconds. A bus appears after its driver shares a GPS location.</p><label for="search">Search buses or routes</label><input id="search" type="search" placeholder="Type a plate number or route name..."><div id="map"></div><section class="panel"><h2>Trips</h2><div id="trip-list" aria-live="polite">Loading trips...</div></section>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"><script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script><script src="assets/track.js" defer></script><?php page_footer();?>
