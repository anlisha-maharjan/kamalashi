<section>
    <div class="row">
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <label>Name</label>
                <label class="form-control"><?php echo $detail->firstname . " " . $detail->lastname; ?></label>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <label>Address</label>
                <label class="form-control"><?php echo $detail->address; ?></label>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <label>Contact</label>
                <label class="form-control"><?php echo $detail->phone; ?></label>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <label>Email</label>
                <label class="form-control"><?php echo $detail->email; ?></label>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <label>Country</label>
                <label class="form-control"><?php echo $controller->getCountryName($detail->country);?></label>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <label>Check In</label>
                <label class="form-control"><?php echo $detail->check_in; ?></label>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <label>Check Out</label>
                <label class="form-control"><?php echo $detail->check_out; ?></label>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <label>No of Adults</label>
                <label class="form-control"><?php echo $detail->adults; ?></label>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <label>No of children</label>
                <label class="form-control"><?php echo $detail->children; ?></label>
            </div>
        </div>

        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <label>Status</label>
                <label class="form-control"><?php echo $detail->status; ?></label>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <label>Additional Information</label>
                <label class="form-control"><?php echo $detail->additional_info; ?></label>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="form-group">
                <label>Booked Date</label>
                <label class="form-control"><?php echo $detail->booked_date; ?></label>
            </div>
        </div>
        
        <div class="col-sm-12 col-md-12">
		<h3 class="caption-subject font-dark bold uppercase">Rooms</h3>
			<div class="table-responsive">
				<?php
				$res = json_decode($detail->json_data);
				if (isset($res) && !empty($res)):
					?>
					<table class="table table-striped table-hover">
						<thead>
						<th>Room</th>
						<th>Quantity</th> 
						<th>Price</th>
						</thead>
						<tbody>
							<?php
							foreach ($res as $key => $val) :

								$accomodata = $this->accomodation->get('1', ['slug' => $key]);
								?>
								<tr>
									<td><?php echo $accomodata->name; ?></td>
									<td><?php echo $val; ?></td>
									<td class="price"><?php echo '$' . $val * $accomodata->price; ?></td>
								</tr>

							<?php endforeach; ?> 
						</tbody>
						<!-- <tfoot>
							<tr>
								<td>Sub Total</td>
								<td></td>						
								<td id="sub_total"></td>
								<td></td>
							</tr>
							<tr>
								<td>Tax(1%)</td>
								<td></td>
								<td id="grand_total"></td>
								<td></td>
							</tr>
						</tfoot> -->
					</table>
					
				<?php endif; ?>
			</div>
		</div>
		<div class="col-sm-12 col-md-12 invoice-block text-right">
			<ul class="list-unstyled amounts">
				<li>
					<strong>Sub - Total amount:</strong> <span id="sub_total"></span> </li>
				<li>
					<strong>Tax:</strong> 1% </li>
				<li>
					<strong>Grand Total:</strong> <span id="grand_total"></span> </li>
			</ul>
			<br>
			<a class="btn btn-lg blue margin-bottom-5" href="<?php echo base_url(BACKENDFOLDER . '/'. $this->header['page_name']) ?>"><span>Close</span></a>
		</div>   
    </div>
</section>


