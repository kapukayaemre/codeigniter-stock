<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Raf Listesi
            <a href="<?php echo base_url('shelves/new_form'); ?>" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> <b>Yeni Ekle</b></a>
        </h4>
    </div><!-- END column -->

    <div class="col-md-12">
        <div class="widget p-lg">

        <?php if (empty($items)) { ?>
        <div class="alert alert-info text-center">
                <h5 class="alert-title">Kayıt Bulunamadı</h5>
                <p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a href="<?php echo base_url('shelves/new_form'); ?>"><strong>tıklayınız.</strong></a></p>
        </div>
        <?php } else { ?>

            <table class="table table-hover table-striped">
                <thead>
                    <th>#</th>
                    <th>Raf Adı</th>
                    <th>İlgili Depo Adı</th>
                    <th>Ürün Adı</th>
                    <th>Sorumlu</th>
                    <th>Kayıt Tarihi</th>
                    <th>Düzenlenme Tarihi</th>
                    <th>Silinme Tarihi</th>
                    <th>Durumu</th>
                    <th>İşlemler</th>
                </thead>

                <tbody>
                
                <?php $i = 0;
                 foreach ($items as $item) {
                    $i++;
                 ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $item->shelves_name; ?></td>
                        <td><?php echo $item->warehouse_id; ?></td>
                        <td><?php echo $item->product_id; ?></td>
                        <td><?php echo $item->user_id; ?></td>
                        <td><?php echo $item->createdAt; ?></td>
                        <td><?php echo $item->updatedAt; ?></td>
                        <td><?php echo $item->deletedAt;?></td>
                        <td>
                            <input
                            data-url = "<?php echo base_url("shelves/isActiveSetter/$item->id") ?>"
                            class = "isActive"
                            type = "checkbox" 
                            data-switchery 
                            data-color = "#10c469" 
                            <?php echo ($item->isActive) ? 'checked' : '' ?>
                            />
                        </td>
                        <td>
                        <button
                            data-url="<?php echo base_url("shelves/delete/$item->id"); ?>"
                            class="btn btn-sm btn-danger remove-btn">
                            <i class="fa fa-trash"></i> <b>Sil</b>
                            </button>
                            <a href="<?php echo base_url("shelves/update_form/$item->id"); ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o"></i><b> Düzenle </b></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php } ?>
        </div><!-- .widget -->
    </div>
</div>