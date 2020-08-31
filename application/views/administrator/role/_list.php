<form action="" method="post" id="gridForm" autocomplete="off">
    <table class="table table-bordered table-hover list-datatable">
        <tfoot id="table-search-row">
        <tr>
            <th></th>
            <th></th>
            <th>Role</th>
            <th></th>
        </tr>
        </tfoot>
        <thead>
        <tr>
            <th>SN</th>
            <th><input type="checkbox" name="selectAll" value="selectAll" class="selectAll" /></th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($rows) : $serial_number = 1; ?>
            <?php foreach ($rows as $row) : ?>
                <?php if (get_userdata('role_id') == 1 ) { ?>
                    
                <tr>
                    <td><?php echo $serial_number; $serial_number++; ?></td>
                    <td><input type="checkbox" name="selected[]" value="<?php echo $row->id; ?>" class="rowCheckBox" /></td>
                    <td><?php echo $row->name ?></td>
                    <td>
                        <?php
                        $this->data['actionBtnData'] = [
                            'module' => 'role',
                            'moduleData' => $row,
                            'options' => 'E'
                        ];
                        $ci = &get_instance();
                        $ci->partialRender(BACKENDFOLDER.'/include/actionButton');
                        ?>
                    </td>
                </tr>
                 <?php } else{
                    if($row->id > 1){ ?>
 <tr>
                    <td><?php echo $serial_number; $serial_number++; ?></td>
                    <td><input type="checkbox" name="selected[]" value="<?php echo $row->id; ?>" class="rowCheckBox" /></td>
                    <td><?php echo $row->name ?></td>
                    <td>
                        <?php
                        $this->data['actionBtnData'] = [
                            'module' => 'role',
                            'moduleData' => $row,
                            'options' => 'E'
                        ];
                        $ci = &get_instance();
                        $ci->partialRender(BACKENDFOLDER.'/include/actionButton');
                        ?>
                    </td>
                </tr>
                   <?php }
                    }?>
            <?php endforeach ?>        <?php else : ?>
            <tr>
                <td>No Data</td>
                <td>No Data</td>
                <td>No Data</td>
                <td>No Data</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</form>