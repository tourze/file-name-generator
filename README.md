# FileNameGenerator

一个简单的文件名生成器，用于生成随机的、基于日期结构的文件名。

## 安装

```bash
composer require tourze/file-name-generator
```

## 基本用法

### 生成随机名称

```php
use Tourze\FileNameGenerator\RandomNameGenerator;

$generator = new RandomNameGenerator();

// 生成一个随机字符串
$randomName = $generator->generateRandomName();
```

### 生成基于日期的文件名

```php
use Tourze\FileNameGenerator\RandomNameGenerator;

$generator = new RandomNameGenerator();

// 生成形如 "2023/05/15/5fd8b23a7a9c1.23456.jpg" 的文件名
$fileName = $generator->generateDateFileName('jpg');

// 带前缀的文件名，例如 "uploads/2023/05/15/5fd8b23a7a9c1.23456.jpg"
$fileNameWithPrefix = $generator->generateDateFileName('jpg', 'uploads');
```

## 特性

- 生成唯一的随机标识符
- 支持基于日期目录结构的文件名生成
- 支持自定义路径前缀
- 支持不同文件扩展名

## 测试

运行单元测试：

```bash
./vendor/bin/phpunit packages/file-name-generator/tests
```
