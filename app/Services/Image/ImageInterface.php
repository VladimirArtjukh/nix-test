<?php
declare(strict_types=1);

/**
 * @author Artuikh Vladimir
 * @copyright 2021 Artuikh Vladimir, vladimir.artjukh@gmail.com
 */

namespace App\Services\Image;

interface ImageInterface
{
    /**
     * @param  mixed[]  $imageParams  parameters array
     *
     * @return mixed
     */
    public function saveImage(array $imageParams);

    /**
     * @param  string  $object  name folder
     * @param  string  $id  id item into DB
     *
     * @return mixed
     */
    public function createDir(string $object, string $id);

    /**
     * @param  mixed[]  $imageParams
     * @param  mixed[]  $setting
     *
     * @return mixed
     */
    public function fit(array $imageParams, array $setting);

}
