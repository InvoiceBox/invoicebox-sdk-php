<?php

namespace Invoicebox\Sdk\Tests\Request;

use Invoicebox\Sdk\DTO\Filter\Filter;
use Invoicebox\Sdk\Exception\InvalidArgument;
use Invoicebox\Sdk\Tests\InvoiceboxTestCase;

class CheckAuthTest extends InvoiceboxTestCase
{
    /**
     * @test
     */
    public function checkAuthSuccess()
    {
        $mockClient = $this->createMockClient('mock/success-check-auth-response.json');

        $response = $mockClient->checkAuth();

        $this->assertNotNull($response);
        $this->assertEquals('017c3c54-5df4-4a72-e90b-b811795fc379', $response->getUserId());
    }

    /**
     * @test
     */
    public function checkAuthFail()
    {
        $this->expectException(InvalidArgument::class);

        $mockClient = $this->createMockClient('mock/wrong-check-auth-response.json');

        $mockClient->checkAuth();
    }
}
