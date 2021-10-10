<?php

namespace App\Http\Controllers;

use App\Facades\BookStoreService;
use App\Http\Requests\FindBookByNameRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Validator;


class BookController extends Controller {

    /**
     * @param string                                   $bookName
     *
     * @return JsonResponse
     */
    public function findByName(string $bookName): JsonResponse
    {
        $validator = Validator::make(
            ['name' => $bookName],
            ['name' => 'string|min:2']
        );
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator);
        }

        return response()->json(BookStoreService::findByName($bookName), 200);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'      => 'required|string',
                'author'    => 'required|string',
                'genre'     => 'required|string'
            ]
        );

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator);
        }

        $books = BookStoreService::store($request->get('genre'), $request->get('name'), $request->get('author'));

        return response()->json($books, 200);
    }

    protected function validationErrorResponse($validator) {
        return response()->json([
            'errors' => $validator->errors(),
            'status' => Response::HTTP_BAD_REQUEST,
        ], Response::HTTP_BAD_REQUEST);
    }
}
