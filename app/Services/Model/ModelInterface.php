<?php


namespace App\Services\Model;


interface ModelInterface
{
    /**
     * @param  array  $data
     * @param  string  $model
     *
     * @return mixed
     */
    public static function list(array $data, string $model);

    /**
     * @param  array  $data
     * @param  string  $model
     *
     * @return mixed
     */
    public static function create(array $data, string $model);
}