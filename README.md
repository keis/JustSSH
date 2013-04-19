JustSSH
=======

libssh2 wrapper with minimal extra baggage.

Usage
=====

```
$client = new \JustSSH\Client;
$client->connect('your-host');
$client->authenticate(
    new \JustSSH\PasswordAuthentication('username', 'password'));

$stream = $client->execute("cowsay 'Moo!'");
// do something with output
```
