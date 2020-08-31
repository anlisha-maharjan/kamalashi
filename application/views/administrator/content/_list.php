<form action="" method="post" id="gridForm" autocomplete="off">
    <table class="table table-bordered table-hover list-datatable">
        <tfoot id="table-search-row">
            <tr>
                <th></th>
                <th></th>
                <th>Title</th>
                <th></th>
            </tr>
        </tfoot>
        <thead>
            <tr>
                <th>SN</th>
                <th><input type="checkbox" name="selectAll" value="selectAll" class="selectAll" /></th>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($contents) : $serial_number = 1; ?>
                <?php foreach ($contents as $content) : ?>
                    <tr>
                        <td><?php
                            echo $serial_number;
                            $serial_number++;
                            ?></td>
                        <td><input type="checkbox" name="selected[]" value="<?php echo $content->id; ?>" class="rowCheckBox" /></td>
                        <td><?php echo $content->name ?></td>

                        <td>
                            <?php
                            $this->data['actionBtnData'] = [
                                'module' => 'content',
                                'moduleData' => $content,
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