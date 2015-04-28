<?php namespace App\Transformers;

abstract class Transformer
{

	//This will map over a collection
	//for each one call a method called transform
	public function transformCollection(array $items)
	{
		return array_map([$this, 'transform'], $items);
	}


	public abstract function transform($item);
}