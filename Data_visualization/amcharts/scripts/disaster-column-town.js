//var csv is the CSV file with headers
        function csvJSON(csv) {
            var lines = csv.split("\r\n");
            var result = [];
            var headers = lines[0].split(",");
          console.log(headers);

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

        am4core.ready(function () {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("disaster-column-town", am4charts.XYChart);
            chart.scrollbarX = new am4core.Scrollbar();

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open('GET', 'https://raw.githubusercontent.com/jungyu/WordPress_Tip/master/Data_visualization/amcharts/data/disaster-town.csv', true);
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        csvData = JSON.parse(csvJSON(xmlhttp.responseText));
                        console.log(csvData);

                        // Add data
                        chart.data = csvData;

                        // Create axes
                        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                        categoryAxis.dataFields.category = "Zone";
                        categoryAxis.renderer.grid.template.location = 0;
                        categoryAxis.renderer.minGridDistance = 30;
                        categoryAxis.renderer.labels.template.horizontalCenter = "right";
                        categoryAxis.renderer.labels.template.verticalCenter = "middle";
                        categoryAxis.renderer.labels.template.rotation = 270;
                        categoryAxis.tooltip.disabled = true;
                        categoryAxis.renderer.minHeight = 110;

                        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                        valueAxis.renderer.minWidth = 50;

                        // Create series
                        var series = chart.series.push(new am4charts.ColumnSeries());
                        series.sequencedInterpolation = true;
                        series.dataFields.valueY = "times";
                        series.dataFields.categoryX = "Zone";
                        series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
                        series.columns.template.strokeWidth = 0;

                        series.tooltip.pointerOrientation = "vertical";

                        series.columns.template.column.cornerRadiusTopLeft = 10;
                        series.columns.template.column.cornerRadiusTopRight = 10;
                        series.columns.template.column.fillOpacity = 0.8;

                        // on hover, make corner radiuses bigger
                        var hoverState = series.columns.template.column.states.create("hover");
                        hoverState.properties.cornerRadiusTopLeft = 0;
                        hoverState.properties.cornerRadiusTopRight = 0;
                        hoverState.properties.fillOpacity = 1;

                        series.columns.template.adapter.add("fill", function (fill, target) {
                            return chart.colors.getIndex(target.dataItem.index);
                        });

                        // Cursor
                        chart.cursor = new am4charts.XYCursor();

                    }
                }
            };
            xmlhttp.send(null);

        }); // end am4core.ready()
