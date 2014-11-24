<div class="container">
    
      <div class="content">
     <h2>All ports</h2>
     <hr/>
     <div class="row">
        <div class="col-md-3">
     <?php

        $n = count($data);
        $i = 0;
        $n_per_c = round($n / 4);
        echo '<ul class="list-group">';
        foreach ($data as $entry) {
            if ($i == $n_per_c) {
                $i = 0;
                echo '</ul></div><div class="col-md-3"><ul class="list-group">';
            }
            echo '<li class="list-group-item"><span class="badge">'.$entry['nName'].'</span><a href="index.php?page=port&port_name='.$entry['port of origin'].'">'.$entry['port of origin'].'</a></li>';  
            $i++;
        }
        echo '</div></ul>';
        ?>

        </div>
        
 
    </div>
       


        </div>

    </div><!-- /.container -->