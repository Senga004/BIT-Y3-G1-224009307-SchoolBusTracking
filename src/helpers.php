<?php
function e(mixed $value): string { return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function redirect(string $path): never { header('Location: '.$path); exit; }
function csrf_token(): string { if (empty($_SESSION['csrf_token'])) $_SESSION['csrf_token']=bin2hex(random_bytes(32)); return $_SESSION['csrf_token']; }
function verify_csrf(): void {
    $sent=$_POST['csrf_token'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
    if (!is_string($sent) || !hash_equals($_SESSION['csrf_token'] ?? '', $sent)) {
        http_response_code(419); exit('Security check failed. Refresh the page and try again.');
    }
}
function require_login(): void { if (empty($_SESSION['user_id'])) redirect('index.php'); }
function require_role(string $role): void { require_login(); if (($_SESSION['role'] ?? '') !== $role) { http_response_code(403); exit('Access denied.'); } }
function valid_text(string $value, int $max=160): bool { return $value!=='' && mb_strlen($value)<=$max; }
function page_header(string $title): void { ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title><?=e($title)?></title><link rel="stylesheet" href="assets/style.css"></head><body>
<header class="topbar"><a class="brand" href="dashboard.php">School Bus Tracking</a><nav><a href="dashboard.php">Dashboard</a> <a href="logout.php">Logout</a></nav></header><main class="container">
<?php }
function page_footer(): void { ?></main><footer class="footer">Online School Bus Tracking System · Student project</footer></body></html><?php }
