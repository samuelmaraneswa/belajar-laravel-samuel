window.notifySuccess = function (message, options = {}) {
  Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: message,
    timer: options.timer ?? 1500,
    showConfirmButton: false,
    ...options,
  });
};

window.notifyError = function (message, options = {}) {
  Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: message,
    ...options,
  });
};

window.notifyConfirm = function ({
  title = 'Yakin?',
  text = 'Data ini akan diproses',
  confirmText = 'Ya',
  cancelText = 'Batal',
}) {
  return Swal.fire({
    icon: 'warning',
    title,
    text,
    showCancelButton: true,
    confirmButtonText: confirmText,
    cancelButtonText: cancelText,
  });
};
