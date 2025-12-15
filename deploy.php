<?php
/**
 * GIT DEPLOYMENT SCRIPT
 * Used for automatically deploying websites via GitHub Webhooks.
 */

// Commands to run
$commands = array(
    'cd /home/laravelbp/public_html/',
    '/usr/local/bin/git pull',
    '/usr/local/bin/php artisan migrate --force'
);

// Run commands
$output = '';
foreach ($commands as $command) {
    $tmp = shell_exec($command . " 2>&1");

    $output .= "<span style=\"color:#6BE234;\">$</span> ";
    $output .= "<span style=\"color:#729FCF;\">{$command}</span>\n";
    $output .= htmlentities(trim($tmp ?? '')) . "\n\n";
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Git Deployment Script</title>
</head>
<body style="background-color:#000;color:#fff;font-weight:bold;padding:10px;">
<pre><?php echo $output; ?></pre>
</body>
</html>
