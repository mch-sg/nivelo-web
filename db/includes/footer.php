

</body>
<script src="scripts/script.js"></script>

<script>
    window.addEventListener('load', function() {
        setTimeout(() => {
        document.querySelector('.loader').classList.add('loader--hidden');
        }, 00)

        document.querySelector('.loader').addEventListener('transitionend', function() {
            document.querySelector('.loader').style.display = 'none';
        })
    });
</script> 
</html>