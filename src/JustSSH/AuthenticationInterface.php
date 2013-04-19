<?php

namespace JustSSH;

/**
 * Interface for ssh authentication schemes.

 * @author David Keijser <keijser@gmail.com>
 */
interface AuthenticationInterface
{
    /**
     * Authenticate.
     *
     * @param resource $session libssh2 session to authenticate.
     *
     * @return void
     */
    public function apply($connection);
}
