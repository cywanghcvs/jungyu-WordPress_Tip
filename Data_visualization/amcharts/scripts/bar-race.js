am4core.ready(function() {
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    var chart = am4core.create("bar-race", am4charts.XYChart);
    chart.padding(40, 40, 40, 40);

    chart.numberFormatter.bigNumberPrefixes = [
        { "number": 1e+3, "suffix": "K" },
        { "number": 1e+6, "suffix": "M" },
        { "number": 1e+9, "suffix": "B" }
    ];

    var label = chart.plotContainer.createChild(am4core.Label);
    label.x = am4core.percent(97);
    label.y = am4core.percent(95);
    label.horizontalCenter = "right";
    label.verticalCenter = "middle";
    label.dx = -15;
    label.fontSize = 50;

    var allData;
    var startYear = 2010;
    var currentYear = 2020;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open('GET', 'https://bilab.npust.edu.tw/wp-json/amcharts/v1/barchartrace/1', true);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 200) {
                allData = JSON.parse(xmlhttp.responseText);

                for (const [key, value] of Object.entries(allData)) {
                    if (startYear > key) statYearr = key;
                    if (currentYear < key) currentYear = key;
                };

                var playButton = chart.plotContainer.createChild(am4core.PlayButton);
                playButton.x = am4core.percent(97);
                playButton.y = am4core.percent(95);
                playButton.dy = -2;
                playButton.verticalCenter = "middle";
                playButton.events.on("toggled", function(event) {
                    if (event.target.isActive) {
                        play();
                    } else {
                        stop();
                    }
                })

                var stepDuration = 4000;

                var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
                categoryAxis.renderer.grid.template.location = 0;
                categoryAxis.dataFields.category = "keywords";
                categoryAxis.renderer.minGridDistance = 1;
                categoryAxis.renderer.inversed = true;
                categoryAxis.renderer.grid.template.disabled = true;

                var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
                valueAxis.min = 0;
                valueAxis.rangeChangeEasing = am4core.ease.linear;
                valueAxis.rangeChangeDuration = stepDuration;
                valueAxis.extraMax = 0.1;

                var series = chart.series.push(new am4charts.ColumnSeries());
                series.dataFields.categoryY = "keywords";
                series.dataFields.valueX = "count";
                series.tooltipText = "{valueX.value}"
                series.columns.template.strokeOpacity = 0;
                series.columns.template.column.cornerRadiusBottomRight = 5;
                series.columns.template.column.cornerRadiusTopRight = 5;
                series.interpolationDuration = stepDuration;
                series.interpolationEasing = am4core.ease.linear;

                var labelBullet = series.bullets.push(new am4charts.LabelBullet())
                labelBullet.label.horizontalCenter = "right";
                labelBullet.label.text = "{values.valueX.workingValue.formatNumber('#.0as')}";
                labelBullet.label.textAlign = "end";
                labelBullet.label.dx = -10;

                chart.zoomOutButton.disabled = true;

                // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
                series.columns.template.adapter.add("fill", function(fill, target) {
                    return chart.colors.getIndex(target.dataItem.index);
                });

                var year = startYear;
                label.text = year.toString();

                var interval;

                function play() {
                    interval = setInterval(function() {
                        nextYear();
                    }, stepDuration)
                    nextYear();
                }

                function stop() {
                    if (interval) {
                        clearInterval(interval);
                    }
                }

                function nextYear() {
                    year++

                    if (year > currentYear) {
                        year = startYear;
                    }

                    var newData = allData[year];
                    var itemsWithNonZero = 0;
                    for (var i = 0; i < chart.data.length; i++) {
                        chart.data[i].count = newData[i].count;
                        if (chart.data[i].count > 0) {
                            itemsWithNonZero++;
                        }
                    }

                    if (year == startYear) {
                        series.interpolationDuration = stepDuration / 4;
                        valueAxis.rangeChangeDuration = stepDuration / 4;
                    } else {
                        series.interpolationDuration = stepDuration;
                        valueAxis.rangeChangeDuration = stepDuration;
                    }

                    chart.invalidateRawData();
                    label.text = year.toString();

                    categoryAxis.zoom({ start: 0, end: itemsWithNonZero / categoryAxis.dataItems.length });
                }


                categoryAxis.sortBySeries = series;



                chart.data = JSON.parse(JSON.stringify(allData[year]));
                console.log(chart.data);
                categoryAxis.zoom({ start: 0, end: 1 / chart.data.length });

                series.events.on("inited", function() {
                    setTimeout(function() {
                        playButton.isActive = true; // this starts interval
                    }, 2000)
                })

            }
        }
    };
    xmlhttp.send(null);
}); // end am4core.ready()