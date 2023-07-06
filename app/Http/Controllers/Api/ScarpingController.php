<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
class ScarpingController extends Controller
{
    public function scrape(Request $request)
    {
        $act  = $request->input('act');
        $id   = $request->input('id');
        $page = $request->input('page');

        $id = !empty($id) ? intval($id) : null;
        $page = !empty($page) ? intval($page) : null;

        $url = !empty($id) ? '/o.php?act=vacancy&id=' . $id : (!empty($page) ? '?page=' . $page : '');
        $contents = $this->fetchContents('https://boss.az/vacancies' . $url);

        if (!empty($contents)) {
            preg_match_all('/<div class="results-i">(.*?)<\/div>/si', $contents, $matches);
            $vacancies = [];

            foreach ($matches[1] as $match) {
                preg_match('/<td>(.*?)<\/td>.*?<td>(.*?)<\/td>.*?<td>(.*?)<\/td>.*?<td>(.*?)<\/td>.*?<td>(.*?)<\/td>/si', $match, $vacancyData);

                // Check if all array keys exist
                if (isset($vacancyData[1]) && isset($vacancyData[2]) && isset($vacancyData[3]) && isset($vacancyData[4]) && isset($vacancyData[5])) {
                    $vacancies[] = [
                        'position' => strip_tags($vacancyData[1]),
                        'company' => strip_tags($vacancyData[2]),
                        'salary' => strip_tags($vacancyData[3]),
                        'details' => strip_tags($vacancyData[4]),
                        'location' => strip_tags($vacancyData[5])
                    ];
                }
            }

            $scrapedData = [
                'vacancies' => $vacancies
            ];

            return response()->json($scrapedData);
        } else {
            $message = 'Bağışlayın, servis müveqqeti işlemir.';
            return response()->json(['error' => $message]);
        }
    }





    private function fetchContents($url)
    {
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Accept' => 'text/html, application/xml, application/xhtml+xml, image/png, image/jpeg, image/gif, image/x-xbitmap, */*',
                'Accept-Language' => 'ru, en, *',
                'Accept-Charset' => 'iso-8859-1, utf-8, utf-16, *',
                'Accept-Encoding' => 'identity',
                'Connection' => 'close'
            ],
            'user_agent' => 'Opera/9.80 (Windows NT 5.1; U; ru) Presto/2.6.22 Version/10.50',
            'referer' => 'http://boss.az/'
        ]);
        return $response->getBody()->getContents();
    }
}
