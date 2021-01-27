/**
 * --------------------------------------------------------
 * This demo was created using amCharts V4 preview release.
 *
 * V4 is the latest installement in amCharts data viz
 * library family, to be released in the first half of
 * 2018.
 *
 * For more information and documentation visit:
 * https://www.amcharts.com/docs/v4/
 * --------------------------------------------------------
 */
am4core.useTheme(am4themes_animated);

var chart = am4core.create("chartdiv", am4maps.MapChart);

try {
    chart.geodata = am4geodata_worldLow;
} catch (e) {
    chart.raiseCriticalError({
        message: 'Map geodata could not be loaded. Please download the latest <a href="https://www.amcharts.com/download/download-v4/">amcharts geodata</a> and extract its contents into the same directory as your amCharts files.'
    });
}

chart.projection = new am4maps.projections.Mercator();

// zoomout on background click
chart.chartContainer.background.events.on("hit", function() {
    zoomOut();
});

var colorSet = new am4core.ColorSet();
var morphedPolygon;

// map polygon series (countries)
var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
polygonSeries.useGeodata = true;
// specify which countries to include
polygonSeries.exclude = [
    "AQ"
];

// country area look and behavior
var polygonTemplate = polygonSeries.mapPolygons.template;
polygonTemplate.strokeOpacity = 1;
polygonTemplate.stroke = am4core.color("#ffffff");
polygonTemplate.fillOpacity = 0.8;
polygonTemplate.tooltipText = "{name}";

// take a color from color set
polygonTemplate.adapter.add("fill", function(fill, target) {
    return colorSet.getIndex(target.dataItem.index + 1).saturate(0.2);
});

// set fillOpacity to 1 when hovered
var hoverState = polygonTemplate.states.create("hover");
hoverState.properties.fillOpacity = 1;

var slider = chart.chartContainer.createChild(am4core.Slider);
slider.start = 0.5;
slider.margin(0, 0, 20, 0);
slider.valign = "bottom";
slider.align = "center";
slider.width = 500;
slider.events.on("rangechanged", () => {
    chart.deltaLongitude = slider.start * 360 - 180;
})