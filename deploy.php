<?php
/**
 * GIT DEPLOYMENT SCRIPT
 *
 * Used for automatically deploying websites via GitHub Webhooks.
 */

// The commands to run should ok?. 
// 1. Go to the project folder (Step 2A repository path)
// 2. Pull the latest changes
// 3. Run the cPanel deployment (process .cpanel.yml tasks)
$commands = array(
    'cd /home/laravelbp/public_html/',
    '/usr/local/bin/git pull', 
    '/usr/local/bin/php artisan migrate --force' // Optional: Run migrations automatically
);

// Run the commands
$output = '';
foreach($commands as $command){
    $tmp = shell_exec($command . " 2>&1"); // Capture error output too
    $output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
    $output .= htmlentities(trim($tmp)) . "\n";
}

// Display output (useful for debugging if you visit the URL manually)
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Git Deployment Script</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<pre>
<?php echo $output; ?>
</pre>
</body>
</html>