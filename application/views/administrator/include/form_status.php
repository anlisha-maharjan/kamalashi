<?php if (get_userdata('role_id') != 3 && get_userdata('role_type') != 'editor') { ?>
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="Active" <?php echo $module_data->status == 'Active' || $module_data->status == '' ? 'selected' : '' ?>>
                Publish
            </option>
            <option value="InActive" <?php echo $module_data->status == 'InActive' ? 'selected' : '' ?>>UnPublish</option>
        </select>
    </div>
<?php } ?>