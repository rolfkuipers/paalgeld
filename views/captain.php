<div class="container">
    
      <div class="content">
     <h2>Overview for <?php echo $captain_name; ?></h2>
     <a href="index.php" class="btn btn-default">Terug</a>
     <hr/>
        <?php
        echo '<table class="table table-bordered table-striped">';
        echo '<tr>';
        echo '<th>Date</th>';
        echo '<th>Name</th>';
        echo '<th>Ship</th>';      
        echo '<th>Port</th>';
        echo '<th>Tax</th>';
        echo '</tr>';
        foreach ($data as $entry) {
            echo '<tr>';
            echo '<td>'.$entry['day'].'-'.$entry['month'].'-'.$entry['year'].'</td>';
            echo '<td>'.$entry['captain fam name'].', '.$entry['captain first names'].'</td>';
            echo '<td>'.$entry['shipname'].'</td>';
             echo '<td>'.$entry['port of origin'].' ('.$entry['Modern Country'].')</td>';
            echo '<td>'.$entry['tax-decimal'].'</td>';
            echo '</tr>';
        }
        echo '</table>'
        ?>


        </div>

    </div><!-- /.container -->