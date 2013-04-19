<?php

namespace JustSSH;

/**
 * Wraps libssh2 functions to act as a handle to the ssh session.
 * 
 * @author David Keijser <keijser@gmail.com>
 */
class Client
{
    /**
     * libssh2 session handle.
     * @var resource
     */
    protected $session;

    /**
     * Connect to a ssh server.
     *
     * @param string $host hostname of server.
     * @param int    $port port of ssh service.
     *
     * @see ssh2_connect
     * @return void;
     */
    public function connect($host, $port = 22)
    {
        $this->session = ssh2_connect($host, $port);
        if (!$this->session) {
            throw new \RuntimeException("Could not connect to {$host}:{$port}");
        }
    }

    /**
     * Get the underlying libssh2 session.
     *
     * @return resource
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Authenticate the session with the given authentication details.
     * 
     * @param AuthenticationIntreface $auth authentication details.
     *
     * @return void
     */
    public function authenticate(AuthenticationInterface $auth)
    {
        $auth->apply($this->session);
    }

    /**
     * Send a command to execute.
     *
     * @param string $command command to execute.
     * 
     * @see ssh2_exec
     * @return resource the output stream.
     */
    public function execute($command)
    {
        $stream = ssh2_exec($this->session, $command);
        if (!$stream) {
            throw new RuntimeException("Could not execute command: {$command}");
        }
        return $stream;
    }
}
