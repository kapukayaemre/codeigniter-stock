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
                        <input class="form-control" placeholder="Depo Adı" name="warehouse_name" id='warehouse' value="<?php echo $item->warehouse_name; ?>">
                        <?php if(isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('warehouse_name'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Şehir</label><br>
                        <select class="form-control" data-plugin="select2" name="city_id" id='city'>        
                            <?php foreach ($datas_city as $data) { ?>
                                <?php if ($data->city_id == $item->city_id) { ?>
                                    <option selected value="<?php echo $data->city_id; ?>"><?php echo $data->city_name; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $data->city_id; ?>"><?php echo $data->city_name; ?></option>
                                <?php } ?>
                            <?php } ?>     
                        </select>
                    </div>
                     
                    <div class="form-group">
                        <label>İlçe</label><br>
                        <select class="form-control" data-plugin="select2" name="town_id" id='town'>        
                            <?php foreach ($datas_town as $data) { ?>
                                <?php if ($data->town_id == $item->town_id) { ?>
                                    <option selected value="<?php echo $data->town_id; ?>"><?php echo $data->town_name; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $data->town_id; ?>"><?php echo $data->town_name; ?></option>
                                <?php } ?>
                            <?php } ?>     
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-success btn-md">Güncelle</button>
                    <a href="<?php echo base_url('warehouse'); ?>" class="btn btn-md btn-danger">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div>
    </div>
</div>