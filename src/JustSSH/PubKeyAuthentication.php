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
        $this->privkey = $opts['privkey'];
        $this->pubkey = $opts['pubkey'];
        $this->passphrase = $opts['passphrase'];
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
        $auth = ssh2_auth_pubkey_file(
            $session,
            $this->username,
            realpath($this->pubkey),
            realpath($this->privkey),
            $this->passphrase
        );

        if (!$auth) {
            throw new \RuntimeException("Could not auth");
        }
    }
}
