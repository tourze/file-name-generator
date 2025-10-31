# 文件名生成器

[English](README.md) | [中文](README.zh-CN.md)

[![PHP Version](https://img.shields.io/packagist/php-v/tourze/file-name-generator.svg?style=flat-square)](https://packagist.org/packages/tourze/file-name-generator)
[![Latest Version](https://img.shields.io/packagist/v/tourze/file-name-generator.svg?style=flat-square)](https://packagist.org/packages/tourze/file-name-generator)
[![License](https://img.shields.io/packagist/l/tourze/file-name-generator.svg?style=flat-square)](https://packagist.org/packages/tourze/file-name-generator)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/file-name-generator.svg?style=flat-square)](https://packagist.org/packages/tourze/file-name-generator)

一个简单的文件名生成器，用于生成随机的、基于日期结构的文件名。

## 特性

- 使用 PHP 的 uniqid 函数生成唯一的随机标识符
- 创建基于日期的目录结构（YYYY/MM/DD 格式）
- 支持自定义路径前缀，便于灵活的文件组织
- 支持各种文件扩展名，包括复合扩展名
- 轻量级，无外部依赖（除了用于服务注册的 Symfony DI）

## 安装

```bash
composer require tourze/file-name-generator
```

## 快速开始

### 生成随机名称

```php
<?php

use Tourze\FileNameGenerator\RandomNameGenerator;

$generator = new RandomNameGenerator();

// 生成一个唯一的随机字符串，如 "5fd8b23a7a9c1.23456"
$randomName = $generator->generateRandomName();
echo $randomName;
```

### 生成基于日期的文件名

```php
<?php

use Tourze\FileNameGenerator\RandomNameGenerator;

$generator = new RandomNameGenerator();

// 生成形如 "2024/07/20/5fd8b23a7a9c1.23456.jpg" 的文件名
$fileName = $generator->generateDateFileName('jpg');

// 带自定义前缀，如 "uploads/2024/07/20/5fd8b23a7a9c1.23456.jpg"
$fileNameWithPrefix = $generator->generateDateFileName('jpg', 'uploads');

// 支持复合扩展名，如 "2024/07/20/5fd8b23a7a9c1.23456.tar.gz"
$archiveFile = $generator->generateDateFileName('tar.gz');
```

### 在 Symfony 中使用

该生成器在使用 Symfony 时会自动注册为服务：

```php
<?php

use Tourze\FileNameGenerator\RandomNameGenerator;

class FileUploadService
{
    public function __construct(
        private RandomNameGenerator $nameGenerator
    ) {}

    public function saveUploadedFile(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = $this->nameGenerator->generateDateFileName($extension, 'uploads');
        
        // 文件保存逻辑...
        
        return $fileName;
    }
}
```

## 贡献

详情请参见 [CONTRIBUTING.md](CONTRIBUTING.md)。

## 许可证

MIT 许可证。详情请参见 [许可证文件](LICENSE)。