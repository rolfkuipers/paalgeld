<div class="container">
    
      <div class="content">
     <h2>Overview all entries</h2>
        <?php
        echo '<table class="table table-bordered table-striped">';
        echo '<tr>';
        echo '<th>Date</th>';
        echo '<th>Name</th>';
        echo '<th>Shipname</th>';
        echo '<th>Port</th>';
        echo '<th>Goods value</th>';
        echo '</tr>';
        foreach ($data as $entry) {
            echo '<tr>';
            echo '<td>'.$entry['day'].'-'.$entry['month'].'-'.$entry['year'].'</td>';
            echo '<td><a href="index.php?page=captain&captain_name='.$entry['captain fam name'].'">'.$entry['captain fam name'].', '.$entry['captain first names'].'</a></td>';
            echo '<td><a href="index.php?page=ship&ship_name='.$entry['shipname'].'">'.$entry['shipname'].'</a></td>';
            echo '<td><a href="index.php?page=port&port_name='.$entry['port of origin'].'">'.$entry['port of origin'].'</a> ('.$entry['Modern Country'].')</td>';
            echo '<td>'.$entry['goods-value'].'</td>';
            echo '</tr>';
        }
        echo '</table>'
        ?>


        </div>

    </div><!-- /.container -->

    http://localhost:8888/paalgeld/index.php?page=ship&shipname=HARMONIE