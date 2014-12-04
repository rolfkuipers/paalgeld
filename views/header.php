<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paalgeld West-indië</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/paalgeld.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">
      
   
      
   
     <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages': ['geochart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
      
    function drawChart() {
      var jsonData = $.ajax({
          url: "index.php?page=charts&type=country",
          dataType:"json",
          async: false
          }).responseText;
      var options = {
        region: 'US',
        width: 1100, 
        height: 440 ,
         displayMode: 'markers',
        colorAxis: {colors: ['green', 'blue']}
      };
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
     var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }

    </script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
     <!-- Menu -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Navigatie aan/uit</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.html">Paalgeld West indie</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                 <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="index.php?page=captain"><span class="glyphicon glyphicon-user"></span> All captains</a></li>
            <li><a href="index.php?page=ship"><span class="glyphicon glyphicon-screenshot"></span> All ships</a></li>
            <li><a href="index.php?page=port"><span class="glyphicon glyphicon-screenshot"></span> All ports</a></li>
            <li><a href="index.php?page=country"><span class="glyphicon glyphicon-screenshot"></span> All countries</a></li>
                
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> Project<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a target="_blank" href="http://server.reinardvandalen.nl/paalgeldeuropa">Paalgeld Europa</a></li>
                    <li><a target="_blank" href="#">Paalgeld West-Indi&euml;</a></li>
                    <li><a target="_blank" href="index.html">Lastgeld</a></li>
                    <li class="divider"></li>
                    <li><a target="_blank" href="http://www.rug.nl/">Rijksuniversiteit Groningen</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    