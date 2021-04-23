const MINUTES = 60;
const HOURS = 60 * MINUTES;
const DAYS = 24 * HOURS;

window.onload = () => {
    const refresh = () => {
        const countdown = document.getElementById("countdown");
        const days = document.getElementById('days');
        const hours = document.getElementById('hours');
        const minutes = document.getElementById('minutes');
        const seconds = document.getElementById('seconds');

        const date =new Date(countdown.dataset.time) / 1000;
        const now = new Date();

        const difference = date - now / 1000;
        const time = {
            days: Math.floor(difference / DAYS ),
            hours: Math.floor(difference % DAYS / HOURS),
            minutes: Math.floor(difference % HOURS / MINUTES),
            seconds: Math.floor(difference % MINUTES)
        }

        days.innerText = time.days;
        hours.innerText = time.hours;
        minutes.innerText = time.minutes;
        seconds.innerText = time.seconds;


        window.setTimeout(() => {
            window.requestAnimationFrame(refresh)
        }, 1000);
    }

    refresh();
}
