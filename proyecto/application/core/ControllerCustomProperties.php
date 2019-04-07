<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 3/28/18
 * Time: 16:23
 */

class ControllerCustomProperties
{
    /**
     * @var array
     */
    private $properties;

    public function __construct()
    {
        $this->properties = [];
    }

    public function addProperty($key, $value) : ControllerCustomProperties {

        $this->properties[$key] = $value;
        return $this;
    }

    public function getControllerName() : string {
        return $this->properties['controller_name'];
    }

    public function getIndexViewURL() : string {
        return $this->properties['index_view'];
    }

    public function getListViewURL() : string {
        return $this->properties['list_view'];
    }

    public function getEditViewURL() : string {
        return $this->properties['edit_view'];
    }

    public function getRegisterViewURL() : string {
        return $this->properties['new_view'];
    }

    public function getListURL() : string {
        return $this->properties['list_url'];
    }

    public function getEditURL() : string {
        return $this->properties['edit_url'];
    }

    public function getRegisterURL() : string {
        return $this->properties['new_url'];
    }

    public function getProperty(string $key) {
        return $this->properties[$key];
    }
}