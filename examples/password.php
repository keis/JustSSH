<?php
/**
 * Example of using JustSSH to connect and authenticate using a password
 */

require_once 'vendor/autoload.php';

$host = @$argv[1];
$username = @$argv[2];
$password = @$argv[3];

if (!$host || !$username || !$password) {
    echo "usage: {$argv[0]} host username password\n";
    exit(1);
}

echo "connecting to {$host}\n";
$client = new \JustSSH\Client;
$client->connect($host);

echo "authenticating as {$username}\n";
$client->authenticate(
    new \JustSSH\PasswordAuthentication($username, $password)
);

$client->execute("echo 'hello world'");
