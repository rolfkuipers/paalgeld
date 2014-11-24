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
        echo '<th>Tax</th>';
        echo '</tr>';
        foreach ($data as $entry) {
            echo '<tr>';
            echo '<td>'.$entry['day'].'-'.$entry['month'].'-'.$entry['year'].'</td>';
            echo '<td><a href="index.php?page=captain&captain_name='.$entry['captain fam name'].'">'.$entry['captain fam name'].', '.$entry['captain first names'].'</a></td>';
            echo '<td><a href="index.php?page=ship&shipname='.$entry['shipname'].'">'.$entry['shipname'].'</a></td>';
            echo '<td>'.$entry['port of origin'].' ('.$entry['Modern Country'].')</td>';
            echo '<td>'.$entry['tax-decimal'].'</td>';
            echo '</tr>';
        }
        echo '</table>'
        ?>


        </div>

    </div><!-- /.container -->