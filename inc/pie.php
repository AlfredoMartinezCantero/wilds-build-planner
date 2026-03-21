<footer>
    <span id="footer-text">MH Wilds Builder © 2026</span>

    <div id="rathalos-easter">
        <img src="../front/img/rathalos.png" alt="Rathalos" class="ratha-img">
    </div>
</footer>

<script>
    (function() {
        const footerText = document.getElementById('footer-text');
        const ratha = document.getElementById('rathalos-easter');
        if (!footerText || !ratha) return;

        let clickCount = 0;
        let timer = null;

        footerText.addEventListener('click', () => {
            clickCount++;

            // Resetea el contador si pasa demasiado tiempo entre clicks
            if (timer) clearTimeout(timer);
            timer = setTimeout(() => { clickCount = 0; }, 1500);

            if (clickCount >= 3) {
                clickCount = 0;
                ratha.classList.add('show');

                // Ocultar después de unos segundos
                setTimeout(() => {
                    ratha.classList.remove('show');
                }, 4000);
            }
        });
    })();
</script>