                                        
                                            <div class="mb-3">
                                                <label class="small mb-1">Akun Server</label>
                                                <select class="form-select" name="id_akun" id="id_akun" aria-label="Default select example">
                                                    <?php
                                                    foreach ($acc->result() as $gbAcc) :
                                                    ?>
                                                    <option value="<?= $gbAcc->account_id ?>"><?= $gbAcc->username ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                    
                                            <div class="mb-3">
                                                <label class="small mb-1">Sistem Operasi</label>
                                                <select class="form-select" name="id_os" id="id_os" aria-label="Default select example">
                                                    <?php
                                                    foreach ($os->result() as $gbOS) :
                                                    ?>
                                                    <option value="<?= $gbOS->os_id ?>"><?= $gbOS->os_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="small mb-1">Jenis Database</label>
                                                <select class="form-select" name="id_db" id="id_db" aria-label="Default select example">
                                                    <?php
                                                    foreach ($db->result() as $gbDB) :
                                                    ?>
                                                    <option value="<?= $gbDB->db_id ?>"><?= $gbDB->db_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>