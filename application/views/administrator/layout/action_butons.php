<?php
$url = $this->uri->segment_array();
$count = count($url);

if ($count == 2) {
    
    switch ($this->header['page_name']) {
        case 'test':

            break;

        default:
            $hrefUrl = base_url(BACKENDFOLDER . '/' . segment(2) . '/create');
            $activeStatusUrl = base_url(BACKENDFOLDER . '/' . segment(2) . '/status/InActive');
            $inactiveStatusUrl = base_url(BACKENDFOLDER . '/' . segment(2) . '/status/Active');
            $deleteUrl = base_url(BACKENDFOLDER . '/' . segment(2) . '/delete');
            $backUrl = '';
            break;
    }
    if ($show_add_link) {
        $roleId = get_userdata('role_id');
        

        if ($activeModulePermission['add']) {
            if (get_userdata('role_type') != 'reviewer') {
                ?>
                <?php if ($this->header['page_name'] != 'form_data') { ?>
                    <a href="<?php echo $hrefUrl ?>" class="btn btn-success btn-xs">
                        <i class="fa fa-plus fa-fw"></i>
                    </a>
                <?php
                } else {
                    if ($url[3] == '2') {
                        ?>
                        <a href="<?php echo $hrefUrl ?>" class="btn btn-success btn-xs">
                            <i class="fa fa-plus fa-fw"></i>
                        </a>
                        <?php
                    }
                }
            }
        }
    }
    if ($activeModulePermission['delete']) {
        ?>
        <?php
        $exception_uri = ['role', 'module', 'rolemodule', 'configuration','dashboard',  'media', 'auditlog', 'activitylog','contact','enquiry','booking'];
        if (!in_array($this->header['page_name'], $exception_uri) && get_userdata('role_id') != 3 && get_userdata('role_type') != 'editor') {
            ?>
            <a href="javascript:void(0);" rel="<?php echo $activeStatusUrl ?>" class="btn btn-success btn-xs"
               id="activeIcon">
                <i class="fa fa-circle fa-fw"></i> Active
            </a>
            <a href="javascript:void(0);" rel="<?php echo $inactiveStatusUrl ?>" class="btn btn-danger btn-xs"
               id="inactiveIcon">
                <i class="fa fa-circle-o fa-fw"></i> Inactive
            </a>
        <?php } ?>
    <?php } ?>

    <?php if ($activeModulePermission['delete']) {
        $exception_uri = ['role', 'module', 'rolemodule', 'configuration',  'dashboard',  'media', 'auditlog', 'activitylog','contact','enquiry','booking'];
        ?>
        <?php if (!in_array($this->header['page_name'], $exception_uri) && get_userdata('role_type') != 'editor') { ?>
            <a href="javascript:void(0);" rel="<?php echo $deleteUrl ?>" class="btn btn-danger btn-xs"
               id="deleteIcon">
                <i class="fa fa-trash fa-fw"></i>
            </a>
        <?php } ?>
    <?php } ?>

    
    <?php if (!empty($backUrl)) { ?>
        <a href="<?php echo $backUrl ?>" class="btn btn-success btn-xs">
            <i class="fa fa-backward fa-fw"></i>
        </a>
    <?php } ?>
<?php } ?>
<?php if (isset($this->header['page_name']) && $this->header['page_name'] == 'role') { ?>
    <a title="Permission" href="<?php echo base_url(BACKENDFOLDER . '/rolemodule/') ?>" class="btn btn-primary btn-xs permissionIcon">
        <i class="fa fa-user-plus fa-fw"></i>
    </a>
<?php } ?>
