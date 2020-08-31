<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo $modal_title ?></h4>
        </div>
        <div class="modal-body">
            <?php echo $modal_body ?>
        </div>
        <?php if(isset($modal_footer)) { ?>
            <div class="modal-footer">
                <?php echo $modal_footer; ?>
            </div>
        <?php } ?>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->