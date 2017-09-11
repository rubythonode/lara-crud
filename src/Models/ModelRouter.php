<?php

namespace Trafik8787\LaraCrud\Models;

use Illuminate\Routing\Route;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Routing\Registrar as RegistrarContract;

class ModelRouter
{
    /**
     * @var RegistrarContract
     */
    protected $router;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $application
     * @param RegistrarContract $router
     */
    public function __construct(Application $application, RegistrarContract $router)
    {
        $this->app = $application;
        $this->router = $router;
    }

    /**
     * @param ModelCollection $models
     */
    public function register(ModelCollection $models)
    {

        $aliases = $models->keyByAlias();

        if ($aliases->count() > 0) {
            $this->registerModelPatterns($aliases);
            $this->registerModelBindings($aliases);
        }
    }

    /**
     * @param Collection $aliases
     */
    protected function registerModelPatterns(Collection $aliases)
    {
        $this->router->pattern('adminModelId', '[a-zA-Z0-9_-]+');
        $this->router->pattern('adminModel', $aliases->keys()->implode('|'));

    }

    /**
     * @param Collection $aliases
     */

    protected function registerModelBindings(Collection $aliases)
    {

        $this->router::bind('adminModel', function ($model, Route $route) use ($aliases) {


            if (is_null($model = $aliases->get($model))) {
                throw new ModelNotFoundException();
            }
            //dd($route);
            if ($model->hasCustomControllerClass() && $route->getActionName() !== 'Closure') {
                list($controller, $action) = explode('@', $route->getActionName(), 2);

                if (method_exists($model->getControllerClass(), $action)) {
                    $this->runCustomController($route, $model->getControllerClass(), $action);
                }
            }

            return $model;
        });
    }

    /**
     * @param Route $route
     * @param string $controller
     * @param string $action
     */
    protected function runCustomController(Route $route, $controller, $action)
    {
        $route->uses(function () use ($route, $controller, $action) {
            return (new \Illuminate\Routing\ControllerDispatcher($this->app))->dispatch(
                $route, $this->app->make($controller), $action
            );
        });
    }
}
