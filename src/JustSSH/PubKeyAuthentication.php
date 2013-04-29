<?php

namespace JustSSH;

/**
 * Authenticate using pub-key.
 *
 * @author David Keijser <keijser@gmail.com>
 */
class PubKeyAuthentication implements AuthenticationInterface
{
    protected $username;
    protected $privkey;
    protected $pubkey;
    protected $passphrase;

    public function __construct($opts)
    {
        $this->username = $opts['username'];
        $this->privkey = realpath($opts['privkey']);
        $this->pubkey = realpath($opts['pubkey']);
        if (isset($opts['passphrase'])) {
            $this->passphrase = $opts['passphrase'];
        }
    }

    /**
     * Authenticate.
     *
     * @param resource $session libssh2 session to authenticate.
     *
     * @see ssh2_auth_pubkey_file
     * @return void
     */
    public function apply($session)
    {
        $args = array($session, $this->username, $this->pubkey, $this->privkey);

        if ($this->passphrase) {
            $args[] = $this->passphrase;
        }

        $auth = call_user_func_array('ssh2_auth_pubkey_file', $args);

        if (!$auth) {
            throw new \RuntimeException("Could not auth");
        }
    }
}
