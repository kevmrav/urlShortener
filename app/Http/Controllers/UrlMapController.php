<?php

namespace App\Http\Controllers;

use App\UrlMap;
use Log;
use DB;


class UrlMapController extends Controller
{

    /**
     * Store a new short url that would
     * link to an original url
      */
   public function store($originalUrl)
    {
        $urlmap = new UrlMap;

        $shortenedUrl = $urlmap->create($originalUrl);

        return response()->json($shortenedUrl);
    }

    /**
     * Consume short url
     * and redirect to original url
     */
    public function show($shortUrl)
    {
        $urlmap = new UrlMap();

        $originalUrl = $urlmap->getOriginalUrl($shortUrl);

        if (!$originalUrl){
            abort(404);
        }

        return redirect()->away($originalUrl);
    }

}
