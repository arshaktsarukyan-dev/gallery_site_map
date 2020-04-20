<?php

namespace App\Http\Controllers;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class WelcomeController extends Controller
{
    public function index()
    {
        if (request()->isMethod('post')) {
            $items = \DB::table('gallery_motorshow')
                ->join('gallery_motorshow_places', 'gallery_motorshow.place_id', '=', 'gallery_motorshow_places.id')
                ->join('gallery_motorshow_events', 'gallery_motorshow.event_id', '=', 'gallery_motorshow_events.id')
                ->select('gallery_motorshow.url', 'gallery_motorshow_places.url as place_url', 'gallery_motorshow_events.year')
                ->get();

            $siteMapUrl = env('SITE_MAP_URL', 'http://site.com');

           if(!$items->isEmpty()){
               $siteMapBuilder = Sitemap::create();
               foreach ($items as $item) {
                   $url = $siteMapUrl . '/' . $item->place_url . '/' . $item->year . '/' . $item->url;
                   $siteMapBuilder = $siteMapBuilder->add(Url::create($url)
                       ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                       ->setPriority(0.8));
               }
               $siteMapBuilder->writeToDisk('public', 'sitemap.xml' );
               return response()->download(storage_path("app/public/sitemap.xml"));
           }
        }
        return view('welcome');
    }
}
