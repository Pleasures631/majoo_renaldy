<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<head>
	<meta charset="utf-8">
	<title>Form Pengisian Data Produk</title>

	<style type="text/css">
		::selection {
			background-color: #E13300;
			color: white;
		}

		::-moz-selection {
			background-color: #E13300;
			color: white;
		}

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
			text-decoration: none;
		}

		a:hover {
			color: #97310e;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
			min-height: 96px;
		}

		p {
			margin: 0 0 10px;
			padding: 0;
		}

		p.footer {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
		}
	</style>
</head>

<body>

	<?php //echo validation_errors('<div class="error">', '</div>'); ?>
	<div id="container">
		<h1>Form Tambah Produk</h1>
		<div id="body">
			<form method="post" id="form-add-product" name="form-add-product" action="<?php echo base_url('Produk/addProduct'); ?>" enctype="multipart/form-data">
				<div class="form-group">
					<label>Nama Produk*</label>
					<input type="text" class="form-control <?php echo form_error('nama_produk') ? "is-invalid" : null?>" id="nama_produk" name="nama_produk" placeholder="Input Nama" value="<?php echo set_value('nama_produk')?>">
					<span class="help-block" style="color:red;"><?php echo form_error('nama_produk')?></span>
				</div>
				<div class="form-group">
					<label>Deskripsi Produk*</label>
					<textarea class="form-control <?php echo form_error('deskripsi_produk') ? "is-invalid" : null?>" id="deskripsi_produk" name="deskripsi_produk" rows="3" value="<?php echo set_value('deskripsi_produk')?>"></textarea>
					<span class="help-block" style="color:red;"><?php echo form_error('deskripsi_produk')?></span>
				</div>
				<div class="form-group">
					<label>Harga Produk*</label>
					<input type="number" class="form-control <?php echo form_error('harga_produk') ? "is-invalid" : null?>" id="harga_produk" name="harga_produk" placeholder="Input Harga Produk" value="<?php echo set_value('harga_produk')?>">
					<span class="help-block" style="color:red;"><?php echo form_error('harga_produk')?></span>
				</div>
				<div class="form-group">
					<label for="type">Kategori*</label>
					<select id="kategori_produk" name="kategori_produk" class="form-control <?php echo form_error('kategori_produk') ? "is-invalid" : null?>">
						<?php foreach ($dataKategori as $data) : ?>
							<option value="<?= $data['category_id']; ?>"><?= $data['category_name']; ?></option>
							<?php endforeach;?>
					</select>
					<script>
						$("#kategori_produk").select2({
							dropdownAutoWidth: true,
							templateResult: formatState
						});
					</script>
					<span class="help-block" style="color:red;"><?php echo form_error('kategori_produk')?></span>
				</div>
				<div class="form-group">
					<label>Upload Gambar*</label>
					<input type="file" class="form-control <?php echo form_error('foto_produk') ? "is-invalid" : null?>" id="foto_produk" name="foto_produk" value="<?php echo set_value('foto_produk')?>">
					<span class="help-block" style="color:red;"><?php echo form_error('foto_produk')?></span>
				</div>
				<input class="btn btn-success" type="submit" name="btn" value="Save"/>
				<a class="btn btn-danger" style="float: right;" href="<?php echo base_url('landing_page'); ?>">Go Back</a>
			</form>

			<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
		</div>
	</div>
</body>

</html>

<script>
	function sendDataProduct() {
		var formName = new FormData(document.getElementById("form-add-product"));
		var answer = confirm('Apakah anda yakin untuk menambahkan produk ini ?');

		if (answer == true) {
			$.ajax({
				type: 'POST',
				dataType: 'JSON',
				url: '<?php echo base_url('Produk/addProduct'); ?>',
				data: formName,
				processData: false,
				contentType: false,
				success: function(response) {
					alert(response.msg)
				},
				error: function(response) {
					alert(response.msg)
				}
			})
		}
	}
</script>