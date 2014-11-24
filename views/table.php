<div class="container">

	<div class="content">
		<h2>Draaitabel</h2>
		<form class="form-inline" role="form" method="post" action="index.php?page=table">
			<div class="form-group">
				<label for="data">Select data:</label>
				<select name="type" class="form-control">
					<option value="country">Countries</option>
					<option value="port">Ports</option>
				</select>
			</div>
			<div class="form-group">
				<label for="dateFrom">date from</label>
				<select name="date_from" class="form-control">
					<?php 
					foreach (range($org_date_from, $org_date_to) as $period) {
						echo '<option>'.$period.'</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="dateFrom">date to</label>
				<select name="date_to" class="form-control">
					<?php 
					
					foreach (range($date_from, $date_to) as $period) {
						if ($period == $date_to) {
							echo '<option selected="selected">'.$period.'</option>';
						} else {
							echo '<option>'.$period.'</option>';
						}
						
					}
					?>
				</select>
			</div>

			<div class="checkbox">
				<label>
					<input name="empty_years" checked="checked" value="true" type="checkbox"> *Hide empty years
				</label>
			</div>
			<button type="submit" class="btn btn-default">Load</button>
		</form>
		<hr/>
		<?php
		echo $date_from.' - '.$date_to;
		echo '<table class="table table-bordered table-striped">';
		echo '<th>Ports</th>';
    //list of all the years for table header
		foreach (range($date_from, $date_to) as $period) {
			echo '<th>'.$period.'</th>';
		}


		foreach ($data as $key => $values) {
			echo '<tr><td>'.$key.'</td>';
			foreach (range($date_from, $date_to) as $period) {
				//if this data row has data for this period display it or show 0
				if (isset($data[$key][$period])) {
					echo '<td>'.$data[$key][$period]['tax'].'<br />'.$data[$key][$period]['times'].'</td>';
				} else {
					echo '<td>0/0</td>';
				}
			}
			echo '</tr>'; //close row	
		}
		echo '</table>';

		?>

	</div>

    </div><!-- /.container -->