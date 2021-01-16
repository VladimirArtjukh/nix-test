<?php
declare(strict_types=1);

/**
 * @author Artuikh Vladimir
 * @copyright 2021 Artuikh Vladimir, vladimir.artjukh@gmail.com
 */

namespace App\Models;

use App\Http\Controllers\Customer\ImageController;
use App\Services\Model\ModelService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $name name of a image
 * @property string $title title of a image
 * @property \datetime|null $created_at
 * @property \datetime|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ImageTag[] $imageTags
 * @property-read int|null $image_tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Image extends Model
{
    use HasFactory;

    const EMPTY_IMG = null;
    protected $guarded = [];
    protected $casts
        = [
            'created_at' => 'datetime:Y-m-d H:m:s',
            'updated_at' => 'datetime:Y-m-d H:m:s'
        ];

    protected $appends
        = [
            'original_image_size',
            'little_image_size'
        ];

    //Path to original image
    public function getOriginalImageSizeAttribute()
    {
        if (isset($this->attributes['name'])) {
            $result = config('app.url').'/storage/'.ImageController::FOLDER_FOR_IMAGE.'/'.$this->attributes['id'].'/big/'.$this->attributes['name'];
        } else {
            $result = self::EMPTY_IMG;
        }

        return $result;
    }
    //Path to original image
    public function getLittleImageSizeAttribute()
    {
        if (isset($this->attributes['name'])) {
            $result = config('app.url').'/storage/'.ImageController::FOLDER_FOR_IMAGE.'/'.$this->attributes['id'].'/little/'.$this->attributes['name'];
        } else {
            $result = self::EMPTY_IMG;
        }

        return $result;
    }
    /**
     * @param $query
     * @param  array  $tagsID
     *
     * @return mixed
     */
    public function scopeFilter($query, array $tagsID)
    {
        $query->with('imageTags');
        if (count($tagsID) > 0) {
            $query->whereHas('imageTags', function ($query) use ($tagsID) {
                $query->whereIn('tag_id', $tagsID);
            });
        }

        return $query;
    }


    /**
     * @param  mixed[]  $data  request data
     *
     * @return array[]
     */
    public static function create(array $data)
    {
        return ModelService::create($data, self::class);
    }

    /**
     * The roles that belong to the user.
     */
    public function imageTags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
