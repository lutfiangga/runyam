<form action="<?php echo site_url('Myprofile/update/' . $edit->id_user) ?>" method="post" enctype="multipart/form-data">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="mx-2 mt-4 d-flex row">
						<div class="d-flex justify-content-between align-items-center">
							<h1 class="h3 text-capitalize"><strong><?= $sub; ?></strong></h1>
							<div class="button-container gap-2">
								<a href="<?= site_url('Myprofile') ?>" class="btn btn-danger">Batal</a>
								<button type="submit" name="button" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<input type="hidden" name="id_user" value="<?= $edit->id_user; ?>">
							<input type="hidden" name="img_user_current" value="<?= $edit->img_user; ?>">
							<div class="col-md-12">
								<div class="form-group">
									<label class="mb-2" for="nama">Nama</label>
									<input type="text" class="form-control" id="nama" name="nama" placeholder="nama" value="<?= $edit->nama ?>">
								</div>
							</div>
							<?php if ($this->session->flashdata('username_error')) : ?>
								<div class="text-danger mt-2">
									Username Sudah digunakan
								</div>
							<?php endif; ?>
							<div class="col-md-12 mt-4">
								<div class="form-group">
									<label class="mb-2" for="username">Username</label>
									<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $edit->username ?>">
								</div>
							</div>
							<div class="col-md-12 mt-4">
								<div class="form-group">
									<label class="mb-2" for="password">Password</label>
									<input type="text" class="form-control" id="password" name="password" placeholder="password" value="<?= $edit->password ?>">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card card-user py-4">
					<div class="d-flex justify-content-center">
						<img src="<?= base_url('assets/img/photos/' . $edit->img_user) ?>" style="border-radius: 5px; background-size: cover;" alt="Profile" width="300vw" height="300vw">
					</div>
					<div class="mt-3 mx-4">
						<label class="form-label">Ubah Foto Profile</label>
						<div class="input-group mb-3">
							<input type="file" name="img_user" class="form-control" id="inputGroupFile02">
							<label class="input-group-text" for="inputGroupFile02">Upload</label>
						</div>
					</div>
					<div class="mt-3 mx-4">
						<!-- Tambahkan elemen untuk menampilkan nama file -->
						<label class="form-label">Nama File</label>
						<input type="text" value="<?= $edit->img_user ?>" id="file-name" class="form-control" readonly disabled>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
