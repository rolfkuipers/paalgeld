<script>

//all javascript files



</script>
<div class="container">

  <div class="content">
   <h2>All captains</h2>
   <hr/>
   <?php

   echo '<table id="all_captains_table" class="table table-bordered table-striped">
   <thead>
   <tr>
   <th>First name</th>
   <th>Last name</th>
   <th># entries</th>
   <th>Value of goods</th>
   <th>More info</th>
   </tr>
   </thead>
   <tbody>';


   foreach ($data as $entry) {
     echo '<tr>
     <td>'.$entry['captain first names'].'</td>
     <td>'.$entry['captain fam name'].'</td>
     <td>'.$entry['nName'].'</td>
     <td>'.$entry['goods_value'].'</td>
     <td><a class="btn btn-default" href="index.php?page=captain&captain_name='.$entry['captain fam name'].'">More info</a></td>
     </tr>';


   }
   echo '</tbody>
   </table>';
   ?>



 </div>

    </div><!-- /.container -->