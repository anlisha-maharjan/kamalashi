<form action="" method="post" id="gridForm" autocomplete="off">
    <table class="table table-bordered table-hover list-datatable">
        
        <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <!--<th>Address</th>-->
            <!--<th>Contact No</th>-->
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($contacts) : $serial_number = 1; ?>
            <?php foreach ($contacts as $row) : ?>
                <tr>
                    <td><?php echo $serial_number; $serial_number++; ?></td>
                    <td><?php echo $row->name ?></td>
                    <!--<td><?php echo $row->address ?></td>-->
                    <!--<td><?php echo $row->phone ?></td>-->
                    <td><?php echo $row->email ?></td>
                    <td><?php echo $row->message ?></td>
                    <td><?php echo $row->date ?></td>
                    <td>
                        <?php
                        $this->data['actionBtnData'] = [
                            'module' => 'contact',
                            'moduleData' => $row,
                            'options' => 'D'
                        ];
                        $ci = &get_instance();
                        $ci->partialRender(BACKENDFOLDER.'/include/actionButton');
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
                <td>No Data</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</form>