<?php

namespace CMS\Product\Models;

use Illuminate\Database\Eloquent\Model;
use CMS\Brand\Models\Brand;
use CMS\Category\Models\Category;
use CMS\Comment\Models\Comment;
use CMS\Media\Models\Media;
use CMS\Media\Service\MediaService;
use CMS\PostMeta\Models\Post_meta;
use CMS\PostMeta\Repository\PostMetaRepository;
use CMS\Product\Repository\ProductRepository;
use CMS\Product\Repository\ProductVariationRepository;
use CMS\Product\Service\ProductVariationService;
use CMS\User\Models\User;

class Wishlist extends Model
{
    protected $fillable=["user_id","product_id"];
    protected $table="wishlist";
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
