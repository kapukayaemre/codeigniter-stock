
<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<b>$item->sub_category_name</b> Kaydını Düzenliyorsunuz..."; ?>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("sub_category/update/$item->id"); ?>" method="POST">
                    
                    <div class="form-group">
                        <label>Ana Kategorisi</label><br>
                        <select class="form-control" data-plugin="select2" name="category_id">
                            
                            <?php foreach ($datas_main_category as $data) { ?>
                                <?php if ($data->category_id == $item->category_id) { ?>
                                    <option selected value="<?php echo $data->category_id; ?>"><?php echo $data->category_name; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $data->category_id; ?>"><?php echo $data->category_name; ?></option>
                                <?php } ?>
                            <?php } ?> 
                                   
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Alt Kategori Adı</label>
                        <input class="form-control" placeholder="Alt Kategori Adı" name="sub_category_name" value="<?php echo $item->sub_category_name; ?>">
                        <?php if(isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('sub_category_name'); ?></small>
                        <?php } ?>
                    </div>
     
                    <button type="submit" class="btn btn-success btn-md">Güncelle</button>
                    <a href="<?php echo base_url('sub_category'); ?>" class="btn btn-md btn-danger">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div>
    </div>
</div>