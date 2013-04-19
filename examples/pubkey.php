<?php
/**
 * Example of using JustSSH to connect and authenticate using a pubkey
 */

require_once 'vendor/autoload.php';

$home = getenv('HOME');

$host = @$argv[1];
$username = @$argv[2];
$passphrase = @$argv[3];

if (!$host || !$username) {
    echo "usage: {$argv[0]} host username [passphrase]\n";
    exit(1);
}

echo "connecting to {$host}\n";
$client = new \JustSSH\Client;
$client->connect($host);

echo "authenticating as {$username}\n";
$client->authenticate(
    new \JustSSH\PubKeyAuthentication(array(
        'username' => $username,
        'privkey' => "${home}/.ssh/id_rsa",
        'pubkey' => "${home}/.ssh/id_rsa.pub",
        'passphrase' => $passphrase
    ))
);

$client->execute("echo 'hello world'");
