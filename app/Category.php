<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Category as ModelsCategory;

class Category extends ModelsCategory
{
	public function children()
	{
		return $this->hasMany(Category::class, 'parent_id');
	}

    public function products()
    {
    	return $this->belongsToMany('App\Product','product_categories');
    }

    public function allProducts()
    {
    	$allProducts = collect([]);

    	$mainCategoryProducts = $this->products;

    	$allProducts = $allProducts->concat($mainCategoryProducts);

    	if($this->children->isNotEmpty())
    	{
    		foreach($this->children as $child)
    		{
    			$allProducts = $allProducts->concat($child->products);
    		}
    	}

    	//dd($allProducts);
    	return $allProducts;
    }
}
