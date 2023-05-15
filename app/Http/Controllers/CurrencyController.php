<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class CurrencyController extends Controller
{
    public function check(Request $request) {
        if ($request->session()->get('key') !== 'authorized') {
            return view('auth', ['message' => true]);
        } else {
            return view('currency');
        }
    }

    public function get_curs(Request $request) {
        // $url = 'https://www.cbr.ru/scripts/XML_daily.asp';
        $date_begin = $request->input('date_begin');
        $date_end = $request->input('date_end'); 
        while ($date_begin <= $date_end) {
            $current_date = date('d/m/Y', strtotime($date_begin));
            $url = 'https://www.cbr.ru/scripts/XML_daily.asp?date_req='.$current_date;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url );
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            $content = curl_exec($ch);
            curl_close($ch);
            $xml = @simplexml_load_string($content);
            foreach ($xml->Valute as $item) {
                // R01235 - Доллар США
                // R01239 - Евро
            
                if ($item['ID'] == 'R01235') {
                    $usd[$current_date] = $item->Value;
                }
                if ($item['ID'] == 'R01239') {
                    $eur[$current_date] = $item->Value;
                }    
            }
            $date_begin = date('Y-m-d', strtotime("+1 days", strtotime($date_begin)));
        }
        return view('currency', ['usd' => $usd, 'eur' => $eur]);
    }
}
