<?php //echo "<pre>"; print_r($datas); ?>
<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Ürün Listesi
            <a href="<?php echo base_url('product/new_form'); ?>" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> <b>Yeni Ekle</b></a>
        </h4>
    </div><!-- END column -->

    <div class="col-md-12">
        <div class="widget p-lg">

        <?php if (empty($datas)) { ?>
        <div class="alert alert-info text-center">
                <h5 class="alert-title">Kayıt Bulunamadı</h5>
                <p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a href="<?php echo base_url('product/new_form'); ?>"><strong>tıklayınız.</strong></a></p>
        </div>
        <?php } else { ?>

            <table class="table table-hover table-striped">
                <thead>
                    <th>#</th>
                    <th>Ürün Adı</th>
                    <th>Açıklama</th>
                    <th>Ana Kategorisi</th>
                    <th>Alt Kategorisi</th>
                    <th>Sorumlu</th>
                    <th>Kayıt Tarihi</th>
                    <th>Düzenlenme Tarihi</th>
                    <th>Silinme Tarihi</th>
                    <th>Durumu</th>
                    <th>İşlemler</th>
                </thead>

                <tbody>

                <?php $i = 0;
                 foreach ($datas as $data) {
                    $i++;
                 ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data->title; ?></td>
                        <td><?php echo $data->description; ?></td>
                        <td><?php echo $data->category_name; ?></td>
                        <td><?php echo $data->sub_category_name; ?></td>
                        <td><?php echo $data->full_name; ?></td>
                        <td><?php echo $data->createdAt; ?></td>
                        <td><?php echo $data->updatedAt; ?></td>
                        <td><?php echo $data->deletedAt;?></td>
                        <td>
                            <input
                            data-url = "<?php echo base_url("product/isActiveSetter/$data->id") ?>"
                            class = "isActive"
                            type = "checkbox"
                            data-switchery
                            data-color = "#10c469"
                            <?php echo ($data->isActive) ? 'checked' : '' ?>
                            />
                        </td>
                        <td>
                        <button
                            data-url="<?php echo base_url("product/delete/$data->id"); ?>"
                            class="btn btn-sm btn-danger remove-btn">
                            <i class="fa fa-trash"></i> <b>Sil</b>
                            </button>
                            <a href="<?php echo base_url("product/update_form/$data->id"); ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o"></i><b> Düzenle </b></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php } ?>
        </div><!-- .widget -->
    </div>
</div>