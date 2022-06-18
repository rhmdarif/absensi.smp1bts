const IO = io("https://absensi-guru.herokuapp.com");
var fingerprintId;
var currentStatus = 0;
var countNoScan = 0;

IO.on("serverLoginSuccess", (datas) => {
    console.log("serverLoginSuccess", datas);
    hasScan(datas);
});

function generateRandomString(length = 6) {
    return Math.random().toString(20).substr(2, length);
};

function generate() {
    if (typeof Storage !== "undefined") {
        // Store
        if (checkAuth()) {
            let Qr = generateRandomString(20);
            localStorage.setItem("qrCode", Qr);

            qrcode.clear();
            qrcode.makeCode(localStorage.getItem("qrCode"));

            setTimeout(() => {
                if (currentStatus == 1) {
                    // UNCOMMENT KODE DIBAWAH JIKA TOMBOL POWER DINYALAKAN
                    // if (countNoScan >= 10) {
                    //     $("#btn_off").click();
                    // } else {
                        getAbsen();
                        generate();
                        countNoScan++;
                    // }
                }
            }, 20000);
        } else {
            proccessChecking();
        }
    } else {
        document.getElementById("result").innerHTML =
            "Sorry, your browser does not support Web Storage...";
    }
}

function initFingerprintJS() {
    // Initialize an agent at application startup.
    const fpPromise = FingerprintJS.load();

    // Get the visitor identifier when you need it.
    fpPromise
        .then((fp) => fp.get())
        .then((result) => {
            // This is the visitor identifier:
            fingerprintId = result.visitorId;
            generate();
            console.log(fingerprintId)
        });
}

function checkAuth() {

    if (typeof Storage !== "undefined" && localStorage.getItem("fingerPrint")) {
        if (localStorage.getItem("fingerPrint") == fingerprintId) {
            return true;
        }
        return false;
    } else {
        return false;
    }
}

function proccessChecking() {
    console.log(fingerprintId);
    fetch("/server/validation/komputer", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
        },
        body: JSON.stringify({
            fingerprint: fingerprintId,
        })
    }).then(res => res.json())
        .then(json => {
            if (json.status) {
                localStorage.setItem("fingerPrint", fingerprintId);
                Swal.fire("Horee!", "Server telah aktif", "success").then(generate);
            } else {
                Swal.fire("Oops!", json.msg, 'error').then(generate)
            }
        })
}

function hasScan(datas) {
    console.log("USER QR", datas.qr_code);
    console.log("SERVER QR",datas.qr_code);
    if (datas.qr_code == localStorage.getItem("qrCode")) {
        let photo = takepicture();

        fetch("/server/validation", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
            },
            body: JSON.stringify({
                photo: photo,
                absen_id: datas.absen_id,
                teacher_id: datas.teacher_id,
                qr_code: datas.qr_code,
                fingerprint: fingerprintId
            }),
        })
            .then((res) => res.json())
            .then((json) => {
                console.log(json);
                if (json.status) {
                    IO.emit("hasVerifiedLogin", {
                        teacher_id: datas.teacher_id,
                    });
                    Swal.fire({
                        icon: "success",
                        title: "Login Berhasil!",
                        text: json.msg,
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        currentStatus = 1;
                        generate();
                    });
                } else {
                    IO.emit("hasFailLogin", {
                        msg: json.msg,
                        teacher_id: datas.teacher_id,
                    });
                    Swal.fire("Gagal!", json.msg, "error").then(() => {
                        currentStatus = 1;
                        generate();
                    });
                }
            });
    }
}

function getAbsen() {
    fetch("/server/get-absen").then(res => res.json())
        .then(json => {
            let html = "";

            if (json.length > 0) {
                json.forEach((e) => {
                    html += `<option value="${e.id}">${e.name}</option>`;
                });
            } else {
                html += `<option value="">Tidak Ada Absen Hari Ini</option>`;
            }

            $('#absensi').html(html);
        });
}
