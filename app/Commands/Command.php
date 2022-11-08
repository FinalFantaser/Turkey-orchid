<?php

namespace App\Commands;

use Illuminate\Http\Request;

abstract class Command{
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
    protected function _loadRepositories(array $repositories): void
    {
        // array_merge($this->_data, $repositories);
        foreach($repositories as $name => $repository)
            $this->_data[$name] = $repository;
    } //_loadRepositories
};

?>