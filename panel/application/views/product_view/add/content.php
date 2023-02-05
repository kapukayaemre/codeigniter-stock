<?php //echo "<pre>"; print_r($datas_sub_category); ?>
<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Ürün Ekle
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('product/save'); ?>" method="POST">

                    <div class="form-group">
                        <label>Ürün Adı</label>
                        <input class="form-control" placeholder="Ürün Adı" name="title">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('title'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Ana Kategorisi</label><br>
                        <select class="form-control" data-plugin="select2" id="category" onchange="get_subcategory()" name="category_id">
                            <option Selected>Seçmek için tıklayınız...</option>
                            <?php foreach ($datas_main_category as $data) { ?>
                                <option value="<?php echo $data->category_id; ?>"><?php echo $data->category_name; ?></option>
                            <?php } ?>
                        </select>
                        <!-- END column -->
                    </div>
                    
                    <div class="form-group">
                        <label>Alt Kategorisi</label><br>
                        <select class="form-control" data-plugin="select2" id="sub_category" name="sub_category_id">
                            <option Selected>Seçmek için tıklayınız...</option>
                            <?php foreach ($datas_sub_category as $data) { ?>
                                <option value="<?php echo $data->sub_category_id; ?>"><?php echo $data->sub_category_name; ?></option>
                            <?php } ?>
                        </select>
                        <!-- END column -->
                    </div>

                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-md"><b>Ekle</b></button>
                    <a href="<?php echo base_url('product'); ?>" class="btn btn-md btn-danger"><b>İptal</b></a>
                </form>
                <script>
                    function get_subcategory() {
                        var category = $(#category).val(); 
                    }
                </script>
            </div><!-- .widget-body -->
        </div>
    </div>
</div>