<?php

namespace Infrastructure\Request;

class Request
{
    private $path;
    private $parameters;
    private $method;

    public function __construct()
    {
        $this->setPath($_GET['path']);
        $this->setParameters($_REQUEST);
        $this->setMethod($_SERVER['REQUEST_METHOD']);
    }

    private function setPath($value)
    {
        $this->path = trim($value, '/');
        unset($_GET['path']);
        unset($_REQUEST['path']);
    }

    private function setParameters($value)
    {
        $this->parameters = $value;
    }

    private function setMethod($value)
    {
        $this->method = strtolower($value);
    }

    public function getPath()
    {

        return $this->path;
    }

    public function getParameters($key = null)
    {

        return $key !== null ? $this->parameters[$key] : $this->parameters;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function __get($property)
    {

        return $this->getParameters($property);
    }

    public function all()
    {
        return $this->getParameters();
    }
}