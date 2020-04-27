<?php


namespace MartinVondrak\AnalyticsService\Validator;


use MartinVondrak\AnalyticsService\Http\BadRequestException;
use MartinVondrak\AnalyticsService\Http\MethodNotAllowedException;
use MartinVondrak\AnalyticsService\Http\Request;

class RequestValidator
{
    public function validateRequest(Request $request): void
    {
        $this->validateMethod($request->getMethod());
        $this->validateFile($request->getFile());
    }

    private function validateMethod(string $method): void
    {
        if ('POST' !== $method) {
            throw new MethodNotAllowedException(sprintf('Method %s not allowed', $method), 405);
        }
    }

    /**
     * @param array|string[]|int[] $file
     */
    private function validateFile(array $file): void
    {
        if (empty($file) || !isset($file['error']) || UPLOAD_ERR_OK !== $file['error'] || empty($file['tmp_name'])) {
            throw new BadRequestException('Missing request content', 400);
        }
    }
}
