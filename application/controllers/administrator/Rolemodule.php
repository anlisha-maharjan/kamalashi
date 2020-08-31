<?php

class Rolemodule extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('rolemodule_model', 'rolemodule');
        $this->load->model('role_model', 'role');
        $this->load->model('module_model', 'module');
        $this->data['module_name'] = 'Role Module Manager';
        $this->template = BACKENDFOLDER.'/layout/role';
        $this->data['show_add_link'] = false;
        $this->header['page_name']	= $this->router->fetch_class();
    }

    public function index()
    {
        $this->data['roles'] = $this->role->get('', array('id !=' => 1));
        $this->data['modules'] = $this->module->get('', array('parent_id' => 0));
        $temp_saved_modules = false;
        $temp_saved_module_permissions = false;
        foreach($this->data['roles'] as $role) {
            $saved_modules = $this->rolemodule->get('', array('role_id' => $role->id));
            if($saved_modules) {
                foreach($saved_modules as $saved_module) {
                    $temp_saved_module_permissions[$role->id][$saved_module->module_id] = $saved_module->permission;
                    $temp_saved_modules[$role->id][] = $saved_module->module_id;
                }
            }
        }
        $this->data['saved_modules'] = $temp_saved_modules;
        $this->data['saved_module_permissions'] = $temp_saved_module_permissions;
        $child_modules = array();
        foreach($this->data['modules'] as $module) {
            $child_modules[$module->id] = $this->module->get('', array('parent_id' => $module->id));
        }
        $this->data['child_modules'] = $child_modules;
        $id = segment(4);
        if($_POST) {
            $post = $_POST;
            $role_id = $post['role_id'];
            $this->rolemodule->delete(array('role_id' => $role_id));
            foreach($post['modules'] as $module) {
                $viewPermission = (isset($post['view-'.$module])) ? '1' : '0';
                $addPermission = (isset($post['add-'.$module])) ? '1' : '0';
                $editPermission = (isset($post['edit-'.$module])) ? '1' : '0';
                $deletePermission = (isset($post['delete-'.$module])) ? '1' : '0';
                $permissionString = $viewPermission . $addPermission . $editPermission . $deletePermission;
                $insert_data = array(
                    'role_id' => $role_id,
                    'module_id' => $module,
                    'permission' => $permissionString
                );
                $this->rolemodule->save($insert_data);
            }
            $response = '<div class="alert alert-info alert-dismissable fade in">';
            $response .= '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
            $response .= 'Data saved';
            $response .= '</div>';
            echo json_encode(array('message' => $response, 'role_id' => $role_id));
        } else {
            $this->form($id, 'rolemodule');
        }
    }

    public function delete()
    {
        $id = segment(4);
        $res = $this->rolemodule->delete(array('id' => $id));

        $res ? set_flash('msg', 'Data deleted') : set_flash('msg', 'Data could not be deleted');

        redirect(BACKENDFOLDER.'/rolemodule');
    }

}