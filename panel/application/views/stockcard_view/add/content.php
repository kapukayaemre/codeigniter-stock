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

                    <div class="form-group">
                        <label>Ana Kategorisi</label><br>
                        <select class="form-control" data-plugin="select2" name="category_id">
                            <option Selected>Seçmek için tıklayınız...</option>
                            <?php foreach ($datas_main_category as $data) { ?>
                                <option value="<?php echo $data->category_id; ?>"><?php echo $data->category_name; ?></option>
                            <?php } ?>
                        </select>
                        <!-- END column -->
                    </div>

                    <div class="form-group">
                        <label>Alt Kategorisi</label><br>
                        <select class="form-control" data-plugin="select2" name="sub_category_id">
                            <option Selected>Seçmek için tıklayınız...</option>
                            <?php foreach ($datas_sub_category as $data) { ?>
                                <option value="<?php echo $data->sub_category_id; ?>"><?php echo $data->sub_category_name; ?></option>
                            <?php } ?>
                        </select>
                        <!-- END column -->
                    </div>

                    <div class="form-group">
                        <label>Ürün</label><br>
                        <select class="form-control" data-plugin="select2" name="product_id">
                            <option Selected>Seçmek için tıklayınız...</option>
                            <?php foreach ($datas_product as $data) { ?>
                                <option value="<?php echo $data->product_id; ?>"><?php echo $data->product_name; ?></option>
                            <?php } ?>
                        </select>
                        <!-- END column -->
                    </div>

                    <button type="submit" class="btn btn-success btn-md"><b>Ekle</b></button>
                    <a href="<?php echo base_url('stockcard'); ?>" class="btn btn-md btn-danger"><b>İptal</b></a>
                </form>
            </div><!-- .widget-body -->
        </div>
    </div>
</div>