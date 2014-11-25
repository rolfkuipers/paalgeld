<div class="container">
    
      <div class="content">
     <h2>Overview for <?php echo $captain_name; ?></h2>
     
     <hr/>
        <?php
        echo '<table class="table table-bordered table-striped">';
        echo '<tr>';
        echo '<th>Date</th>';
        echo '<th>Name</th>';
        echo '<th>Ship</th>';      
        echo '<th>Port</th>';
        echo '<th>Goods value</th>';
        echo '</tr>';
        foreach ($data as $entry) {
            echo '<tr>';
            echo '<td>'.$entry['day'].'-'.$entry['month'].'-'.$entry['year'].'</td>';
            echo '<td>'.$entry['captain fam name'].', '.$entry['captain first names'].'</td>';
            echo '<td><a href="index.php?page=ship&ship_name='.$entry['shipname'].'">'.$entry['shipname'].'</a></td>';
            echo '<td><a href="index.php?page=port&port_soundcode='.$entry['soundcode'].'">'.$entry['port_name'].'</a> ('.$entry['country_name'].')</td>';
             echo '<td>'.$entry['goods_value'].'</td>';
            echo '</tr>';
        }
        echo '</table>'
        ?>


        </div>

    </div><!-- /.container -->