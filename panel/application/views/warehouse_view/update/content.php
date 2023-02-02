<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<b>$item->warehouse_name</b> Kaydını Düzenliyorsunuz..."; ?>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("warehouse/update/$item->id"); ?>" method="POST">
                    <div class="form-group">
                        <label>Depo Adı</label>
                        <input class="form-control" placeholder="Depo Adı" name="warehouse_name" value="<?php echo $item->warehouse_name; ?>">
                        <?php if(isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('warehouse_name'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Şehir</label>
                        <input class="form-control" placeholder="Şehir" name="city" value="<?php echo $item->city; ?>">
                        <?php if(isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('city'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>İlçe</label>
                        <input class="form-control" placeholder="İlçe" name="district" value="<?php echo $item->district; ?>">
                        <?php if(isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('district'); ?></small>
                        <?php } ?>
                    </div>
                    
                    <button type="submit" class="btn btn-success btn-md">Güncelle</button>
                    <a href="<?php echo base_url('warehouse'); ?>" class="btn btn-md btn-danger">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div>
    </div>
</div>