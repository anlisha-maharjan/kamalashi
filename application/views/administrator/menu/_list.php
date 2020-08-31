<form action="" method="post" id="gridForm" autocomplete="off">

    <table class="table table-bordered table-hover list-datatable">
        <tfoot id="table-search-row">
            <tr>
                <th></th>
                <th></th>
                <th>Menu Title</th>
                <th>Menu Type</th>
                <th>Link Type</th>
                <th></th>
            </tr>
        </tfoot>
        <thead>
            <tr>
                <th>SN</th>
                <th><input type="checkbox" name="selectAll" value="selectAll" class="selectAll" /></th>
                <th>Menu Title</th>
                <th>Menu Type</th>
                <th>Link Type</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php if ($menus) : $serial_number = 1; ?>
                <?php foreach ($menus as $menu) : ?>
                    <tr>
                        <td><?php
                            echo $serial_number;
                            $serial_number++;
                            ?></td>
                        <td><input type="checkbox" name="selected[]" value="<?php echo $menu['id']; ?>" class="rowCheckBox" /></td>
                        <td><?php echo $menu['menu_title']; ?></td>
                        <td><?php echo $menu['menu_type']; ?></td>
                        <td><?php echo $menu['menu_link_type']; ?></td>
                        <td>
                            <?php
                            $this->data['actionBtnData'] = [
                                'module' => 'menu',
                                'moduleData' => (object) $menu,
                                'options' => 'EDS'
                            ];
                            $ci = &get_instance();
                            $ci->partialRender(BACKENDFOLDER . '/include/actionButton');
                            ?>
                        </td>
                    </tr>
                    <?php foreach ($menu['childList'] as $menuchild) : ?>
                        <tr>
                            <td><?php
                                echo $serial_number;
                                $serial_number++;
                                ?></td>
                            <td><input type="checkbox" name="selected[]" value="<?php echo $menuchild['id']; ?>" class="rowCheckBox" /></td>
                            <td><?php echo '--- ' . $menuchild['menu_title']; ?></td>
                            <td><?php echo $menuchild['menu_type']; ?></td>
                            <td><?php echo $menuchild['menu_link_type']; ?></td>
                            <td>
                                <?php
                                $this->data['actionBtnData'] = [
                                    'module' => 'menu',
                                    'moduleData' => (object) $menuchild,
                                    'options' => 'EDS'
                                ];
                                $ci = &get_instance();
                                $ci->partialRender(BACKENDFOLDER . '/include/actionButton');
                                ?>
                            </td>
                        </tr>

                        <?php foreach ($menuchild['childList'] as $menugrandchild) : ?>
                            <tr>
                                <td><?php
                                    echo $serial_number;
                                    $serial_number++;
                                    ?></td>
                                <td><input type="checkbox" name="selected[]" value="<?php echo $menugrandchild['id']; ?>" class="rowCheckBox" /></td>
                                <td><?php echo '------ ' . $menugrandchild['menu_title']; ?></td>
                                <td><?php echo $menugrandchild['menu_type']; ?></td>
                                <td><?php echo $menugrandchild['menu_link_type']; ?></td>
                                <td>
                                    <?php
                                    $this->data['actionBtnData'] = [
                                        'module' => 'menu',
                                        'moduleData' => (object) $menugrandchild,
                                        'options' => 'EDS'
                                    ];
                                    $ci = &get_instance();
                                    $ci->partialRender(BACKENDFOLDER . '/include/actionButton');
                                    ?>
                                </td>
                            </tr>
                            <?php foreach ($menugrandchild['childList'] as $menugrandsecondchild) : ?>
                                <tr>
                                    <td><?php
                                        echo $serial_number;
                                        $serial_number++;
                                        ?></td>
                                    <td><input type="checkbox" name="selected[]" value="<?php echo $menugrandsecondchild['id']; ?>" class="rowCheckBox" /></td>
                                    <td><?php echo '--------- ' . $menugrandsecondchild['menu_title']; ?></td>
                                    <td><?php echo $menugrandsecondchild['menu_type']; ?></td>
                                    <td><?php echo $menugrandsecondchild['menu_link_type']; ?></td>
                                    <td>
                                        <?php
                                        $this->data['actionBtnData'] = [
                                            'module' => 'menu',
                                            'moduleData' => (object) $menugrandsecondchild,
                                            'options' => 'EDS'
                                        ];
                                        $ci = &get_instance();
                                        $ci->partialRender(BACKENDFOLDER . '/include/actionButton');
                                        ?>
                                    </td>
                                </tr>

                                <?php foreach ($menugrandsecondchild['childList'] as $menugrandthirdchild) : ?>
                                    <tr>
                                        <td><?php
                                            echo $serial_number;
                                            $serial_number++;
                                            ?></td>
                                        <td><input type="checkbox" name="selected[]" value="<?php echo $menugrandthirdchild['id']; ?>" class="rowCheckBox" /></td>
                                        <td><?php echo '--------- ' . $menugrandthirdchild['menu_title']; ?></td>
                                        <td><?php echo $menugrandthirdchild['menu_type']; ?></td>
                                        <td><?php echo $menugrandthirdchild['menu_link_type']; ?></td>
                                        <td>
                                            <?php
                                            $this->data['actionBtnData'] = [
                                                'module' => 'menu',
                                                'moduleData' => (object) $menugrandthirdchild,
                                                'options' => 'EDS'
                                            ];
                                            $ci = &get_instance();
                                            $ci->partialRender(BACKENDFOLDER . '/include/actionButton');
                                            ?>
                                        </td>
                                    </tr>

                                <?php endforeach ?>

                            <?php endforeach ?>
                        <?php endforeach ?>

                    <?php endforeach ?>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td>No Data</td>
                    <td>No Data</td>
                    <td>No Data</td>
                    <td></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</form>
