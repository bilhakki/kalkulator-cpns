const elSkd = document.querySelector(`input[name="skd"]`);
const elSkb = document.querySelector(`input[name="skb"]`);
const elWawancara = document.querySelector(`input[name="wawancara"]`);
const elTpk = document.querySelector(`input[name="tpk"]`);

// Total skor maksimal untuk setiap unit ujian
const skdCatMaxScore = 550;
const skbCatMaxScore = 500;
const wawancaraMaxScore = 100;
const tpkMaxScore = 100;

// Bobot untuk setiap unit ujian
const skdCatWeight = 0.4;
const skbCatWeight = 0.3;
const wawancaraWeight = 0.15;
const tpkWeight = 0.15;

function calculate() {
    // Nilai dari setiap unit ujian
    const skdCatScore = elSkd.value || 0;
    const skbCatScore = elSkb.value || 0;
    const wawancaraScore = elWawancara.value || 0;
    const tpkScore = elTpk.value || 0;



    // Menghitung nilai relatif untuk setiap unit ujian
    const skdCatRelativeScore = (skdCatScore / skdCatMaxScore) * 100;
    const skbCatRelativeScore = (skbCatScore / skbCatMaxScore) * 100;
    const wawancaraRelativeScore = (wawancaraScore / wawancaraMaxScore) * 100;
    const tpkRelativeScore = (tpkScore / tpkMaxScore) * 100;

    // Menghitung total nilai berdasarkan bobot
    const totalScore = (
        skdCatRelativeScore * skdCatWeight +
        skbCatRelativeScore * skbCatWeight +
        wawancaraRelativeScore * wawancaraWeight +
        tpkRelativeScore * tpkWeight
    ).toFixed(2);

    if (skdCatScore && skbCatScore && wawancaraScore && tpkScore) {
        saveValue({
            skdCatScore,
            skbCatScore,
            wawancaraScore,
            tpkScore,
            totalScore
        });
    }

    document.querySelector(`#totalNilai`).innerHTML = totalScore;
}

calculate();
elSkd.addEventListener("keyup", () => {
    calculate();
});
elSkb.addEventListener("keyup", () => {
    calculate();
});
elWawancara.addEventListener("keyup", () => {
    calculate();
});
elTpk.addEventListener("keyup", () => {
    calculate();
});

var fingerprint = localStorage.getItem("fingerprint");
if (!fingerprint) {
    const fpPromise = import(
        "https://fpjscdn.net/v3/alRTWiUQBY2mkQM53KUi"
    ).then((FingerprintJS) =>
        FingerprintJS.load({
            apiKey: "alRTWiUQBY2mkQM53KUi",
            region: "eu",
        })
    );

    // Get the visitor identifier when you need it.
    fpPromise
        .then((fp) => fp.get())
        .then((result) => {
            localStorage.setItem("fingerprint", result.visitorId);
            fingerprint = result.visitorId;
        });
}

async function getDeviceData() {
    try {
        const res = await fetch("http://ip-api.com/json/36.82.97.16");
        const data = await res.json();
        return data
    } catch (error) {
        console.error(error);
    }
}


async function saveValue({
    skdCatScore,
    skbCatScore,
    wawancaraScore,
    tpkScore,
    totalScore
}) {
    if (fingerprint) {
        let device = localStorage.getItem("device")
        if(!device){
            device = await getDeviceData()
            localStorage.setItem("device", JSON.stringify(device))
        }else{
            device = JSON.parse(device)
        }

        await fetch(`/device`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                fingerprint,
                ip: device.query,
                country: device.country,
                regionName: device.regionName,
                city: device.city,
                timezone: device.timezone,
                as: device.as,
                isp: device.isp,
            }),
        });
        const res = await fetch(`/save`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                skd: skdCatScore,
                skb: skbCatScore,
                wawancara: wawancaraScore,
                tpk: tpkScore,
                totalScore,
                fingerprint,
            }),
        });

        // if (res.ok) {
        //     const data = await res.json();
        // }
    }
}
