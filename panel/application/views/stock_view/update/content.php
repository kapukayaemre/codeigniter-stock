
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("stock/update/$item->id"); ?>" method="POST">
                

                    <div class="form-group">
                        <label>Stok Kartı</label><br>
                        <select class="form-control" data-plugin="select2" name="product_id" id="product">
                            <option Selected>Seçmek için tıklayınız...</option>
                            <?php foreach ($datas_stockcard as $data) { ?>
                                <?php if ($data->product_id == $item->product_id) { ?>
                                <option selected value="<?php echo $data->product_id; ?>"><?php echo $data->product_title; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $data->product_id; ?>"><?php echo $data->product_title; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Depo</label><br>
                        <select class="form-control" data-plugin="select2" name="warehouse_id" id="warehouse">
                            <option Selected>Seçmek için tıklayınız...</option>
                            <?php foreach ($datas_warehouse as $data) { ?>
                                <?php if ($data->warehouse_id == $item->warehouse_id) { ?>
                                <option selected value="<?php echo $data->warehouse_id; ?>"><?php echo $data->warehouse_name; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $data->warehouse_id; ?>"><?php echo $data->warehouse_name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Raf</label><br>
                        <select class="form-control" data-plugin="select2" name="shelves_id" id="shelves">
                            <option Selected>Seçmek için tıklayınız...</option>
                            <?php foreach ($datas_shelves as $data) { ?>
                                <?php if ($data->shelves_id == $item->shelves_id) { ?>
                                <option selected value="<?php echo $data->shelves_id; ?>"><?php echo $data->shelves_name; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $data->shelves_id; ?>"><?php echo $data->shelves_name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Stok Kayıt Tipi</label>
                        <select class="form-control" data-plugin="select2" name="type" id="type">
                            <?php if($data->type == $item->type) { ?>
                            <option selected value="<?php $item->type; ?>">$item->type;</option>
                            <?php } ?>
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