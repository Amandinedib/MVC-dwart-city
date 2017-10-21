<?php
class CoreController
{
    private $parameters;
    private $data;
    protected $className;
    private static $listModel;

    public function getFolderView($view)
    {
        return VIEWS_PATH . DS . $this->className . DS .strtolower($view).'.php';
    }

    public function __construct($className)
    {
        if($className)
        {
            $this->className = $className;
        }

        $this->parameters = array();
        $this->data = array();
    }

    protected function getInstanceModel($className = '')
    {
        if($className)
        {
            $modelName = ucwords($className).'Model';
        }
        else
        {
            $modelName = $this->className.'Model';
        }

        if(empty(self::$listModel[$modelName]))
        {

            self::$listModel[$modelName] = new $modelName();
        }

        return self::$listModel[$modelName];
    }

    private function accessArray(array $array, $key = null, $default = null)
    {
        if(is_null($key))
        {
            return $array;
        }
        else
        {
            if(isset($array[$key]))
            {
                return $array[$key];
            }
            else
            {
                return $default;
            }
        }
    }

    /**
     * @param $key The key you want to access
     * @param $default The returned value if the key is not found
     * @return mixed The whole array or the accessed item if key is provided
     */
    public function getParameters($key = null, $default = null)
    {
        return $this->accessArray($this->parameters, $key, $default);
    }

    /**
     * @param array $parameters
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @see CoreController::getParameters()
     */
    public function getData($key = null, $default = null)
    {
        return $this->accessArray($this->data, $key, $default);
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function callActionName($actionName)
    {
        $action = str_replace(' ', '', lcfirst(ucwords(strtolower($actionName)))) . 'Action';

        if(method_exists($this, $action))
        {
            $this->$action();
        }
        else
        {
           echo 'erreur';
           var_dump($action);
        }
    }
}