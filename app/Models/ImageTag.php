<?php
declare(strict_types=1);

/**
 * @author Artuikh Vladimir
 * @copyright 2021 Artuikh Vladimir, vladimir.artjukh@gmail.com
 */

namespace App\Models;

use App\Services\Model\ModelService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ImageTag
 *
 * @property int $id
 * @property int $image_id Image ID
 * @property int $tag_id Tag ID
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Image $images
 * @property-read \App\Models\Tag $tags
 * @method static \Illuminate\Database\Eloquent\Builder|ImageTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageTag whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageTag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ImageTag extends Model
{

    use HasFactory;

    protected $table = 'image_tag';
    protected $guarded = [];
    protected $casts
        = [
            'created_at' => 'datetime:Y-m-d H:m:s',
            'updated_at' => 'datetime:Y-m-d H:m:s'
        ];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function images()
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tags()
    {
        return $this->belongsTo(Tag::class);
    }
}
