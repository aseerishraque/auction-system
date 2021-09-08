<?php

namespace App\Services;

use Illuminate\Http\Request;
use Image;

class SaveImageService
{
    private $attribute = [];

    public function saveImage(Request $request, array $attributes, string $prefix, string $path): SaveImageService
    {
        foreach ($attributes as $attribute)
        {
            $file_name = null;
            
            if ($request->get($attribute))
            {
                if(substr($request[$attribute], 0, 10) === 'data:image')
                {
                    // $image     = Image::make($request[$attribute])->resize('200','200');
                    $image     = Image::make($request[$attribute]);
                    $file_type = explode('/', $image->mime())[1];
                    $file_name = $attribute . '-' . $prefix . '-' . time() . '.' . $file_type;
                    $filepath  = public_path() . '/' . $path;
    
                    $image->save($filepath . $file_name);

                    $file_name = $path . $file_name;
                }

                else
                {
                    $file_name = $request[$attribute];
                }
            }

            $this->attribute[$attribute] = $file_name;
        }

        return $this;
    }

    public function get(): array
    {
        return $this->attribute;
    }

}
