
//section 1: 방문자 요약 차트
const buildVisitSummaryChart = function(data){
    $('.intrusion-visit-chart').dxChart({
        palette: 'Harmony Light',
        dataSource: data,
        commonSeriesSettings: {
            type: 'area',
            argumentField: 'date',
        },
        series: [
            { valueField: 'visit', name: 'number of visits', axis: 'visitAxis' },
            { valueField: 'attack', name: 'number of attacks', axis: 'intrusionAxis' },

        ],
        margin: {
            bottom: 20,
        },
        argumentAxis: {
            valueMarginsEnabled: false,
        },
        valueAxis: [{
            name: 'visitAxis',
            position: 'right',
            title: '방문',
        },{
            name: 'intrusionAxis',
            title: '공격',
        }, ],
        legend: {
            visible: false,
        },
        tooltip: {
            enabled: true,
            customizeTooltip(arg){
                return{
                    text: `${arg.valueText}<br/>[${arg.argumentText}] `
                }
            }
        }
    });
};
const firstButtonSelected = function(data){
    document.getElementById("enter-num").style.borderWidth = "1px 0px 0px 1px";
    document.getElementById("enter-num").style.backgroundColor = "#FFFFFF";
    document.getElementById("visitor-num").style.borderWidth = "1px 1px 1px 1px";
    document.getElementById("visitor-num").style.backgroundColor = "#999999";
    buildVisitSummaryChart(data);

}
const buildVisitorSummaryChart = function(data){
    $('.intrusion-visit-chart').dxChart({
        palette: 'Harmony Light',
        dataSource: data,
        commonSeriesSettings: {
            type: 'area',
            argumentField: 'date',
        },
        series: [
            { valueField: 'visitor', name: 'number of visitors', axis: 'visitorAxis' },
            { valueField: 'attacker', name: 'number of attackers', axis: 'attackerAxis' },

        ],
        margin: {
            bottom: 20,
        },
        argumentAxis: {
            valueMarginsEnabled: false,
        },
        valueAxis: [{
            name: 'visitorAxis',
            position: 'right',
            title: '방문자',
        },{
            name: 'attackerAxis',
            title: '해커',
        }, ],
        legend: {
            visible: false,
        },
        tooltip: {
            enabled: true,
            customizeTooltip(arg){
                return{
                    text: `${arg.valueText}<br/>[${arg.argumentText}] `
                }
            }
        }
    });
};
const secondButtonSelected = function(data) {
    document.getElementById("enter-num").style.borderWidth = "1px 1px 1px 1px";
    document.getElementById("enter-num").style.backgroundColor = "#999999"
    document.getElementById("visitor-num").style.borderWidth = "0px 0px 1px 1px";
    document.getElementById("visitor-num").style.backgroundColor = "#FFFFFF";
    buildVisitorSummaryChart(data);

};

//section 2: 주소 지도/테이블
const buildMarkerMap = function(data){
    $('.intrusion-curr-map').dxVectorMap({
        layers: [{
            dataSource: DevExpress.viz.map.sources.world,
            hoverEnabled: false,
        }, {
            name: 'bubbles',
            dataSource: data,
            elementType: 'bubble',
            dataField: 'value',
            minSize: 20,
            maxSize: 40,
            sizeGroups: [0, 8000, 10000, 50000],
            opacity: 0.8,
        }],
        tooltip: {
            enabled: true,
            customizeTooltip(arg) {
                if (arg.layer.type === 'marker') {
                    return {text: arg.attribute('tooltip')};
                }
                return null;
            },
        },
        legends: [{
            source: {layer: 'bubbles', grouping: 'size'},
            markerShape: 'circle',
            customizeText(arg) {
                return ['< 8000K', '8000K to 10000K', '> 10000K'][arg.index];
            },
            customizeItems(items) {
                return items.reverse();
            },
        }],
        bounds: [-180, 85, 180, -60],
    });
};
const buildAreaMap = function(data){
    $('.intrusion-curr-map').dxVectorMap({
        bounds: [-180, 85, 180, -60],
        tooltip: {
            enabled: true,
            border: {
                visible: false,
            },
            font: { color: '#fff' },
            customizeTooltip(arg) {
                const name = arg.attribute('name');
                const country = data[name];
                if (country) {
                    return { text: `${name}: ${country.totalArea}M km&#178`, color: country.color };
                }
                return null;
            },
        },
        layers: {
            dataSource: DevExpress.viz.map.sources.world,
            customize(elements) {
                $.each(elements, (_, element) => {
                    const country = data[element.attribute('name')];
                    if (country) {
                        element.applySettings({
                            color: country.color,
                            hoveredColor: '#e0e000',
                            selectedColor: '#008f00',
                        });
                    }
                });
            },
        },
    });
};
const buildIpTable = function(data){
    var t = document.getElementById("address-table");
    t.innerHTML = null;
    for (var i = 0; i < data.length; i++){
        var row =  `<tr class=\'main-row\'>
            <td colspan="1">${data[i].index}</td>
            <td colspan="5">${data[i].IP}<button id="nation-label" >${data[i].nation}</button></td>
            <td id="block-cell" class="cell" colspan="2" style="text-align: end;"><button id="block-button" >${data[i].intrusions}</button></td>
            </tr>`;
        t.innerHTML += row;

    }
    $("td#block-cell").hover(function(){
        $(this).addClass("cell");
        $(this)[0].onclick = function(){
            $(this)[0].innerHTML = "<button id=\"yes-button\" >YES</button><button id=\"no-button\">NO</button>";
        }
        console.log($(this));
    }, function(){
        $(this).removeClass("cell");
    });
    console.log(t);


};
const buildNationTable = function(data){
    var t = document.getElementById("address-table");
    t.innerHTML = null;
    for (var i = 0; i < data.length; i++){
        var row =  `<tr class=\'main-row\'>
            <td colspan="1">${data[i].index}</td>
            <td colspan="5">${data[i].nation}</td>
            <td id="attack-cell" class="cell" colspan="2" style="text-align: end;"><button id="attack-button" >${data[i].intrusions}</button></td>
            </tr>`;
        t.innerHTML += row;

    }
    console.log(t);


};

