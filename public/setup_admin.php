<?php
require_once __DIR__.'/../src/auth.php';
$count=(int)$pdo->query("SELECT COUNT(*) FROM users WHERE role='admin'")->fetchColumn();
if($count>0) exit('An administrator already exists. Delete this setup file now.');
if($_SERVER['REQUEST_METHOD']==='POST') {
 verify_csrf(); $username=trim((string)($_POST['username']??'')); $email=trim((string)($_POST['email']??'')); $password=(string)($_POST['password']??'');
 if(!valid_text($username,60)||!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($password)<10) $error='Enter a username, valid email and password of at least 10 characters.';
 else { $s=$pdo->prepare("INSERT INTO users(username,email,password_hash,role) VALUES(?,?,?,'admin')"); $s->execute([$username,$email,password_hash($password,PASSWORD_DEFAULT)]); exit('Administrator created. Delete public/setup_admin.php now, then sign in.'); }
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Create first administrator</title><link rel="stylesheet" href="assets/style.css"></head><body class="login-page"><main class="login-card"><h1>First administrator</h1><?php if(!empty($error)):?><div class="alert"><?=e($error)?></div><?php endif;?><form method="post"><input type="hidden" name="csrf_token" value="<?=e(csrf_token())?>"><label>Username</label><input name="username" required maxlength="60"><label>Email</label><input type="email" name="email" required><label>Password (10+ characters)</label><input type="password" name="password" minlength="10" required><button>Create administrator</button></form></main></body></html>
