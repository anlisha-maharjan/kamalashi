<form action="" method="post" id="gridForm" autocomplete="off">
    <table class="table table-bordered table-hover list-datatable">

        <thead>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Contact No</th>
                <th>Email</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($booking) : $serial_number = 1; ?>
                <?php foreach ($booking as $row) : ?>
                    <tr>
                        <td><?php
                            echo $serial_number;
                            $serial_number++;
                            ?></td>
                        <td><?php echo $row->firstname . " " . $row->lastname ?></td>
                        <td><?php echo $row->phone ?></td>
                        <td><?php echo $row->email ?></td>
                        <td><?php echo $row->booked_date ?></td>
                        <td>
                            <div class="form-group">
                                <input class="id" type="hidden" value="<?php echo $row->id ?>">
                                <select name="status" class="form-control status">
                                    <option>Select Status</option>
                                    <option value="Pending" <?php if ($row->status == 'Pending') {echo 'selected';} else {echo'';}?>>Pending</option>
                                    <option value="Approved" <?php if ($row->status == 'Approved') {echo 'selected';} else {echo'';}?>>Approved</option>
                                    <option value="Completed" <?php if ($row->status == 'Completed') {echo 'selected';} else {echo'';}?>>Completed</option>
                                </select>
                            </div> 
                        </td>
                        <td>
                             <a href="<?php echo base_url() . BACKENDFOLDER . "/booking/view/" . $row->id; ?>" class="btn btn-info">View</a>
                            <?php
                            $this->data['actionBtnData'] = [
                                'module' => 'booking',
                                'moduleData' => $row,
                                'options' => 'D'
                            ];
                            $ci = &get_instance();
                            $ci->partialRender(BACKENDFOLDER . '/include/actionButton');
                            ?>
                           
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td>No Data</td>
                    <td>No Data</td>
                    <td>No Data</td>
                    <td>No Data</td>
                    <td>No Data</td>
                    <td>No Data</td>
                    <td>No Data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</form>