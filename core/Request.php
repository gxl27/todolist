<?php

namespace App\Core;

class Request {

    private array $routeParams = [];

    public function getMethod() {

        return strtolower($_SERVER['REQUEST_METHOD']);

    }

    public function getUrl()
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    

    public function isGet() {

        return $this->getMethod() === 'get';

    }

    public function isPost() {

        return $this->getMethod() === 'post';

    }

    public function getBody() {

        $body = [];

        if ($this->getMethod() === 'get') {
            foreach ($_GET as $key => $value) {

                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);

            }
        }

        if ($this->getMethod() === 'post') {
            foreach ($_POST as $key => $value) {

                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);

            }
        }

        return $body;

    }

        /**
     * @param $params
     * @return self
     */
    public function setRouteParams($params)
    {
        $this->routeParams = $params;
        return $this;
    }

    public function getRouteParams()
    {
        return $this->routeParams;
    }

    public function getRouteParam($param, $default = null)
    {
        return $this->routeParams[$param] ?? $default;
    }
    
}