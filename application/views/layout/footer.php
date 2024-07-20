 <!-- Modal Logout -->
 <div class="modal fade" id="confirmLogout<?= $id_user; ?>" tabindex="-1" aria-labelledby="confirmLogoutLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content" style="max-width: 30%; border-radius: 10px;">
             <div class="modal-header  d-flex justify-content-center">
                 <h5 class="modal-title fw-bold fs-3 mb-3" id="confirmLogoutLabel">Konfirmasi Keluar</h5>
             </div>
             <div class="modal-body fw-md fs-4 mb-4  d-flex justify-content-center">
                 Yakin Mau Keluar
             </div>
             <div class="modal-footer mt-4 d-flex justify-content-center gap-2">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                 <a class="btn btn-danger" href="<?= site_url('Auth/logout') ?>">Ya, Keluar</a>
             </div>
         </div>
     </div>
 </div>
 <footer class="footer">
     <div class="container-fluid">
         <div class="row text-muted">
             <div class="col-12 text-center">
                 <p class="mb-0">
                     <a class="text-muted" href="#"><strong>Copyright &copy;Omah Creativa <?= date('Y'); ?>. All Right Reserved</strong></a>
                 </p>
             </div>
         </div>
     </div>
 </footer>