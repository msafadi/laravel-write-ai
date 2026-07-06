<?php

namespace App\Actions;

use Illuminate\Http\Request;

class FileUpload
{
    public function __construct(protected ?Request $request = null)
    {
        //
    }

    public function handle(string $key, $path = '/', $disk = 'public')
    {
        if (! $this->request) {
            throw new \Exception('Request instance is not available.');
        }

        $file = $this->request->file($key);
        if (! $file) {
            return null;
        }

        return $file->store($path, $disk);
    }
}
