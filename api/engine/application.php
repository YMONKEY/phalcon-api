<?php
    class Application{

        private $method = 'index';
        private $route = '';
        public function startup($config,$app){

            $query = explode('/', preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)trim($_SERVER['REQUEST_URI'],'/')));
            $parts = array_slice($query,0,3);
            $args = array_slice($query,2);
            // Break apart the route
            while ($parts) {
                $file = $config->DIR_INTERFACE  . implode('/', $parts) . '.php';

                if (is_file($file)) {
                    $this->route = implode('/', $parts);

                    break;
                } else {
                    $this->method = array_pop($parts);
                }
            }

            $file = $config->DIR_INTERFACE  . $this->route . '.php';

            $class = 'Interface' . preg_replace('/[^a-zA-Z0-9]/', '', $this->route);

            if(is_file($file)){
                include_once($file);
                $controller = new $class($app);
            }else{
                exit ('Error: Could not call ' . $this->route . '/' . $this->method . '!');
            }

            $reflection = new ReflectionClass($class);

            if ($reflection->hasMethod($this->method) && $reflection->getMethod($this->method)->getNumberOfRequiredParameters() <= count($args)) {
                return call_user_func_array(array($controller, $this->method), $args);
            } else {
                exit('Error: Could not call ' . $this->route . '/' . $this->method . '!');
            }

        }

    }
?>