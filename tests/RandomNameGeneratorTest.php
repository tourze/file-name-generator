<?php

declare(strict_types=1);

namespace Tourze\FileNameGenerator\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\FileNameGenerator\RandomNameGenerator;

/**
 * @internal
 */
#[CoversClass(RandomNameGenerator::class)]
final class RandomNameGeneratorTest extends TestCase
{
    private RandomNameGenerator $generator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->generator = new RandomNameGenerator();
    }

    /**
     * 测试生成的随机名称不为空
     */
    public function testGenerateRandomNameReturnsNonEmptyString(): void
    {
        $result = $this->generator->generateRandomName();
        $this->assertNotEmpty($result);
    }

    /**
     * 测试多次调用生成的名称是否不同（唯一性测试）
     */
    public function testGenerateRandomNameReturnsUniqueValues(): void
    {
        $value1 = $this->generator->generateRandomName();
        $value2 = $this->generator->generateRandomName();
        $this->assertNotEquals($value1, $value2);
    }

    /**
     * 测试生成的字符串格式是否符合uniqid的预期格式
     */
    public function testGenerateRandomNameMatchesExpectedFormat(): void
    {
        $result = $this->generator->generateRandomName();
        // uniqid格式为带小数点的十六进制数字，开启more_entropy时格式为"十六进制.十六进制"
        $this->assertMatchesRegularExpression('/^[0-9a-f]+\.[0-9a-f]+$/', $result);
    }

    /**
     * 测试只提供扩展名参数时的文件名生成
     */
    public function testGenerateDateFileNameWithExtensionOnly(): void
    {
        $extension = 'jpg';
        $result = $this->generator->generateDateFileName($extension);

        $today = date('Y/m/d');
        $this->assertStringContainsString($today, $result);
        $this->assertMatchesRegularExpression('/^' . preg_quote($today, '/') . '\/[0-9a-f]+\.[0-9a-f]+\.' . $extension . '$/', $result);
    }

    /**
     * 测试带路径前缀的文件名生成
     */
    public function testGenerateDateFileNameWithPathPrefix(): void
    {
        $extension = 'jpg';
        $pathPrefix = 'uploads';
        $result = $this->generator->generateDateFileName($extension, $pathPrefix);

        $today = date('Y/m/d');
        $this->assertStringStartsWith($pathPrefix, $result);
        $this->assertMatchesRegularExpression('/^' . preg_quote($pathPrefix, '/') . '\/' . preg_quote($today, '/') . '\/[0-9a-f]+\.[0-9a-f]+\.' . $extension . '$/', $result);
    }

    /**
     * 测试多层路径前缀的文件名生成
     */
    public function testGenerateDateFileNameWithMultiLevelPathPrefix(): void
    {
        $extension = 'jpg';
        $pathPrefix = 'uploads/images';
        $result = $this->generator->generateDateFileName($extension, $pathPrefix);

        $today = date('Y/m/d');
        $this->assertStringStartsWith($pathPrefix, $result);
        $this->assertMatchesRegularExpression('/^' . preg_quote($pathPrefix, '/') . '\/' . preg_quote($today, '/') . '\/[0-9a-f]+\.[0-9a-f]+\.' . $extension . '$/', $result);
    }

    /**
     * 测试空扩展名的边界情况
     */
    public function testGenerateDateFileNameWithEmptyExtension(): void
    {
        $result = $this->generator->generateDateFileName('');

        $today = date('Y/m/d');
        $this->assertStringContainsString($today, $result);
        $this->assertMatchesRegularExpression('/^' . preg_quote($today, '/') . '\/[0-9a-f]+\.[0-9a-f]+\.$/', $result);
    }

    /**
     * 测试特殊字符扩展名（如复合扩展名）
     */
    public function testGenerateDateFileNameWithSpecialCharacters(): void
    {
        $extension = 'tar.gz';
        $result = $this->generator->generateDateFileName($extension);

        $today = date('Y/m/d');
        $this->assertStringContainsString($today, $result);
        $this->assertMatchesRegularExpression('/^' . preg_quote($today, '/') . '\/[0-9a-f]+\.[0-9a-f]+\.' . preg_quote($extension, '/') . '$/', $result);
    }

    /**
     * 验证生成的文件名包含正确的日期格式
     */
    public function testGenerateDateFileNameContainsCorrectDateFormat(): void
    {
        $extension = 'txt';
        $result = $this->generator->generateDateFileName($extension);

        $expectedDatePattern = '/^\d{4}\/\d{2}\/\d{2}\//';
        $this->assertMatchesRegularExpression($expectedDatePattern, $result);

        $today = date('Y/m/d');
        $this->assertStringContainsString($today . '/', $result);
    }
}
