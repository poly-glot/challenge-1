<html>
<head>
	<title>SimpleUX Meetup Travel Plan</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<table cellpadding="0" cellspacing="0" class="table table-hover" width="100%">
					<thead>
					<tr>
						<th>Name</th>
						<th>Starting Balance</th>
						<th>Travel</th>
						<th>End Balance</th>
						<th>Note</th>
					</tr>
					</thead>
					<tbody>

					<?php foreach ($team_members_journey as $journey) :

						?>
						<tr>
							<td>
								<span class="name">
									<?php 
										/* TODO: Print Team Member Full Name */ 
										echo $journey->getPerson()->getFirstname() . ' ' . $journey->getPerson()->getLastname();
									?>
								</span>
                     		 	<div class="intro small">
									<?php 
										/* TODO: Print Operating System */
										echo $journey->getPerson()->getDevice()->getOS();
									?>,
									<?php 
										/* TODO: Print Residence */ 
										echo $journey->getPerson()->getResidence();
									?>
                      			</div>
							</td>
							<td><?php echo $journey->getStartingBalance(); ?></td>
							<td>
								<div class="small">
									<?php
										echo implode(', ', $journey->getPlannedJourney());
									?>
								</div>
							</td>
							<td>
								<?php 
									/* TODO: Print End Balance Here */ 
									echo $journey->getBalance(); 
								?>
							</td>
							<td>
								<?php
									$note = $journey->getNote();
									if(!empty($note)):
										printf('<span class="label label-danger">%s</span>', $note);
									endif;
								?>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</body>
</html>