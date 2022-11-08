<?php

namespace App\Query;

use ReflectionClass;
use Illuminate\Support\Str;

abstract class Query{
    protected array $_data = [];

    /**
     *      Открытые методы
     */
    public function __set(string $name, mixed $value): void
    {
        $this->_data[$name] = $value;
    } //__set

    public function __get(string $name): mixed
    {
        return $this->_data[$name];
    } //__get

    public function __unset(string $name): void
    {
        unset($this->_data[$name]);
    } //__unset

    abstract public function __invoke();

    /**
     *      Скрытые методы
     */
    protected function _loadRepositories(string ... $reps): void
    {
        foreach($reps as $rep){
            $instance = app($rep);
            $name = Str::lcfirst(
                (new ReflectionClass($instance))->getShortName() 
            );

            $this->$name = $instance;
        }
    } //_loadRepositories
};