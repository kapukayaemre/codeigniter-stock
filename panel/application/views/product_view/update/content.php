<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<b>$item->title</b> Kaydını Düzenliyorsunuz..."; ?>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("product/update/$item->id"); ?>" method="POST">

                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" placeholder="Başlık" name="title" value="<?php echo $item->title; ?>">
                        <?php if(isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('title'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Ana Kategorisi</label><br>
                        <select class="form-control" data-plugin="select2" name="category_id">
                            <option >Seçmek için tıklayınız...</option>
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
                        <label>Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                            <?php echo $item->description; ?>
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-md">Güncelle</button>
                    <a href="<?php echo base_url('product'); ?>" class="btn btn-md btn-danger">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div>
    </div>
</div>