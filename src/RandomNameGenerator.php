<?php

namespace Tourze\FileNameGenerator;

class RandomNameGenerator
{
    public function generateRandomName(): string
    {
        return uniqid('', true);
    }

    public function generateDateFileName(string $extension, string $pathPrefix = ''): string
    {
        $dateStr = date('Y/m/d');
        $fileName = $this->generateRandomName() . '.' . $extension;

        $result = [];
        if (!empty($pathPrefix)) {
            $result[] = $pathPrefix;
        }
        $result[] = $dateStr;
        $result[] = $fileName;
        return implode('/', $result);
    }
}
