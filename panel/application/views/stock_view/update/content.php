<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("stock/update/$item->id"); ?>" method="POST">

                    <div class="form-group">
                        <label>Stok Kartı</label><br>
                        <select class="form-control" data-plugin="select2" name="stockcard_id">
                            <option selected>Seçmek için tıklayınız...</option>
                            <?php foreach ($datas_stockcard as $data) { ?>
                                <option value="<?php echo $data->stockcard_id; ?>"><?php echo $data->stockcard_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Depo</label><br>
                        <select class="form-control" data-plugin="select2" name="warehouse_id">
                            <option Selected>Seçmek için tıklayınız...</option>
                            <?php foreach ($datas_warehouse as $data) { ?>
                                <option value="<?php echo $data->warehouse_id; ?>"><?php echo $data->warehouse_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Raf</label><br>
                        <select class="form-control" data-plugin="select2" name="shelves_id">
                            <option Selected>Seçmek için tıklayınız...</option>
                            <?php foreach ($datas_shelves as $data) { ?>
                                <option value="<?php echo $data->shelves_id; ?>"><?php echo $data->shelves_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Stok Kayıt Tipi</label>
                        <select class="form-control" data-plugin="select2" name="type">
                            <option selected>Tip Seçiniz</option>
                            <option value="in">Giriş</option>
                            <option value="out">Çıkış</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Stok Adeti</label>
                        <input class="form-control" placeholder="Adet Giriniz" name="total" value="<?php echo $item->total; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('total'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 200}">
                            <?php echo $item->description; ?>
                        </textarea>
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('description'); ?></small>
                        <?php } ?>
                    </div>
                    
                    <button type="submit" class="btn btn-success btn-md">Güncelle</button>
                    <a href="<?php echo base_url('stock'); ?>" class="btn btn-md btn-danger">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div>
    </div>
</div>