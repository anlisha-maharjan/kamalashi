<form action="" method="post" id="gridForm" autocomplete="off">
    <table class="table table-bordered table-hover list-datatable">
        <tfoot id="table-search-row">
            <tr>
                <th></th>
                <th></th>
                <th>Banner Title</th>
                <th></th>
                <th></th>

            </tr>
        </tfoot>
        <thead>
            <tr>
                <th>SN</th>
                <th><input type="checkbox" name="selectAll" value="selectAll" class="selectAll" /></th>
                <th>Banner Title</th>
                <th>Image</th>
                <th></th>
        <tbody>
            <?php if ($banners) : $serial_number = 1; ?>
                <?php foreach ($banners as $banner) : ?>
                    <tr>
                        <td><?php
                            echo $serial_number;
                            $serial_number++;
                            ?></td>
                        <td><input type="checkbox" name="selected[]" value="<?php echo $banner->id; ?>" class="rowCheckBox" /></td>
                        <td><?php echo $banner->title ?></td>
                        <td><img src="<?php echo base_url($banner->image) ?>" width="100"/></td>
                        <td>
                            <?php
                            $this->data['actionBtnData'] = [
                                'module' => 'banner',
                                'moduleData' => $banner,
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