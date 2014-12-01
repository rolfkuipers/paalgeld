<div class="container">

  <div class="content">
   <h2>All countries</h2>
   <hr/>
   <div class="row">
    <div class="col-md-4">
     <?php

     $n = count($data);
     $i = 0;
     $n_per_c = round($n / 3);
     echo '<ul class="list-group">';
     foreach ($data as $entry) {
      if ($i == $n_per_c) {
        $i = 0;
        echo '</ul></div><div class="col-md-4"><ul class="list-group">';
      }
      echo '<li class="list-group-item"><span class="badge">'.$entry['nName'].'</span><a href="index.php?page=country&country_name='.$entry['country_name'].'">'.$entry['country_name'].'</a></li>';  
      $i++;
    }
    echo '</div></ul>';
    ?>

  </div>


</div>
<!--Div that will hold the pie chart-->
<div id="chart_div"></div>


</div>

    </div><!-- /.container -->