//var csv is the CSV file with headers
function csvJSON(csv) {
    var lines = csv.split("\r\n");
    var result = [];
    var headers = lines[0].split(",");

    for (var i = 1; i < lines.length; i++) {
        var obj = {};
        var currentline = lines[i].split(",");
        for (var j = 0; j < headers.length; j++) {
            obj[headers[j]] = currentline[j];
        }
        result.push(obj);
    }
    //return result; //JavaScript object
    return JSON.stringify(result); //JSON
}

am4core.ready(function() {
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("disaster-pie", am4charts.PieChart);

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open('GET', 'https://raw.githubusercontent.com/jungyu/WordPress_Tip/master/Data_visualization/amcharts/data/disaster-landslide.csv', true);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 200) {
                csvData = JSON.parse(csvJSON(xmlhttp.responseText));
                console.log(csvData);
                // Add data
                chart.data = csvData;

                // Add and configure Series
                var pieSeries = chart.series.push(new am4charts.PieSeries());
                pieSeries.dataFields.value = "Quantity";
                pieSeries.dataFields.category = "Disaster";
                pieSeries.slices.template.stroke = am4core.color("#fff");
                pieSeries.slices.template.strokeOpacity = 1;

                // This creates initial animation
                pieSeries.hiddenState.properties.opacity = 1;
                pieSeries.hiddenState.properties.endAngle = -90;
                pieSeries.hiddenState.properties.startAngle = -90;

                chart.hiddenState.properties.radius = am4core.percent(0);
            }
        }
    };
    xmlhttp.send(null);
}); // end am4core.ready()