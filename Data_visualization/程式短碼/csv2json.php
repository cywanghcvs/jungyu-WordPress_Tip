add_shortcode( 'csv2json', function () {

	?>
<script>

	$.get("./data/002.csv", function (data) {

                var data = JSON.parse(csvJSON(data));

                $(data).each(function (k, v) {
                    console.log(v);
                })

            })
//var csv is the CSV file with headers
function csvJSON(csv){

  var lines=csv.split("\n");

  var result = [];

  var headers=lines[0].split(",");

  for(var i=1;i<lines.length;i++){

	  var obj = {};
	  var currentline=lines[i].split(",");

	  for(var j=0;j<headers.length;j++){
		  obj[headers[j]] = currentline[j];
	  }

	  result.push(obj);

  }
  
  //return result; //JavaScript object
  return JSON.stringify(result); //JSON
}

</script>
<?php
} );