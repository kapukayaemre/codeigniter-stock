<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<b>$item->shelves_name</b> Kaydını Düzenliyorsunuz..."; ?>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("shelves/update/$item->id"); ?>" method="POST">

                    <div class="form-group">
                        <label>Raf Adı</label>
                        <input class="form-control" placeholder="Raf Adı" name="shelves_name" value="<?php echo $item->shelves_name; ?>">
                        <?php if(isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('shelves_name'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Ana Kategorisi</label><br>
                        <select class="form-control" data-plugin="select2" name="category_id">        
                            <?php foreach ($datas_warehouse as $data) { ?>
                                <?php if ($data->warehouse_id == $item->warehouse_id) { ?>
                                    <option selected value="<?php echo $data->warehouse_id; ?>"><?php echo $data->warehouse_name; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $data->warehouse_id; ?>"><?php echo $data->warehouse_name; ?></option>
                                <?php } ?>
                            <?php } ?>        
                        </select>
                    </div>     
                    
                    <button type="submit" class="btn btn-success btn-md">Güncelle</button>
                    <a href="<?php echo base_url('shelves'); ?>" class="btn btn-md btn-danger">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div>
    </div>
</div>