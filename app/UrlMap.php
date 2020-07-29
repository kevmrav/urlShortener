<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Log;

class UrlMap extends Model
{

    private $baseUrl = null;

    public function __construct()
    {
        $this->baseUrl = env('APP_URL') . '/';
    }

    /*
     * Create shortened url from an source url
     */
    public function create($originalUrl)
    {
        $randNumLength =  rand(5,10);

        $shortUrl = $this->baseUrl . Str::lower(Str::random($randNumLength));

        $originalUrl = (Str::lower(substr($originalUrl, 0,4)) === 'http') ? $originalUrl: 'http://'.$originalUrl;

        $this->updateOrInsert(
                ['original_url' => $originalUrl],
                [
                    'short_url' => $shortUrl,
                    'expires_at' => Carbon::now()->addDays(30),
                    'created_at' => Carbon::now()
                ], true
        );

        return $shortUrl;
    }


    /*
     * Find the original url by
     * querying on short url
     */
    public function getOriginalUrl($shortUrl)
    {
        $shortUrl = $this->baseUrl . $shortUrl;

        $rec = $this->select('original_url')
            ->where([
                ['short_url', $shortUrl],
                ['expires_at', '>=', Carbon::now()]
            ])
            ->first();

        if (!$rec){
            return null;
        }

        return $rec->original_url;
    }
}
