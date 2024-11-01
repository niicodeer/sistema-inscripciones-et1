function showToast(type, title, message) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    Toast.fire({
        title: title,
        text: message,
        icon: type,
    });
}

function checkSessionAlerts() {
    const successMessage = document.body.dataset.success;
    const errorMessage = document.body.dataset.error;

    if (successMessage) {
        showToast('success', 'Éxito', successMessage);
    }

    if (errorMessage) {
        showToast('error', 'Error', errorMessage);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    checkSessionAlerts();
});
