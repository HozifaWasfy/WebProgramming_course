
let time, intervalId;


function incrementTime() {
    time++;
    document.getElementById("time").textContent =
            ("0" + Math.trunc(time / 60)).slice(-2) +
            ":" + ("0" + (time % 60)).slice(-2);
}
