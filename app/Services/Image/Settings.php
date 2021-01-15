<?php
declare(strict_types=1);

/**
 * @author Artuikh Vladimir
 * @copyright 2021 Artuikh Vladimir, vladimir.artjukh@gmail.com
 */

namespace App\Services\Image;

use App\Http\Controllers\Customer\ImageController;

class Settings
{
    /**
     * @return array
     */
    public static function setting()
    {
        $data = [
            ImageController::FOLDER_FOR_IMAGE => [
                [
                    'folder'  => 'big',
                    'width'   => '1460',
                    'height'  => '500',
                    'quality' => '100'
                ]
            ]
        ];

        return $data;
    }
}
