var qrcode = new QRCode("qr_code", {
    width: 500,
    height: 500,
    colorDark: "#000000",
    colorLight: "#ffffff",
    correctLevel: QRCode.CorrectLevel.H,
});
// getAbsen();
$(document).ready(() => {
    $("#qr_code").show();

    currentStatus = 1;
    countNoScan = 0;
    initFingerprintJS();
})

$("#btn_on").click(() => {
    $("#btn_off").show();
    $("#btn_on").hide();
    $("#qr_code").show();

    currentStatus = 1;
    countNoScan = 0;
    initFingerprintJS();
});
$("#btn_off").click(() => {
    $("#btn_off").hide();
    $("#btn_on").show();
    $("#qr_code").hide();
    currentStatus = 0;
    localStorage.removeItem("fingerPrint");
});
// $(document).ready(async () => {
//     generate();
//     setInterval(() => {
//         generate();
//     }, 20000);
// });
