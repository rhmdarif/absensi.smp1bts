var lastQR = "";
var canScan = true;
const socket = io("https://absensi-guru.herokuapp.com");
console.log(TEACHER_ID)

socket.on("guruHasVerified", (val) => {
    console.log(val)
    DIALOG_SUCCESS.modal('hide');
    DIALOG_DANGER.modal('hide');
    DIALOG_INFO.modal('hide');
    if (val.teacher_id == TEACHER_ID) {

        DIALOG_SUCCESS.find('.modal-body').text("Terimakasih telah mengambil absensi..");
        DIALOG_SUCCESS.modal('show');
        setTimeout(() => {
            location.reload()
        }, 1000);
    }
})

socket.on("guruinvalidToken", (val) => {
    console.log(val);
    DIALOG_SUCCESS.modal('hide');
    DIALOG_DANGER.modal('hide');
    DIALOG_INFO.modal('hide');
    if (val.teacher_id == TEACHER_ID) {

        DIALOG_DANGER.find('.modal-body').text("Qr Code tidak valid/kadaluarsa");
        DIALOG_DANGER.modal('show');
        setTimeout(() => {
            canScan = true;
        }, 1000);
    }
})

socket.on("guruHasFail", (val) => {
    console.log(val);
    DIALOG_SUCCESS.modal('hide');
    DIALOG_DANGER.modal('hide');
    DIALOG_INFO.modal('hide');
    if (val.teacher_id == TEACHER_ID) {
        DIALOG_DANGER.find('.modal-body').text(val.msg);
        DIALOG_DANGER.modal('show');
        setTimeout(() => {
            canScan = true;
        }, 1000);
    }
})

function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    console.log(`Scan result: ${decodedText}`, decodedResult);
}

function onScanError(errorMessage) {
    // handle on error condition, with error message
}

var html5QrcodeScanner = new Html5QrcodeScanner( "qr-reader", { fps: 10, qrbox: 250 });



const html5QrCode = new Html5Qrcode("qr-reader");
const qrCodeSuccessCallback = (message) => {
    console.log(absen_id)
    DIALOG_SUCCESS.modal('hide');
    DIALOG_DANGER.modal('hide');
    DIALOG_INFO.modal('hide');
    if(canScan) {
        canScan = false;
        console.log('ada nggak?');

        fetch("/teacher/absensi/scan?qrCode="+message+"&absen_id="+absen_id)
            .then(res => res.json())
            .then(json => {
                console.log(json)
                if(json.status) {
                    socket.emit('loginSuccess', json)
                    $("#actionSheetContent").modal('hide');
                    DIALOG_INFO.find('.modal-body').text("Absensi sedang diperiksa");
                    DIALOG_INFO.modal('show');
                } else {
                    DIALOG_DANGER.find('.modal-body').text(json.msg);
                    DIALOG_DANGER.modal('show');
                    setTimeout(() => {
                        canScan = true;
                    }, 1000);
                }
            });

    }

}


const config = { fps: 10, qrbox: 150, aspectRatio: .95 };

// If you want to prefer back camera
$(document).ready(() => {
    //triggered when modal is about to be shown
    $("#actionSheetContent").on("show.bs.modal", function (e) {
        html5QrcodeScanner.start({ facingMode: "environment" }, config, qrCodeSuccessCallback);
        // html5QrcodeScanner.render(onScanSuccess, onScanError);
    });
    $("#actionSheetContent").on("hide.bs.modal", function (e) {
        html5QrcodeScanner.stop().then((ignore) => {
            // QR Code scanning is stopped.
        }).catch((err) => {
            // Stop failed, handle it.
            location.reload();
        });
    });
})
