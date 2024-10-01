<?php


use Database\Seeders\LocalImages;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait CanCreateImages
{
    public function createImage(?string $size = LocalImages::SIZE_200x200): ?string
    {
        $randomImage = LocalImages::getRandomFile($size);

        $image = file_get_contents($randomImage->getPathname());

        $filename = Str::uuid() . '.jpg';

        Storage::disk('s3')->put($filename, $image);

        return $filename;
    }
}
