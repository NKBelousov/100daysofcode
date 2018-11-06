<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use Tests\TestCase;

use App\Http\Controllers\MemeController;
use App\Meme;

class MemeCrudTest extends TestCase
{
    private function generateGetRequest()
    {
        $request = new Request();
        return $request;
    }

    private function getListResponse()
    {
        $controller = new MemeController();
        $response = $controller->list($this->generateGetRequest());
        $collection = json_decode($response->getContent());
        return $collection;
    }

    public function testListHasArrayData()
    {
        $collection = $this->getListResponse();
        $this->assertTrue(is_array($collection->data));
    }

    public function testListHasPageMetadata()
    {
        $collection = $this->getListResponse();
        $this->assertTrue(is_numeric($collection->current_page));
        $this->assertTrue(is_numeric($collection->per_page));
        $this->assertTrue(is_numeric($collection->total));
    }

    public function testGetReturnsExistingModel()
    {
        $controller = new MemeController();
        $id = Meme::inRandomOrder()->first()->id;
        $response = $controller->get($id);
        $model = json_decode($response->getContent());
        $this->assertNotEmpty($model);
    }

    public function testGetReturnsNotFoundForNonExistingModel()
    {
        $controller = new MemeController();
        $id = Meme::orderBy('id', 'desc')->first()->id + 1;
        $response = $controller->get($id);
        $this->assertEquals($response->getStatusCode(), 404);
    }

    public function testShouldPreventGetRequestWithoutId()
    {
        $controller = new MemeController();
        $response = $controller->get();
        $this->assertEquals($response->getStatusCode(), 400);
    }
}
