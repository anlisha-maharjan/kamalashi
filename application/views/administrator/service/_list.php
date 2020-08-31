<form action="" method="post" id="gridForm" autocomplete="off">

    <table class="table table-bordered table-hover list-datatable">
        <tfoot id="table-search-row">
            <tr>
                <th></th>
                <th></th>
                <th>Service</th>
                <th>Image</th>
                <th></th>
            </tr>
        </tfoot>
        <thead>
            <tr>
                <th>SN</th>
                <th><input type="checkbox" name="selectAll" value="selectAll" class="selectAll"/></th>
                <th>Service</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($services) : $serial_number = 1; ?>
                <?php foreach ($services as $service) : ?>
                    <tr>
                        <td><?php echo $serial_number;
            $serial_number++;
                    ?></td>
                        <td><input type="checkbox" name="selected[]" value="<?php echo $service->id; ?>"
                                   class="rowCheckBox"/></td>
                        <td><?php echo $service->name ?></td>
                        <td>
                            <?php if (file_exists($service->image)) { ?>
                                <img src="<?php echo image_thumb($service->image, 100, 100, '', true) ?>"/>
        <?php } ?>
                        </td>
                        <td>
                            <?php
                            $this->data['actionBtnData'] = [
                                'module' => 'service',
                                'moduleData' => $service,
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
                    <td>No Data</td>
                </tr>
<?php endif; ?>
        </tbody>
    </table>
</form>