<div class="container">
    
      <div class="content">
     <h2>All captains</h2>
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
            echo '<li class="list-group-item"><span class="badge">'.$entry['nName'].'</span><a href="index.php?page=captain&captain_name='.$entry['captain fam name'].'">'.$entry['captain fam name'].'</a></li>';  
            $i++;
        }
        echo '</div></ul>';
        ?>

        </div>
        
 
    </div>
       


        </div>

    </div><!-- /.container -->