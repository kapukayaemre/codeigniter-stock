
<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Raf Ekle
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('shelves/save'); ?>" method="POST">

                    <div class="form-group">
                        <label>Raf Adı</label>
                        <input class="form-control" placeholder="Raf Adı" name="shelves_name">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('shelves_name'); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Depo Adı</label><br>
                        <select class="form-control" data-plugin="select2" name="warehouse_id">
                            <option Selected>Seçmek için tıklayınız...</option>
                            <?php foreach ($datas_warehouse as $data) { ?>
                                <option value="<?php echo $data->warehouse_id; ?>"><?php echo $data->warehouse_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success btn-md"><b>Ekle</b></button>
                    <a href="<?php echo base_url('shelves'); ?>" class="btn btn-md btn-danger"><b>İptal</b></a>
                </form>
            </div><!-- .widget-body -->
        </div>
    </div>
</div>