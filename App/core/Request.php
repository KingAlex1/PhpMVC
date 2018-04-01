<?php

namespace App\core;


class Request
{
    private $get;
    private $post;
    private $server;
    private $cookie;
    private $file;
    private $session;

    public function __construct($get, $post, $server, $cookie, $file, $session)
    {
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
        $this->cookie = $cookie;
        $this->file = $file;
        $this->session = $session;
    }

    public function get($key = null)
    {
        $this->getArr($this->get, $key);
    }

    public function post($key = null)
    {
        return $this->getArr($this->post, $key);
    }

    public function session($key = null)
    {
        return $this->getArr($this->session, $key);
    }

    public function file($key = null)
    {
       return $arr = $this->getArr($this->file, $key);
    }

    private function getArr(array $arr, $key = null)
    {
        if (!$key) {
            return $arr;
        }
        if (isset($arr[$key])) {
            return $arr[$key];
        }
        return null;
    }
}
