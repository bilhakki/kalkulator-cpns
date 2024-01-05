fetch("http://ip-api.com/json")
    .then((e) => e.json())
    .then((res) => {
        console.log(res);
    })
    .catch((e) => console.error(e));

async function getData() {
    try {
        const res = await fetch("http://ip-api.com/json/36.82.97.16");
        const data = await res.text();
        console.log(data);
    } catch (error) {
        console.error(error);
    }
}
getData()
async function getData() {
    try {
        const res = await fetch("https://api.ipify.org/?format=json");
        const data = await res.text();
        console.log(data);
    } catch (error) {
        console.error(error);
    }
}
getData()
