<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\UrlMap;

class UrlMapTest extends TestCase
{
    public $shortUrl = null;
    public $shortUrlCode = null;
    public $originalUrl = 'http://www.paycertify-test-original-url.com';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUrlMapMethods()
    {
        $this->verify404StatusOnEmptyPageLoad();

        $this->ConvertOriginalUrlToShortUrl();

        $this->getOriginalUrlByItsShortUrl();
    }


    public function verify404StatusOnEmptyPageLoad()
    {
        $response = $this->get('/');
        $response->assertStatus(404);
    }

    public function convertOriginalUrlToShortUrl()
    {
        $urlmap = new UrlMap();

        $this->shortUrl = $urlmap->create($this->originalUrl);

        $recordExists = $urlmap->where('short_url', $this->shortUrl)->exists();

        $this->assertEquals(true, $recordExists, 'Record with short_url ' . $this->shortUrl . ' does NOT exist');

        $this->shortUrlCode = str_replace(env('APP_URL') . '/', null, $this->shortUrl);
    }

    
    public function getOriginalUrlByItsShortUrl()
    {
        $urlmap = new UrlMap();

        $originalUrl = $urlmap->getOriginalUrl($this->shortUrlCode);

        $this->assertEquals($this->originalUrl, $originalUrl, 'Url does not match value original url stored in db');

        //Clean up db by removing the test record
        $urlmap->where('short_url', $this->shortUrl)->delete();

    }
}
