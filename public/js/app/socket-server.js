const IO = io("https://absensi-guru.herokuapp.com");

IO.on("serverLoginSuccess", (datas) => {
    console.log("serverLoginSuccess", datas);

    hasScan(datas);
});

