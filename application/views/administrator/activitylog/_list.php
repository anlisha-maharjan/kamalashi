<form action="" method="post" id="gridForm" autocomplete="off">
    <table class="table table-bordered table-hover activity-log-datatable">
        <tfoot id="table-search-row">
        <tr>
            <th></th>
            <th>User</th>
            <th>Ip</th>
            <th>Url</th>
            <th>Time</th>
        </tr>
        </tfoot>
        <thead>
        <tr>
            <th>SN</th>
            <th>User</th>
            <th>Ip</th>
            <th>Url</th>
            <th>Time</th>
        </tr>
        </thead>
        <tbody>
        <?php /* if ($activity_log_data) : $serial_number = 1; ?>
            <?php foreach ($activity_log_data as $data) : ?>
                <tr>
                    <td><?php echo $serial_number;
                        $serial_number++; ?></td>
                    <td><?php echo $data->user_name ?></td>
                    <td><?php echo $data->ip?></td>
                    <td><?php echo $data->url?></td>
                    <td><?php echo date('Y/m/d    h:i:a',$data->created_on); ?> </td>
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
        <?php endif; */ ?>
        </tbody>
    </table>
</form>