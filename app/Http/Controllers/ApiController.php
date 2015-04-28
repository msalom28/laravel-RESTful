<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Response;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Pagination\LengthAwarePaginator;


class ApiController extends Controller {

	/**
	 * @var int $statusCode
	 */
	protected $statusCode = 200;


	/**
	 * @return $statusCode
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * @int $statusCode
	 *
	 * @return Object
	 */
	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;

		return $this;
	}

	/**
	 * @param string $message
	 *
	 * @return Response
	 */
	public function responseNotSaved($message)
	{
		return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->responseWithError($message);
	}

	/**
	 *
	 * @param  string  $com_message_pump()
	 * @return Response
	 */
	public function responseNotFound($message = 'Item not found!')
	{
		return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->responseWithError($message);
	}

	/**
	 * @param string $message
	 */
	public function responseCreated($message)
	{
			return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->response([
			//some people like to use status => 'failed'
			'message' => $message
		]);	
	}

	/**
	 * @param array $data
	 *
	 * @param array $headers
	 */
	public function response($data, $headers = [])
	{
		return Response::json($data, $this->getStatusCode(), $headers);
	}

	/**
	 *  @param string $message
	 */
	public function responseWithError($message)
	{
			return $this->response([

			'error' => [

				'message' => $message,

				'status_code' => $this->getStatusCode()
			]
		]);

	}

	/**
	 *	@param LengthAwarePaginator $lessons
	 *
	 *	@param array $data
	 *
	 * 	@return mixed
	 */
	protected function responseWithPagination(LengthAwarePaginator $lessons, $data)
	{

		$data = array_merge($data, [

			'paginator' => [

				'total_count' 	=> $lessons->total(),
				'total_pages'	=> ceil($lessons->total() / $lessons->perPage()),
				'current_page'	=> $lessons->currentPage(),
				'limit'			=> $lessons->perPage()

			]

		]);

		return $this->response($data);

	}

}
