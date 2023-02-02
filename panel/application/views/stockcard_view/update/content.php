<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<b>$item->stockcard_title</b> Kaydını Düzenliyorsunuz..."; ?>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("stockcard/update/$item->id"); ?>" method="POST">
                    <div class="form-group">
                        <label>Stok Kartı Başlık</label>
                        <input class="form-control" placeholder="Stok Kartı Başlık" name="stockcard_title" value="<?php echo $item->stockcard_title; ?>">
                        <?php if(isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('stockcard_title'); ?></small>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-success btn-md">Güncelle</button>
                    <a href="<?php echo base_url('stockcard'); ?>" class="btn btn-md btn-danger">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div>
    </div>
</div>