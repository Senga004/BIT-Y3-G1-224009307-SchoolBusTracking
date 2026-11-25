<?php
require_once __DIR__.'/../src/auth.php';
if (!empty($_SESSION['user_id'])) redirect('dashboard.php');
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    verify_csrf();
    $username=trim((string)($_POST['username']??'')); $password=(string)($_POST['password']??'');
    $stmt=$pdo->prepare('SELECT user_id,username,password_hash,role FROM users WHERE username=? LIMIT 1');
    $stmt->execute([$username]); $user=$stmt->fetch();
    if ($user && password_verify($password,$user['password_hash'])) {
        session_regenerate_id(true); $_SESSION['user_id']=(int)$user['user_id']; $_SESSION['username']=$user['username']; $_SESSION['role']=$user['role']; redirect('dashboard.php');
    }
    $error='Incorrect username or password.';
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Sign in</title><link rel="stylesheet" href="assets/style.css"></head><body class="login-page"><main class="login-card"><h1>School Bus Tracking</h1><p class="muted">Sign in to continue</p>
<?php if($error):?><div class="alert"><?=e($error)?></div><?php endif;?>
<form method="post"><input type="hidden" name="csrf_token" value="<?=e(csrf_token())?>"><label>Username</label><input name="username" autocomplete="username" maxlength="60" required><label>Password</label><input type="password" name="password" autocomplete="current-password" required><button>Sign in</button></form><p class="small muted">Ask the administrator to create your account.</p></main></body></html>
