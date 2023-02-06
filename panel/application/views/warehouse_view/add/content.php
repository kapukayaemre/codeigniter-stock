
<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Depo Ekle
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('warehouse/save'); ?>" method="POST">

                    <div class="form-group">
                        <label>Depo Adı</label>
                        <input class="form-control" placeholder="Depo Adı" name="warehouse_name">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?php echo form_error('warehouse_name'); ?></small>
                        <?php } ?>
                    </div>


                    <div class="form-group">
                        <label>Şehir</label><br>
                        <select class="form-control" data-plugin="select2" id="city" name="city_id">
                            <option Selected>Seçmek için tıklayınız...</option>
                            <?php foreach ($datas_city as $data) { ?>
                                <option value="<?php echo $data->city_id; ?>"><?php echo $data->city_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                     
                    <div class="form-group">
                        <label>İlçe</label><br>
                        <select class="form-control" data-plugin="select2" id="town" name="town_id">
                            <option Selected>Seçmek için tıklayınız...</option>
                            <?php foreach ($datas_town as $data) { ?>
                                <option value="<?php echo $data->town_id; ?>"><?php echo $data->town_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success btn-md"><b>Ekle</b></button>
                    <a href="<?php echo base_url('warehouse'); ?>" class="btn btn-md btn-danger"><b>İptal</b></a>
                </form>
            </div><!-- .widget-body -->
        </div>
    </div>
</div>