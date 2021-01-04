<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 */
class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';
    protected $fillable = ['title', 'description', 'deleted_at'];

    public function comments()
    {
        $this->hasMany(Comment::class);
    }

    /**
     * @param $data
     * @return Product
     */
    public function storeProduct($data)
    {
        $product = new self();
        $product->title = $data['title'];
        $product->description = $data['description'];

        $product->save();

        return $product;
    }

    /**
     * @param integer $id
     * @param array $data
     * @return bool
     */
    public function updateProduct($id, $data)
    {
        $product = self::find($id);
        $product->title = $data['title'];
        $product->description = $data['description'];

        $product->save();

        return $product;
    }
}
