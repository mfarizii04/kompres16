<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventarizz. - Loading Session</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;900&family=Orbitron:wght@700;900&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('public/') ?>css/veda.css">
</head>
<body>

    <div id="splash-screen">
        <div class="header-box">
            <img width="150" src="<?= base_url("public/") ?>assets/img/skkmigas.png">
            <h1 class="race-title">SELAMAT DATANG DI <strong class="text-success">INVENT</strong><strong class="text-danger">ARIZZ</strong></h1>
            <div class="race-subtitle">Manajemen Aset, Live Audit Trail, Monitoring dan Ticketing Helpdesk Infrastruktur IT</div>
        </div>

        <div class="track-container">
            <!-- Counter Loading dipindah tepat ke tengah atas bar -->
            <div class="loading-counter"><span id="load-pct">0</span>%</div>
            
            <div id="rider" class="motor-rider-box">
                <img src="<?= base_url('public/') ?>assets/img/motor.png" alt="Veda Ega Moto3" class="rider-image-asset">
                <span class="skid-smoke">💨</span>
            </div>
            
            <div class="race-track"></div>
            <div id="progress" class="progress-line"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <?php $this->load->view('veda_js'); ?>

</body>
</html>