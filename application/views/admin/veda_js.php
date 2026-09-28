<script type="text/javascript">
    
    $(document).ready(function() {
        let progress = 0;
        const $rider = $('#rider');
        const $progress = $('#progress');
        const $loadPct = $('#load-pct');

        // --- AUDIO ENGINE
        const raceAudio = new Audio('https://www.myinstants.com/media/sounds/motor-sesi.mp3');
        raceAudio.volume = 0.4;

        $(document).one('click startengine', function() {
            if(progress < 100) raceAudio.play().catch(e => console.log("Audio play diblokir oleh browser!"));
        });
        setTimeout(() => { $(document).trigger('startengine'); }, 150);

        // TIMING ENGINE LOADING BAR
        const loadingInterval = setInterval(function() {
            progress += Math.floor(Math.random() * 3) + 2; 
            
            if (progress >= 100) {
                progress = 100;
                clearInterval(loadingInterval);
                
                $progress.css('width', progress + '%');
                $rider.css('left', progress + '%');
                $loadPct.text(progress);

                executeGridExit();
            } else {
                $progress.css('width', progress + '%');
                $rider.css('left', progress + '%');
                $loadPct.text(progress);

                if (progress > 30 && progress < 82) {
                    $rider.addClass('drifting');
                } else {
                    $rider.removeClass('drifting');
                }
            }
        }, 75);

        // --- REDIRECT LOGIC ---
        function executeGridExit() {
            $rider.removeClass('drifting');

            setTimeout(function() {
                // Motor melesat keluar memotong pembatas layar kanan
                $rider.css({
                    'left': '160%',
                    'transition': 'left 0.45s cubic-bezier(0.42, 0, 0.58, 1)'
                });

                setTimeout(function() {
                    $('#splash-screen').animate({
                        opacity: 0
                    }, 400, function() {
                        // REDIRECT MANAGEMENT SYSTEM
                        <?php if($this->session->userdata("admin")){ ?>
                        window.location.href = "<?= base_url('admin/dashboard') ?>";
                        <?php } else { ?>
                        window.location.href = "<?= base_url() ?>";
                        <?php } ?>
                    });
                }, 300);

            }, 200);
        }
    });
    
</script>