//section 3: 공격 유형 차트/테이블
const buildUrlTable = function(data) {
    var t = document.getElementById("url-chart-table");
    console.log(data);
    for (var i = 0; i < data.length; i++){
        var urlPie = $("#url-chart").dxPieChart("instance");
        var Point = urlPie.series[0].pointsByArgument[data[i].url][0];
        var colorString = Point.graphic._settings.fill;
        var row =  `<tr class="tb-row">
                    <td ><div id="color-palette" style=" height: 15px; width: 15px;background-color: ` + colorString + `;"></div></td>
                    <td id="${data[i].url}">${data[i].url} (${data[i].number})</td>
                    </tr>`;
        t.innerHTML += row;

    }
    $("tr").hover(function(){
        $(this).addClass("tb-row");
    }, function(){
        $(this).removeClass("tb-row");
    });
    $('#url-chart-table .tb-row').hover(function() {
        var urlPie = $("#url-chart").dxPieChart("instance");
        var Point = urlPie.series[0].pointsByArgument[$(this)[0].children[1].id][0];
        !Point.isHovered() ? Point.hover() : Point.clearHover();
        Point.showTooltip();
    }, function() {
        var urlPie = $("#url-chart").dxPieChart("instance");
        var Point = urlPie.series[0].pointsByArgument[$(this)[0].children[1].id][0];
        !Point.isHovered() ? Point.hover() : Point.clearHover();
        Point.showTooltip();
    });
    console.log(t);
};
const buildTypeTable = function(data){
    var t = document.getElementById("type-chart-table");
    console.log(data);
    for (var i = 0; i < data.length; i++){
        var urlPie = $("#type-chart").dxPieChart("instance");
        var Point = urlPie.series[0].pointsByArgument[data[i].type][0];
        var colorString = Point.graphic._settings.fill;
        var row =  `<tr class="tb-row" style="height: 50px;">
                    <td ><div id="color-palette" style=" height: 15px; width: 15px;background-color: ` + colorString + `;"></div></td>
                    <td id="${data[i].type}">${data[i].type} (${data[i].number})</td>
                    <td><div id="tooltip-label" data-toggle="tooltip" data-placement="top" title=${data[i].exp} style="height: 15px; width: 15px;background-color: ` + colorString + `;"></div></td>
                    </tr>`;
        t.innerHTML += row;

    }
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    $("tr").hover(function(){
        $(this).addClass("tb-row");
    }, function(){
        $(this).removeClass("tb-row");
    });
    $('#type-chart-table .tb-row').hover(function() {
        var typePie = $("#type-chart").dxPieChart("instance");
        var Point = typePie.series[0].pointsByArgument[$(this)[0].children[1].id][0];
        !Point.isHovered() ? Point.hover() : Point.clearHover();
        Point.showTooltip();
    }, function() {
        var typePie = $("#type-chart").dxPieChart("instance");
        var Point = typePie.series[0].pointsByArgument[$(this)[0].children[1].id][0];
        !Point.isHovered() ? Point.hover() : Point.clearHover();
        Point.showTooltip();
    });


}
const buildUrlChart = function(data){
    $('#url-chart').dxPieChart({
        palette: 'bright',
        dataSource: data,
        legend: {
            visible: false,
        },
        series: [{
            argumentField: 'url',
            valueField: 'number',
        }],
        tooltip: {
            enabled: true,
            customizeTooltip(arg) {
                return {text: `${arg.argumentText} (${arg.originalValue})`};
            },
        },
    });
};
const buildTypeChart = function(data){
    $('#type-chart').dxPieChart({
        palette: 'bright',
        dataSource: data,
        legend: {
            visible: false,
        },
        series: [{
            argumentField: 'type',
            valueField: 'number',
        }],
        tooltip: {
            enabled: true,
            customizeTooltip(arg) {
                return {text: `${arg.argumentText} (${arg.originalValue})`};
            },
        },
    });
};


