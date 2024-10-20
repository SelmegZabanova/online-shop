<?php

namespace Request;

class Request
{
    private string $uri;
    private string $method;
    protected array $data;
    public function __construct(string $uri, string $method, array $data = [])
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->data = $data;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getData(): array
    {
        return $this->data;
    }

}