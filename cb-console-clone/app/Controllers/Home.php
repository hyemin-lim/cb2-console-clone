<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = "Dashboard";
        return view('dashboard', $data);
    }

    public function intrusionTypeData(){
        $data  = array(
            [
                'type' => 'Identity Theft',
                'number' => 1271,
                'exp' => 'blah'
            ],
            [
                'type' => 'Vulnerability Scan',
                'number' => 983,
                'exp' => 'djkhfsl',
            ],
            [
                'type' => 'Interrupting Server',
                'number' => 130,
                'exp' => 'djkhfsdfdsl',
            ],
            [
                'type' => 'Spreading Malware',
                'number' => 172,
                'exp' => 'deeeeeejkhfsl',
            ],
            [
                'type' => 'Falsifying Websites',
                'number' => 118,
                'exp' => 'dggggggggjkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkhfsl',
            ],
            [
                'type' => 'flying Websites',
                'number' => 99,
                'exp' => 'dggggggggjkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkhfsl',
            ],
            [
                'type' => 'fishing site',
                'number' => 95,
                'exp' => 'dggggggggjkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkhfsl',
            ],
        );

        return $this->response->setJSON($data);
    } //공격 유형 데이터 전송

    public function intrusionUrlData(){
        $data = array(
            [
                'url'=> "/shop/",
                'number' => 1049,
            ],
            [
                'url'=> "/product-category/accessories/on-course-accessories/clean",
                'number' => 260,
            ],
            [
                'url'=> "/",
                'number' => 111,
            ],
            [
                'url'=> "/wp-content/uploads/2019/03/GolfersClub-Online-LogoNorm",
                'number' => 36,
            ],
            [
                'url'=> "/index.php",
                'number' => 22,
            ],
        );
        return $this->response->setJSON($data);
    } //공격 URL 데이터 전송

    public function intrusionAddressData(){
        $data['data'] = array(
            [
                "index"=> 1,
                "IP"=> "138.99.216.233",
                "nation"=> "벨리즈",
                "intrusions"=> 964,
            ],
            [
                "index"=> 2,
                "IP"=> "141.98.9.212",
                "nation"=> "리투아니아",
                "intrusions"=> 260,
            ],
            [
                "index"=> 3,
                "IP"=> "52.147.222.97",
                "nation"=> "미국",
                "intrusions"=> 77,
            ],
            [
                "index"=> 4,
                "IP"=> "197.86.210.14",
                "nation"=> "남아프리카 공화국",
                "intrusions"=> 52,
            ],
            [
                "index"=> 5,
                "IP"=> "41.180.14.122",
                "nation"=> "남아프리카 공화국",
                "intrusions"=> 45,
            ],
        );
        $data['markers'] = [
            "type"=>'FeatureCollection',
            "features"=>array(
                [
                    "type"=>'Feature',
                    "geometry"=>[
                        "type"=>'Point',
                        "coordinates"=>[144.95, -37.8],
                    ],
                    "properties"=>[
                        "text"=>'Melbourne',
                        "value"=>4252,
                        "tooltip"=>"<b>Melbourne</b>\n4252K",
                    ],
                ],
                [
                    "type"=>'Feature',
                    "geometry"=>[
                        "type"=>'Point',
                        "coordinates"=>[28.03, -26.2],
                    ],
                    "properties"=>[
                        "text"=>'Johannesburg',
                        "value"=>4434,
                        "tooltip"=>"<b>Johannesburg</b>\n4252K",
                    ],
                ],
                [
                    "type"=>'Feature',
                    "geometry"=>[
                        "type"=>'Point',
                        "coordinates"=>[30.3, 59.95],
                    ],
                    "properties"=>[
                        "text"=>'Saint Petersburg',
                        "value"=>5131,
                        "tooltip"=>"<b>Saint Petersburg</b>\n4252K",
                    ],
                ],
            ),
        ];
        $data['countries'] = [
            "Russia"=>[
                "totalArea"=>17.12,
                "color"=>"#1E90FF",
            ],
            "Canada"=>[
                "totalArea"=>9.98,
                "color"=>"#B8860B",
            ],
            "China"=>[
                "totalArea"=>9.59,
                "color"=>"#BDB76B",
            ],
            "United States"=>[
                "totalArea"=>9.52,
                "color"=>"#FFA07A",
            ],
            "Brazil"=>[
                "totalArea"=>8.51,
                "color"=>"#3CB371",
            ],
            "Australia"=>[
                "totalArea"=>7.69,
                "color"=>"#D8BFD8",
            ],
        ];
        return $this->response->setJSON($data);
    } //공격 주소(ip, 국가) 데이터 전송

    public function intrusionSummaryData(){
        $data = array(
            [
                "date"=>"03/01",
                "attack"=>147,
                "visit"=>45278034,
                "attacker"=>22,
                "visitor"=>9000,
            ],
            [
                "date"=>"03/03",
                "attack"=>223,
                "visit"=>18053690,
                "attacker"=>11,
                "visitor"=>8000,
            ],
            [
                "date"=>"03/04",
                "attack"=>253,
                "visit"=>18053606,
                "attacker"=>29,
                "visitor"=>5489,
            ],
            [
                "date"=>"03/05",
                "attack"=>333,
                "visit"=>18075106,
                "attacker"=>42,
                "visitor"=>8510,
            ],
            [
                "date"=>"03/06",
                "attack"=>553,
                "visit"=>18975106,
                "attacker"=>72,
                "visitor"=>9070,
            ],
            [
                "date"=>"03/07",
                "attack"=>444,
                "visit"=>8975106,
                "attacker"=>33,
                "visitor"=>7690,
            ],
            [
                "date"=>"03/08",
                "attack"=>144,
                "visit"=>8974106,
                "attacker"=>66,
                "visitor"=>5660,
            ],
            [
                "date"=>"03/09",
                "attack"=>124,
                "visit"=>7974106,
                "attacker"=>12,
                "visitor"=>4890,
            ],
            [
                "date"=>"03/11",
                "attack"=>334,
                "visit"=>17974106,
                "attacker"=>55,
                "visitor"=>8888,
            ],
        );
        return $this->response->setJSON($data);
    } //방문&공격 현황 데이터 전송
}
