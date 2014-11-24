<div class="container">

      <div class="content">
        <h1><?php echo $title; ?></h1>
        <?php
        echo '<table class="table">'
        foreach (array_keys($data) as $key) {
        	echo '<th>'.$key.'</th>';
        }
        foreach ($data as $value) {
        	echo '<td>'.$value.'</td>';
        }

        echo '</table>';
        ?>


        </div>

    </div><!-- /.container -->