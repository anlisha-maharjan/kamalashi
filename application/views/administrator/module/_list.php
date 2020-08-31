<form action="" method="post" id="gridForm" autocomplete="off">
    <table class="table table-bordered table-hover list-datatable">
        <tfoot id="table-search-row">
            <tr>
                <th></th>
                <th>Module Name</th>
                <th></th>
            </tr>
        </tfoot>
        <thead>
            <tr>
                <th>SN</th>
                <th>Module Name</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php if ($modules) : $serial_number = 1; ?>
                <?php foreach ($modules as $module) : ?>
                    <tr>
                        <td><?php echo $serial_number;
            $serial_number++; ?></td>
                        <td><?php echo $module->name ?></td>
                        <td>
                            <?php
                            $this->data['actionBtnData'] = [
                                'module' => 'module',
                                'moduleData' => $module,
                                'options' => 'ED'
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
                </tr>
<?php endif; ?>
        </tbody>
    </table>
</form>