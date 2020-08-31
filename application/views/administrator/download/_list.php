<form action="" method="post" id="gridForm" autocomplete="off">
    <table class="table table-bordered table-hover list-datatable">
        <tfoot id="table-search-row">
            <tr>
                <th></th>
                <th></th>
                <th>Name</th>
                <th></th>
            </tr>
        </tfoot>
        <thead>
            <tr>
                <th>SN</th>
                <th><input type="checkbox" name="selectAll" value="selectAll" class="selectAll" /></th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($downloads) : $serial_number = 1; ?>
                <?php foreach ($downloads as $download) : ?>
                    <tr>
                        <td><?php
                            echo $serial_number;
                            $serial_number++;
                            ?></td>
                        <td><input type="checkbox" name="selected[]" value="<?php echo $download->id; ?>" class="rowCheckBox" /></td>
                        <td><?php echo $download->name ?></td>
                        <td>
                            <?php
                            $this->data['actionBtnData'] = [
                                'module' => 'download',
                                'moduleData' => $download,
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