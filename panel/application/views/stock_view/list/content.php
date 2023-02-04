
<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Stok Listesi
            <a href="<?php echo base_url('stock/new_form'); ?>" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> <b>Yeni Ekle</b></a>
        </h4>
    </div><!-- END column -->

    <div class="col-md-12">
        <div class="widget p-lg">

        <?php if (empty($datas)) { ?>
        <div class="alert alert-info text-center">
                <h5 class="alert-title">Kayıt Bulunamadı</h5>
                <p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a href="<?php echo base_url('stock/new_form'); ?>"><strong>tıklayınız.</strong></a></p>
        </div>
        <?php } else { ?>

            <table class="table table-hover table-striped">
                <thead>
                    <th>#</th>
                    <th>Stok Kart</th>
                    <th>Depo</th>
                    <th>Raf</th>
                    <th>Tip</th>
                    <th>Adet</th>
                    <th>Sorumlu</th>
                    <th>Açıklama</th>
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
                        <td><?php echo $data->stockcard_title; ?></td>
                        <td><?php echo $data->warehouse_name; ?></td>
                        <td><?php echo $data->shelves_name; ?></td>
                        <td><?php echo ($data->type === 'in') ? 'Giriş' : 'Çıkış';?></td>
                        <td><?php echo $data->total;?></td>
                        <td><?php echo $data->full_name;?></td>
                        <td><?php echo $data->description;?></td>
                        <td><?php echo $data->createdAt;?></td>
                        <td><?php echo $data->updatedAt;?></td>
                        <td><?php echo $data->deletedAt;?></td>
                        <td>
                            <input
                            data-url = "<?php echo base_url("stock/isActiveSetter/$data->id") ?>"
                            class = "isActive"
                            type = "checkbox" 
                            data-switchery 
                            data-color = "#10c469" 
                            <?php echo ($data->isActive) ? 'checked' : '' ?>
                            />
                        </td>
                        <td>
                        <button
                            data-url="<?php echo base_url("stock/delete/$data->id"); ?>"
                            class="btn btn-sm btn-danger remove-btn">
                            <i class="fa fa-trash"></i> <b>Sil</b>
                            </button>
                            <a href="<?php echo base_url("stock/update_form/$data->id"); ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o"></i><b> Düzenle </b></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php } ?>
        </div><!-- .widget -->
    </div>
</div>