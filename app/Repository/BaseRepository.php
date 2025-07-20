<?php

declare(strict_types=1);

namespace App\Repository;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

abstract class BaseRepository
{
    /**
     * @var mixed|null
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->model = $this->initialize();
    }

    /**
     *
     * @return string
     */
    abstract public function getModel(): string;

    /**
     *
     * @return mixed
     * @throws BindingResolutionException
     * @throws Exception
     */
    public function initialize()
    {
        if (class_exists($this->getModel())) {
            return app()->make($this->getModel());
        }
        throw new Exception($this->getModel());
    }
}
