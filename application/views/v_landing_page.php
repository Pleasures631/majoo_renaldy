<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style>
    #container {
        border: 1px solid #D0D0D0;
        box-shadow: 0 0 8px #D0D0D0;
    }
</style>
<nav class="navbar navbar-light bg-dark">
    <a class="navbar-brand" href="#" style="color: white;">
        Mini Apps
    </a>
</nav>
<div id="container">
    <h1 class="ml-5 mt-2"style="text-align: left;">Produk</h1>
    <a class="btn btn-success mr-5" style="float:right"href="<?php echo base_url('produk/index'); ?>">Tambah Data Produk</a>

    <?php if (sizeof($allData) > 0) { ?>
        <?php
        $number = 1;
        $numberOfColumn = 4;
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numberOfColumn;
        $arrayCount = count($allData);
        ?>
        <div class="row m-5">
            <?php
            foreach ($allData as $data) { ?>
                <div class="col-md-<?php echo $bootstrapColWidth ?> border border-dark p-5">
                    <div style="text-align: center;"><img style="width: 230px;" src="<?php echo base_url() . 'upload/' . $data['product_pict']; ?>" /></div>
                    <div style="text-align: center;"><?php echo $data['product_name'] ?></div>
                    <div style="text-align: center; font-weight:bold"><?php echo number_format($data['product_amount'], 2, ",", ".") ?></div>
                    <div style="text-align: center;"><?php echo $data['product_desc'] ?></div>
                    <div style="text-align: center;">
                        <a class="btn btn-primary" href='<?php echo base_url('produk/edit?id='); ?><?php echo $data["product_detail_id"] ?>'>Edit Data Produk</a>
                        <a class="btn btn-danger" href='<?php echo base_url('landing_page/deletedata?id='); ?><?php echo $data["product_detail_id"] ?>'>Hapus Data Produk</a>
                    </div>
                </div>

            <?php
                $rowCount++;
                if ($rowCount % $numberOfColumn == 0 && $rowCount < $arrayCount) {
                    echo '</div><div class="row p-5">';
                }
            }
            ?>

            <?php
            $number++;
            ?>

            </table>
        <?php } else { ?>
            <tr>
                <td>Data Empty</td>
            </tr>
        <?php } ?>
        </div>


        <!-- <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga Produk</th>
            <th>Produk Deskripsi</th>
            <th>Kategori Produk</th>
            <th>Gambar Produk</th>
            <th>Action</th>
        </tr>

        <?php if (sizeof($allData) > 0) { ?>
        <?php
            $number = 1;
            foreach ($allData as $data) { ?>
            <tr>
                <td><?php echo $number ?></td>
                <td><?php echo $data['product_name'] ?></td>
                <td><?php echo number_format($data['product_amount'], 2, ",", ".") ?></td>
                <td><?php echo $data['product_desc'] ?></td>
                <td><?php echo $data['category_name'] ?></td>
                <td><img style="width: 300px;"src="<?php echo base_url() . 'upload/' . $data['product_pict']; ?>" /></td>
                <td>
                    <a class="btn btn-primary" href='<?php echo base_url('produk/edit?id='); ?><?php echo $data["product_detail_id"] ?>'>Edit Data Produk</a>
                    <a class="btn btn-danger" href='<?php echo base_url('landing_page/deletedata?id='); ?><?php echo $data["product_detail_id"] ?>'>Hapus Data Produk</a>
                </td>
            </tr>

        <?php
                $number++;
            }
        ?>
  
    </table>
    <?php } else { ?>
            <tr>
                <td>Data Empty</td>
            </tr>
            <?php } ?>       -->

</div>