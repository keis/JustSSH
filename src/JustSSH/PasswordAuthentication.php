<?php

namespace JustSSH;

/**
 * Authenticate using password.
 *
 * @author David Keijser <keijser@gmail.com>
 */
class PasswordAuthentication implements AuthenticationInterface
{
    protected $username;
    protected $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Authenticate.
     *
     * @param resource $session libssh2 session to authenticate.
     *
     * @see ssh2_auth_password
     * @return void
     */
    public function apply($session)
    {
        $auth = ssh2_auth_password($session, $this->username, $this->password);

        if (!$auth) {
            throw new \RuntimeException("Could not auth");
        }
    }
}
