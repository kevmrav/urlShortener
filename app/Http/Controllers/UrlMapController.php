<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\UrlMap;
use Log;

class UrlMapController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store($originalUrl)
    {
        $urlmap = new UrlMap;

        $shortenedUrl = $urlmap->create($originalUrl);

        return response()->json(['newUrl' => $shortenedUrl]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
