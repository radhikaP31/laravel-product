<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;


abstract class BaseRepository {

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @paras Application $app;
     * 
     * @throws Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Get a Searchable fields array
     * 
     * @return array 
     */
    abstract public function getFieldsSearchable();

    /**
     * Configure Model
     * 
     * @return string 
     */
    abstract public function model();

    /**
     * Make model Instanse
     * 
     * @throws \Exception
     * 
     * @return Model
     */
    public function makeModel(){

        $model = $this->app->make($this->model());

        if(!$model instanceof Model){
            throw new \Exception("Class: ($this->model()) must be instance of Illuminate\Database\Eloquent\Model");
            
        }

        return $this->model = $model;
    }

}
?>