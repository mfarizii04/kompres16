
        <!-- NAVBAR -->
        <?php require "_parts/navbar.php"; ?>

        <!-- KONTEN -->
        <div id="layoutSidenav_content" class="mt-5">
            <main>
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-lg-6 mt-4 d-block">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                                            Dashboard
                                        </h1>
                                        <div class="page-header-subtitle">Haihaii! Selamat Datang di <strong>Inventarizz.</strong>!</div>
                                    </div>
                                    <div class="col-lg-6 mt-4" align="right">
                                        <div class="input-group input-group-joined border-0" style="width: 11.5rem">
                                            <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i>&nbsp; <?= $hari . ", " . $tgl . " " . $bln . " " . $thn ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                <!-- Main page content-->
                <div class="container-xl px-4 mt-n10">
                    <div class="row">
                        <div class="col-xxl-4 col-xl-12 mb-4">
                            <div class="card h-100">
                                <div class="card-body h-100 p-5">
                                    <div class="row align-items-center">
                                        <div class="col-xl-8 col-xxl-12">
                                            <div class="text-center text-xl-start text-xxl-center mb-4 mb-xl-0 mb-xxl-4">
                                                <h1 class="text-primary">Met <?php if($jam >= 03 && $jam < 11){ echo "Pagiii"; } elseif($jam >= 11 && $jam < 15){ echo "Siangg"; } elseif($jam >= 15 && $jam < 18){ echo "Soreee"; } else { echo "Malammm"; } ?>,&nbsp;<b><?= $this->session->userdata("fullname") ?></b>! ✨</h1>
                                                <p class="text-gray-700 mb-0">
                                                    <?php
                                                    if ($jam >= 03 && $jam < 11){
                                                        echo "Utamakan sarapan yaa, bukan harapan!";
                                                    } elseif ($jam >= 11 && $jam < 15){
                                                        echo "Jangan lupaa maksii biar kembali produktif!";
                                                    } elseif ($jam >= 15 && $jam < 18) {
                                                        echo "Hati-hati di jalan yaa. Kamu udah lakuin yang terbaik hari ini kok!";
                                                    } else {
                                                        echo "Jangan lupa istirahat yang cukup supaya besok lebih produktif!";
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-xxl-12 text-center"><img class="img-fluid" src="<?= base_url('public/') ?>assets/img/illustrations/at-work.svg" style="max-width: 26rem" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-6 mb-4">
                            <div class="card card-header-actions h-100">
                                <?php
                                $token   = 'b5c04fc1493ad35d544987267144f79b';
                                $baseUrl = 'https://v-class.gunadarma.ac.id/webservice/rest/server.php';

                                $siteInfoUrl = $baseUrl . "?wstoken=$token&wsfunction=core_webservice_get_site_info&moodlewsrestformat=json";
                                $userInfo = json_decode(file_get_contents($siteInfoUrl));

                                if (isset($userInfo->userid)) {
                                    $userId     = $userInfo->userid;
                                    $coursesUrl = $baseUrl . "?wstoken=$token&wsfunction=core_enrol_get_users_courses&moodlewsrestformat=json&userid=$userId";
                                    $courses    = json_decode(file_get_contents($coursesUrl));
                                    $total      = count($courses);
                                ?>
                                <div class="card-header">
                                    <div class="col-lg-5 d-block"><h3 class="mt-2 page-header-title">Kelas Daringmu 📚</h3></div>
                                        <div class="col-lg-7 text-end"><h6 class="mt-2">Ada <?= number_format($total,0, "", ".") ?> kelas yang kamu enroll</h6></div>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-center text-center">
                                        <?php foreach ($courses as $course): ?>
                                        <div class="col-lg-6 mb-3">
                                            <div style="height: 100%" class="card">
                                                <a class="text-dark" href="<?= base_url("course/" . htmlspecialchars($course->id)) ?>">
                                                    <div class="card-body">
                                                        <?= htmlspecialchars($course->fullname) ?>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <?php endforeach; } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-6 mb-4">
                            <div class="card card-header-actions h-100">
                                <div class="card-header">
                                    <?php
                                    $statusAssignmentsUrl = $baseUrl . "?wstoken=$token&wsfunction=core_webservice_get_site_info&moodlewsrestformat=json";
                                    $userInfo             = json_decode(file_get_contents($statusAssignmentsUrl), true);
                                    $userID               = $userInfo['userid'];

                                    $assignmentsUrl  = $baseUrl . "?wstoken=$token&wsfunction=mod_assign_get_assignments&moodlewsrestformat=json";
                                    $assignmentsData = json_decode(file_get_contents($assignmentsUrl), true);

                                    $belumKumpul = [];

                                    foreach ($assignmentsData['courses'] as $course) {
                                        foreach ($course['assignments'] as $assignment) {
                                            $assignid = $assignment['id'];

                                            $submissionStatusUrl = $baseUrl . "?wstoken=$token&wsfunction=mod_assign_get_submission_status&moodlewsrestformat=json&assignid=$assignid&userid=$userID";
                                            $submissionStatusUrl = json_decode(file_get_contents($submissionStatusUrl), true);

                                            if (isset($submissionStatus['lastattempt']['submission']['status']) &&
                                                $submissionStatus['lastattempt']['submission']['status'] !== 'submitted') {
                                                $belumKumpul[] = [
                                                    'course'     => $course['fullname'],
                                                    'assignment' => $assignment['name'],
                                                    'duedate'    => $assignment['duedate']
                                                ];
                                            }
                                        }
                                    }

                                    if (count($belumKumpul) === 0) {
                                        echo '<span class="text-success">Semua tugas sudah dikumpulkan 🎉</span>';
                                    } else {
                                        echo '<span class="text-danger">Ada ' . $total . ' tugas yang menantiimu~ 💼</span>';
                                    }

                                    ?>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // echo "<h3>Tugas yang Belum Dikumpulkan:</h3>";
                                    if (count($belumKumpul) > 0) {
                                        echo "<ul>";
                                        foreach ($belumKumpul as $tugas) {
                                            echo "<li><strong>{$tugas['assignment']}</strong> - {$tugas['course']} <br> Deadline: " . date('d-m-Y H:i', $tugas['duedate']) . "</li>";
                                        }
                                        echo "</ul>";
                                    } else {
                                        echo '<img width="100%" height="100%" src="' . base_url() . 'public/assets/img/illustrations/404-error.svg">';
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
            <!-- FOOTER -->
            <?php require "_parts/footer.php"; ?>

        </div>