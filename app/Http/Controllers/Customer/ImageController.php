<?php
declare(strict_types=1);

/**
 * @author Artuikh Vladimir
 * @copyright 2021 Artuikh Vladimir, vladimir.artjukh@gmail.com
 */

namespace App\Http\Controllers\Customer;

use App\Http\Requests\Images\IndexRequest;
use App\Http\Requests\Images\StoreRequest;
use App\Facades\ImageSaveFacade;
use App\Models\Image;
use App\Models\ImageTag;
use App\Models\Tag;

class ImageController extends CustomerBaseController
{
    const FOLDER_FOR_IMAGE = 'images';
    const SUCCESSFUL_STATUS = 'Image saved successfully';
    const PAGINATE = 6;

    /**
     * @param  IndexRequest  $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(IndexRequest $request)
    {
        $tagsFilter = ($request->has('tags')) ? $request->tags : [];
        $images     = Image::filter($tagsFilter)->paginate(self::PAGINATE);
        $tags       = Tag::all(['id', 'name']);
        return view('customer.image.index', compact('images', 'tagsFilter', 'tags'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $tags = Tag::all(['id', 'name']);

        return view('customer.image.create', compact('tags'));
    }

    /**
     * @param  StoreRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        foreach ($request->files as $imageName) {
            $nameImg = uniqid().'-'.rand().'.jpg'; //name of image
            //save image to DB
            $imageId = $this->storeImageToDB(['name' => $nameImg, 'title' => $request->title]);
            //save file to directive
            $this->saveImage((int)$imageId, (string)$nameImg, (object)$imageName);
            //save tags to DB
            $this->storeTagsToDB((int)$imageId, $request->tags);
        }

        return redirect()->back()->with('status', self::SUCCESSFUL_STATUS);
    }

    /**
     * @param  int  $id
     * @param  string  $nameImg
     * @param  object  $imageFile
     */
    protected function saveImage(int $id, string $nameImg, object $imageFile)
    {
        //save image
        $image_params = [
            'object'   => self::FOLDER_FOR_IMAGE,
            'id'       => $id,
            'name_img' => $nameImg,
            'file'     => $imageFile
        ];
        ImageSaveFacade::saveImage($image_params);
    }

    /**
     * @param  array  $data
     *
     * @return integer
     */
    protected function storeImageToDB(array $data): int
    {
        $result = Image::create($data);

        return (int)$result->id;
    }

    /**
     * @param  int  $imageId
     * @param  array  $data
     */
    protected function storeTagsToDB(int $imageId, array $data)
    {
        foreach ($data as $tag) {
            ImageTag::create(['image_id' => $imageId, 'tag_id' => (int)$tag]);
        }
    }
}
