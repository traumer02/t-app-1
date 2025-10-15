<?php

namespace App\Helpers;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use stdClass;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * Response helper
 *
 * @method Response created
 * @method Response accepted
 * @method Response noContent
 * @method Response resetContent
 * @method Response forbidden
 * @method Response badRequest
 * @method Response notFound
 * @method Response gone
 * @method Response unauthorized
 * @method Response iAmATeapot
 * @method Response internalServerError
 * @method Response unprocessableEntity
 */
class Response
{

    /**
     * @var stdClass
     */
    protected stdClass $response;

    /**
     * @var array
     */
    protected array $headers = [];

    /**
     * @var int
     */
    protected int $httpCode = ResponseAlias::HTTP_OK;

    /**
     *
     */
    public function __construct()
    {
        $this->response = new stdClass();
    }

    /**
     * Magic method to set http response code by name i.e $this->forbidden()
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return \App\Helpers\Response
     */
    public function __call(string $name, array $arguments = []): Response
    {
        try {
            $httpCode = \constant(
                \sprintf(
                    'Symfony\Component\HttpFoundation\Response::HTTP_%s',
                    Str
                        ::of($name)
                        ->snake()
                        ->upper()
                )
            );
        } catch (\Exception $exception) {
            $httpCode = ResponseAlias::HTTP_BAD_REQUEST;
        }

        $this->http((int)$httpCode);

        return $this;
    }

    /**
     * @param string|array|\Illuminate\Http\Resources\Json\JsonResource $data
     * @param \Illuminate\Http\Request|null                             $request
     *
     * @return $this
     */
    public function data(string|array|JsonResource $data, ?Request $request = null): Response
    {
        if (is_string($data)) {
            $data = json_decode($data);
        }

        if (is_a($data, JsonResource::class)) {
            $data = $data->toArray($request ?? request());
        }

        $this->response->data = $data;

        return $this;
    }

    /**
     * Set pagination data
     *
     * @param integer $total
     * @param int     $perPage
     * @param integer $current
     * @param int     $last
     *
     * @return \App\Helpers\Response
     *
     * @example pagination(
     *              total:   $model->total(),
     *              perPage: $model->perPage(),
     *              current: $model->currentPage(),
     *              last:    $model->lastPage(),
     *          )
     *
     */
    public function pagination(
        int $total = 0,
        int $perPage = 0,
        int $current = 0,
        int $last = 0,
    ): Response
    {
        $this->response->pagination = [
            'items' => [
                'total'    => $total,
                'per_page' => $perPage,
            ],
            'page'  => [
                'current' => $current,
                'last'    => $last,
            ],
        ];

        return $this;
    }

    /**
     * @param int $httpCode
     *
     * @return $this
     */
    public function http(int $httpCode): Response
    {
        $this->httpCode = $httpCode;

        return $this;
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return \App\Helpers\Response
     */
    public function header(string $name, mixed $value): Response
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Set a single message
     *
     * @param string $message
     *
     * @return \App\Helpers\Response
     */
    public function message(string $message): Response
    {
        $this->response->message = $message;

        return $this;
    }

    /**
     * Returns successful response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ok(): JsonResponse
    {
        $this->response->success = true;

        return response()->json($this->response, $this->httpCode, $this->headers);
    }

    /**
     * Returns failed response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fail(): JsonResponse
    {
        $this->response->success = false;

        return response()->json($this->response, $this->httpCode, $this->headers);
    }
}
