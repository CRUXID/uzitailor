<div class="col-sm-4 col-md-4 col-lg-3 mb-3">
    <label class="small text-muted mb-1">Pembeli</label>
    <div class="position-relative">
        <input type="text" name="pembeli" class="form-control form-control-sm" list="datalist2" onchange="changeValue(this.value)" required autofocus>
        <datalist id="datalist2">
            <?php if(mysqli_num_rows($datapembeli)) {?>
                <?php while($row_brg= mysqli_fetch_array($datapembeli)) {?>
                    <option value="<?php echo $row_brg["id_pembeli"]?>"> <?php echo $row_brg["nama_pembeli"]?> </option>
                <?php } ?>
            <?php } ?>
        </datalist>
    </div>
    <div class="col-sm-4 col-md-4 col-lg-3 mb-3">
        <label class="small text-muted mb-1">Tanggal Jadi</label>
        <div class="position-relative">
            <input type="date" name="tgljadi" class="form-control form-control-sm" value="<?=date("Y-m-d");?>" required>
        </div>
    </div>
</div>