<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Stok Kartı Tanımla
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('stockcard/save'); ?>" method="POST">
                    <div class="form-group">
                        <label>Stok Kartı Başlık</label>
                        <input class="form-control" placeholder="Stok Kartı Başlık" name="stockcard_title">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('stockcard_title'); ?></small>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-success btn-md"><b>Ekle</b></button>
                    <a href="<?php echo base_url('stockcard'); ?>" class="btn btn-md btn-danger"><b>İptal</b></a>
                </form>
            </div><!-- .widget-body -->
        </div>
    </div>
</div>