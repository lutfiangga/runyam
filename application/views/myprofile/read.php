<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="mx-2 mt-4 d-flex row">
					<div class="d-flex justify-content-between align-items-center">
						<h1 class="h3 text-capitalize"><strong><?= $sub; ?></strong></h1>
						<div class="button-container">
							<a href="<?= site_url('Myprofile/edit/'.$id_user) ?>" class="btn btn-primary">Edit Profile</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form class="mb-3">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="mb-2" for="nama">Nama</label>
									<input type="text" class="form-control" id="nama" disabled placeholder="nama" value="<?= $nama; ?>">
								</div>
							</div>
							<div class="col-md-12 mt-4">
								<div class="form-group">
									<label class="mb-2" for="username">Username</label>
									<input type="text" class="form-control" id="username" placeholder="Username" value="<?= $username; ?>">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card card-user py-4">
				<div class="d-flex justify-content-center">
					<img src="<?= base_url($foto) ?>" style="border-radius: 5px; background-size: cover;" alt="Profile" width="300vw" height="300vw">
				</div>
			</div>
		</div>
	</div>
</div>
