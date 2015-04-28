<?php namespace App\Transformers;

class CommentTransformer extends Transformer
{
	public function transform($comment)
	{
		return [

			'body' => $comment['body']
		];
	}
}