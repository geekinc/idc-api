<?php

require '../vendor/autoload.php';

if (PHP_SAPI == 'cli') {

    // Load DB settings
    $settings = require __DIR__ . '/settings.php';
    $dsn = 'mysql:host=' .
        $settings['settings']['doctrine']['connection']['host'] .
        ';dbname=' .
        $settings['settings']['doctrine']['connection']['dbname'] .
        ';charset=utf8';
    $usr = $settings['settings']['doctrine']['connection']['user'];
    $pwd = $settings['settings']['doctrine']['connection']['password'];

    $db = new \Slim\PDO\Database($dsn, $usr, $pwd);

    // Get all pending queries
    $jobs = $db->query("SELECT `id`, `scriptPath`, `params` FROM selenium_job WHERE `status` = 'pending'")->fetchAll();

    $jobIds = [];
    foreach($jobs as $job) {
        $jobIds[] = $job['id'];
    }

    if (count($jobIds) === 0) {
        exit;
    }

    // Mark all queries as active, so another script instance won't pick them up
    $query = sprintf("UPDATE selenium_job SET `status`='active' WHERE `id` IN (%s)", implode(', ', $jobIds));
    $db->query($query);

    // Run each script
    foreach($jobs as $job) {
        $command = sprintf("python %s '%s' 2> /tmp/out.txt", $job['scriptPath'], $job['params']);
        $scriptOutput = shell_exec($command);
        $db->query(sprintf(
            "UPDATE selenium_job SET `status`='complete', `result`='%s' WHERE `id` = %d",
            $scriptOutput,
            $job['id']
        ));
    }
}