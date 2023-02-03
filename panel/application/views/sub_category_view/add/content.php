<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Alt Kategori Ekle
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('sub_category/save'); ?>" method="POST">
                    
                    <div class="form-group">
                        <label>Alt Kategori Adı</label>
                        <input class="form-control" placeholder="Alt Kategori Adı" name="sub_category_name">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('sub_category_name'); ?></small>
                        <?php } ?>
                    </div>
                        
                    <div class="form-group">
                        <label>Ana Kategorisi</label>      
                            <select class="form-control" data-plugin="select2" name="category_id" >
                                <option selected>Ana Kategori Seçiniz...</option>
                                <?php foreach ($result as $row) { ?>
                                <option value="<?php echo $row->id; ?>"><?php echo $row->category_name; ?></option>
                                <?php } ?>
                            </select>        
					</div>

                    <button type="submit" class="btn btn-success btn-md"><b>Ekle</b></button>
                    <a href="<?php echo base_url('sub_category'); ?>" class="btn btn-md btn-danger"><b>İptal</b></a>
                </form>
            </div><!-- .widget-body -->
        </div>
    </div>
</div>