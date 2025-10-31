# File Name Generator

[English](README.md) | [中文](README.zh-CN.md)

[![PHP Version](https://img.shields.io/packagist/php-v/tourze/file-name-generator.svg?style=flat-square)](https://packagist.org/packages/tourze/file-name-generator)
[![Latest Version](https://img.shields.io/packagist/v/tourze/file-name-generator.svg?style=flat-square)](https://packagist.org/packages/tourze/file-name-generator)
[![License](https://img.shields.io/packagist/l/tourze/file-name-generator.svg?style=flat-square)](https://packagist.org/packages/tourze/file-name-generator)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/file-name-generator.svg?style=flat-square)](https://packagist.org/packages/tourze/file-name-generator)

A simple file name generator for creating random and date-based structured file names.

## Features

- Generate unique random identifiers using PHP's uniqid function
- Create date-structured file paths (YYYY/MM/DD format)
- Support custom path prefixes for flexible file organization
- Support various file extensions including compound extensions
- Lightweight with no external dependencies

## Installation

```bash
composer require tourze/file-name-generator
```

## Quick Start

### Generate Random Names

```php
<?php

use Tourze\FileNameGenerator\RandomNameGenerator;

$generator = new RandomNameGenerator();

// Generate a unique random string like "5fd8b23a7a9c1.23456"
$randomName = $generator->generateRandomName();
echo $randomName;
```

### Generate Date-based File Names

```php
<?php

use Tourze\FileNameGenerator\RandomNameGenerator;

$generator = new RandomNameGenerator();

// Generate file name like "2024/07/20/5fd8b23a7a9c1.23456.jpg"
$fileName = $generator->generateDateFileName('jpg');

// Generate with custom prefix like "uploads/2024/07/20/5fd8b23a7a9c1.23456.jpg"
$fileNameWithPrefix = $generator->generateDateFileName('jpg', 'uploads');

// Support compound extensions like "2024/07/20/5fd8b23a7a9c1.23456.tar.gz"
$archiveFile = $generator->generateDateFileName('tar.gz');
```

### Integration Examples

```php
<?php

use Tourze\FileNameGenerator\RandomNameGenerator;

class FileUploadService
{
    private RandomNameGenerator $nameGenerator;
    
    public function __construct()
    {
        $this->nameGenerator = new RandomNameGenerator();
    }

    public function saveUploadedFile(string $originalExtension): string
    {
        $fileName = $this->nameGenerator->generateDateFileName($originalExtension, 'uploads');
        
        // Save file logic here...
        
        return $fileName;
    }
}
```

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.