        </div>

        <!-- Footer -->
        <footer>
            <p>&copy; 2026 PKBM Sidandu Indah. Sistem Administrasi Website.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Session Timeout Warning Modal -->
    <div class="modal fade" id="sessionTimeoutModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Peringatan: Session Akan Berakhir</h5>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Session Anda akan berakhir dalam <strong id="countdownTimer">5:00</strong> menit.</p>
                    <p class="mb-0 text-muted small">
                        <i class="bi bi-info-circle"></i> 
                        Anda akan otomatis logout jika tidak ada aktivitas selama <strong>1 jam</strong>, atau jika sudah <strong>5 jam</strong> sejak login.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="logoutNow()">Logout Sekarang</button>
                    <button type="button" class="btn btn-primary" onclick="keepSessionAlive()">Lanjutkan Bekerja</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="notificationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto" id="toastTitle">Notifikasi</strong>
                <small id="toastTime">baru saja</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastMessage">
                Pesan notifikasi akan tampil di sini
            </div>
        </div>
    </div>

    <!-- Confirmation Delete Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle-fill"></i> Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="deleteConfirmMessage">Apakah Anda yakin ingin menghapus item ini?</p>
                    <p class="text-muted small"><i class="bi bi-info-circle"></i> Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()"><i class="bi bi-trash"></i> Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        
        
        const SESSION_ABSOLUTE_TIMEOUT = 18000;       
        const SESSION_INACTIVITY_TIMEOUT = 3600;      
        const WARNING_TIME_BEFORE = 300;              

        let sessionWarningTimer = null;
        let countdownTimer = null;
        let warningShown = false;
        let lastCheckTime = Date.now();
        let inactivityStartTime = Date.now();

        function resetActivityTimer() {
            inactivityStartTime = Date.now(); 
            
            fetch('/pkbm-website/public/admin/update-activity', { method: 'POST' })
                .catch(() => {}); 
            
            if (warningShown) {
                warningShown = false;
                clearInterval(countdownTimer);
                const modal = bootstrap.Modal.getInstance(document.getElementById('sessionTimeoutModal'));
                if (modal) modal.hide();
            }
        }

        document.addEventListener('click', resetActivityTimer);
        document.addEventListener('keypress', resetActivityTimer);
        document.addEventListener('mousemove', resetActivityTimer);
        document.addEventListener('scroll', resetActivityTimer);

        function checkSessionStatus() {
            if (warningShown) {
                return;
            }

            const inactivityTime = (Date.now() - inactivityStartTime) / 1000;
            
            if (inactivityTime >= (SESSION_INACTIVITY_TIMEOUT - WARNING_TIME_BEFORE)) {
                warningShown = true;
                showSessionWarning();
            }
        }

        function showSessionWarning() {
            const modal = new bootstrap.Modal(document.getElementById('sessionTimeoutModal'));
            modal.show();
            
            let timeRemaining = WARNING_TIME_BEFORE;
            
            countdownTimer = setInterval(() => {
                timeRemaining--;
                const minutes = Math.floor(timeRemaining / 60);
                const seconds = timeRemaining % 60;
                document.getElementById('countdownTimer').textContent = 
                    minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
                
                if (timeRemaining <= 0) {
                    clearInterval(countdownTimer);
                    logoutNow();
                }
            }, 1000);
        }

        function keepSessionAlive() {
            fetch('/pkbm-website/public/admin/update-activity', { method: 'POST' });
            const modal = bootstrap.Modal.getInstance(document.getElementById('sessionTimeoutModal'));
            modal.hide();
            warningShown = false;
            inactivityStartTime = Date.now();  
            clearInterval(countdownTimer);
        }

        function logoutNow() {
            window.location.href = '/pkbm-website/public/admin/logout';
        }

        document.addEventListener('DOMContentLoaded', function() {
            inactivityStartTime = Date.now();
            setInterval(checkSessionStatus, 5000);
            
            const currentUrl = window.location.pathname;
            const menuLinks = document.querySelectorAll('.sidebar-menu a');
            menuLinks.forEach(link => {
                link.classList.remove('active');
                if (currentUrl.includes(link.getAttribute('href').split('/').pop())) {
                    link.classList.add('active');
                }
            });
        });

        function showNotification(title, message, type = 'info', duration = 5000) {
            const toast = document.getElementById('notificationToast');
            const toastHeader = toast.querySelector('.toast-header');
            const toastTitle = document.getElementById('toastTitle');
            const toastMessage = document.getElementById('toastMessage');
            
            toastTitle.textContent = title;
            toastMessage.textContent = message;
            
            toastHeader.classList.remove('bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'text-white');
            
            switch(type) {
                case 'success':
                    toastHeader.classList.add('bg-success', 'text-white');
                    break;
                case 'error':
                case 'danger':
                    toastHeader.classList.add('bg-danger', 'text-white');
                    break;
                case 'warning':
                    toastHeader.classList.add('bg-warning', 'text-dark');
                    break;
                case 'info':
                default:
                    toastHeader.classList.add('bg-info', 'text-white');
                    break;
            }
            
            const bsToast = new bootstrap.Toast(toast, { delay: duration });
            bsToast.show();
        }

        function notifySuccess(title, message) {
            showNotification(title, message, 'success', 4000);
        }

        function notifyError(title, message) {
            showNotification(title, message, 'error', 5000);
        }

        function notifyWarning(title, message) {
            showNotification(title, message, 'warning', 4000);
        }

        function notifyInfo(title, message) {
            showNotification(title, message, 'info', 3000);
        }

        window.addEventListener('load', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const notification = urlParams.get('notification');
            const notifType = urlParams.get('type') || 'info';
            const notifMessage = urlParams.get('message') || '';
            
            if (notification) {
                showNotification(notification, notifMessage, notifType);
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });

        let pendingDeleteUrl = null;

        function showDeleteConfirm(url, message) {
            pendingDeleteUrl = url;
            document.getElementById('deleteConfirmMessage').textContent = message;
            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            modal.show();
        }

        function confirmDelete() {
            if (pendingDeleteUrl) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal'));
                modal.hide();
                
                window.location.href = pendingDeleteUrl;
            }
        }
    </script>
</body>
</html>
