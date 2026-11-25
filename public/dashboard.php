<?php
require_once __DIR__.'/../src/auth.php'; require_login(); page_header('Dashboard');
?>
<h1>Dashboard</h1><p>Welcome, <strong><?=e($_SESSION['username'])?></strong> (<?=e($_SESSION['role'])?>).</p><div class="cards">
<?php if($_SESSION['role']==='admin'):?><a class="card" href="admin.php"><h2>Administration</h2><p>Create users, manage buses, routes and trips.</p></a><?php endif;?>
<?php if($_SESSION['role']==='driver'):?><a class="card" href="driver.php"><h2>Share GPS location</h2><p>Send the current bus location for an active trip.</p></a><?php endif;?>
<?php if(in_array($_SESSION['role'],['parent','admin'],true)):?><a class="card" href="track.php"><h2>Track a bus</h2><p>View scheduled and active buses on the map.</p></a><?php endif;?>
<?php if($_SESSION['role']==='driver'):?><a class="card" href="track.php"><h2>View bus map</h2><p>See available trip information.</p></a><?php endif;?>
</div>
<?php page_footer();?>
