<form action="" method="post" id="gridForm" autocomplete="off">
    <table class="table table-bordered table-hover list-datatable">
        <tfoot id="table-search-row">
            <tr>
                <th></th>
                <th></th>
                <th>Category</th>
                <th>Category Type</th>
                <th></th>
            </tr>
        </tfoot>
        <thead>
            <tr>
                <th>SN</th>
                <th><input type="checkbox" name="selectAll" value="selectAll" class="selectAll" /></th>
                <th>Category</th>
                <th>Category Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($categories) : $serial_number = 1; ?>
                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td><?php
                            echo $serial_number;
                            $serial_number++;
                            ?></td>
                        <td><input type="checkbox" name="selected[]" value="<?php echo $category->id; ?>" class="rowCheckBox" /></td>
                        <td><?php echo $category->name ?></td>
                        <td><?php echo $category->categoryType ?></td>
                        <td>
                            <?php
                            $this->data['actionBtnData'] = [
                                'module' => 'category',
                                'moduleData' => $category,
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