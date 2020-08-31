<form action="" method="post" id="gridForm" autocomplete="off">
    <table class="table table-bordered table-hover list-datatable">
        <tfoot id="table-search-row">
        <tr>
            <th></th>
            <th></th>
            <th>Title</th>
            <!--<th>Category</th>-->
            <th></th>
        </tr>
        </tfoot>
        <thead>
        <tr>
            <th>SN</th>
            <th><input type="checkbox" name="selectAll" value="selectAll" class="selectAll" /></th>
            <th>Title</th>
           <!-- <th>Category</th>-->
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($events) : $serial_number = 1; ?>
            <?php foreach ($events as $event) : ?>
                <tr>
                    <td><?php echo $serial_number;
                        $serial_number++; ?></td>
                    <td><input type="checkbox" name="selected[]" value="<?php echo $event->id; ?>" class="rowCheckBox" /></td>
                    <td><?php echo $event->name ?></td>
                   <!-- <td><?php /*echo $event->category_name */?></td>-->
                    <td>
                        <?php
                        $this->data['actionBtnData'] = [
                            'module' => 'event',
                            'moduleData' => $event,
                            'options' => 'EDS'
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
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</form>