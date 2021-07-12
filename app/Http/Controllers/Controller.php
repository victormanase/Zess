<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $view_data = [];
    public $view_root = "";
    public $root_url = "";
    public $defaultModel = null;

    public function __set($name, $value)
    {
        $this->view_data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->view_data[$name];
    }

    public function __isset($name)
    {
        return isset($this->view_data[$name]);
    }

    public function addUrls($array_of_urls)
    {
        foreach ($array_of_urls as $key => $value) {
            $this->view_data[$key] = url($this->root_url . $value);
        }
    }

    public function cView($view)
    {
        $this->view_data['view_root'] = $this->view_root;
        return view($this->view_root . ".$view", $this->view_data);
    }

    public function getModel($model)
    {
        if ($this->hasId())
            $model_instance = $model::find(request()->id);
        else
            $model_instance = new $model;

        return $model_instance;
    }

    public function hasId()
    {
        return request()->id != null;
    }

    public function initialise($root_url, $view_root, array $middleware, array $urls, $defaultModel)
    {
        $this->root_url = $root_url;
        $this->view_root = $view_root;

        $this->defaultModel = $defaultModel;
        $this->isEditing = $this->hasId();
        $this->request = request();

        $this->middleware($middleware);
        $this->addUrls($urls);
        $this->filters = [];
    }
}
