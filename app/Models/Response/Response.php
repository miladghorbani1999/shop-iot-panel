<?php

namespace App\Response;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\AbstractPaginator;

class Response
{
    protected $response;

    protected $data = [];

    protected $errors;

    protected $message;

    protected $statusCode;

    protected $headers;

    protected $encodeOption;

    public function __construct()
    {
        $this->response = new JsonResponse();
    }

    public function empty(): JsonResponse
    {

        $this->response->setData([]);

        $this->response->setStatusCode(204);

        if (!blank($this->headers)) {
            $this->response->withHeaders($this->headers);
        }

        if (!blank($this->encodeOption)) {
            $this->response->setEncodingOptions($this->encodeOption);
        }

        return $this->response;
    }

    public function fail(): JsonResponse
    {
        $data = [
            'message' => $this->message,
            'errors' => $this->errors,
        ];

        $this->response->setData($data);

        $this->response->setStatusCode($this->statusCode ?? 400);

        if (!blank($this->headers)) {
            $this->response->withHeaders($this->headers);
        }

        if (!blank($this->encodeOption)) {
            $this->response->setEncodingOptions($this->encodeOption);
        }

        return $this->response;
    }

    public function success(): JsonResponse
    {
        if ($this->data instanceof AbstractPaginator) {
            $this->data = [
                'items' => $this->data->getCollection(),
                'meta' => $this->paginator($this->data),
            ];
        }

        if (config('app.debug', false) && app()->bound('debugbar') && app('debugbar')->isEnabled()) {
            $_debugbar = app('debugbar')->getData();
        }

        $this->response->setStatusCode($this->statusCode ?? 200);

        if (!blank($this->headers)) {
            $this->response->withHeaders($this->headers);
        }

        if ($this->message) {
            $this->data += ['message' => $this->message];
        }

        if (!blank($this->encodeOption)) {
            $this->response->setEncodingOptions($this->encodeOption);
        }

        $this->response->setData($this->data);

        return $this->response;
    }

    public function message($message = ''): static
    {
        $this->message = $message;

        return $this;
    }

    public function content($data = []): static
    {
        $this->data = $data;

        return $this;
    }

    public function status($code): static
    {
        $this->statusCode = $code;

        return $this;
    }

    public function errors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    public function headers($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    public function encodeOption($encodeOption)
    {
        $this->encodeOption = $encodeOption;

        return $this;
    }

    protected function paginator($paginator)
    {
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();

        $pagination = [
            'total' => $paginator->total(),
            'count' => $paginator->count(),
            'per_page' => $paginator->perPage(),
            'current_page' => $currentPage,
            'total_pages' => $lastPage,
        ];

        $pagination['links'] = [];

        if ($currentPage > 1) {
            $pagination['links']['previous'] = $paginator->url($currentPage - 1);
        }

        if ($currentPage < $lastPage) {
            $pagination['links']['next'] = $paginator->url($currentPage + 1);
        }

        if (empty($pagination['links'])) {
            $pagination['links'] = (object) [];
        }

        return ['pagination' => $pagination];
    }
}
