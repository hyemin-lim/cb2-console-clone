<!doctype html>
<html>
<head>
    <title>console dashboard clone</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/21.2.5/css/dx.light.css">
    <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/21.2.5/js/dx.all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn3.devexpress.com/jslib/21.2.5/js/vectormap-data/world.js"></script>
    <script src="https://cdn3.devexpress.com/jslib/21.2.5/js/vectormap-data/africa.js"></script>
    <script src="https://cdn3.devexpress.com/jslib/21.2.5/js/vectormap-data/canada.js"></script>
    <script src="https://cdn3.devexpress.com/jslib/21.2.5/js/vectormap-data/eurasia.js"></script>
    <script src="https://cdn3.devexpress.com/jslib/21.2.5/js/vectormap-data/europe.js"></script>
    <script src="https://cdn3.devexpress.com/jslib/21.2.5/js/vectormap-data/usa.js"></script>
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/js/data.js"></script>
</head>
<body class="dx-viewport">
    <header>
        <h1><?= esc($title) ?></h1>
    </header>
    <div class="demo-container">
        <div class="intrusion-visit-summ">
            <div class="intrusion-visit-num">
                <div id="enter-num" onclick="firstButtonSelected()">
                    <div class="intr">
                        <p id="intrusion">공격</p>
                        <p id="intrusion-number">2,661</p>
                    </div>
                    <div id="divider"></div>
                    <div class="vist">
                        <p id="visit">방문</p>
                        <p id="visit-number">5,807,445</p>
                    </div>
                </div>
                <div id="visitor-num" onclick="secondButtonSelected()">
                    <div class="intr">
                        <p id="intrusion">해커</p>
                        <p id="intrusion-number">387</p>
                    </div>
                    <div id="divider"></div>
                    <div class="vist">
                        <p id="visit">방문자</p>
                        <p id="visit-number">51,950</p>
                    </div>
                </div>
            </div>
            <div class="intrusion-visit-chart"></div>
        </div>
        <div class="intrusion-detail">
            <div class="intrusion-curr-status">
                <div class="intrusion-curr-map"></div>
                <div class="intrusion-curr-address">
                    <div id="button-group">
                        <div id="ip-button"></div>
                        <div id="nation-button"></div>
                    </div>
                    <table id="content-table">
                        <tbody id="address-table"></tbody>
                    </table>
                </div>
            </div>
            <div class="intrusion-info">
                <div class="type">
                    <p>공격 유형</p>
                    <div class="content">
                        <div class="pi-chart" id="type-chart"></div>
                        <div class="table-container">
                            <table class="pi-table" >
                                <tbody id="type-chart-table"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="url">
                    <p>공격 URL</p>
                    <div class="content">
                        <div class="pi-chart" id="url-chart"></div>
                        <div class="table-container">
                            <table class="pi-table">
                                <tbody id="url-chart-table"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        $(() => {
            $.ajax({ //공격 유형 파이 차트 & 테이블
                url: '<?php echo site_url('/intrusionTypeData')?>',
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    buildTypeChart(response);
                    buildTypeTable(response);
                },
                error: function (response) {
                    console.log(response);
                }
            });
            $.ajax({ //공격 URL 파이 차트 & 테이블
                url: '<?php echo site_url('/intrusionUrlData')?>',
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    buildUrlChart(response);
                    buildUrlTable(response);
                },
                error: function (response) {
                    console.log(response);
                }
            });
            $.ajax({ //주소 테이블 + 지도
                url: '<?php echo site_url('/intrusionAddressData')?>',
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    buildIpTable(response.data);
                    buildMarkerMap(response.markers);
                    $("#ip-button").dxButton({
                        text: "IP 주소",
                        onClick: function() {
                            buildIpTable(response.data);
                            buildMarkerMap(response.markers);
                        },
                    });
                    $("#nation-button").dxButton({
                        text: "국가",
                        onClick: function(){
                            buildNationTable(response.data);
                            buildAreaMap(response.countries);
                        }
                    });
                },
                error: function (response) {
                    console.log(response);
                }
            });
            $.ajax({ // 방문 & 방문자 요약 차트
                url: '<?php echo site_url('/intrusionSummaryData')?>',
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    buildVisitSummaryChart(response);
                    document.getElementById("enter-num").onclick = ()=> {firstButtonSelected(response);};
                    document.getElementById("visitor-num").onclick = ()=> {secondButtonSelected(response);};
                },
                error: function (response) {
                    console.log(response);
                }
            });

        });
    </script>

</body>
</html>