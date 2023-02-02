<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Raf Ekle
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('shelves/save'); ?>" method="POST">
                    <div class="form-group">
                        <label>Raf Adı</label>
                        <input class="form-control" placeholder="Raf Adı" name="shelves_name">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('shelves_name'); ?></small>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-success btn-md"><b>Ekle</b></button>
                    <a href="<?php echo base_url('shelves'); ?>" class="btn btn-md btn-danger"><b>İptal</b></a>
                </form>
            </div><!-- .widget-body -->
        </div>
    </div>
</div>