<?php
declare(strict_types=1);

/**
 * @author Artuikh Vladimir
 * @copyright 2021 Artuikh Vladimir, vladimir.artjukh@gmail.com
 */

namespace App\Services\Model;

class ModelService implements ModelInterface
{
    /**
     * @param  array  $data
     * @param  string  $model
     *
     * @return array
     */
    public static function list(array $data, string $model)
    {
        if (isset($data['paginate'])) {
            //with pagination
            $result = $model::filter($data)->paginate($data['paginate']);
        } elseif (isset($data['count'])) {
            //count data into DB
            $result = ['count' => $model::filter($data)->count()];
        } elseif (isset($data['limit'])) {
            //limit
            $result = $model::filter($data)->limit($data['limit'])->get();
        } else {
            //without pagination
            $result = $model::filter($data)->get();
        }

        return $result;
    }

    /**
     * @param  array  $data
     * @param  string  $model
     *
     * @return array[]|mixed
     */
    public static function create(array $data, string $model)
    {
        $result = new $model();
        $result->fill($data);
        try {
            $result->save();

            return $result;
        } catch (\Exception $ex) {
            return [
                'errors' => ['error' => $ex->getMessage()]
            ];
        }
    }
}
