<?php
declare(strict_types=1);

namespace Tests\Unit\DOMParserService;

use App\Service\DOMParserService;
use PHPUnit\Framework\TestCase;

class DOMParserServiceTest extends TestCase
{
    /**
     * @covers \App\Service\DOMParserService
     */
    public function testCountOfCertainPage(): void
    {

        $DOMParserService = new DOMParserService();


        $content = '<html><head><title>Test title</title></head><body><p>Test paragraph</p><p>Second</p></body></html>';

        $result = $DOMParserService->parse($content);

        $this->assertEquals(1, $result->html);
        $this->assertEquals(1, $result->head);
        $this->assertEquals(1, $result->title);
        $this->assertEquals(2, $result->p);
        $this->assertEquals(1, $result->body);

    }
    /**
     * @covers \App\Service\DOMParserService
     */
    public function testDoNotCountTagsWithoutBraces(): void
    {

        $DOMParserService = new DOMParserService();

        $content = 'html>head>title>Test title/title>/head>body>p>Test paragraph/p>p>Second/p>/body>/html>';

        $result = $DOMParserService->parse($content);

        $this->assertEquals(0, $result->html);
        $this->assertEquals(0, $result->head);
        $this->assertEquals(0, $result->title);
        $this->assertEquals(0, $result->p);
        $this->assertEquals(0, $result->body);

    }

}