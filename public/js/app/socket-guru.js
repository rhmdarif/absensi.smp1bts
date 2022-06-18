const IO = io("https://absensi-guru.herokuapp.com");

IO.on("gapp-login-success", (datas) => {
    guruLoginSuccess(datas);
})
