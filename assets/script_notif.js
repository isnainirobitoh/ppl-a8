function requestNotificationPermission() {
    if ('Notification' in window) {
        Notification.requestPermission()
            .then(function(permission) {
                console.log('Izin notifikasi:', permission);
            });
    }
}

function scheduleNotification(hour, minute, message) {
    var now = new Date();
    var notificationTime = new Date();
    notificationTime.setHours(hour, minute, 0); // Mengatur waktu notifikasi

    if (notificationTime < now) {
        notificationTime.setDate(notificationTime.getDate() + 1); // Jika waktu notifikasi sudah lewat, mmengatur untuk besok
    }

    var timeUntilNotification = notificationTime - now;

    setTimeout(function() {
        showNotification(message);
        scheduleNotification(hour, minute, message); // Mengatur notifikasi berikutnya pada waktu yang sama
    }, timeUntilNotification);
}

function showNotification(message) {
    if ('Notification' in window && Notification.permission === 'granted') {
        var options = {
            body: message,
            icon: 'images/icon.png'
        };

        var notification = new Notification('Reminder!', options);
    }
}