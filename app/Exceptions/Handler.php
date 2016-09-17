<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response as IlluminateResponse;

class Handler extends ExceptionHandler
{
    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    // public function report(Exception $e)
    // {
    //     parent::report($e);
    // }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        // custom error message on 404 not found
        if ($e instanceof NotFoundHttpException) {
            $status = IlluminateResponse::HTTP_NOT_FOUND;
            $return = [
                'status' => $status,
                'message' => 'Endpoint not found.',
                'data' => '',
            ];
            return response()->json($return, $status);
        } elseif ($e instanceof MethodNotAllowedHttpException) {
            // custom error message on 405 method not allowed 
            $status = IlluminateResponse::HTTP_METHOD_NOT_ALLOWED;
            $return = [
                'status' => $status,
                'message' => 'Method not allowed.',
                'data' => '',
            ];
            return response()->json($return, $status);
        } else {
            if (app()->environment('local')) {
                $message = 'Error occurred on file '. $e->getFile() .' : '. $e->getLine() .'. Error : ' . $e->getMessage();
            } else {
                $message = "whoops";
            }
            $status = IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR;
            $return = [
                'status' => $status,
                'message' => $message,
                'data' => '',
            ];
            return response()->json($return, $status);
        }
    }
}
