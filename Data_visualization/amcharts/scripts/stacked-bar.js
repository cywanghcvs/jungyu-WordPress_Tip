am4core.ready(function() {
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("stacked-bar", am4charts.XYChart);

    chart.dataSource.url = "https://bilab.npust.edu.tw/wp-json/amcharts/v1/stackedbar/1"

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "year";
    categoryAxis.renderer.grid.template.location = 0;


    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.inside = true;
    valueAxis.renderer.labels.template.disabled = true;
    valueAxis.min = 0;

    // Create series
    function createSeries(field, name) {

        // Set up series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.name = name;
        series.dataFields.valueY = field;
        series.dataFields.categoryX = "year";
        series.sequencedInterpolation = true;

        // Make it stacked
        series.stacked = true;

        // Configure columns
        series.columns.template.width = am4core.percent(60);
        series.columns.template.tooltipText = "[bold]{name}[/]\n[font-size:14px]{categoryX}: {valueY}";

        // Add label
        var labelBullet = series.bullets.push(new am4charts.LabelBullet());
        labelBullet.label.text = "{valueY}";
        labelBullet.locationY = 0.5;
        labelBullet.label.hideOversized = true;

        return series;
    }

    createSeries("動腦雜誌", "動腦雜誌");
    createSeries("天下", "天下");
    createSeries("數位時代", "數位時代");
    createSeries("經濟日報", "經濟日報");
    createSeries("聯合新聞網", "聯合新聞網");
    createSeries("遠見", "遠見");
    createSeries("電子商務時報", "電子商務時報");
    createSeries("風傳媒", "風傳媒");
    // Legend
    chart.legend = new am4charts.Legend();
}); // end am4core.ready()